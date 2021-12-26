@extends('layouts.admin.dashboard.master')

@section('page-title', 'All Posts')

@section('title-page')
    <span class="icon"><svg height="682pt" viewBox="-21 -47 682.6667 682" width="682pt" xmlns="http://www.w3.org/2000/svg"><path d="M552.0117-1.332H87.9883C39.4727-1.332 0 38.1328 0 86.6562V370.629c0 48.414 39.3008 87.8164 87.6758 87.9883v128.8633l185.1914-128.8633h279.1445c48.5156 0 87.9883-39.4727 87.9883-87.9883V86.6562c0-48.5234-39.4727-87.9882-87.9883-87.9882zM602.5 370.629c0 27.8358-22.6484 50.4882-50.4883 50.4882H261.1016l-135.9258 94.586v-94.586H87.9883c-27.8399 0-50.4883-22.6524-50.4883-50.4883V86.6563c0-27.8438 22.6484-50.4883 50.4883-50.4883h464.0234c27.8399 0 50.4883 22.6445 50.4883 50.4883zm0 0"/><path d="M171.293 131.1719h297.414v37.5H171.293zM171.293 211.1719h297.414v37.5H171.293zM171.293 291.1719h297.414v37.5H171.293zm0 0"/></svg></span>
    <span class="text">All Requested</span>
@endsection

@section('content')
    <section class="report-table">
        @if(count($ServiceRequest))
            <div class="row">
                <div class="col-12">
                    <div class="widget-block widget-item widget-style">
                        <div class="heading-widget">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <span class="widget-title">All Requested</span>
                                </div>
                            </div>
                        </div>

                        <div class="widget-content">
                            <form action="{{ url('dashboard/contacts/destroy') }}" method="post" onsubmit="return confirm('<?php echo "Are you sure you want to delete the selected items?";?>');">
                                @csrf
                                {{ method_field('DELETE') }}
                                <table class="table align-items-center">
                                    <thead>
                                    <tr>
                                        <th class="delete-col">
                                            <input class="select-all" type="checkbox">
                                        </th>
{{--                                        <th>Service</th>--}}
                                        <th>Name</th>
                                        <th>Project Name</th>
                                        <th>Status</th>
                                        <th>Create Date</th>
                                        <th width="80px" class="center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($ServiceRequest as $item)
                                        <tr>
                                            <td class="delete-col">
                                                <input class="delete-checkbox" type="checkbox" name="delete_item[{{ $item->id }}]" value="1">
                                            </td>
{{--                                            @php $service_type = json_decode( $item->service_type , true) @endphp--}}
{{--                                            <td class="text-capitalize">{{ str_replace('-',' ', implode(", ", (array)$service_type)) }}</td>--}}
                                            <td class="text-capitalize">{{ $item->full_name }}</td>
                                            <td class="text-capitalize">{{ $item->project_name }}</td>
                                            <td class="text-capitalize">{{ $item->status }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td class="center">
                                                <a href="{{ route('services-request.edit', $item->id) }}" class="table-btn table-btn-icon table-btn-icon-edit"><i class="zmdi zmdi-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                    <tfoot>
                                    <tr class="titles">
                                        <th class="delete-col">
                                            <button class="table-btn table-btn-icon table-btn-icon-delete">
                                                <span><img src="{{ asset('public/assets/admin/img/base/icons') }}/trash.svg" alt="ID" title="Delete"></span>
                                            </button>
                                        </th>
{{--                                        <th>Service</th>--}}
                                        <th>Name</th>
                                        <th>Project Name</th>
                                        <th>Status</th>
                                        <th>Create Date</th>
                                        <th width="80px" class="center">Actions</th>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;" colspan="8">
                                            <div class="row align-items-center">
                                                <div class="col-4">
                                                    Show items {{ $ServiceRequest->firstItem() }} to {{ $ServiceRequest->lastItem() }} from {{ $ServiceRequest->total() }} item (pages {{ $ServiceRequest->currentPage() }} from {{ $ServiceRequest->lastPage() }})
                                                </div>
                                                <div class="col-8 left">
                                                    <div class="pagination-table">
                                                        {{$ServiceRequest->links('vendor.pagination.default')}}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="widget-block widget-item widget-style center no-item">
                <div class="icon"><img src="{{ asset('public/assets/admin/img/base/icons') }}/no-item.svg"></div>
                <h2>No item found!</h2>
            </div>
        @endif

    </section>
@endsection
