<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Posts\StoreRequest;
use App\Http\Requests\Posts\UpdateRequest;
use App\Models\Post;
use App\Traits\ApiResponseTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Throwable;

class PostController extends Controller
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
           /* $posts = DB::table('posts')->with()->get();*/
            $posts = Post::with('tags')->get();
            return $this->apiSuccess($posts,'success',200);
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
     * @param Request $request
     * @return ResponseFactory|JsonResponse|Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['cover_image'] = $request->file('cover_image')->store('public');
            $data = Post::create($validatedData);
            return $this->apiSuccess($data,'Store has success',200);
        }  catch (Throwable $th) {
            return $this->apiFailure(null,$th->getMessage(),'failed Not store');
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
        try {
            $Post = Post::with('tags')->findorfail($id);
            if ($Post) {
                return $this->apiSuccess($Post,'Response has success',200);
            }
        }catch (Throwable $th) {
            return $this->apiFailure(null,'THe Post Not Exist',204);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return Response
     */
    public function edit(post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\post  $post
     * @return Response
     */
    public function update(UpdateRequest $request, post $post)
    {
       try {
            $post->update($request->validated());
            return $this->apiSuccess($post,'update has Success',200);
        }  catch (Throwable $th) {
            return $this->apiFailure(null,$th->getMessage(),500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return Response
     */
    public function destroy(post $post)
    {
       try {
            $post->delete();
            return $this->apiSuccess($post,'delete has Success',200);
        }  catch (Throwable $th) {
            return $this->apiFailure(null,'failed Not delete',500);
        }
    }
}
