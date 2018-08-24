@extends('backend.templates.main')

@push('title')
    {{ @$edit == false ? 'Add' : 'Edit' }} Room
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
            initSummernote($('#overview'));
            initSummernote($('#facilities'));
            initSummernote($('#amenities'));
            initSummernote($('#specials'));
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
                                <h1>{{ @$edit == false ? 'Add' : 'Edit' }} Room</h1>
                            </div>
                            <div class="col-lg-6">
                                <a href="{{ url('admin/rooms') }}" class="btn btn-outline-danger float-right">
                                    <i class="fa fa-times"></i>&nbsp;&nbsp;Back
                                </a>
                            </div>
                        </div>
                        @include('backend.templates.feedback')
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{ @$edit == false ? url('admin/rooms') : url('admin/rooms/'.$room->id) }}"
                                      method="post">
                                    {{ csrf_field() }}
                                    {{ @$edit == true ? method_field('PUT') : '' }}

                                    <div class="form-group">
                                        <label for="name" class="bmd-label-floating">Room Name <span class="required">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control"
                                               value="{{ @old('name') ? old('name') : (@$room->name ? $room->name : '') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="type" class="bmd-label-floating">Room Type <span class="required">*</span></label>
                                        <input type="text" name="type" id="type" class="form-control"
                                               value="{{ @old('type') ? old('type') : (@$room->type ? $room->type : '') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="price" class="bmd-label-floating">Weekday Price (in Rupiah) <span class="required">*</span></label>
                                        <input type="number" name="price" id="price" class="form-control"
                                               value="{{ @old('price') ? old('price') : (@$room->price ? $room->price : '') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="price_weekend" class="bmd-label-floating">Weekend Price (in Rupiah) <span class="required">*</span></label>
                                        <input type="number" name="price_weekend" id="price_weekend" class="form-control"
                                               value="{{ @old('price_weekend') ? old('price_weekend') : (@$room->price_weekend ? $room->price_weekend : '') }}">
                                    </div>

                                    <div class="form-group overview">
                                        <label for="overview" class="bmd-label-floating strong-label">Room Overview <span class="required">*</span></label>
                                        <textarea name="overview" id="overview" class="summernote">{{ @old('overview') ? old('overview') : (@$room->overview ? $room->overview : '') }}</textarea>
                                    </div>

                                    <div class="form-group facilities">
                                        <label for="facilities" class="bmd-label-floating strong-label">Facilities <span class="required">*</span></label>
                                        <textarea name="facilities" id="facilities" class="summernote">{{ @old('facilities') ? old('facilities') : (@$room->facilities ? $room->facilities : '') }}</textarea>
                                    </div>

                                    <div class="form-group amenities">
                                        <label for="amenities" class="bmd-label-floating strong-label">Amenities <span class="required">*</span></label>
                                        <textarea name="amenities" id="amenities" class="summernote">{{ @old('amenities') ? old('amenities') : (@$room->amenities ? $room->amenities : '') }}</textarea>
                                    </div>

                                    <div class="form-group specials">
                                        <label for="specials" class="bmd-label-floating strong-label">Specials <span class="required">*</span></label>
                                        <textarea name="specials" id="specials" class="summernote">{{ @old('specials') ? old('specials') : (@$room->specials ? $room->specials : '') }}</textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="max_guest" class="bmd-label-floating">Max no. of Guest <span class="required">*</span></label>
                                        <input type="number" class="form-control" id="max_guest" name="max_guest"
                                               value="{{ @old('max_guest') ? old('max_guest') : (@$room->max_guest ? $room->max_guest : '') }}">
                                    </div>

                                    <div class="form-group pt-3">
                                        <label class="custom-switch">
                                            <input type="checkbox" name="installment" class="custom-switch-input" value="1" checked>
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Installment available for credit card holders</span>
                                        </label>
                                    </div>

                                    <div class="form-group pt-3">
                                        <label class="custom-switch">
                                            <input type="checkbox" name="featured" class="custom-switch-input" value="1">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Featured Room</span>
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