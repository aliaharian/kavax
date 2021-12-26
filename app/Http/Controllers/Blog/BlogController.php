<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Model\Attachments;
use App\Model\Blog;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BlogController extends Controller {
    /* Show All Blog Posts in Admin Panel */
    public function index(){
        $Blog = Blog::orderBy('created_at', 'desc')->paginate(12)->onEachSide(2);
        return view('admin.blog.index', compact('Blog'));
    }

    /* Create New Post */
    public function create() {
        return view('admin.blog.create');
    }

    /* Submit Post */
    public function store(Request $request) {
        $this->middleware('can:isAuthor');
        $user = auth()->user();
        $BlogData = $request->all();
        $BlogData['author_id'] = $user->id;
        $BlogData['slug'] = SlugService::createSlug(Blog::class, 'slug', $request->title);

        /* Save Thumbnail */
        if ($thumbnail_path = $request->file('thumbnail')) {
            $attachments_id = array();
            if ($path = $thumbnail_path->store('blog/thumbnail/full')) {
                $Attachments = new Attachments();
                $Attachments->uid = $user->id;
                $Attachments->orgname = $thumbnail_path->getClientOriginalName();
                $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                $Attachments->type = $thumbnail_path->extension();
                $img = Image::make('storage/app/blog/thumbnail/full/' . $Attachments->path);

                // save the file 636px
                $img->backup();
                $img->crop(636, 385);

                if (!file_exists('storage/app/blog/thumbnail/636')) {
                    mkdir('storage/app/blog/thumbnail/636', 0755, true);
                }
                $img->save('storage/app/blog/thumbnail/636/' . pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'], 100);

                if ($Attachments->save()) {
                    array_push($attachments_id, $Attachments->id);
                } else {
                    return redirect()->back()->with('notification', [
                        'status' => 'danger',
                        'message' => 'Thumbnail is not uploaded!',
                    ]);
                }
            }
            $BlogData['thumbnail'] = end($attachments_id);
        }

        if (Blog::create($BlogData)) {
            return redirect('dashboard/blog')->with('notification', [
                'class' => 'success',
                'message' => 'Post Created.'
            ]);
        } else {
            return redirect()->back()->with('notification', [
                'class' => 'alert',
                'message' => 'Error.'
            ]);
        }
    }


    /* Edit Post Page */
    public function edit($id) {
        $Blog = Blog::find($id);
        return view('admin.blog.edit', compact('Blog'));
    }

    /* Update Blog */
    public function update(Request $request, $id) {
        $this->middleware('can:isAuthor');
        $user = auth()->user();
        $Blog = Blog::find($id);

        $BlogData = $request->all();
        $BlogData['slug'] = $Blog->slug;
        if ($Blog->title != $request->title) {
            $BlogData['slug'] = SlugService::createSlug(Blog::class, 'slug', $request->title);
        }

        /* Save Thumbnail */
        if ($thumbnail_path = $request->file('thumbnail')) {
            $attachments_id = array();
            if ($path = $thumbnail_path->store('blog/thumbnail/full')) {
                $Attachments = new Attachments();
                $Attachments->uid = $user->id;
                $Attachments->orgname = $thumbnail_path->getClientOriginalName();
                $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                $Attachments->type = $thumbnail_path->extension();
                $img = Image::make('storage/app/blog/thumbnail/full/' . $Attachments->path);

                // save the file 350px
                $img->backup();
                $img->crop(636, 385);

                if (!file_exists('storage/app/blog/thumbnail/636')) {
                    mkdir('storage/app/blog/thumbnail/636', 0755, true);
                }
                $img->save('storage/app/blog/thumbnail/636/' . pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'], 100);

                if ($Attachments->save()) {
                    array_push($attachments_id, $Attachments->id);
                } else {
                    return redirect()->back()->with('notification', [
                        'status' => 'danger',
                        'message' => 'Thumbnail is not uploaded!',
                    ]);
                }
            }
            $BlogData['thumbnail'] = end($attachments_id);
        }

        if ($Blog->update($BlogData)) {
            return redirect()->back()->with('notification', [
                'class' => 'success',
                'message' => 'Post Updated.'
            ]);
        } else {
            return redirect('dashboard/blog')->with('notification', [
                'class' => 'danger',
                'message' => 'Error.'
            ]);
        }
    }

    /* Show All Blog Posts */
    public function show_all() {
        $Blog = Blog::orderBy('created_at', 'desc')->paginate(12)->onEachSide(2);
        return view('site.pages.blog.blog', compact('Blog'));
    }

    /* Show Post */
    public function show($slug){
        $Blog = Blog::where('slug', $slug)->first();

        return view('site.pages.blog.single', compact('Blog'));
    }


    /* Post Destroy */
    public function destroy(Request $request) {
        $this->middleware('can:isAuthor');
        foreach ($request->delete_item as $key => $item) {
            Blog::where('id', $key)->delete();
        }

        return redirect('/dashboard/blog')->with('notification', [
            'class' => 'success',
            'message' => 'Post is Deleted.'
        ]);
    }
}
