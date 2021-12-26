<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Model\Attachments;
use App\Model\Portfolio;
use App\Model\Services;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ServicesController extends Controller {
    /* All Services Pages */
    public function index() {
        $Services = Services::orderBy('created_at', 'desc')->paginate(12)->onEachSide(2);
        return view('admin.services.index', compact('Services'));
    }

    /* Create Services Pages */
    public function create() {
        $Services = Services::where('service_level', 'parent')->select('id', 'title')->orderBy('created_at', 'desc')->get();
        $Portfolio = Portfolio::select('id', 'title')->get();

        $Date = [
            'Services',
            'Portfolio'
        ];

        return view('admin.services.create', compact($Date));
    }

    /* Service Store */
    public function store(Request $request) {
        $ServiceData = $request->all();
        $user = auth()->user();
        $ServiceData['uid'] = $user->id;

        /* Parent ID */
        if ($request->service_level == 'child' && isset($ServiceData['parent_id'])) {
            $ServiceData['parent_id'] = $request->parent_id;
        } else {
            $ServiceData['parent_id'] = null;
        }

        /* Save Thumbnail */
        if ($thumbnail_path = $request->file('thumbnail')) {
            $attachments_id = array();
            if ($path = $thumbnail_path->store('services/thumbnail/full')) {
                $Attachments = new Attachments();
                $Attachments->uid = $user->id;
                $Attachments->orgname = $thumbnail_path->getClientOriginalName();
                $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                $Attachments->type = $thumbnail_path->extension();
                $img = Image::make('storage/app/services/thumbnail/full/' . $Attachments->path);

                // save the file 636px
                $img->backup();
                $img->crop(636, 385);

                if (!file_exists('storage/app/services/thumbnail/636')) {
                    mkdir('storage/app/services/thumbnail/636', 0755, true);
                }
                $img->save('storage/app/services/thumbnail/636/' . pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'], 100);

                if ($Attachments->save()) {
                    array_push($attachments_id, $Attachments->id);
                } else {
                    return redirect()->back()->with('notification', [
                        'status' => 'danger',
                        'message' => 'Thumbnail is not uploaded!',
                    ]);
                }
            }
            $ServiceData['thumbnail'] = end($attachments_id);
        }

        /* Service Include */
        if ($request->service_includes) {
            $ServiceIncludesData = array();
            foreach ($request->service_includes as $item) {
                if ($thumbnail_path = $item['icon']) {
                    $attachments_id = array();

                    if ($item['icon']->extension() == 'svg') {
                        if ($path = $thumbnail_path->store('services/service-include')) {
                            $Attachments = new Attachments();
                            $Attachments->uid = $user->id;
                            $Attachments->orgname = $thumbnail_path->getClientOriginalName();
                            $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                            $Attachments->type = $thumbnail_path->extension();
                        }
                    } else {
                        if ($path = $thumbnail_path->store('services/service-include/full')) {
                            $Attachments = new Attachments();
                            $Attachments->uid = $user->id;
                            $Attachments->orgname = $thumbnail_path->getClientOriginalName();
                            $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                            $Attachments->type = $thumbnail_path->extension();
                            $img = Image::make('storage/app/services/service-include/full/' . $Attachments->path);

                            // save the file 150px
                            $img->backup();
                            $img->resize(150, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });

                            if (!file_exists('storage/app/services/service-include')) {
                                mkdir('storage/app/services/service-include', 0755, true);
                            }
                            $img->save('storage/app/services/service-include/' . pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'], 100);

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

                    array_push($ServiceIncludesData, ['name' => $item['name'], 'icon' => end($attachments_id)]);
                }
            }
            $ServiceData['service_includes'] = json_encode($ServiceIncludesData);
        }

        /* Technology Items */
        if ($request->technology_list) {
            $TechnologyData = array();
            foreach ($request->technology_list as $item) {
                if ($thumbnail_path = $item['icon']) {
                    $attachments_id = array();

                    if ($item['icon']->extension() == 'svg') {
                        if ($path = $thumbnail_path->store('services/technology')) {
                            $Attachments = new Attachments();
                            $Attachments->uid = $user->id;
                            $Attachments->orgname = $thumbnail_path->getClientOriginalName();
                            $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                            $Attachments->type = $thumbnail_path->extension();
                        }
                    } else {
                        if ($path = $thumbnail_path->store('services/technology/full')) {
                            $Attachments = new Attachments();
                            $Attachments->uid = $user->id;
                            $Attachments->orgname = $thumbnail_path->getClientOriginalName();
                            $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                            $Attachments->type = $thumbnail_path->extension();
                            $img = Image::make('storage/app/services/technology/full/' . $Attachments->path);

                            // save the file 150px
                            $img->backup();
                            $img->resize(150, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });

                            if (!file_exists('storage/app/services/technology')) {
                                mkdir('storage/app/services/technology', 0755, true);
                            }
                            $img->save('storage/app/services/technology/' . pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'], 100);
                        }
                    }

                    if ($Attachments->save()) {
                        array_push($attachments_id, $Attachments->id);
                    } else {
                        return redirect()->back()->with('notification', [
                            'status' => 'danger',
                            'message' => 'Thumbnail is not uploaded!',
                        ]);
                    }

                    array_push($TechnologyData, ['name' => $item['name'], 'icon' => end($attachments_id)]);
                }
            }
            $ServiceData['technology_list'] = json_encode($TechnologyData);
        }

        /* Service Icon */
        if (isset($request->service_meta[0]['icon_service']) && $service_icon = $request->service_meta[0]['icon_service']) {
            $attachments_id = array();

            if ($service_icon->extension() == 'svg') {
                if ($path = $service_icon->store('services/service-icon')) {
                    $Attachments = new Attachments();
                    $Attachments->uid = $user->id;
                    $Attachments->orgname = $service_icon->getClientOriginalName();
                    $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                    $Attachments->type = $service_icon->extension();
                }
            } else {
                if ($path = $service_icon->store('services/service-icon/full')) {
                    $Attachments = new Attachments();
                    $Attachments->uid = $user->id;
                    $Attachments->orgname = $service_icon->getClientOriginalName();
                    $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                    $Attachments->type = $service_icon->extension();
                    $img = Image::make('storage/app/services/service-icon/full/' . $Attachments->path);

                    // save the file 150px
                    $img->backup();
                    $img->resize(150, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    if (!file_exists('storage/app/services/service-icon')) {
                        mkdir('storage/app/services/service-icon', 0755, true);
                    }
                    $img->save('storage/app/services/service-icon/' . pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'], 100);

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

            $ServiceData['service_meta'][0]['icon_service'] = end($attachments_id);
        }

        $ServiceData['service_meta'] = json_encode(end($ServiceData['service_meta']));

        if (Services::create($ServiceData)) {
            return redirect('dashboard/services')->with('notification', [
                'class' => 'success',
                'message' => 'Services Created.'
            ]);
        } else {
            return redirect()->back()->with('notification', [
                'class' => 'alert',
                'message' => 'Error.'
            ]);
        }
    }

    /* Service Edit Page */
    public function edit($id) {
        $Services = Services::find($id);
        $ParentServices = Services::where('service_level', 'parent')->select('id', 'title')->orderBy('created_at', 'desc')->get();
        $Portfolio = Portfolio::select('id', 'title')->get();

        $Date = [
            'Services',
            'ParentServices',
            'Portfolio'
        ];

        return view('admin.services.edit', compact($Date));
    }

    /* Service Update */
    public function update(Request $request, $id) {
        $user = auth()->user();
        $Services = Services::find($id);

        $ServiceData = $request->all();
        $ServiceData['slug'] = $Services->slug;
        if ($Services->title != $request->title) {
            $ServiceData['slug'] = SlugService::createSlug(Services::class, 'slug', $request->title);
        }

        /* Thumbnail */
        if ($thumbnail_path = $request->file('thumbnail')) {
            $attachments_id = array();
            if ($path = $thumbnail_path->store('services/thumbnail/full')) {
                $Attachments = new Attachments();
                $Attachments->uid = $user->id;
                $Attachments->orgname = $thumbnail_path->getClientOriginalName();
                $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                $Attachments->type = $thumbnail_path->extension();
                $img = Image::make('storage/app/services/thumbnail/full/' . $Attachments->path);

                // save the file 636px
                $img->backup();
                $img->crop(636, 385);

                if (!file_exists('storage/app/services/thumbnail/636')) {
                    mkdir('storage/app/services/thumbnail/636', 0755, true);
                }
                $img->save('storage/app/services/thumbnail/636/' . pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'], 100);

                if ($Attachments->save()) {
                    array_push($attachments_id, $Attachments->id);
                } else {
                    return redirect()->back()->with('notification', [
                        'status' => 'danger',
                        'message' => 'Thumbnail is not uploaded!',
                    ]);
                }
            }
            $ServiceData['thumbnail'] = end($attachments_id);
        }

        /* Service Include */
        $OldServiceIncludes = json_decode($Services->service_includes, true);
        if ($request->service_includes) {
            $i = 0;
            $ServiceIncludesData = array();
            foreach ($request->service_includes as $item) {
                if (isset($item['icon']) && $thumbnail_path = $item['icon']) {
                    $attachments_id = array();

                    if ($item['icon']->extension() == 'svg') {
                        if ($path = $thumbnail_path->store('services/service-include')) {
                            $Attachments = new Attachments();
                            $Attachments->uid = $user->id;
                            $Attachments->orgname = $thumbnail_path->getClientOriginalName();
                            $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                            $Attachments->type = $thumbnail_path->extension();
                        }
                    } else {
                        if ($path = $thumbnail_path->store('services/service-include/full')) {
                            $Attachments = new Attachments();
                            $Attachments->uid = $user->id;
                            $Attachments->orgname = $thumbnail_path->getClientOriginalName();
                            $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                            $Attachments->type = $thumbnail_path->extension();
                            $img = Image::make('storage/app/services/service-include/full/' . $Attachments->path);

                            // save the file 150px
                            $img->backup();
                            $img->resize(150, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });

                            if (!file_exists('storage/app/services/service-include')) {
                                mkdir('storage/app/services/service-include', 0755, true);
                            }
                            $img->save('storage/app/services/service-include/' . pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'], 100);

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

                    array_push($ServiceIncludesData, ['name' => $item['name'], 'icon' => end($attachments_id)]);
                } else {
                    array_push($ServiceIncludesData, [
                        'name' => $item['name'],
                        'icon' => $OldServiceIncludes[$i]['icon']
                    ]);
                }
                $i += 1;
            }
            $ServiceData['service_includes'] = json_encode($ServiceIncludesData);
        }

        /* Technology Items */
        $OldTechnologyList = json_decode($Services->technology_list, true);
        if ($request->technology_list) {
            $i = 0;
            $TechnologyData = array();
            foreach ($request->technology_list as $item) {
                if (isset($item['icon']) && $thumbnail_path = $item['icon']) {
                    $attachments_id = array();

                    if ($item['icon']->extension() == 'svg') {
                        if ($path = $thumbnail_path->store('services/technology')) {
                            $Attachments = new Attachments();
                            $Attachments->uid = $user->id;
                            $Attachments->orgname = $thumbnail_path->getClientOriginalName();
                            $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                            $Attachments->type = $thumbnail_path->extension();
                        }
                    } else {
                        if ($path = $thumbnail_path->store('services/technology/full')) {
                            $Attachments = new Attachments();
                            $Attachments->uid = $user->id;
                            $Attachments->orgname = $thumbnail_path->getClientOriginalName();
                            $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                            $Attachments->type = $thumbnail_path->extension();
                            $img = Image::make('storage/app/services/technology/full/' . $Attachments->path);

                            // save the file 150px
                            $img->backup();
                            $img->resize(150, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });

                            if (!file_exists('storage/app/services/technology')) {
                                mkdir('storage/app/services/technology', 0755, true);
                            }
                            $img->save('storage/app/services/technology/' . pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'], 100);
                        }
                    }

                    if ($Attachments->save()) {
                        array_push($attachments_id, $Attachments->id);
                    } else {
                        return redirect()->back()->with('notification', [
                            'status' => 'danger',
                            'message' => 'Thumbnail is not uploaded!',
                        ]);
                    }

                    array_push($TechnologyData, ['name' => $item['name'], 'icon' => end($attachments_id)]);
                } else {
                    array_push($TechnologyData, [
                        'name' => $item['name'],
                        'icon' => $OldTechnologyList[$i]['icon']
                    ]);
                }
                $i += 1;
            }
            $ServiceData['technology_list'] = json_encode($TechnologyData);
        }

        /* Service Icon */
        if (isset($request->service_meta[0]['icon_service']) && $service_icon = $request->service_meta[0]['icon_service']) {
            $attachments_id = array();

            if ($service_icon->extension() == 'svg') {
                if ($path = $service_icon->store('services/service-icon')) {
                    $Attachments = new Attachments();
                    $Attachments->uid = $user->id;
                    $Attachments->orgname = $service_icon->getClientOriginalName();
                    $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                    $Attachments->type = $service_icon->extension();
                }
            } else {
                if ($path = $service_icon->store('services/service-icon/full')) {
                    $Attachments = new Attachments();
                    $Attachments->uid = $user->id;
                    $Attachments->orgname = $service_icon->getClientOriginalName();
                    $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                    $Attachments->type = $service_icon->extension();
                    $img = Image::make('storage/app/services/service-icon/full/' . $Attachments->path);

                    // save the file 150px
                    $img->backup();
                    $img->resize(150, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    if (!file_exists('storage/app/services/service-icon')) {
                        mkdir('storage/app/services/service-icon', 0755, true);
                    }
                    $img->save('storage/app/services/service-icon/' . pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'], 100);

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

            $ServiceData['service_meta'][0]['icon_service'] = end($attachments_id);
        } elseif (isset(json_decode($Services->service_meta, true)['icon_service'])) {
            $ServiceData['service_meta'][0]['icon_service'] = json_decode($Services->service_meta, true)['icon_service'];
        }

        $ServiceData['service_meta'] = json_encode(end($ServiceData['service_meta']));

        if ($Services->update($ServiceData)) {
            return redirect()->back()->with('notification', [
                'class' => 'success',
                'message' => 'Service Updated.'
            ]);
        } else {
            return redirect('dashboard/services')->with('notification', [
                'class' => 'danger',
                'message' => 'Error.'
            ]);
        }
    }

    /* Show Post */
    public function show($slug) {
        $Services = Services::where('slug', $slug)->first();

        /* Get Parent Service */
        $ParentService = Services::find($Services->parent_id);

        /* Get Child Service */
        $ChildServices = Services::where('parent_id', $Services->id)->get();

        /* Portfolio */
        $Portfolio_id = Portfolio::find($Services->portfolio_id);

        $Portfolio = json_decode($Portfolio_id['grid'], true);

        $Grid = [];
        foreach ($Portfolio as $item) {
            if (array_key_exists($item['name'], $Grid)) {
                array_push($Grid[$item['name']], $item['image']);
            } else {
                $Grid[$item['name']] = [$item['image']];
            }
        }

        $Data = [
            'Services',
            'ParentService',
            'ChildServices',
            'Portfolio',
            'Grid',
        ];

        if ($Services->service_level == 'parent') {
            return view('site.pages.services.parent', compact($Data));
        } elseif ($Services->service_level == 'child') {
            return view('site.pages.services.child', compact($Data));
        }
    }

    /* Services Destroy */
    public function destroy(Request $request) {
        $this->middleware('can:isAuthor');
        foreach ($request->delete_item as $key => $item) {
            Services::where('id', $key)->delete();
        }

        return redirect('/dashboard/services')->with('notification', [
            'class' => 'success',
            'message' => 'Services Deleted.'
        ]);
    }
}
