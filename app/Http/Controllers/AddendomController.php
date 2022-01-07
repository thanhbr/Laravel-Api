<?php

namespace App\Http\Controllers;

use App\Models\Addendom;
use Illuminate\Http\Request;

class AddendomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('layouts.default')->with(['view' => view('components.form.index')->with([
                // 'filterKeys'    => $filterKeys,
                // 'filterData'    => $filterModel->toData(),
                'pageTitle'     => 'Phụ lục hợp đồng',
            ])]);
        } catch (\Throwable $th) {
            logger(th);
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
     * @param  \App\Models\Addendom  $addendom
     * @return \Illuminate\Http\Response
     */
    public function show(Addendom $addendom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Addendom  $addendom
     * @return \Illuminate\Http\Response
     */
    public function edit(Addendom $addendom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Addendom  $addendom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Addendom $addendom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Addendom  $addendom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Addendom $addendom)
    {
        //
    }
}
