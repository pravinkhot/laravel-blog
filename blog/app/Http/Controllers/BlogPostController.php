<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use Carbon\Carbon;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogPostList = DB::table('blog')
                        ->leftjoin('users', 'users.id', '=', 'blog.created_by')
                        ->select('blog.*', 'users.role_id')
                        ->paginate(15);
        return view('blogPost.index', [
            'blogPostList' => $blogPostList
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('blogPost.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->dataOperation($request, $id = NULL, $method = 'add');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blogPostDetail = DB::table('blog')
                        ->select('name', 'description')
                        ->where([
                            'blog_id' => $id
                        ])
                        ->first();
        return view('blogPost.show', [
            'blogID' => $id,
            'blogPostDetail' => $blogPostDetail
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blogPostDetail = DB::table('blog')
                        ->select('blog.name', 'blog.description', 'users.role_id')
                        ->leftjoin('users', 'users.id', '=', 'blog.created_by')
                        ->where([
                            'blog.blog_id' => $id
                        ])
                        ->first();
        if ($blogPostDetail->role_id == Auth::user()->role_id) {
            return view('blogPost.edit', [
                'blogID' => $id,
                'blogPostDetail' => $blogPostDetail
            ]);
        } else {
            echo 'This operation not permitted.';
        }
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
        return $this->dataOperation($request, $id, $method = 'edit');
    }

    /**
     * Add/Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  string  $method
     * @return \Illuminate\Http\Response
     */
    private function dataOperation(Request $request, $id, $method)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        $input = $request->all();

        switch ($method) {
            case 'add':
                DB::table('blog')->insert(
                    ['name' => $input['name'], 'description' => $input['description'], 'created_by' => Auth::user()->id, 'created_date' => Carbon::now()->toDateTimeString()]
                );
                $successMessage = 'Blog post is added successfully.';
                break;
            
            case 'edit':
                DB::table('blog')
                ->where([
                    'blog_id' => $id
                ])
                ->update(
                    ['name' => $input['name'], 'description' => $input['description'], 'modified_by' => Auth::user()->id, 'modified_date' => Carbon::now()->toDateTimeString()]
                );
                $successMessage = 'Blog post is updated successfully.';
                break;
        }
        
        return redirect('blogPost')->with('successMessage', $successMessage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blogPostDetail = DB::table('blog')
                        ->select('blog.name', 'blog.description', 'users.role_id')
                        ->leftjoin('users', 'users.id', '=', 'blog.created_by')
                        ->where([
                            'blog.blog_id' => $id
                        ])
                        ->first();

        if ($blogPostDetail->role_id == Auth::user()->role_id) {
            DB::table('blog')
            ->where([
                'blog_id' => $id
            ])
            ->delete();
            return redirect('blogPost')->with('successMessage', 'Blog post is deleted successfully.');
        } else {
            echo 'This operation not permitted.';
        }
    }
}
