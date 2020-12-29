<?php

namespace App\Http\Controllers;

use App\Models\StatusView;
use Illuminate\Http\Request;

class StatusViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
            $status = New StatusView();
            $status->status_id = $request->id;
            $status->user_id = auth()->user()->id;
            $status->save();
            $data['data'] = $status;
            $data['message'] = 'create';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = 'error';
            return  $this->apiResponse($data, 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StatusView  $statusView
     * @return \Illuminate\Http\Response
     */
    public function show(StatusView $statusView)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StatusView  $statusView
     * @return \Illuminate\Http\Response
     */
    public function edit(StatusView $statusView)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StatusView  $statusView
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StatusView $statusView)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StatusView  $statusView
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatusView $statusView)
    {
        //
    }
}
