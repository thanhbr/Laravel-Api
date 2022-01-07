<?php

namespace App\Http\Controllers;
use Auth;
use App;
use \Throwable;

use App\Models\Type;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, Redirect};
use Illuminate\Validation\Rule;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

// use App\View\Components;
use App\Traits\{CastRequestTrait};

class TypeController extends Controller
{
    use CastRequestTrait;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Type $type)
    {
        try {
            $currentUser = Auth::user();
            $action = $request->segment(2);
            $perPage = (int)$request->input('per-page');
            $newQuery = null;
            $subQuery = Type::query();
            $colTitle = [
                'no'        => 'STT',
                'code'      => 'Mã loại kho',
                'name'      => 'Loại Kho',
                'note'      => 'Ghi chú',
                '_action'   => 'Chức năng',
            ];
            /*setup*/
            $newQuery = $type->fromSub($subQuery, 'types');
            
            /*get pagination*/
            $pagination = $newQuery->orderBy('id', 'asc')->paginate($action === 'export' ? $newQuery->count() : $perPage);
            
            $collection = $pagination->getCollection();
            $collection->map(function ($_element, $key) {
                $_element->__set('code-link', ['href' => $_element->route('show'), 'label' => ($_element->name ?? '') . ' ('.($_element->code??'').')']);
                // $_element->__set('shop', $_element->shop);
                // $_element->__set('status_name', $_element->status->name ?? '');
                /*set action*/
                $_element->__set('_action', ['show' => $_element->route('show'), 'edit' => $_element->route('edit'), 'destroy' => $_element->route('destroy')]);
            });
            return view('layouts.default')->with(['view' => view('templates.common.index')->with([
                'dataRows'  => $collection->toArray(),
                'colTitle'  => $colTitle,
                'pageTitle' => 'Danh sách 11',
                'addLink'   => $type->route('create'),
            ])]);           
        } catch (Throwable $th) {logger($th);}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Type $type)
    {
        try {
            return view('layouts.default')->with(['view' => view('type.create')]);
        } catch (Throwable $th) {logger($th);}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $input = $request->all();
            $messages = [
                'required'  => 'Trường :attribute là bắt buộc',
                'unique'    => 'Trường :attribute đã tồn tại',
                'max'       => 'Độ dài tối đa là :max',
                'alpha_dash'=> 'Ký tự phải là chữ/số/"-"/"_"'
            ];
            $validator = Validator::make($input, [
                'code' => ['required','alpha_dash','max:16', Rule::unique($type->getTable())->ignore($type->id)],
                'name' => 'required|max:100',
            ], $messages);
            if ($validator->fails()) return back()->withErrors($validator)->withInput();
            //
            if ($type->fill($input)->save()) return back()->with('success', trans('site.created_success'));
            throw new Throwable("Can't save");
        } catch (Throwable $th) {
            logger($th);
            return back()->withInput()->with('failed', trans('site.created_failed'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        try {
            return view('layouts.default')->with(['view' => view('types.show')->with(compact('type'))]);
        } catch (Throwable $th) {
            logger($th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        try {            
            return view('layouts.default')->with(['view' => view('types.show')->with(compact('type'))]);
        } catch (Throwable $th) {
            logger($th);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        try {
            $input = $request->all();
            $messages = [
                'required'  => 'Trường :attribute là bắt buộc',
                'unique'    => 'Trường :attribute đã tồn tại',
                'max'       => 'Độ dài tối đa là :max',
                'alpha_dash'=> 'Ký tự phải là chữ/số/"-"/"_"'
            ];
            $validator = Validator::make($input, [
                'code' => ['required','alpha_dash','max:16', Rule::unique($type->getTable())->ignore($type->id)],
                'name' => 'required|max:100',
            ], $messages);
            if ($validator->fails()) return back()->withErrors($validator)->withInput();
            
            if ($type->fill($input)->save()) return back()->with('success', trans('site.updated_success'));
            throw new Throwable("Can't save");
        } catch (Throwable $th) {
            logger($th);
            return back()->withInput()->with('failed', trans('site.created_failed'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        try {
            if ($type->delete()) return Response(__('titles.deleted_success'), 301);
            else return Response(__('titles.deleted_success'), 302);
        } catch (Throwable $th) {
            logger($th);
        }
    }
}
