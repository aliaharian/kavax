@extends('layouts.site.master')@section('page-title', 'Blog')@section('page-style', 'other-page/other-page.min.css')

@section('content')
    <!-- Intro Section -->
    <section class="intro-section">
        <div class="section-bg">
            <img class="shape" src="{{ asset('public/assets/site/images/base') }}/heading-bg-shape.png" alt="A young diverse team of digital experts">
            <img class="bg-img" src="{{ asset('public/assets/site/images/base') }}/header-image/archive.png" alt="A young diverse team of digital experts">
        </div>

        <div class="content-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-sm-8 col-12">
                        <div class="breadcrumb-block">
                            <ul>
                                <li><a href="{{ url('') }}">Home</a></li>
                                <li>Blog</li>
                            </ul>
                        </div>
                        <div class="title-heading">Adapt or die</div>
                        <div class="section-text">Actionable advice, tips and guides on how to grow your organisation online.</div>
                        <div class="archive-cat-list">
                            <ul>
                                <li class="active"><a href="#">All</a></li>
                                <li><a href="#">Digital marketing</a></li>
                                <li><a href="#">development</a></li>
                                <li><a href="#">Video marketing</a></li>
                                <li><a href="#">Content</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Archive Blog -->
    <section class="archive-blog-section gradient-page">
        <div class="container">
            <div class="row">
                @if(count($Blog))
                    @foreach($Blog as $item)
                        <div class="col-lg-6 col-12">
                            <div class="item-inner">
                                <a href="{{ url('blog/') .'/'. $item->slug }}">
						<span class="thumbnail">
							<img src="@if($item->thumbnail && isset(\App\Model\Attachments::find($item->thumbnail)->path)) {{asset('storage/app/blog/thumbnail/636').'/'.\App\Model\Attachments::find($item->thumbnail)->path}} @else{{ asset('public/assets/admin/img/base/icons/image.svg') }}@endif" alt="{{ $item->title }}">
						</span> <span class="post-meta">
{{--							<span class="cat-name">{{ $item->title }}</span>--}}
                        <div class="date">{{ date('F / d M, Y', strtotime($item->created_at)) }}</div>
						</span> <span class="title">{{ $item->title }}</span>

                                    <span class="read-more">Read article</span> </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="center">No item found!</div>
                @endif
            </div>

            <div class="section-pagination center num-fa">
                {{$Blog->appends(request()->input())->links('vendor.pagination.default')}}
            </div>
        </div>
    </section>
@endsection
