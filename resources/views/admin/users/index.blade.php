@extends('layouts.admin.dashboard.master')

@section('page-title', 'All Users')

@section('title-page')
    <span class="icon"><img src="{{ asset('public/assets/admin/img/base/icons') }}/user.svg"></span>
    <span class="text">All Users</span>
@endsection

@section('content')
    <section class="report-table">
        <div class="row">
            <div class="col-12">
                <div class="widget-block widget-item widget-style">
                    <div class="heading-widget">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <span class="widget-title">All Users</span>
                            </div>
                            <div class="col-2 left">
                                <a href="{{ url('dashboard/users/create') }}" class="submit-form-btn">Create User</a>
                            </div>
                        </div>
                    </div>

                    <div class="widget-content">
                        <form action="{{ url('dashboard/users/destroy') }}" method="post" onsubmit="return confirm('<?php echo "Are you sure you want to delete the selected items?";?>');">
                            @csrf
                            <table class="table align-items-center">
                                <thead>
                                <tr>
                                    @can('isAdmin')
                                        <th class="delete-col">
                                            <input class="select-all" type="checkbox">
                                        </th>
                                    @endcan
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Register Date</th>
                                    @can('isAdmin')
                                        <th width="80px" class="center">Actions</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        @can('isAdmin')
                                            <td class="delete-col">
                                                <input class="delete-checkbox" type="checkbox" name="delete_item[{{ $user->id }}]" value="1">
                                            </td>
                                        @endcan
                                        <td class="num-fa">{{ $user->id }}</td>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>@if($user->role == 'admin' || $user->role == 'super_admin'){{ 'Super Admin' }}@elseif($user->role == 'user'){{ 'User' }}@elseif($user->role == 'author'){{ 'Author' }}@endif</td>
                                        <td class="num-fa">{{ $user->created_at }}</td>
                                        @can('isAdmin')
                                            <td class="center">
                                                <a href="{{ route('users.edit', $user->id) }}" class="table-btn table-btn-icon table-btn-icon-edit"><i class="zmdi zmdi-edit"></i></a>
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot class="num-fa">
                                <tr class="titles">
                                    @can('isAdmin')
                                        <th class="delete-col">
                                            <button class="table-btn table-btn-icon table-btn-icon-delete">
                                                <span><img src="{{ asset('public/assets/admin/img/base/icons') }}/trash.svg" alt="ID" title="Delete"></span>
                                            </button>
                                        </th>
                                    @endcan
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Register Date</th>
                                    @can('isAdmin')
                                        <th width="80px" class="center">Actions</th>
                                    @endcan
                                </tr>
                                <tr>
                                    <td style="vertical-align: middle;" colspan="8">
                                        <div class="row align-items-center">
                                            <div class="col-4">
                                                Show items {{ $users->firstItem() }} to {{ $users->lastItem() }} from {{ $users->total() }} item (pages {{ $users->currentPage() }} from {{ $users->lastPage() }})
                                            </div>
                                            <div class="col-8 left">
                                                <div class="pagination-table">
                                                    {{$users->links('vendor.pagination.default')}}
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
    </section>
@endsection
