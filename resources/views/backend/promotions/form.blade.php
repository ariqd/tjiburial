@extends('backend.templates.main')

@push('title')
    {{ @$edit == false ? 'Add' : 'Edit' }} Promotion
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/summernote/summernote-lite.css">
@endpush

@push('js')
    <script src="{{ asset('backend') }}/assets/plugins/summernote/summernote-lite.js"></script>
@endpush

@push('style')
    <style>
        #overview, #facilities{
            height: 100px;
        }
        .strong-label{
            top: .6rem !important;
            font-size: .8rem !important;
            color: rgba(0,0,0,.6) !important;
        }
        .note-btn-group>.note-btn:after{
            content: normal;
        }
        .btn-light.custom-file-control:before, .btn.btn-light {
            color: #666;
            background-color: transparent;
            border-color: #ccc;
        }

        .btn-light.active.custom-file-control:before, .btn-light.custom-file-control:active:before, .btn-light.custom-file-control:focus:before, .btn-light.custom-file-control:hover:before, .btn-light.focus.custom-file-control:before, .btn.btn-light.active, .btn.btn-light.focus, .btn.btn-light:active, .btn.btn-light:focus, .btn.btn-light:hover, .open>.btn-light.dropdown-toggle.custom-file-control:before, .open>.btn.btn-light.dropdown-toggle {
            color: #333;
            background-color: hsla(0,0%,60%,.2);
            border-color: hsla(0,0%,60%,.2);
        }
        .note-editor.note-frame .note-editing-area .note-editable {
            height: 200px;
        }

        .drop_target:after {
            content: 'an Image';
            bottom: 55px;
        }
        .drop_target:before {
            top: 55px;
        }
        .close:before {
            content: '' !important;
        }
        .required{
            color: #cc1f1f;
        }
        #detail-event{
            animation: fadeIn 0.3s ease-in-out;
        }
        .hidden{
            display: none !important;
        }
        @keyframes fadeIn {
            from{
                opacity: 0;
            }
            to{
                opacity: 1;
            }
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function(){
            function initSummernote(el) {
                el.summernote({
                    disableDragAndDrop: true
                });
            }
            initSummernote($('#description'));
        })
    </script>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <h1>{{ @$edit == false ? 'Add' : 'Edit' }} Promotion</h1>
                            </div>
                            <div class="col-lg-6">
                                <a href="{{ url('admin/promotions') }}" class="btn btn-outline-danger float-right">
                                    <i class="fa fa-times"></i>&nbsp;&nbsp;Back
                                </a>
                            </div>
                        </div>
                        @include('backend.templates.feedback')
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{ !@$edit ? url('admin/promotions') : url('admin/promotions/'.$promotion->id) }}"
                                      method="post">
                                    {{ csrf_field() }}
                                    {{ @$edit ? method_field('PUT') : '' }}

                                    <div class="form-group">
                                        <label for="title" class="bmd-label-floating">Promotion Title <span class="required">*</span></label>
                                        <input type="text" name="title" id="title" class="form-control"
                                               value="{{ @old('title') ? old('title') : (@$edit ? $promotion->title : '') }}" required>
                                    </div>

                                    <div class="form-group description">
                                        <label for="description" class="bmd-label-floating strong-label">Description <span class="required">*</span></label>
                                        <textarea name="description" id="description" class="summernote">{{ @old('description') ? old('description') : (@$edit ? $promotion->description : '') }}</textarea>
                                    </div>

                                    <div class="form-group pt-3">
                                        <label class="custom-switch">
                                            <input type="checkbox" name="status" class="custom-switch-input" value="1" {{ @$promotion->status == 1 ? 'checked' : '' }}>
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Promotion Available</span>
                                        </label>
                                    </div>

                                    <button type="submit" class="btn btn-success btn-block"><i class="fa fa-arrow-right"></i> Next</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection