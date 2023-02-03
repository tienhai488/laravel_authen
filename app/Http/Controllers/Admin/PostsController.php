<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index(){
        $listPost = Post::orderBy('created_at','desc')->get();
        return view('admin.posts.list',compact('listPost'));
    }

    public function add(){
        return view('admin.posts.add');
    }

    public function postAdd(Request $request){
        $request->validate([
            'title'=>'required',
            'content'=>'required',
        ],[
            'title.required'=>'Tiêu đề bắt buộc phải nhập!',
            'content.required'=>'Nội dung bắt buộc phải nhập!',
        ]);

        $post = new Post();

        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::user()->id;
        $post->created_at = date('Y-m-d H:i:s');

        $post->save();
        
        return redirect()->route('admin.posts.index')->with('msg','Thêm bài viết thành công!');
    }

    public function edit(Request $request,Post $post){
        return view('admin.posts.edit',compact('post'));
    }

    public function postEdit(Request $request,Post $post){
        $request->validate([
            'title'=>'required',
            'content'=>'required',
        ],[
            'title.required'=>'Tiêu đề bắt buộc phải nhập!',
            'content.required'=>'Nội dung bắt buộc phải nhập!',
        ]);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->updated_at = date('Y-m-d H:i:s');

        $post->save();
        
        return back()->with('msg','Cập nhập bài viết thành công!');
    }

    public function delete(Post $post){
        Post::destroy($post->id);
            return redirect()->route('admin.posts.index')->with('msg','Xóa bài viết thành công!');
    }

}