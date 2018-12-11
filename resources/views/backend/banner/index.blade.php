@extends('backend.templates.main')

@push('title')
    Banners
@endpush

@push('css')
    <link href="{{ asset('backend') }}/assets/plugins/DataTables/datatables.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="{{ asset('backend') }}/assets/plugins/DataTables/datatables.min.js"></script>
@endpush

@push('script')
    <script>
        $(document).ready(function(){
            $('.data-table').dataTable({
                responsive: true
            });

            $('.btnDelete').on('click', function(e){
                e.preventDefault();
                var parent = $(this).parent();

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then(function(willDelete){
                        if (willDelete) {
                            parent.find('.formDelete').submit();
                        }
                    });
            });
        });
    </script>
@endpush

@push('style')
    <style>
        .banner-preview{
            max-width: 100px;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1>Banners</h1>
            </div>
            <div class="col-lg-6">
                <div class="float-right">
                    <a href="{{ url('admin/banners/create') }}" class="btn btn-primary">
                        <i class="fe fe-plus"></i> Add Banner
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @include('backend.templates.feedback')
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter data-table">
                                <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Image</th>
                                    <th>title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($banners as $banner)
                                    <tr>
                                        <td>{{ $banner->order }}</td>
                                        <td><img class="banner-preview" src="{{ asset('uploads/banner/'.$banner->image) }}" alt="{{ $banner->title }}"></td>
                                        <td>{{ $banner->title }}</td>
                                        <td>{{ $banner->description }}</td>
                                        <td>
                                            @if($banner->status)
                                                <i class="fa fa-check text-success"></i> Active
                                            @else
                                                <i class="fa fa-times text-danger"></i> Disabled
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/banners/'. $banner->id .'/edit') }}" class="btn btn-warning"><i class="fe fe-edit"></i></a>
                                            <a href="#" class="btn btn-danger btnDelete"><i class="fe fe-trash"></i></a>
                                            <form action="{{ url('admin/banners/'.$banner->id) }}" method="post" class="formDelete" style="display: none;">
                                                {!! csrf_field() !!}
                                                {!! method_field('delete') !!}
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection