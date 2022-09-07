<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ComplainationResource;

class ComplainationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ComplainationResource::collection(Complaination::all());
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
        $user = auth('api')->user()->id;
        $validator = Validator::make($request->all(),[
            'message' => 'required',
        ]);
        $complaination = new Complaination;
        $complaination->message = $validator->validated();
        $complaination->user_id = $user;
        $complaination->save();
        return response([
            'data'=> new ComplainationResource($complaination)
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Complaination $Complaination)
    {
        return new ComplainationResource($Complaination);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Complaination $complaination)
    {
        $complaination->delete();
        return response(null,404);
    }
}
