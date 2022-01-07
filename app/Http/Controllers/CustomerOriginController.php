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
use Maatwebapp\Excel\Facades\Excel;
use Carbon\Carbon;

use App\View\Components\{FilterModel};
use App\Traits\{CastRequestTrait};
use App\Models\{CustomerOrigin, Status,};

class CustomerOriginController extends Controller
{
    
    use CastRequestTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request, CustomerOrigin $customer_origin)
    // {
    //      try {
    //         $currentUser = Auth::user();
    //         $action = $request->segment(2);
    //         $perPage = (int)$request->input('per-page');
    //         $filter = new FilterModel;
    //         $newQuery = null;
    //         $subQuery = CustomerOrigin::query();
    //         $colTitle = [
    //             "no"        => 'STT',
    //             'code-link' => 'Mã khách hàng',
    //             'name'      => 'Cửa hàng',
    //             'description' => 'Nguồn khách hàng',
    //             '_action'   => '<i class="fa fa-cog" aria-hidden="true"></i>',
    //         ];
    //         /*setup*/
    //         $filter->setKey('keyword', $request->input('keyword'))->setKey('phone', $request->input('phone'))
    //         ->setKey('status_id', $request->input('status_id'));
    //         $filter->with('status_id', Status::getListKVByPrefix('customer_origin'), $filter->getKey('status_id'), '...');
    //         /*search by like*/
    //         if ($filter->hasKey('keyword')) {
    //             $subQuery->where('customer_origins.code', $filter->getKey('keyword'))
    //             ->orwhere('customer_origins.name', 'LIKE', '%'. $filter->getKey('keyword').'%');
    //         }
    //         $newQuery = $customer_origin->fromSub($subQuery, 'customer_origins');
    //         /*filter*/
    //         if ($filter->hasKey('status_id')) {
    //             $newQuery->where('customer_origins.status_id', $filter->getKey('status_id'));
    //         }
    //         /*get pagination*/
    //         $pagination = $newQuery->orderBy('id', 'asc')->paginate($action === 'export' ? $newQuery->count() : $perPage);
            
    //         $collection = $pagination->getCollection();
    //         $collection->map(function ($_element, $key) {
    //             $_element->__set('code-link', ['href' => $_element->route('show'), 'label' => ($_element->name ?? '') . ' ('.($_element->code??'').')']);
    //             $_element->__set('shop', $_element->shop);
    //             $_element->__set('status_name', $_element->status->name ?? '');
    //             /*set action*/
    //             $_element->__set('_action', ['edit' => $_element->route('edit'), 'destroy' => $_element->route('destroy')]);
    //         });
    //         /*export list*/
    //         if ($action === 'export') {
    //             $customHeading = $colTitle;
    //             unset($customHeading['_action']);
    //             foreach ($customHeading as $_attr => $_label) { $customHeading[$_attr] = $_label;}
    //             return $this->exportList($collection, $customHeading);
    //         }
    //         return view('layouts.default')->with(['view' => view('templates.common.index')->with([
    //             'filter'        => $filter,
    //             'pageTitle'     => 'Nguồn khách hàng',
    //             'colTitle'      => $colTitle,
    //             'pagination'    => $pagination,
    //             'dataRows'      => $collection->toArray(),
    //             'addLink'       => $customer_origin->route('create'),
    //             'exportLink'    => $customer_origin->route('export'),
    //         ])]);
    //     } catch (Throwable $th) {
    //         logger($th);
    //     }
    // }
    public function index()
    {
         try {
            return view('layouts.default')->with(['view' => view('customer_origins.index')]);
        } catch (Throwable $th) {
            logger($th);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerOrigin  $customerOrigin
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerOrigin $customerOrigin)
    {
        try {
            $customAttribute = [
                'name'          => 'Tên',
                'code'          => 'Mã',
                'description'   => 'Mô tả',
                'created_at'    => 'Ngày tạo',
            ];
            return view('layouts.default')->with(['view' => view('templates.common.show')->with(
                [
                    'pageTitle'         => 'Chỉnh sửa thông tin nguồn khách hàng',
                    'modelDefault'      => $customerOrigin,
                    'customAttribute'   => $customAttribute,
                    'editLink'          => $customerOrigin->route('edit'),
                    'backLink'          => [$customerOrigin->route('index'), 'Danh sách'],
                ]
            )]);
        } catch (Exception $e) {
            logger($e);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerOrigin  $customerOrigin
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerOrigin $customerOrigin)
    {
        try {
             $customAttribute = [
                'code'          => 'Mã',
                'name'          => 'Tên',
                'description'   => 'Mô tả',
                'created_at'    => 'Ngày tạo',
            ];
            return view('layouts.default')->with(['view' => view('templates.common.edit')->with(
                [
                    'pageTitle' => 'Chỉnh sửa thông tin nguồn khách hàng',
                    'modelDefault'      => $customerOrigin,
                    'customAttribute'   => $customAttribute,

                ]
            )]);
        } catch (Exception $e) {
            logger($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerOrigin  $customerOrigin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerOrigin $customerOrigin)
    {
        try {
            $input = $request->all();
            $this->castDatetime($input, 'created_at');
            $messages = [
                'required'  => 'Trường :attribute là bắt buộc',
                'unique'    => 'Trường :attribute đã tồn tại',
                'max'       => 'Độ dài tối đa là :max',
                'alpha_dash'=> 'Ký tự phải là chữ/số/"-"/"_"'
            ];
            $validator = Validator::make($input, [
                'code' => ['required','alpha_dash','max:16', Rule::unique($customerOrigin->getTable())->ignore($customerOrigin->id)],
                'name' => 'required|max:100',
            ], $messages);
            // dd($input);
            if ($validator->fails()) return back()->withErrors($validator)->withInput();
            
            if ($customerOrigin->fill($input)->save()) return back()->with('success', trans('titles.updated_success'));
            throw new Throwable("Can't save");
        } catch (Throwable $e) {
            logger($e);
            return back()->withInput()->with('failed', trans('titles.created_failed'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerOrigin  $customerOrigin
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerOrigin $customerOrigin)
    {
        try {
            if ($customerOrigin->delete()) {
                return Response(__('titles.deleted_success'),301);
            } else{
                return Response(__('titles.deleted_success'),302);
            }
        } catch (Throwable $e) {logger($e);}
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
