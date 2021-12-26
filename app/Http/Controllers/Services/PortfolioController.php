<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Model\Attachments;
use App\Model\Portfolio;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PortfolioController extends Controller {
    /* Show All Portfolios */
    public function index() {
        $Portfolio = Portfolio::orderBy('created_at', 'desc')->paginate(12)->onEachSide(2);
        return view('admin.portfolio.index', compact('Portfolio'));
    }

    /* Create Portfolios */
    public function create() {
        return view('admin.portfolio.create');
    }

    /* Portfolio Store */
    public function store(Request $request) {
        $PortfolioData = $request->all();
        $user = auth()->user();
        $PortfolioData['uid'] = $user->id;


        $Grid = [];
        foreach ($request->portfolio as $item) {

            /* Save Thumbnail */
            if ($thumbnail_path = $item['image']) {
                $attachments_id = array();
                if ($path = $thumbnail_path->store('portfolio/full')) {
                    $Attachments = new Attachments();
                    $Attachments->uid = $user->id;
                    $Attachments->orgname = $thumbnail_path->getClientOriginalName();
                    $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                    $Attachments->type = $thumbnail_path->extension();
                    $img = Image::make('storage/app/portfolio/full/' . $Attachments->path);

                    // save the file 412px
                    $img->backup();
                    $img->resize(412, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });


                    if (!file_exists('storage/app/portfolio/thumbnail')) {
                        mkdir('storage/app/portfolio/thumbnail', 0755, true);
                    }
                    $img->save('storage/app/portfolio/thumbnail/' . pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'], 100);

                    if ($Attachments->save()) {
                        array_push($attachments_id, $Attachments->id);
                    } else {
                        return redirect()->back()->with('notification', [
                            'status' => 'danger',
                            'message' => 'Image is not uploaded!',
                        ]);
                    }
                }
            }

            array_push($Grid, ['name' => $item['name'], 'image' => end($attachments_id)]);
        }

        $PortfolioData['grid'] = json_encode($Grid);

        if (Portfolio::create($PortfolioData)) {
            return redirect('dashboard/portfolio')->with('notification', [
                'class' => 'success',
                'message' => 'Portfolio Created.'
            ]);
        } else {
            return redirect()->back()->with('notification', [
                'class' => 'alert',
                'message' => 'Error.'
            ]);
        }

    }

    /* Edit Portfolio */
    public function edit($id) {
        $Portfolio = Portfolio::find($id);

        return view('admin.portfolio.edit', compact('Portfolio'));
    }

    /* Portfolio Update */
    public function update(Request $request, $id) {
        $user = auth()->user();
        $Portfolio = Portfolio::find($id);

        $PortfolioData = $request->all();
        $PortfolioData['slug'] = $Portfolio->slug;
        if ($Portfolio->title != $request->title) {
            $PortfolioData['slug'] = SlugService::createSlug(Portfolio::class, 'slug', $request->title);
        }

        /* Technology Items */
        $OldPortfolio = json_decode($Portfolio->grid, true);
        if ($request->portfolio) {
            $i = 0;
            $Grid = [];
            foreach ($request->portfolio as $item) {

                /* Save Thumbnail */
                if (isset($item['image']) && $thumbnail_path = $item['image']) {
                    $attachments_id = array();
                    if ($path = $thumbnail_path->store('portfolio/full')) {
                        $Attachments = new Attachments();
                        $Attachments->uid = $user->id;
                        $Attachments->orgname = $thumbnail_path->getClientOriginalName();
                        $Attachments->path = pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'];
                        $Attachments->type = $thumbnail_path->extension();
                        $img = Image::make('storage/app/portfolio/full/' . $Attachments->path);

                        // save the file 412px
                        $img->backup();
                        $img->resize(412, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });


                        if (!file_exists('storage/app/portfolio/thumbnail')) {
                            mkdir('storage/app/portfolio/thumbnail', 0755, true);
                        }
                        $img->save('storage/app/portfolio/thumbnail/' . pathinfo($path)['filename'] . '.' . pathinfo($path)['extension'], 100);

                        if ($Attachments->save()) {
                            array_push($attachments_id, $Attachments->id);
                        } else {
                            return redirect()->back()->with('notification', [
                                'status' => 'danger',
                                'message' => 'Image is not uploaded!',
                            ]);
                        }
                    }
                    array_push($Grid, ['name' => $item['name'], 'image' => end($attachments_id)]);
                } else {
                    array_push($Grid, [
                        'name' => $item['name'],
                        'image' => $OldPortfolio[$i]['image']
                    ]);
                }
                $i += 1;
            }
        }

        $PortfolioData['grid'] = json_encode($Grid);

        if ($Portfolio->update($PortfolioData)) {
            return redirect()->back()->with('notification', [
                'class' => 'success',
                'message' => 'Portfolio Updated.'
            ]);
        } else {
            return redirect('dashboard/portfolioData')->with('notification', [
                'class' => 'danger',
                'message' => 'Error.'
            ]);
        }
    }


    /* Services Destroy */
    public function destroy(Request $request) {
        $this->middleware('can:isAuthor');
        foreach ($request->delete_item as $key => $item) {
            Portfolio::where('id', $key)->delete();
        }

        return redirect('/dashboard/portfolio')->with('notification', [
            'class' => 'success',
            'message' => 'Portfolio Deleted.'
        ]);
    }
}
