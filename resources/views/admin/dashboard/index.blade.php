@extends('layouts.admin.dashboard.master')

@section('page-title', 'Dashboard')

@section('title-page')
    <span class="icon"><img src="{{ asset('public/assets/admin/img/base/icons') }}/dashboard.svg"></span>
    <span class="text">Dashboard</span>
@endsection

@section('content')
    <section class="report-table">
        <div class="row">
{{--            <div class="col-6">--}}
{{--                <div class="widget-block widget-item widget-style">--}}
{{--                    <div class="heading-widget">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-9">--}}
{{--                                <span class="widget-title">آخرین تیکت های بروزرسانی شده</span>--}}
{{--                            </div>--}}
{{--                            <div class="col-3 right">--}}
{{--                                <a href="{{ Url('dashboard/support') }}" class="show-all">Load More</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="widget-content">--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table class="table align-items-center">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>عنوان</th>--}}
{{--                                    <th class="center">وضعیت</th>--}}
{{--                                    <th>تاریخ</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                </tbody>--}}
{{--                            </table>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </section>
@endsection
