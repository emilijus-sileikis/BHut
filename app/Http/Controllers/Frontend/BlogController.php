<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::paginate(16);
        $newest = Blog::orderBy('created_at', 'desc')->limit(5)->get();

        return view('frontend.blog.index', compact('blogs', 'newest'));
    }

    public function create()
    {
        if (Auth::user()) {
            return view('frontend.blog.create');
        } else {
            return redirect()->route('login');
        }

    }

    public function post(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:50',
            'content' => 'required'
        ]);

        $blog = new Blog;
        $blog->user_id = Auth::user()->getAuthIdentifier();
        $blog->title = $validatedData['title'];
        $blog->descr = $validatedData['content'];

        // Handle the file upload
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = rand(1000000, 9999999).'.'.$ext;
            $destinationPath = 'uploads/blog/';
            $file->move($destinationPath,$fileName);
            $blog->image = $destinationPath.$fileName;
        }

        $blog->save();

        return redirect()->back()->with('success', 'Recipe created successfully');
    }

    public function view($id)
    {
        $blog = Blog::where('id', $id)->first();

        if ($blog) {
            return view('frontend.blog.view', compact('blog'));
        } else {
            return redirect()->back();
        }
    }

    public function comment(Request $request, $id)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $user_id = Auth::id();

        $comment = new BlogComment;
        $comment->user_id = $user_id;
        $comment->blog_id = $id;
        $comment->content = $validatedData['content'];
        $comment->save();

        return redirect()->back();
    }

    public function delete($id)
    {
        $comment = BlogComment::where('id', $id)->first();
        $comment->delete();
        return back()->with('success', 'Comment deleted successfully!');
    }

}
