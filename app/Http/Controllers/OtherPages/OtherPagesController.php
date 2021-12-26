<?php

namespace App\Http\Controllers\OtherPages;

use App\Http\Controllers\Controller;
use App\Model\Attachments;
use App\Model\OtherPages;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class OtherPagesController extends Controller {
    /* Show All Pages */
    public function index() {
        $OtherPages = OtherPages::orderBy('created_at', 'desc')->paginate(12)->onEachSide(2);
        return view('admin.other-pages.index', compact('OtherPages'));
    }

    /* Create New Page */
    public function create() {
        return view('admin.other-pages.create');
    }


    /* Submit Page */
    public function store(Request $request) {
        $this->middleware('can:isAuthor');
        $user = auth()->user();
        $OtherPagesData = $request->all();
        $OtherPagesData['uid'] = $user->id;
        $OtherPagesData['slug'] = SlugService::createSlug(OtherPages::class, 'slug', $request->title);

        /* Save Thumbnail */
        if ($thumbnail_path = $request->file('thumbnail')) {
            $attachments_id = array();
            if ($path = $thumbnail_path->store('other-pages/thumbnail/full')) {
                $Attachments = new Attachments();
                $Attachments->uid = $user->id;
                $Attachments->orgname = $thumbnail_path->getClientOriginalName();
                $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                $Attachments->type = $thumbnail_path->extension();
                $img = Image::make('storage/app/other-pages/thumbnail/full/' . $Attachments->path);

                // save the file 636px
                $img->backup();
                $img->crop(636, 385);

                if (!file_exists('storage/app/other-pages/thumbnail/636')) {
                    mkdir('storage/app/other-pages/thumbnail/636', 0755, true);
                }
                $img->save('storage/app/other-pages/thumbnail/636/' . pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'], 100);

                if ($Attachments->save()) {
                    array_push($attachments_id, $Attachments->id);
                } else {
                    return redirect()->back()->with('notification', [
                        'status' => 'danger',
                        'message' => 'Thumbnail is not uploaded!',
                    ]);
                }
            }
            $OtherPagesData['thumbnail'] = end($attachments_id);
        }

        /* Team */
        if ($request->team) {
            $TeamData = array();
            foreach ($request->team as $item) {
                if ($thumbnail_path = $item['image']) {
                    $attachments_id = array();

                    if ($item['image']->extension() == 'svg') {
                        if ($path = $thumbnail_path->store('other-pages/team')) {
                            $Attachments = new Attachments();
                            $Attachments->uid = $user->id;
                            $Attachments->orgname = $thumbnail_path->getClientOriginalName();
                            $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                            $Attachments->type = $thumbnail_path->extension();
                        }
                    } else {
                        if ($path = $thumbnail_path->store('other-pages/team/full')) {
                            $Attachments = new Attachments();
                            $Attachments->uid = $user->id;
                            $Attachments->orgname = $thumbnail_path->getClientOriginalName();
                            $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                            $Attachments->type = $thumbnail_path->extension();
                            $img = Image::make('storage/app/other-p
                            ages/team/full/' . $Attachments->path);

                            // save the file 305px
                            $img->backup();
                            $img->resize(305, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });


                            if (!file_exists('storage/app/other-pages/team')) {
                                mkdir('storage/app/other-pages/team', 0755, true);
                            }
                            $img->save('storage/app/other-pages/team/' . pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'], 100);

                        }
                    }

                    if ($Attachments->save()) {
                        array_push($attachments_id, $Attachments->id);
                    } else {
                        return redirect()->back()->with('notification', [
                            'status' => 'danger',
                            'message' => 'Image is not uploaded!',
                        ]);
                    }

                    array_push($TeamData, [
                        'name' => $item['name'],
                        'job' => $item['job'],
                        'image' => end($attachments_id)
                    ]);
                }
            }
            $OtherPagesData['page_meta'] = json_encode(['team' => $TeamData]);
        }

        if (OtherPages::create($OtherPagesData)) {
            return redirect('dashboard/other-pages')->with('notification', [
                'class' => 'success',
                'message' => 'Page Created.'
            ]);
        } else {
            return redirect()->back()->with('notification', [
                'class' => 'alert',
                'message' => 'Error.'
            ]);
        }
    }

    /* Edit Post Other Pages */
    public function edit($id) {
        $OtherPage = OtherPages::find($id);
        return view('admin.other-pages.edit', compact('OtherPage'));
    }

    /* Update Page */
    public function update(Request $request, $id) {
        $this->middleware('can:isAuthor');
        $user = auth()->user();
        $OtherPage = OtherPages::find($id);

        $OtherPageData = $request->all();
        $OtherPageData['slug'] = $OtherPage->slug;
        if ($OtherPage->title != $request->title) {
            $OtherPageData['slug'] = SlugService::createSlug(OtherPages::class, 'slug', $request->title);
        }

        /* Save Thumbnail */
        if ($thumbnail_path = $request->file('thumbnail')) {
            $attachments_id = array();
            if ($path = $thumbnail_path->store('other-pages/thumbnail/full')) {
                $Attachments = new Attachments();
                $Attachments->uid = $user->id;
                $Attachments->orgname = $thumbnail_path->getClientOriginalName();
                $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                $Attachments->type = $thumbnail_path->extension();
                $img = Image::make('storage/app/other-pages/thumbnail/full/' . $Attachments->path);

                // save the file 636px
                $img->backup();
                $img->crop(636, 385);

                if (!file_exists('storage/app/other-pages/thumbnail/636')) {
                    mkdir('storage/app/other-pages/thumbnail/636', 0755, true);
                }
                $img->save('storage/app/other-pages/thumbnail/636/' . pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'], 100);

                if ($Attachments->save()) {
                    array_push($attachments_id, $Attachments->id);
                } else {
                    return redirect()->back()->with('notification', [
                        'status' => 'danger',
                        'message' => 'Thumbnail is not uploaded!',
                    ]);
                }
            }
            $OtherPageData['thumbnail'] = end($attachments_id);
        }

        /* Team */
        $OldTeam = json_decode($OtherPage->page_meta, true)['team'];
        if ($request->team) {
            $i = 0;
            $TeamData = array();
            foreach ($request->team as $item) {
                if (isset($item['image']) && $thumbnail_path = $item['image']) {
                    $attachments_id = array();

                    if ($item['image']->extension() == 'svg') {
                        if ($path = $thumbnail_path->store('other-page/team')) {
                            $Attachments = new Attachments();
                            $Attachments->uid = $user->id;
                            $Attachments->orgname = $thumbnail_path->getClientOriginalName();
                            $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                            $Attachments->type = $thumbnail_path->extension();
                        }
                    } else {
                        if ($path = $thumbnail_path->store('other-pages/team/full')) {
                            $Attachments = new Attachments();
                            $Attachments->uid = $user->id;
                            $Attachments->orgname = $thumbnail_path->getClientOriginalName();
                            $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                            $Attachments->type = $thumbnail_path->extension();
                            $img = Image::make('storage/app/other-pages/team/full/' . $Attachments->path);

                            // save the file 305px
                            $img->backup();
                            $img->resize(305, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });


                            if (!file_exists('storage/app/other-pages/team')) {
                                mkdir('storage/app/other-pages/team', 0755, true);
                            }
                            $img->save('storage/app/other-pages/team/' . pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'], 100);

                        }
                    }

                    if ($Attachments->save()) {
                        array_push($attachments_id, $Attachments->id);
                    } else {
                        return redirect()->back()->with('notification', [
                            'status' => 'danger',
                            'message' => 'Image is not uploaded!',
                        ]);
                    }

                    array_push($TeamData, ['name' => $item['name'], 'job' => $item['job'], 'image' => end($attachments_id)]);
                } else {
                    array_push($TeamData, [
                        'name' => $item['name'],
                        'job' => $item['job'],
                        'image' => $OldTeam[$i]['image']
                    ]);
                }
                $i += 1;
            }
            $OtherPageData['page_meta'] = json_encode(['team' => $TeamData]);
        }

        if ($OtherPage->update($OtherPageData)) {
            return redirect()->back()->with('notification', [
                'class' => 'success',
                'message' => 'Page Updated.'
            ]);
        } else {
            return redirect('dashboard/other-pages')->with('notification', [
                'class' => 'danger',
                'message' => 'Error.'
            ]);
        }
    }

    /* Show Page */
    public function show($slug) {
        $OtherPage = OtherPages::where('slug', $slug)->first();

        if ($OtherPage->template == 'about-us') {
            return view('site.pages.other-pages.about-us', compact('OtherPage'));
        }
    }

    /* Page Destroy */
    public function destroy(Request $request) {
        $this->middleware('can:isAuthor');
        foreach ($request->delete_item as $key => $item) {
            OtherPages::where('id', $key)->delete();
        }

        return redirect('/dashboard/other-pages')->with('notification', [
            'class' => 'success',
            'message' => 'Item is Delete.'
        ]);
    }
}
