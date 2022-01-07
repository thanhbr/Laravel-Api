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
use App\Models\{Contract, Customer, HistoryContact};

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Contract $contract)
    {
        try {
            $currentUser = Auth::user();
            $action = $request->segment(2);
            $perPage = (int)$request->input('per-page');
            $filter = new FilterModel;
            $newQuery = null;
            $subQuery = Contract::query();
            $colTitle = [
                "no"        => 'STT',
                'code-link' => 'Mã khách hàng',
                'shop-link' => 'Cửa hàng',
                'phone'     => 'Điện thoại',
                'origin_id' => 'Nguồn khách hàng',
                'staff_name'=> 'Nhân viên',
                '_action' => '<i class="fa fa-cog" aria-hidden="true"></i>',
            ];
            /*setup*/
            $filter->setKey('keyword', $request->input('keyword'))->setKey('phone', $request->input('phone'));
            /*search by like*/
            if ($filter->hasKey('keyword')) {
                $subQuery->where('contracts.code', $filter->getKey('keyword'))
                ->orwhere('contracts.name', 'LIKE', '%'. $filter->getKey('keyword').'%')
                ->orwhere('contracts.phone', 'LIKE', '%'. $filter->getKey('keyword').'%');
                // ->orwhereHas('brand', function($q) use($filterKeys){
                //     $q->where('name', 'like', '%'. $filterKeys['keyword'].'%');
                // });
            }
            $newQuery = $contract->fromSub($subQuery, 'contracts');
            /*filter*/
            if ($filter->hasKey('keys')) {
                $newQuery->where('contracts.phone', $filter->getKey('keys'));
            }
            /*set by role*/
            // if ($currentUser->hasRole('contract')) {
            //     $newQuery->whereHas('contract', function($q) use($currentUser){
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
            return view('layouts.default')->with(['view' => view('components.form.index')->with([
                'filter'        => $filter,
                'pageTitle'     => 'Danh sách khách hàng',
                'colTitle'      => $colTitle,
                'pagination'    => $pagination,
                'dataRows'      => $collection->toArray(),
                'addLink'       => $contract->route('create'),
                'exportLink'    => $contract->route('export'),
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
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        //
    }
}
