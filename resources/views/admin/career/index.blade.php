@extends('layouts.admin.dashboard.master')

@section('page-title', 'All Careers')

@section('title-page')
    <span class="icon"><svg height="512" viewBox="0 0 512.013 512.013" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m451.013 293.793-4.394-4.394c-1.984-1.985-20.409-19.393-55.606-19.393s-53.622 17.408-55.606 19.393l-4.394 4.394v36.213h-60v182h241v-182h-61zm-90 13.722c5.305-3.174 15.248-7.508 30-7.508s24.695 4.334 30 7.508v22.492h-60zm-60 174.492v-62h75v31h30v-31h76v62zm181-92h-181v-30h181z"/><path d="M181.013 330.007v152h-30v30h90v-30h-30v-242h141.213l45-45-45-45H211.013v-120h30v-30h-90v30h30v30H68.8l-45 45 45 45h112.213v90H45l-45 45 45 45zm158.787-150 15 15-15 15H211.013v-30zm-258.573-60-15-15 15-15h99.787v30zm-23.8 150h123.586v30H57.427l-15-15z"/></svg></span>
    <span class="text">All Careers</span>
@endsection

@section('content')
    <section class="report-table">
        @if(count($Career))
            <div class="row">
                <div class="col-12">
                    <div class="widget-block widget-item widget-style">
                        <div class="heading-widget">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <span class="widget-title">All Careers</span>
                                </div>
                                <div class="col-2 left">
                                    <a href="{{ url('dashboard/career/create') }}" class="submit-form-btn">New Career</a>
                                </div>
                            </div>
                        </div>

                        <div class="widget-content">
                            <form action="{{ url('dashboard/career/destroy') }}" method="post" onsubmit="return confirm('<?php echo "Are you sure you want to delete the selected items?";?>');">
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
                                    @foreach ($Career as $item)
                                        <tr>
                                            <td class="delete-col">
                                                <input class="delete-checkbox" type="checkbox" name="delete_item[{{ $item->id }}]" value="1">
                                            </td>
                                            <td>{{ $item->title }}</td>
                                            <td class="text-capitalize">{{ $item->status }}</td>
                                            <td>{{ $item->user_tbl->full_name }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td class="center">
                                                <a href="{{ route('career.edit', $item->id) }}" class="table-btn table-btn-icon table-btn-icon-edit"><i class="zmdi zmdi-edit"></i></a>
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
                                                    Show items {{ $Career->firstItem() }} to {{ $Career->lastItem() }} from {{ $Career->total() }} item (pages {{ $Career->currentPage() }} from {{ $Career->lastPage() }})
                                                </div>
                                                <div class="col-8 left">
                                                    <div class="pagination-table">
                                                        {{ $Career->links('vendor.pagination.default') }}
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
