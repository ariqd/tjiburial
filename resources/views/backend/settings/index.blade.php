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
                        <div id="terms">
                            <h4>Terms & Conditions</h4>
                            <form action="{{ url('admin/settings/save') }}" method="post">
                                {!! csrf_field() !!}
                                {!! method_field('PUT') !!}
                                {{--<input type="hidden" name="update[terms][type]" value="terms">--}}
                                <textarea name="terms" class="form-control" id="tc" style="resize:none">{{ @old('terms') ? old('terms') : (@$terms->body ? $terms->body : '') }}</textarea>
                                <button type="submit" class="btn btn-primary float-right mt-2">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection