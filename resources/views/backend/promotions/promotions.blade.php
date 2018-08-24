@extends('backend.templates.main')

@push('title')
    Manage Promotions
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
                responsive: true,
                "columnDefs": [
                    { "orderable": false, "targets": 0 }
                ],
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
        .sorting_disabled{
            width: 5px !important;
        }
        .width50{
            width: 50px !important;
        }
        .width50{
            width: 100px !important;
        }
        .label-danger{
            background: #e01f1f;
            color: #fff;
        }
        .label-success{
            background: #2bb13c;
            color: #fff;
        }
        .label{
            padding: 5px;
            border-radius: 5px;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <h1>Promotions</h1>
                            </div>
                            <div class="col-lg-6">
                                <a href="{{ url('admin/promotions/create') }}" class="btn btn-primary float-right">
                                    <i class="fe fe-plus"></i>&nbsp;&nbsp;New Promotion
                                </a>
                            </div>
                        </div>

                        @include('backend.templates.feedback')

                        @if(!$promotions->isEmpty())
                            <div class="table-responsive">
                                <table class="table card-table table-bordered data-table table-vcenter">
                                    <thead>
                                    <tr>
                                        {{--<th class="sorting_disabled"></th>--}}
                                        <th class="sorting_disabled">No.</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                        {{--<th>Description</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($promotions as $key => $promotion)
                                        <tr>
                                            {{--<td class="sorting_disabled"></td>--}}
                                            <td class="sorting_disabled">{{ $key + 1 }}</td>
                                            <td><a href="{{ url('admin/promotions/'.$promotion->id.'/edit') }}">{{ $promotion->title }}</a></td>
                                            <td class="width50">
                                                @if(@$promotion->status == 1)
                                                    <div class="label label-success"><i class="fe fe-check"></i> Available</div>
                                                @else
                                                    <div class="label label-danger"><i class="fe fe-x"></i> Unavailable</div>
                                                @endif
                                            </td>
                                            <td class="width50">
                                                <a class="icon" href="{{ url('admin/promotions/'.$promotion->id.'/images') }}">
                                                    <i class="fe fe-image"></i> {{ $promotion->images()->count() }}
                                                </a>
                                                <a class="icon ml-3" href="{{ url('admin/promotions/'.$promotion->id.'/edit') }}">
                                                    <i class="fe fe-edit"></i>
                                                </a>
                                                <a class="icon ml-3 btnDelete" href="#"><i class="fe fe-trash"></i></a>
                                                <form action="{{ url('admin/promotions/'.$promotion->id) }}" method="post" class="formDelete" style="display: none;">
                                                    {!! csrf_field() !!}
                                                    {!! method_field('delete') !!}
                                                </form>
                                            </td>
                                            {{--<td>{!! $promotion->description !!}</td>--}}
                                            {{--<td>{{ date('d m Y', strtotime($promotion->end_date)) }}</td>--}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection