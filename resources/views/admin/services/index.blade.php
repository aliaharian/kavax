@extends('layouts.admin.dashboard.master')

@section('page-title', 'All Services')

@section('title-page')
    <span class="icon"><svg height="512" viewBox="0 0 32 32" width="512" xmlns="http://www.w3.org/2000/svg"><path d="M23.5 30c-1.93 0-3.5-1.57-3.5-3.5V13.367c-1.865-1.189-3-3.234-3-5.473 0-2.45 1.358-4.666 3.544-5.785.311-.158.681-.145.978.037.297.183.478.505.478.854v4.323l1.5.6 1.5-.6V3c0-.349.181-.671.478-.854.297-.182.667-.195.978-.037C28.642 3.229 30 5.444 30 7.895c0 2.238-1.135 4.283-3 5.473V26.5c0 1.93-1.57 3.5-3.5 3.5zM20 5.066c-.637.785-1 1.775-1 2.828 0 1.694.941 3.229 2.456 4.005a1 1 0 0 1 .544.89V26.5c0 .827.673 1.5 1.5 1.5s1.5-.673 1.5-1.5V12.789a1 1 0 0 1 .544-.89C27.059 11.123 28 9.589 28 7.895c0-1.053-.363-2.043-1-2.828V8c0 .409-.249.776-.628.929l-2.5 1a.9944.9944 0 0 1-.743 0l-2.5-1C20.249 8.776 20 8.409 20 8z"/><path d="M17.074 30h-2.147c-1.039 0-1.915-.811-1.994-1.846l-.126-1.635c-.686-.208-1.35-.484-1.985-.824l-1.246 1.067c-.789.677-1.981.63-2.715-.103l-1.52-1.521c-.734-.734-.78-1.927-.104-2.716l1.067-1.245c-.34-.635-.616-1.299-.824-1.985l-1.634-.125C2.811 18.989 2 18.113 2 17.074v-2.148c0-1.039.811-1.915 1.847-1.994l1.634-.125c.208-.687.484-1.351.824-1.985L5.237 9.575c-.676-.788-.63-1.98.105-2.716L6.86 5.34c.735-.735 1.928-.78 2.716-.104l1.246 1.067c.635-.34 1.299-.616 1.985-.824l.126-1.635C13.012 2.811 13.888 2 14.926 2H16c.552 0 1 .447 1 1s-.448 1-1 1h-1.074l-.18 2.341c-.034.436-.347.799-.772.897-.967.223-1.887.604-2.734 1.135a.9948.9948 0 0 1-1.181-.089L8.274 6.755l-1.518 1.52 1.529 1.784c.285.332.32.811.088 1.181-.53.848-.912 1.768-1.135 2.734a.999.999 0 0 1-.898.772l-2.34.18v2.148l2.34.18c.436.033.8.347.898.772.223.967.604 1.887 1.135 2.734.232.37.196.849-.088 1.181l-1.529 1.784 1.519 1.52 1.784-1.529a.9978.9978 0 0 1 1.181-.089c.848.53 1.768.912 2.734 1.135.426.099.739.462.772.897l.18 2.341h2.147c.042-.55.521-.961 1.074-.92.551.042.963.523.92 1.074-.079 1.035-.955 1.846-1.993 1.846z"/><path d="M9 16c0-3.434 2.454-6.337 5.835-6.903.543-.097 1.061.276 1.151.821.091.545-.276 1.06-.821 1.151C12.752 11.474 11 13.548 11 16c0 3.453 3.43 5.861 6.667 4.716.518-.185 1.092.087 1.277.608.184.521-.088 1.092-.609 1.276C13.782 24.211 9 20.816 9 16z"/></svg></span>
    <span class="text">Services</span>
@endsection

@section('content')
    <section class="report-table">
        @if(count($Services))
            <div class="row">
                <div class="col-12">
                    <div class="widget-block widget-item widget-style">
                        <div class="heading-widget">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <span class="widget-title">All Service</span>
                                </div>
                                <div class="col-2 left">
                                    <a href="{{ url('dashboard/services/create') }}" class="submit-form-btn">New Service</a>
                                </div>
                            </div>
                        </div>

                        <div class="widget-content">
                            <form action="{{ url('dashboard/services/destroy') }}" method="post" onsubmit="return confirm('<?php echo "Are you sure you want to delete the selected items?";?>');">
                                @csrf
                                {{ method_field('DELETE') }}
                                <table class="table align-items-center">
                                    <thead>
                                    <tr>
                                        <th class="delete-col">
                                            <input class="select-all" type="checkbox">
                                        </th>
                                        <th>Title</th>
                                        <th>Parent</th>
                                        <th>Status</th>
                                        <th>Author</th>
                                        <th>Create Date</th>
                                        <th width="80px" class="center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($Services as $item)
                                        <tr>
                                            <td class="delete-col">
                                                <input class="delete-checkbox" type="checkbox" name="delete_item[{{ $item->id }}]" value="1">
                                            </td>
                                            <td>{{ $item->title }}</td>
                                            <td>@if(isset($item->parent_id)){{ strtok(wordwrap(\App\Model\Services::find($item->parent_id)->title, 20, "...\n"), "\n") }}@else{{ '-' }}@endif</td>
                                            <td class="text-capitalize">{{ $item->status }}</td>
                                            <td>{{ $item->user_tbl->full_name }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td class="center">
                                                <a href="{{ route('services.edit', $item->id) }}" class="table-btn table-btn-icon table-btn-icon-edit"><i class="zmdi zmdi-edit"></i></a>
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
                                        <th>Parent</th>
                                        <th>Status</th>
                                        <th>Author</th>
                                        <th>Create Date</th>
                                        <th width="80px" class="center">Actions</th>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle;" colspan="8">
                                            <div class="row align-items-center">
                                                <div class="col-4">
                                                    Show items {{ $Services->firstItem() }} to {{ $Services->lastItem() }} from {{ $Services->total() }} item (pages {{ $Services->currentPage() }} from {{ $Services->lastPage() }})
                                                </div>
                                                <div class="col-8 left">
                                                    <div class="pagination-table">
                                                        {{$Services->links('vendor.pagination.default')}}
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
