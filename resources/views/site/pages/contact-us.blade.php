@extends('layouts.site.master')@section('page-title', 'Contact Us')
@section('page-style', 'other-page/other-page.min.css')

@section('content')
    <!-- Intro Section -->
    <section class="intro-section">
        <div class="section-bg">
            <img class="shape" src="{{ asset('public/assets/site/images/base') }}/heading-bg-shape.png" alt="A young diverse team of digital experts">
            <img class="bg-img" src="{{ asset('public/assets/site/images/base') }}/header-image/contact-us.png" alt="A young diverse team of digital experts">
        </div>

        <div class="content-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-sm-8 col-12">
                        <div class="breadcrumb-block">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Contact Us</li>
                            </ul>
                        </div>
                        <div class="title-heading">A young diverse team of digital experts</div>
                        <div class="section-text">With our space shuttle launch platform in the heart of London's creative community, we've got our finger on the launch button for your projects.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section class="contact-us-section gradient-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="contact-info">
                        <div class="row">
                            <div class="col-12">
                                <div class="contact-item">
                                    <div class="label">Location:</div>
                                    <div class="value">
                                        KavaX Media<br> International House<br> 64, Nile Street, London, N1 7SR, United Kingdom
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm col-12">
                                <div class="contact-item">
                                    <div class="label">E-Mail:</div>
                                    <div class="value">
                                        <a href="mailto:info@kavax.co.uk">info@kavax.co.uk</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm col-12">
                                <div class="contact-item">
                                    <div class="label">Call:</div>
                                    <div class="value">
                                        <a href="tel:+447807059059">+447807059059</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="contact-us-form">
                        <div class="heading-form">Talk to us</div>
                        @php
                            $msg = \Session::get('notification')
                        @endphp

                        @if($msg)
                            <div class="message-session {{ $msg['class'] }}">{{ $msg['message'] }}</div>
                        @endif

                        <form action="{{ route('ContactUs.store') }}" method="POST">
                            @csrf
                            <div class="form-block">
                                <div class="row gy-4">
                                    <div class="col-sm-6 col-12">
                                        <div class="field-block on-line-input text-field">
                                            <div class="row g-0">
                                                {!! Form::text('name',null,[ 'required', 'id'=>'name' , 'class'=>'col-12 order-1']) !!}
                                                {!! Form::label('name','Name:',['class'=>'col-12 order-0']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="field-block on-line-input text-field">
                                            <div class="row g-0">
                                                {!! Form::text('email',null,[ 'required', 'id'=>'email' , 'class'=>'col-12 order-1']) !!}
                                                {!! Form::label('email','Email:',['class'=>'col-12 order-0']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="field-block on-line-input text-field">
                                            <div class="row g-0">
                                                {!! Form::text('phone',null,[ 'required', 'id'=>'phone' , 'class'=>'col-12 order-1']) !!}
                                                {!! Form::label('phone','phone number:',['class'=>'col-12 order-0']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="field-block on-line-input text-field">
                                            <div class="row g-0">
                                                {!! Form::text('business_name',null,[ 'id'=>'business_name' , 'class'=>'col-12 order-1']) !!}
                                                {!! Form::label('business_name','business name:',['class'=>'col-12 order-0']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="field-block on-line-input text-field">
                                            <div class="row g-0">
                                                {!! Form::textarea('message',null,[ 'required', 'id'=>'message' , 'class'=>'col-12 order-1']) !!}
                                                {!! Form::label('message','your message:',['class'=>'col-12 order-0']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="field-block submit-form">
                                            <input type="submit" value="SEND message">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- General Enquiries  -->
    <section class="general-enquiries">
        <div class="section-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="section-image">
                            <img src="{{ asset('public/assets/site/images/base') }}/general-enquiries.png" alt="General Enquiries">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="general-enquiries-block">
                            <div class="image-absolute">
                                <img src="{{ asset('public/assets/site/images/base') }}/general-enquiries-block.png" alt="General Enquiries">
                            </div>
                            <div class="title base-color text-color text-capitalize">General enquiries</div>
                            <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore</div>
                        </div>
                    </div>
                </div>
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

