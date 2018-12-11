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
            initSummernote($('#desc'));
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
                                        <label for="title" class="bmd-label-floating">Title</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                               value="{{ @old('title') ? old('title') : (@$room->title ? $room->title : '') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="tipe_kamar" class="bmd-label-floating">Room Type</label>
                                        <input type="text" name="tipe_kamar" id="tipe_kamar" class="form-control"
                                               value="{{ @old('tipe_kamar') ? old('tipe_kamar') : (@$room->tipe_kamar ? $room->tipe_kamar : '') }}">
                                    </div>

                                    <div class="form-group overview">
                                        <label for="desc" class="bmd-label-floating strong-label">Description</label>
                                        <textarea name="desc" id="desc" class="summernote">{!!@old('desc') ? old('desc') : (@$room->desc ? $room->desc : '')!!}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="qty_room" class="bmd-label-floating">Room Qty</label>
                                        <input type="number" name="qty_room" id="qty_room" class="form-control"
                                               value="{{ @old('qty_room') ? old('qty_room') : (@$room->qty_room ? $room->qty_room : '') }}">
                                        <p class="small text-secondary">No. of rooms in 1 room type</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="qty_tamu" class="bmd-label-floating">Guest Qty</label>
                                        <input type="number" name="qty_tamu" id="qty_tamu" class="form-control"
                                               value="{{ @old('qty_tamu') ? old('qty_tamu') : (@$room->qty_tamu ? $room->qty_tamu : '') }}">
                                        <p class="small text-secondary">No. of guest(s) in 1 room</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="bed_type1" class="bmd-label-floating">Bed Type 1</label>
                                        <input type="text" name="bed_type1" class="form-control" id="bed_type1"
                                               value="{{ @old('bed_type1') ? old('bed_type1') : (@$room->bed_type1 ? $room->bed_type1 : '') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="bed_type2" class="bmd-label-floating">Bed Type 2 (Optional)</label>
                                        <input type="text" name="bed_type2" class="form-control" id="bed_type2"
                                               value="{{ @old('bed_type2') ? old('bed_type2') : (@$room->bed_type2 ? $room->bed_type2 : '') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="bed_type3" class="bmd-label-floating">Bed Type 3 (Optional)</label>
                                        <input type="text" name="bed_type3" class="form-control" id="bed_type3"
                                               value="{{ @old('bed_type3') ? old('bed_type3') : (@$room->bed_type3 ? $room->bed_type3 : '') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="room_size" class="bmd-label-floating">Room Size</label>
                                        <input type="number" class="form-control" id="room_size" name="room_size"
                                               value="{{ @old('room_size') ? old('room_size') : (@$room->room_size ? $room->room_size : '') }}">
                                    </div>

                                    <div class="form-group pt-3">
                                        <label class="custom-switch">
                                            <input type="checkbox" name="room_size_terrace" class="custom-switch-input" value="1" {{ @$room->room_size_terrace ? 'checked' : '' }}>
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Terrace room size</span>
                                        </label>
                                    </div>

                                    <div class="form-group facilities">
                                        <label for="facilities" class="bmd-label-floating strong-label">Facilities</label>
                                        <div class="row">
                                            @foreach($facilities as $facility)
                                                <div class="col-lg-4 my-2">
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="facilities[{{ $facility->id }}]" value="{{ $facility->name }}" {{ (@$edit && @$room->facilities->contains($facility->id)) ? 'checked' : '' }}>
                                                        <span class="custom-control-label">{{ $facility->name }}</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="form-group pt-3">
                                        <label class="custom-switch">
                                            <input type="checkbox" name="breakfast" class="custom-switch-input" value="1" {{ @$room->breakfast ? 'checked' : '' }} >
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Breakfast</span>
                                        </label>
                                    </div>

                                    <div class="form-group pt-3">
                                        <label class="custom-switch">
                                            <input type="checkbox" name="wifi" class="custom-switch-input" value="1" {{ @$room->wifi ? 'checked' : '' }}>
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Wi-Fi Available</span>
                                        </label>
                                    </div>

                                    <div class="form-group pt-3">
                                        <label class="custom-switch">
                                            <input type="checkbox" name="smoking" class="custom-switch-input" value="1" {{ @$room->smoking ? 'checked' : '' }}>
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Smoking</span>
                                        </label>
                                    </div>

                                    <div class="form-group pt-3">
                                        <label class="custom-switch">
                                            <input type="checkbox" name="has_terrace" class="custom-switch-input" value="1" {{ @$room->has_terrace ? 'checked' : '' }}>
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Has terrace</span>
                                        </label>
                                    </div>

                                    <div class="form-group pt-3">
                                        <label class="custom-switch">
                                            <input type="checkbox" name="day_use_room" class="custom-switch-input" value="1" {{ @$room->day_use_room ? 'checked' : '' }}>
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Day use room (24h room)</span>
                                        </label>
                                    </div>

                                    <div class="form-group pt-3">
                                        <label class="custom-switch">
                                            <input type="checkbox" name="installment" class="custom-switch-input" value="1" {{ @$room->installment ? 'checked' : '' }}>
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Terima cicilan untuk pemegang kartu kredit</span>
                                        </label>
                                    </div>

                                    <div class="form-group pt-3">
                                        <label class="custom-switch">
                                            <input type="checkbox" name="featured" class="custom-switch-input" value="1" {{ @$room->featured ? 'checked' : '' }}>
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Featured</span>
                                        </label>
                                    </div>

                                    <button type="submit" class="btn btn-success btn-block">
                                        {{ (@$edit ? 'Save' : 'Next') }}
                                        <i class="fa fa-arrow-right"></i>
                                    </button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection