<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostsRequest;
use App\Post;
use App\Comment;
use App\Photo;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::paginate(20);
	
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$users = User::pluck('name', 'id')->all();
		$categories = Category::pluck('name', 'id')->all();
		return view('admin.posts.create', compact('users', 'categories'));		
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        //
		$input = $request->all();

		$user = Auth::user();
		
		if ($input['user_id'] <> ''){
			$user = User::findOrFail($request->user_id);
		}
		
		if ($file = $request->file('photo_id')){
			$name = time() . $file->getClientOriginalName();
			$file->move('images', $name);
			$photo = Photo::create(['file'=>$name]);
			$input['photo_id'] = $photo->id;
		}

		$post = $user->posts()->create($input);
		$msg = "Post: " . $post->id . " - " . $post->title . " foi Incluído";
		Session::flash('Post Incluído',$msg);
		return redirect('admin/posts');		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
		$post = Post::findOrFail($id);
		$users = User::pluck('name', 'id')->all();
		$categories = Category::pluck('name', 'id')->all();
		
		return view('admin.posts.show', compact('post', 'users', 'categories'));			
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
		$post = Post::findOrFail($id);
		$users = User::pluck('name', 'id')->all();
		$categories = Category::pluck('name', 'id')->all();
		
		return view('admin.posts.edit', compact('post', 'users', 'categories'));		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request, $id)
    {
        //
		$input = $request->all();
		$user_id = $request['user_id'];
		$user = User::findOrFail($user_id);
		
		$post = Post::findOrFail($id);
		$post['user_id'] = $user_id;
		
		if ($file = $request->file('photo_id')){
			if ($post->photo_id <> 0){
				if (!empty($post->photo->file)) {
					unlink(public_path() . $post->photo->file);
				}	
			}
			$name = time() . $file->getClientOriginalName();
			$file->move('images', $name);
			$photo = Photo::create(['file'=>$name]);
			$input['photo_id'] = $photo->id;
		} else {
			if ($post->photo_id <> 0){
				$name = $post->photo->name;
			}
		}
		
		$post = $post->update($input);
		
		// Auth::user()->posts()->whereId($id)->first()->update($input); outra forma de atualizar
		
		$msg = "Post: " . $id . " - " . $post['title'] . " foi Atualizado";
		Session::flash('Post Atualizado',$msg);
        return redirect('/admin/posts');		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
		$post = Post::findOrFail($id);
		if ($post->photo_id <> 0){
			if (trim($post->photo->file) <> '') {
				unlink(public_path() . $post->photo->file);
			}	
		}
		$msg = "Post: " . $post->id . " - " . $post->title. " foi excluído";
		Session::flash('Post Excluído',$msg);
		$post->delete();
		return redirect('/admin/posts');
		
    }
    public function post($slug)
    {
        //
        $post = Post::findBySlugOrFail($slug);
        $comments = $post->comments()->whereIsActive(1)->get();
        $commentsreplies = $post->commentsreplies;
        
        return view('post', compact('post', 'comments', 'commentsreplies'));
		
    }
}
