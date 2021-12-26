@extends('layouts.admin.dashboard.master')

@section('page-title', 'All Portfolio')

@section('title-page')
    <span class="icon"><svg viewBox="0 -31 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M497.0938 60.004c-.0313 0-.0625-.004-.0938-.004H361V45c0-24.8125-20.1875-45-45-45H196c-24.8125 0-45 20.1875-45 45v15H15C6.6484 60 0 66.8438 0 75v330c0 24.8125 20.1875 45 45 45h422c24.8125 0 45-20.1875 45-45V75.2578c-.5742-9.8516-6.6328-15.1992-14.9063-15.2539zM181 45c0-8.2695 6.7305-15 15-15h120c8.2695 0 15 6.7305 15 15v15H181zm295.1875 45-46.582 139.7422A14.9747 14.9747 0 0 1 415.3789 240H331v-15c0-8.2852-6.7148-15-15-15H196c-8.2852 0-15 6.7148-15 15v15H96.621a14.9747 14.9747 0 0 1-14.2265-10.2578L35.8125 90zM301 240v30h-90v-30zm181 165c0 8.2695-6.7305 15-15 15H45c-8.2695 0-15-6.7305-15-15V167.4336l23.9336 71.7969C60.0664 257.6367 77.2226 270 96.621 270H181v15c0 8.2852 6.7148 15 15 15h120c8.2852 0 15-6.7148 15-15v-15h84.379c19.3983 0 36.5546-12.3633 42.6874-30.7695L482 167.4335zm0 0"/></svg></span>
    <span class="text">Portfolio</span>
@endsection

@section('content')
    <section class="report-table">
        @if(count($Portfolio))
            <div class="row">
                <div class="col-12">
                    <div class="widget-block widget-item widget-style">
                        <div class="heading-widget">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <span class="widget-title">All Portfolio</span>
                                </div>
                                <div class="col-2 left">
                                    <a href="{{ url('dashboard/portfolio/create') }}" class="submit-form-btn">New Portfolio</a>
                                </div>
                            </div>
                        </div>

                        <div class="widget-content">
                            <form action="{{ url('dashboard/portfolio/destroy') }}" method="post" onsubmit="return confirm('<?php echo "Are you sure you want to delete the selected items?";?>');">
                                @csrf
                                {{ method_field('DELETE') }}
                                <table class="table align-items-center">
                                    <thead>
                                    <tr>
                                        <th class="delete-col">
                                            <input class="select-all" type="checkbox">
                                        </th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Create Date</th>
                                        <th width="80px" class="center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($Portfolio as $item)
                                        <tr>
                                            <td class="delete-col">
                                                <input class="delete-checkbox" type="checkbox" name="delete_item[{{ $item->id }}]" value="1">
                                            </td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->user_tbl->full_name }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td class="center">
                                                <a href="{{ route('portfolio.edit', $item->id) }}" class="table-btn table-btn-icon table-btn-icon-edit"><i class="zmdi zmdi-edit"></i></a>
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
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Create Date</th>
                                        <th width="80px" class="center">Actions</th>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;" colspan="8">
                                            <div class="row align-items-center">
                                                <div class="col-4">
                                                    Show items {{ $Portfolio->firstItem() }} to {{ $Portfolio->lastItem() }} from {{ $Portfolio->total() }} item (pages {{ $Portfolio->currentPage() }} from {{ $Portfolio->lastPage() }})
                                                </div>
                                                <div class="col-8 left">
                                                    <div class="pagination-table">
                                                        {{$Portfolio->links('vendor.pagination.default')}}
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
                <div class="create-item"><a href="{{ url()->current() }}/create">Add New Item</a></div>
            </div>
        @endif

    </section>
@endsection
