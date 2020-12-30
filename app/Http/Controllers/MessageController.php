<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MessageList;
use App\Models\GroupMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $message = MessageList::where('user_id',auth()->user()->id)->get();
            $data['data'] = $message;
            $data['message'] = 'list';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = 'error';
            return  $this->apiResponse($data, 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
            if($request->for == 'single'){
                $message = New Message();
                $message->to_id = auth()->user()->id;
                $message->from_id =  $request->from_user;
                $message->message = $request->message;
                $message->type = $request->type;
                $message->parent_id = ($request->parent_id)?$request->parent_id:0;
                $message->save();
            }else{
                $message = New GroupMessage();
                $message->group_id = $request->group_id;
                $message->from =  $request->from_user;
                $message->message = $request->message;
                $message->type = $request->type;
                $message->parent_id = ($request->parent_id)?$request->parent_id:0;
                $message->save();
            }
            $data['data'] = $message;
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
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $message = Message::where(function ($query) {
                $query->where('from_id', '=', auth()->user()->id)
                      ->Where('to_id', '=', $id);
            })->orWhere(function ($query) {
                $query->where('to_id', '=', auth()->user()->id)
                      ->Where('from_id', '=', $id);
            })->get();
            $data['data'] = $message;
            $data['message'] = 'list';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = 'error';
            return  $this->apiResponse($data, 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
