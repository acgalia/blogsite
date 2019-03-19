<?php

namespace App\Http\Controllers;
use Session;


use Illuminate\Http\Request;
use App\User;
use App\Blog;

class UserController extends Controller
{
    public function showBlog(){
    	$blogs = Blog::orderBy('id', 'desc')->get();
    	$users = User::all();
    	// $blogs = Blog::all();
    	// dd($blogs);
    	
    	return view('users.menu', compact('users', 'blogs'));
    }

    public function saveBlog(Request $request){

    	$rules = array(
    		'title' => 'required',
    		'content' => 'required'
    	);

            //to validate $request from form
        $this->validate($request, $rules);

        $blog = new Blog;
        $blog->title = $request->title;
        $blog->content = $request->content;

        $blog->save();
        Session::flash("addBlog", "Blog created.");
        return back();
    }

    public function deleteBlog($id){
    	$delete_blog = Blog::find($id);
    	$delete_blog->delete();
    	Session::flash("deleteBlog", "Blog deleted. =(");
    	return back();
    }

    public function editBlog($id, Request $request){
    	$edit_blog = Blog::find($id);

    	$rules = array(
    		'title' => 'required',
    		'content' => 'required'
    	);

    	$this->validate($request, $rules);

    	$edit_blog->title = $request->title;
    	$edit_blog->content = $request->content;

    	$edit_blog->save();
    	Session::flash("editBlog", "Blog updated.");
    	return back();
    }


}
