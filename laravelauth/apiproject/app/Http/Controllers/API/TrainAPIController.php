<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\APIBaseController as APIBaseController;
use App\train;
use Validator;

class TrainAPIController extends APIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = train::all();
        return $this->sendResponse($posts->toArray(), 'Posts retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'source' => 'required',
            'destination' => 'required',
            'price' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $post = train::create($input);

        // return $this->sendResponse($post->toArray(), 'Post created successfully.');
        return $post;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = train::find($id);

        if (is_null($post)) {
            return $this->sendError('Post not found.');
        }

        return $this->sendResponse($post->toArray(), 'Post retrieved successfully.');
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
        $input = $request->all();

        $validator = Validator::make($input, [
             'source' => 'required',
            'destination' => 'required',
            'price' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $post = train::find($id);
        if (is_null($post)) {
            return $this->sendError('Post not found.');
        }

        $post->source = $input['source'];
        $post->destination = $input['destination'];
        $post->price = $input['price'];

        $post->save();

        return $this->sendResponse($post->toArray(), 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = train::find($id);

        if (is_null($post)) {
            return $this->sendError('Post not found.');
        }

        $post->delete();

        return $this->sendResponse($id, 'Tag deleted successfully.');
    }
}