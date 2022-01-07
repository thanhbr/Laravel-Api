<?php

namespace App\Http\Controllers;
use Auth;
use App;
use \Throwable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, Redirect};
use Illuminate\Validation\Rule;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

use App\View\Components\{FilterModel};
use App\Traits\{CastRequestTrait};
use App\Models\{Customer, Status, Brand};

class CustomerController extends Controller
{
    use CastRequestTrait;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Customer $customer)
    {
        try {
            $currentUser = Auth::user();
            $action = $request->segment(2);
            $perPage = (int)$request->input('per-page');
            $filter = new FilterModel;
            $newQuery = null;
            $subQuery = Customer::query();
            $colTitle = [
                "no"        => 'STT',
                'code-link' => 'Mã khách hàng',
                'shop'      => 'Cửa hàng',
                'phone'     => 'Điện thoại',
                'origin_id' => 'Nguồn khách hàng',
                'status'    => 'Trạng thái',
                'staff_name'=> 'Nhân viên',
                '_action'   => '<i class="fa fa-cog" aria-hidden="true"></i>',
            ];
            /*setup*/
            $filter->setKey('keyword', $request->input('keyword'))->setKey('phone', $request->input('phone'))
            ->setKey('status_id', $request->input('status_id'));
            $filter->with('status_id', Status::getListKVByPrefix('customer'), $filter->getKey('status_id'), '...');
            /*search by like*/
            if ($filter->hasKey('keyword')) {
                $subQuery->where('customers.code', $filter->getKey('keyword'))
                ->orwhere('customers.name', 'LIKE', '%'. $filter->getKey('keyword').'%')
                ->orwhere('customers.phone', 'LIKE', '%'. $filter->getKey('keyword').'%');
                // ->orwhereHas('brand', function($q) use($filterKeys){
                //     $q->where('name', 'like', '%'. $filterKeys['keyword'].'%');
                // });
            }
            $newQuery = $customer->fromSub($subQuery, 'customers');
            /*filter*/
            if ($filter->hasKey('status_id')) {
                $newQuery->where('customers.status_id', $filter->getKey('status_id'));
            }
            /*set by role*/
            // if ($currentUser->hasRole('customer')) {
            //     $newQuery->whereHas('customer', function($q) use($currentUser){
            //         $q->whereHas('user', function($q2) use($currentUser){
            //             $q2->where('users.id',$currentUser->id);
            //         });
            //     });
            // }
            /*get pagination*/
            $pagination = $newQuery->orderBy('id', 'asc')->paginate($action === 'export' ? $newQuery->count() : $perPage);
            
            $collection = $pagination->getCollection();
            $collection->map(function ($_element, $key) {
                $_element->__set('code-link', ['href' => $_element->route('show'), 'label' => ($_element->name ?? '') . ' ('.($_element->code??'').')']);
                $_element->__set('shop', $_element->shop);
                $_element->__set('status_name', $_element->status->name ?? '');
                /*set action*/
                $_element->__set('_action', ['show' => $_element->route('show'), 'edit' => $_element->route('edit'), 'destroy' => $_element->route('destroy')]);
            });
            /*export list*/
            if ($action === 'export') {
                $customHeading = $colTitle;
                unset($customHeading['_action']);
                foreach ($customHeading as $_attr => $_label) { $customHeading[$_attr] = $_label;}
                return $this->exportList($collection, $customHeading);
            }
            return view('layouts.default')->with(['view' => view('customers.index')->with([
                'filter'        => $filter,
                'pageTitle'     => 'Danh sách khách hàng',
                'colTitle'      => $colTitle,
                'pagination'    => $pagination,
                'dataRows'      => $collection->toArray(),
                'addLink'       => $customer->route('create'),
                'exportLink'    => $customer->route('export'),
            ])]);
        } catch (Throwable $th) {
            logger($th);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Customer $customer)
    {
        try {
            return view('layouts.default')->with(['view' => view('customers.create')->with([
                'pageTitle' => 'Tạo mới sản phẫm ',
                'storeLink' => $customer->route('store'),
            ])]);
        } catch (Throwable $th) {logger($th);}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Customer $customer)
    {
        try {
            $input = $request->all();
            $validator = Validator::make($input, 
                [
                    'code' => ['required','alpha_dash','max:16', Rule::unique($customer->getTable())->ignore($customer->id)],
                    'name' => 'required|max:100|alpha_dash',
                    
                ],
                [
                    'required'  => 'Trường :attribute là bắt buộc',
                    'name.required' => 'Bạn chưa điền tên cửa hàng !',
                    'unique'    => 'Trường :attribute đã tồn tại',
                    'max'       => 'Độ dài tối đa là :max',
                    'alpha_dash'=> 'Ký tự phải là chữ/số/"-"/"_"',
                    'name.alpha_dash'   => 'Tên cửa hàng không bao gồm ký tứ đặc biệt !'
                ]
            );
            if ($validator->fails()) return back()->withErrors($validator)->withInput();
            if ($customer->fill($input)->save()) return back()->with('success', trans('site.created_success'));
            throw new Throwable("Can't save");
        } catch (Throwable $th) {
            logger($th);
            return back()->withInput()->with('failed', trans('site.created_failed'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        try {
            return view('layouts.default')->with(['view' => view('customers.show')->with(compact('customer'))]);
        } catch (Throwable $th) {
            logger($th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        try {
            $storeLink = $customer->route('update');            
            return view('layouts.default')->with(['view' => view('customers.edit')->with(compact('customer', 'storeLink'))]);
        } catch (Throwable $th) {
            logger($th);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        try {
            $input = $request->all();
            $validator = Validator::make($input,
                [
                    // 'code' => ['required','alpha_dash','max:16',Rule::unique($customer->getTable())->ignore($customer->id)],
                    'name' => 'required|max:100|min:10',
                ], 
                [
                    'required'  => 'Trường :attribute là bắt buộc',
                    'unique'    => 'Trường :attribute đã tồn tại',
                    'max'       => 'Độ dài tối đa là :max',
                    'name.min'  => 'Tối thiểu :min ký tự',
                    'alpha_dash'=> 'Ký tự phải là chữ/số/"-"/"_"'
                ]
            );
            if ($validator->fails()) return back()->withErrors($validator)->withInput();
            /**/
            if ($customer->fill($input)->save()) return back()->with('success', trans('titles.updated_success')); 
            throw new Throwable("Can't save");
        } catch (Throwable $th) {
            logger($th);
            return back()->withInput()->with('failed', trans('titles.created_failed'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        try {
            if ($customer->delete()) return Response(__('titles.deleted_success'), 301);
            return Response(__('titles.deleted_success'), 302);
        } catch (Throwable $th) {logger($th);}
    }
    /**
     * @author toannguyen.dev
     * @todo export the list to excel
     * @param Collection $collection
     * @param Array $customHeading
     * @return xlsl file
     * @var 
    */
    public function exportList($collection = [], $customHeading = [])
    {
        try {
            $customHeadingDefault = [
                'id' => 'Mã',
                'name' => 'Tên',
            ];
            if (empty($customHeading)) $customHeading = $customHeadingDefault;
            $nowString = Carbon::now()->format('Y-m-d H:i');
            $fileName = 'Customer-list-'. $nowString . '.xlsx';
            $thxportExcel = new ExportExcelController($collection, $customHeading);
            $thxportExcel->title = 'Danh sách';
            return Excel::download($thxportExcel, $fileName);
        } catch (Throwable $th) {logger($th);}
    }
}
