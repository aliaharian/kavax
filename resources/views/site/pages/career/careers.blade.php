@extends('layouts.site.master')@section('page-title', 'Careers')@section('page-style', 'other-page/other-page.min.css')

@section('content')
    <!-- Intro Section -->
    <section class="intro-section">
        <div class="section-bg">
            <img class="shape" src="{{ asset('public/assets/site/images/base') }}/heading-bg-shape.png" alt="Careers">
            <img class="bg-img" src="{{ asset('public/assets/site/images/base') }}/header-image/career-list.png" alt="Careers">
        </div>

        <div class="content-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-sm-8 col-12">
                        <div class="breadcrumb-block">
                            <ul>
                                <li><a href="{{ url('') }}">Home</a></li>
                                <li>Careers</li>
                            </ul>
                        </div>
                        <div class="title-heading">Careers</div>
                        <div class="section-text">We’re always on the lookout for bright digital minds, creative superstars, coding gurus and razorsharp client partners to add their own brand of digital brilliance to our heady mix.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Archive Career -->
    <section class="archive-blog-section gradient-page">
        <div class="container">
            <div class="row">
                @if(count($Career))
                    @foreach($Career as $item)
                        <div class="col-lg-6 col-12">
                            <div class="item-inner">
                                <a href="{{ url('career/') .'/'. $item->slug }}">
						<span class="thumbnail">
							<img src="@if($item->thumbnail && isset(\App\Model\Attachments::find($item->thumbnail)->path)) {{asset('storage/app/career/thumbnail/636').'/'.\App\Model\Attachments::find($item->thumbnail)->path}} @else{{ asset('public/assets/admin/img/base/icons/image.svg') }}@endif" alt="{{ $item->title }}">
						</span> <span class="post-meta">
{{--							<span class="cat-name">{{ $item->title }}</span>--}}
                        <div class="date">{{ $item->location }} / {{ $item->term }}</div>
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
                {{$Career->appends(request()->input())->links('vendor.pagination.default')}}
            </div>
        </div>
    </section>

    <!-- Start Your Project -->
    <section class="section-galaxy-bg request-section m-0">
        <div class="section-inner">
            <div class="container">
                <div class="section-title center">Ready to Skyrocket Your Business?</div>
                <div class="row center">
                    <div class="col-sm-6">
                        <div class="request-col">
                            <div class="title-item">Start your project</div>
                            <div class="cta-link"><a href="{{ url('services-request') }}">Submit your brief</a></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="request-col">
                            <div class="title-item">We're hiring</div>
                            <div class="cta-link"><a href="{{ url('contact-us') }}">join the team</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer-section')
    @include('layouts.site.sections.review-client')
@endsection
