@extends('backend.templates.main')

@push('title')
    Settings
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/summernote/summernote-lite.css">
@endpush

@push('js')
    <script src="{{ asset('backend') }}/assets/plugins/summernote/summernote-lite.js"></script>
@endpush

@push('style')
    <style>
        .links li {
            padding: 5px 0;
        }
        .links li a {
            color: #000000;
        }
        .links li a:hover {
            text-decoration: none;
            color: #8BC34A;
        }
        .links li.active, .links li.active a {
            color: #8BC34A;
            font-weight: 600;
        }
        .note-group-select-from-files {
            display: none;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function(){
            function initSummernote(el) {
                el.summernote({
                    disableDragAndDrop: true,
                    height: 200,
                    toolbar: [
                        [ 'style', [ 'style' ] ],
                        [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                        [ 'fontname', [ 'fontname' ] ],
                        [ 'fontsize', [ 'fontsize' ] ],
                        [ 'color', [ 'color' ] ],
                        [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                        [ 'table', [ 'table' ] ],
                        [ 'insert', [ 'link'] ],
                        [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
                    ]
                });
            }
            initSummernote($('#tc'));

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
        })
    </script>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-unstyled links">
                            <li class="active"><a href="{{ url('/settings') }}">Main Settings</a></li>
                            <li><a href="{{ url('/logout') }}">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        @include('backend.templates.feedback')
                        <div id="terms" class="pb-4">
                            <h4>Terms & Conditions</h4>
                            <form action="{{ url('admin/settings/save') }}" method="post">
                                {!! csrf_field() !!}
                                {!! method_field('PUT') !!}
                                {{--<input type="hidden" name="update[terms][type]" value="terms">--}}
                                <textarea name="terms" class="form-control" id="tc" style="resize:none">{{ @old('terms') ? old('terms') : (@$terms->body ? $terms->body : '') }}</textarea>
                                <button type="submit" class="btn btn-success btn-raised float-right mt-2">Save</button>
                            </form>
                        </div> {{-- Terms --}}

                        <hr class="dashed">

                        <div id="faq">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between">
                                        <h4>FAQs</h4>
                                        <a href="{{ url('admin/settings/faq') }}" class="btn btn-raised btn-primary btn-sm mb-3"><i class="fa fa-plus"></i> New FAQ</a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">

                            </div>
                            <table class="table card-table table-vcenter table-bordered data-table">
                                <thead>
                                <tr>
                                    {{--<th>No</th>--}}
                                    <th>Order</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($faqs as $faq)
                                    <tr>
                                        <td>{{ $faq->order }}</td>
                                        <td>{{ $faq->question }}</td>
                                        <td>{{ $faq->answer }}</td>
                                        <td>
                                            <a href="{{ url('admin/settings/faq/'.$faq->id.'/edit') }}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm btnDelete" href="#">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form action="{{ url('admin/settings/faq/'.$faq->id) }}" method="post" class="formDelete" style="display: none;">
                                                {!! csrf_field() !!}
                                                {!! method_field('delete') !!}
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <div class="text-center">
                                                <p>No Data</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection