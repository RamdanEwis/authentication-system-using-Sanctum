<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Tags\StoreRequest;
use App\Http\Requests\Tags\UpdateRequest;
use App\Models\Tag;
use App\Traits\ApiResponseTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Throwable;

class TagController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return ResponseFactory|JsonResponse|Response
     */
    public function index()
    {
        try {
            $tags = DB::table('tags')->get();
            return $this->apiSuccess($tags,'success',200);
        }  catch (Throwable $th) {
            return $this->apiFailure(null,$th->getMessage(),500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return ResponseFactory|JsonResponse|Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $tag = Tag::create($request->validated());
            return $this->apiSuccess($tag,'Store has success',200);
        }  catch (Throwable $th) {
            return $this->apiFailure($request->all,'failed Not store',500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return Response
     */
    public function show($id)
    {
        $tag = Tag::findorfail($id);
        if ($tag) {
            return $this->apiSuccess($tag,'Response has success',200);
        }
        return $this->apiFailure(null,'Not exist Tenant',204);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, tag $tag)
    {
        try {
            $tag->update($request->validated());
            return $this->apiSuccess($tag,'update has Success',200);
        }  catch (Throwable $th) {
            return $this->apiFailure(null,'failed Not update',500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(tag $tag)
    {
        try {
            $tag->delete();
            return $this->apiSuccess($tag,'delete has Success',200);
        }  catch (Throwable $th) {
            return $this->apiFailure(null,'failed Not delete',500);
        }
    }
}
