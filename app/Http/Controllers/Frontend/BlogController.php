<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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

        return redirect()->route('blogs')->with('success', 'Recipe created successfully');
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
            'title' => 'required|max:50',
            'content' => 'required|max:5000',
            'image' => 'nullable|image|max:4000|mimes:jpeg,png,jpg',
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

        if (Auth::id() == $comment->user_id) {
            $comment->delete();
            return back()->with('success', 'Comment deleted successfully!');
        } else {
            return redirect()->route('login');
        }
    }

    public function blogs()
    {
        $blogs = Blog::where('user_id', Auth::user()->getAuthIdentifier())->paginate(16);

        return view('frontend.blog.blogs', compact('blogs'));
    }

    public function deleteBlog($id)
    {
        $blog = Blog::where('id', $id)->first();
        $path = public_path($blog->image);

        if (Auth::id() == $blog->user_id || Auth::user()->role_as == '1') {
            $blog->comments()->delete();

            if (File::exists($path)) {
                File::delete($path);
            }
            $blog->delete();
            return redirect()->route('blogs')->with('message', 'Blog Deleted Successfully');
        } else {
            return redirect()->route('login');
        }
    }

    public function edit($id)
    {
        $blog = Blog::where('id', $id)->first();
        if (Auth::id() == $blog->user_id || Auth::user()->role_as == '1') {
            return view('frontend.blog.edit', compact('blog'));
        } else {
            return redirect()->route('login');
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:50',
            'content' => 'required|max:5000',
            'image' => 'nullable|image|max:4000|mimes:jpeg,png,jpg',
        ]);

        $blog = Blog::where('id', $id)->first();

        if($request->hasFile('image')) {

            $path = public_path($blog->image);

            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = rand(1000000, 9999999).'.'.$ext;
            $destinationPath = 'uploads/blog/';

            $file->move($destinationPath,$fileName);
            $blog->image = $destinationPath.$fileName;
        }

        Blog::where('id',$blog->id)->update([
            'title' => $validatedData['title'],
            'descr' => $validatedData['content'],
            'image' => $blog->image,
        ]);

        return redirect()->back();
    }

}
