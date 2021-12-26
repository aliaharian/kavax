@extends('layouts.admin.dashboard.master')

@section('title-page')
    <span class="icon"><svg height="512" viewBox="0 0 90 90" width="512" xmlns="http://www.w3.org/2000/svg"><path d="M32.991 24.801h46.908L54.275 44.923a3.427 3.427 0 0 1-1.775.691 3.49 3.49 0 0 1-1.787-.691L32.401 30.538a1.957 1.957 0 0 0-.654-.349 7.145 7.145 0 0 0 1.328-4.272 10.269 10.269 0 0 0-.084-1.116zM21.062 11.86c.059.01.156.047.367.145.417.198 1.08.708 1.729 1.419 1.307 1.424 2.613 3.581 3.291 5.005.021.042.043.088.063.135 1.924 3.301 2.754 5.826 2.779 7.41.027 1.591-.4 2.276-1.749 3.051l-3.48 2.006c-2.267 1.305-3.338 3.644-3.604 5.826-.267 2.183.126 4.304 1.097 5.981l8.59 14.805c.973 1.676 2.634 3.078 4.665 3.939 2.033.863 4.604 1.107 6.871-.195l3.48-2.002c1.348-.773 2.163-.789 3.532.025 1.373.816 3.156 2.787 5.072 6.09.027.049.053.09.084.137.898 1.295 2.121 3.492 2.711 5.332.293.914.408 1.74.371 2.197-.041.459-.051.412-.172.484l-2.648 1.518c-6.652 2.885-12.749 2.234-18.198-.592-5.459-2.838-10.204-7.963-13.512-13.98-.011-.012-.016-.027-.025-.035L15.13 48.073c-.012-.012-.017-.023-.027-.039-3.585-5.86-5.674-12.513-5.412-18.634.262-6.112 2.742-11.684 8.584-15.971l2.649-1.513c.061-.035.081-.062.138-.056zm.027-3.721c-.701-.011-1.416.136-2.059.509l-2.801 1.611c-.063.036-.121.073-.178.109C9.312 15.3 6.209 22.166 5.906 29.243c-.303 7.074 2.059 14.375 5.961 20.758l7.222 12.445-.017-.037c3.605 6.551 8.771 12.234 15.084 15.508 6.316 3.279 13.84 4.039 21.504.697.063-.027.127-.057.184-.092l2.805-1.611c1.297-.738 1.949-2.174 2.055-3.428.109-1.25-.146-2.467-.533-3.666-.758-2.371-2.08-4.674-3.172-6.254-2.063-3.549-4.055-6.012-6.357-7.389a7.251 7.251 0 0 0-7.377-.057l-3.48 2.006c-1.028.592-2.23.523-3.495-.012-1.259-.535-2.425-1.605-2.858-2.355l-8.59-14.804c-.434-.754-.789-2.292-.621-3.648.162-1.352.711-2.411 1.74-3.004l3.381-1.944c.088.453.344.864.715 1.14L48.37 47.884a7.193 7.193 0 0 0 4.023 1.539 2 2 0 0 0 .219 0 7.185 7.185 0 0 0 4.018-1.539L81.852 28.07v32.734c0 .498-.568 1.154-1.682 1.154H62.709a1.889 1.889 0 0 0-1.902 1.887c0 1.043.852 1.891 1.902 1.885H80.17c2.854 0 5.477-2.063 5.477-4.926V25.955c0-2.865-2.623-4.927-5.477-4.927H31.952c-.534-1.335-1.239-2.75-2.127-4.288-.831-1.73-2.179-4.017-3.866-5.856-.852-.932-1.771-1.758-2.92-2.292v.005a4.864 4.864 0 0 0-1.95-.458z"/></svg></span>
    <span class="text text-capitalize">{{ $Contact->name }}</span>
@endsection

@section('content')
    <section class="form-section">
        <form action="{{ route('blog.update' , $Contact->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-9">
                    <div class="row">
                        <div class="col-12">
                            <div class="widget-block widget-item widget-style">
                                <div class="heading-widget">
                                    <div class="row align-items-center">
                                        <div class="col-8"><span class="widget-title">Contact Message</span></div>
                                        <div class="col-4 right">{{ $Contact->created_at }}</div>
                                    </div>
                                </div>

                                <div class="widget-content widget-content-padding">{{ $Contact->message }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="widget-block widget-item widget-style">
                        <div class="heading-widget">
                            <span class="widget-title">Contact Info</span>
                        </div>

                        <div class="widget-content widget-content-padding widget-content-padding-side">
                            <div class="item-info">
                                <div class="item-label">Name</div>
                                <div class="item-value">{{ $Contact->name }}</div>
                            </div>

                            <div class="item-info">
                                <div class="item-label">Phone</div>
                                <div class="item-value num-fa">{{ $Contact->phone }}</div>
                            </div>

                            <div class="item-info">
                                <div class="item-label">Email</div>
                                <div class="item-value num-fa">{{ $Contact->email }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </form>
    </section>

@endsection

@section('footer')
@endsection
