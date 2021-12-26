@extends('layouts.admin.dashboard.master')

@section('page-title', 'All Posts')

@section('title-page')
    <span class="icon"><svg height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg"><path d="M422 0H0v452c0 33.086 26.914 60 60 60h392.0078C485.086 512 512 485.086 512 452V241h-90zM60 482c-16.543 0-30-13.457-30-30V30h362v422c0 10.9258 2.9492 21.168 8.0703 30zm422-211v181c0 16.543-13.4531 30-30 30-16.543 0-30-13.457-30-30V271zm0 0"/><path d="M60 181h302V60H60zm30-91h242v61H90zM60 211h151v30H60zM241 211h121v30H241zM60 271h151v30H60zM241 271h121v30H241zM60 331h151v30H60zM60 391h151v30H60zM241 421h121v-90H241zm30-60h61v30h-61zm0 0"/></svg></span>
    <span class="text">All Posts</span>
@endsection

@section('content')
    <section class="report-table">
        @if(count($Blog))
            <div class="row">
                <div class="col-12">
                    <div class="widget-block widget-item widget-style">
                        <div class="heading-widget">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <span class="widget-title">All Posts</span>
                                </div>
                                <div class="col-2 left">
                                    <a href="{{ url('dashboard/blog/create') }}" class="submit-form-btn">New Post</a>
                                </div>
                            </div>
                        </div>

                        <div class="widget-content">
                            <form action="{{ url('dashboard/blog/destroy') }}" method="post" onsubmit="return confirm('<?php echo "Are you sure you want to delete the selected items?";?>');">
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
                                    @foreach ($Blog as $item)
                                        <tr>
                                            <td class="delete-col">
                                                <input class="delete-checkbox" type="checkbox" name="delete_item[{{ $item->id }}]" value="1">
                                            </td>
                                            <td>{{ $item->title }}</td>
                                            <td class="text-capitalize">{{ $item->status }}</td>
                                            <td>{{ $item->user_tbl->full_name }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td class="center">
                                                <a href="{{ route('blog.edit', $item->id) }}" class="table-btn table-btn-icon table-btn-icon-edit"><i class="zmdi zmdi-edit"></i></a>
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
                                                    Show items {{ $Blog->firstItem() }} to {{ $Blog->lastItem() }} from {{ $Blog->total() }} item (pages {{ $Blog->currentPage() }} from {{ $Blog->lastPage() }})
                                                </div>
                                                <div class="col-8 left">
                                                    <div class="pagination-table">
                                                        {{$Blog->links('vendor.pagination.default')}}
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
