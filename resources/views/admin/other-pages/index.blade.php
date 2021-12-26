@extends('layouts.admin.dashboard.master')

@section('page-title', 'All Posts')

@section('title-page')
    <span class="icon"><svg height="512" viewBox="0 0 64 64" width="512" xmlns="http://www.w3.org/2000/svg"><path d="M45.4 61.8H8.5c-1.1 0-2-.9-2-2V11.3c0-1.1.9-2 2-2h24.3c.5 0 1 .2 1.3.5l12.5 11.1c.4.4.7.9.7 1.5v37.5c.1 1-.8 1.9-1.9 1.9zm-34.9-4h32.8V23.3L32 13.3H10.5z"/><path d="M55.5 54.7H45.3c-1.1 0-2-.9-2-2s.9-2 2-2h8.1V16.2l-11.3-10H20.6v5.1c0 1.1-.9 2-2 2s-2-.9-2-2V4.2c0-1.1.9-2 2-2H43c.5 0 1 .2 1.3.5l12.5 11.1c.4.4.7.9.7 1.5v37.5c0 1-.9 1.9-2 1.9z"/></svg></span>
    <span class="text">All Pages</span>
@endsection

@section('content')
    <section class="report-table">
        @if(count($OtherPages))
            <div class="row">
                <div class="col-12">
                    <div class="widget-block widget-item widget-style">
                        <div class="heading-widget">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <span class="widget-title">All Pages</span>
                                </div>
                                <div class="col-2 left">
                                    <a href="{{ url('dashboard/other-pages/create') }}" class="submit-form-btn">New Page</a>
                                </div>
                            </div>
                        </div>

                        <div class="widget-content">
                            <form action="{{ url('dashboard/other-pages/destroy') }}" method="post" onsubmit="return confirm('<?php echo "Are you sure you want to delete the selected items?";?>');">
                                @csrf
                                {{ method_field('DELETE') }}
                                <table class="table align-items-center">
                                    <thead>
                                    <tr>
                                        <th class="delete-col">
                                            <input class="select-all" type="checkbox">
                                        </th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Author</th>
                                        <th>Create Date</th>
                                        <th width="80px" class="center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($OtherPages as $item)
                                        <tr>
                                            <td class="delete-col">
                                                <input class="delete-checkbox" type="checkbox" name="delete_item[{{ $item->id }}]" value="1">
                                            </td>
                                            <td>{{ $item->title }}</td>
                                            <td class="text-capitalize">{{ $item->status }}</td>
                                            <td>{{ $item->user_tbl->full_name }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td class="center">
                                                <a href="{{ route('other-pages.edit', $item->id) }}" class="table-btn table-btn-icon table-btn-icon-edit"><i class="zmdi zmdi-edit"></i></a>
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
                                        <th>Status</th>
                                        <th>Author</th>
                                        <th>Create Date</th>
                                        <th width="80px" class="center">Actions</th>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;" colspan="8">
                                            <div class="row align-items-center">
                                                <div class="col-4">
                                                    Show items {{ $OtherPages->firstItem() }} to {{ $OtherPages->lastItem() }} from {{ $OtherPages->total() }} item (pages {{ $OtherPages->currentPage() }} from {{ $OtherPages->lastPage() }})
                                                </div>
                                                <div class="col-8 left">
                                                    <div class="pagination-table">
                                                        {{$OtherPages->links('vendor.pagination.default')}}
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
