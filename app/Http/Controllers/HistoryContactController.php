<?php

namespace App\Http\Controllers;
use Auth;
use App;
use \Exception;
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

use App\View\Components\{ViewModel, ActionModel, FilterModel};
use App\Traits\{CastRequestTrait};
use App\Models\{HistoryContact, Category, Brand};

class HistoryContactController extends Controller
{
    use CastRequestTrait;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, HistoryContact $historyContact)
    {
        try {
            $currentUser = Auth::user();
            $action = $request->segment(2);
            $perPage = (int)$request->input('per-page');
            $filter = new FilterModel;
            $newQuery = null;
            $subQuery = HistoryContact::query();
            $colTitle = [
                "no"            => 'STT',
                'customer_code' => 'Mã khách',
                'name-link'     => 'Khách hàng',
                'shop_id'     => 'Cửa hàng',
                'content'       => 'Nội dung',
                'created_at'    => 'Thời gian',
                'staff_name'    => 'Nhân viên',
                // '_action'       => '<i class="fa fa-cog" aria-hidden="true"></i>',
            ];
            /*setup*/
            $filter->setKey('keyword', $request->input('keyword'))->setKey('phone', $request->input('phone'));
            /*search by like*/
            if ($filter->hasKey('keyword')) {
                $subQuery->where('history_contacts.code', $filter->getKey('keyword'))
                ->orwhere('history_contacts.name', 'LIKE', '%'. $filter->getKey('keyword').'%')
                ->orwhere('history_contacts.phone', 'LIKE', '%'. $filter->getKey('keyword').'%');
                // ->orwhereHas('brand', function($q) use($filterKeys){
                //     $q->where('name', 'like', '%'. $filterKeys['keyword'].'%');
                // });
            }
            $newQuery = $historyContact->fromSub($subQuery, 'history_contacts')->whereNull('deleted_at')->where('method_id', 3);
            /*filter*/
            if ($filter->hasKey('keys')) {
                $newQuery->where('history_contacts.phone', $filter->getKey('keys'));
            }
            /*set by role*/
            // if ($currentUser->hasRole('historyContact')) {
            //     $newQuery->whereHas('historyContact', function($q) use($currentUser){
            //         $q->whereHas('user', function($q2) use($currentUser){
            //             $q2->where('users.id',$currentUser->id);
            //         });
            //     });
            // }
            /*get pagination*/
            $pagination = $newQuery->orderBy('id', 'asc')->paginate($action === 'export' ? $newQuery->count() : $perPage);
            
            $collection = $pagination->getCollection();
            $collection->map(function ($_element, $key) {
                if($_element->customer){
                    $_element->__set('customer_code', ($_element->customer->code??''));
                    $_element->__set('name-link', ['href' => $_element->customer->route('show'), 'label' => ($_element->customer->name ?? '')]);
                    $_element->__set('shop_id', ($_element->customer->shop_id??''));
                }
                /*set action*/
                // $_element->__set('_action', ['show' => $_element->route('show'), 'edit' => $_element->route('edit'), 'destroy' => $_element->route('destroy')]);
            });
            // dd($collection->toArray());
            /*export list*/
            if ($action === 'export') {
                $customHeading = $colTitle;
                unset($customHeading['_action']);
                foreach ($customHeading as $_attr => $_label) { $customHeading[$_attr] = $_label;}
                return $this->exportList($collection, $customHeading);
            }
            return view('layouts.default')->with(['view' => view('history_contacts.index')->with([
                'filter'        => $filter,
                'pageTitle'     => 'Lịch sử liên hệ',
                'colTitle'      => $colTitle,
                'pagination'    => $pagination,
                'dataRows'      => $collection->toArray(),
                'addLink'       => $historyContact->route('create'),
                'exportLink'    => $historyContact->route('export'),
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
    public function create(Request $request, HistoryContact $historyContact)
    {
        try {
            return view('layouts.default')->with(['view' => view('history_contacts.create')]);            
        } catch (Throwable $e) {logger($e);}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, HistoryContact $historyContact)
    {
        try {
            $input = $request->all();
            $validator = Validator::make($input, 
                [
                    'code' => ['required','alpha_dash','max:16', Rule::unique($historyContact->getTable())->ignore($historyContact->id)],
                    'name' => 'required|max:100',
                ],
                [
                    'required'  => 'Trường :attribute là bắt buộc',
                    'unique'    => 'Trường :attribute đã tồn tại',
                    'max'       => 'Độ dài tối đa là :max',
                    'alpha_dash'=> 'Ký tự phải là chữ/số/"-"/"_"'
                ]
            );
            if ($validator->fails()) return back()->withErrors($validator)->withInput();
            if ($historyContact->fill($input)->save()) return back()->with('success', trans('site.created_success'));
            throw new Exception("Can't save");
        } catch (Exception $e) {
            logger($e);
            return back()->withInput()->with('failed', trans('site.created_failed'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HistoryContact  $historyContact
     * @return \Illuminate\Http\Response
     */
    public function show(HistoryContact $historyContact)
    {
        try {
            return view('layouts.default')->with(['view' => view('history_contacts.show')->with(compact('historyContact'))]);
        } catch (Exception $e) {
            logger($e);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HistoryContact  $historyContact
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoryContact $historyContact)
    {
        try {
            return view('layouts.default')->with(['view' => view('history_contacts.edit')]);
        } catch (Exception $e) {
            logger($e);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HistoryContact  $historyContact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistoryContact $historyContact)
    {
        try {
            $input = $request->all();
            $validator = Validator::make($input,
                [
                    'code' => ['required','alpha_dash','max:16',Rule::unique($historyContact->getTable())->ignore($historyContact->id)],
                    'name' => 'required|max:100',
                ], 
                [
                    'required'  => 'Trường :attribute là bắt buộc',
                    'unique'    => 'Trường :attribute đã tồn tại',
                    'max'       => 'Độ dài tối đa là :max',
                    'alpha_dash'=> 'Ký tự phải là chữ/số/"-"/"_"'
                ]
            );
            if ($validator->fails()) return back()->withErrors($validator)->withInput();
            /**/
            if ($historyContact->fill($input)->save()) return back()->with('success', trans('site.updated_success')); 
            throw new Throwable("Can't save");
        } catch (Throwable $e) {
            logger($e);
            return back()->withInput()->with('failed', trans('site.created_failed'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HistoryContact  $historyContact
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistoryContact $historyContact)
    {
        try {
            if ($historyContact->delete()) return Response(__('titles.deleted_success'), 301);
            return Response(__('titles.deleted_success'), 302);
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
            $fileName = 'HistoryContact-list-'. $nowString . '.xlsx';
            $exportExcel = new ExportExcelController($collection, $customHeading);
            $exportExcel->title = 'Danh sách';
            return Excel::download($exportExcel, $fileName);
        } catch (Exception $e) {logger($e);}
    }
}
