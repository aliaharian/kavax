<?php

namespace App\Http\Controllers\Career;

use App\Http\Controllers\Controller;
use App\Model\Attachments;
use App\Model\Career;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CareerController extends Controller
{
    /* Show All Career */
    public function index() {
        $Career = Career::orderBy('created_at', 'desc')->paginate(12)->onEachSide(2);
        return view('admin.career.index', compact('Career'));
    }

    /* Create New Career */
    public function create() {
        return view('admin.career.create');
    }

    /* Submit Career */
    public function store(Request $request) {
        $this->middleware('can:isAuthor');
        $user = auth()->user();
        $CareerData = $request->all();
        $CareerData['uid'] = $user->id;
        $CareerData['slug'] = SlugService::createSlug(Career::class, 'slug', $request->title);

        /* Save Thumbnail */
        if ($thumbnail_path = $request->file('thumbnail')) {
            $attachments_id = array();
            if ($path = $thumbnail_path->store('career/thumbnail/full')) {
                $Attachments = new Attachments();
                $Attachments->uid = $user->id;
                $Attachments->orgname = $thumbnail_path->getClientOriginalName();
                $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                $Attachments->type = $thumbnail_path->extension();
                $img = Image::make('storage/app/career/thumbnail/full/' . $Attachments->path);

                // save the file 636px
                $img->backup();
                $img->crop(636, 385);

                if (!file_exists('storage/app/career/thumbnail/636')) {
                    mkdir('storage/app/career/thumbnail/636', 0755, true);
                }
                $img->save('storage/app/career/thumbnail/636/' . pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'], 100);

                if ($Attachments->save()) {
                    array_push($attachments_id, $Attachments->id);
                } else {
                    return redirect()->back()->with('notification', [
                        'status' => 'danger',
                        'message' => 'Thumbnail is not uploaded!',
                    ]);
                }
            }
            $CareerData['thumbnail'] = end($attachments_id);
        }

        if (Career::create($CareerData)) {
            return redirect('dashboard/career')->with('notification', [
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

    /* Edit Career Page */
    public function edit($id) {
        $Career = Career::find($id);
        return view('admin.career.edit', compact('Career'));
    }

    /* Update Career */
    public function update(Request $request, $id) {
        $this->middleware('can:isAuthor');
        $user = auth()->user();
        $Career = Career::find($id);

        $CareerData = $request->all();
        $CareerData['slug'] = $Career->slug;
        if ($Career->title != $request->title) {
            $CareerData['slug'] = SlugService::createSlug(Career::class, 'slug', $request->title);
        }

        /* Save Thumbnail */
        if ($thumbnail_path = $request->file('thumbnail')) {
            $attachments_id = array();
            if ($path = $thumbnail_path->store('career/thumbnail/full')) {
                $Attachments = new Attachments();
                $Attachments->uid = $user->id;
                $Attachments->orgname = $thumbnail_path->getClientOriginalName();
                $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                $Attachments->type = $thumbnail_path->extension();
                $img = Image::make('storage/app/career/thumbnail/full/' . $Attachments->path);

                // save the file 350px
                $img->backup();
                $img->crop(636, 385);

                if (!file_exists('storage/app/career/thumbnail/636')) {
                    mkdir('storage/app/career/thumbnail/636', 0755, true);
                }
                $img->save('storage/app/career/thumbnail/636/' . pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'], 100);

                if ($Attachments->save()) {
                    array_push($attachments_id, $Attachments->id);
                } else {
                    return redirect()->back()->with('notification', [
                        'status' => 'danger',
                        'message' => 'Thumbnail is not uploaded!',
                    ]);
                }
            }
            $CareerData['thumbnail'] = end($attachments_id);
        }

        if ($Career->update($CareerData)) {
            return redirect()->back()->with('notification', [
                'class' => 'success',
                'message' => 'Post Updated.'
            ]);
        } else {
            return redirect('dashboard/career')->with('notification', [
                'class' => 'danger',
                'message' => 'Error.'
            ]);
        }
    }

    /* Show All Blog Career */
    public function show_all() {
        $Career = Career::orderBy('created_at', 'desc')->paginate(12)->onEachSide(2);
        return view('site.pages.career.careers', compact('Career'));
    }

    /* Show Career */
    public function show($slug){
        $Career = Career::where('slug', $slug)->first();

        return view('site.pages.career.single', compact('Career'));
    }

    /* Career Destroy */
    public function destroy(Request $request) {
        $this->middleware('can:isAuthor');
        foreach ($request->delete_item as $key => $item) {
            Career::where('id', $key)->delete();
        }

        return redirect('/dashboard/career')->with('notification', [
            'class' => 'success',
            'message' => 'Career is Deleted.'
        ]);
    }

}
