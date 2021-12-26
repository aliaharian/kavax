@extends('layouts.admin.dashboard.master')

@section('title-page')
    <span class="icon"><svg height="682pt" viewBox="-21 -47 682.6667 682" width="682pt" xmlns="http://www.w3.org/2000/svg"><path d="M552.0117-1.332H87.9883C39.4727-1.332 0 38.1328 0 86.6562V370.629c0 48.414 39.3008 87.8164 87.6758 87.9883v128.8633l185.1914-128.8633h279.1445c48.5156 0 87.9883-39.4727 87.9883-87.9883V86.6562c0-48.5234-39.4727-87.9882-87.9883-87.9882zM602.5 370.629c0 27.8358-22.6484 50.4882-50.4883 50.4882H261.1016l-135.9258 94.586v-94.586H87.9883c-27.8399 0-50.4883-22.6524-50.4883-50.4883V86.6563c0-27.8438 22.6484-50.4883 50.4883-50.4883h464.0234c27.8399 0 50.4883 22.6445 50.4883 50.4883zm0 0"/><path d="M171.293 131.1719h297.414v37.5H171.293zM171.293 211.1719h297.414v37.5H171.293zM171.293 291.1719h297.414v37.5H171.293zm0 0"/></svg></span>
    <span class="text text-capitalize">{{ $ServiceRequest->project_name }}</span>
@endsection

@section('content')
    <section class="form-section">
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <div class="col-12">
                        <div class="widget-block widget-item widget-style">
                            <div class="heading-widget">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <span class="widget-title">Request Details</span>
                                    </div>
                                    <div class="col-4 right">{{ $ServiceRequest->created_at }}</div>
                                </div>
                            </div>

                            <div class="widget-content widget-content-padding">
                                <div class="show-info-block">
                                    <div class="item-info">
                                        <div class="item-label title-block">Services</div>
                                        <ul>
                                            @forelse(json_decode( $ServiceRequest->service_type , true) as $item)
                                                <li>
                                                    <div class="item-value value-block text-capitalize">{{ str_replace('-',' ', $item) }}</div>
                                                </li>
                                            @empty
                                            @endforelse
                                        </ul>
                                    </div>

                                    @foreach(json_decode($ServiceRequest->request_meta, true) as $key => $item)
                                        <div class="title-block">{{ $key }}</div>
                                        <div class="value-block">{{ $item }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="widget-block widget-item widget-style">
                    <div class="heading-widget">
                        <span class="widget-title">Contact Info</span>
                    </div>

                    <div class="widget-content widget-content-padding widget-content-padding-side show-info-block">
                        <div class="item-info">
                            <div class="item-label title-block">Name</div>
                            <div class="item-value value-block">{{ $ServiceRequest->full_name }}</div>
                        </div>

                        <div class="item-info">
                            <div class="item-label title-block">Phone</div>
                            <div class="item-value value-block num-fa">{{ $ServiceRequest->phone }}</div>
                        </div>

                        <div class="item-info">
                            <div class="item-label title-block">Email</div>
                            <div class="item-value value-block num-fa">{{ $ServiceRequest->email }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection

@section('footer')
@endsection
