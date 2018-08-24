@extends('backend.templates.main')

@push('title')
    Images of {{ $room->name }}
@endpush

@push('js')
    <script src="{{ asset('assets') }}/plugins/jquery-uploader/jquery-uploader.js"></script>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/jquery-uploader/jquery-uploader.css">
@endpush

@push('style')
    <style>
        .hidden{
            display: none !important;
        }
        .strong-label{
            top: .6rem !important;
            font-size: .8rem !important;
            color: rgba(0,0,0,.6) !important;
        }
    </style>
@endpush

@push("script")
    <script>
        $(document).ready(function() {
            imageUploader()

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $(input).parents('.form-row').find('.image-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            function initPreview() {
                $(".inputPhoto").change(function() {
                    readURL(this);
                });
            }

            function initForm(){
                $('input.form-control').unbind('focus');
                $('input.form-control').on('focus', function(){
                    var parent = $(this).parent();
                    parent.addClass('is-filled');
                });
                $('input.form-control').unbind('blur');
                $('input.form-control').on('blur', function(){
                    var val = $(this).val()
                    var parent = $(this).parent();
                    if(val !== ''){
                        parent.addClass('is-filled');
                    }else{
                        parent.removeClass('is-filled');
                    }
                });
            }

            function initDelete(){
                $('.btnDeleteImage').unbind('click');
                $('.btnDeleteImage').on('click', function(){
                    $(this).parents('.roomPhotos').remove();

                    var id = $(this).data('id');
                    console.log(id);
                    $(".deleteImage"+id).prop('disabled', false);
                });
            }

            initDelete();
            initPreview();

            $('.btnAddImage').on('click', function(e){
                e.preventDefault();

                if($('form .roomPhotos').length === 3){
                    swal('Caution!', 'You already reach the image limit.', 'warning');
                    return false;
                }


                $('#additional-image').append($('#template')[0].innerHTML);

                $('.roomPhotos').each(function(key, val){
                    $(val).find('input:file').each(function(keyInput, valInput){
                        console.log(valInput);
                        $(valInput)[0].setAttribute('name', 'roomPhoto['+key+']'+$(valInput).data('name'));
                    });
                });

                initPreview();
                initForm();
                initDelete();
                imageUploader();
            });
        });
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
                            <h1>Images of {{ $room->name }}</h1>
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ url('admin/rooms') }}" class="btn btn-primary float-right">
                                <i class="fa fa-home"></i>&nbsp;&nbsp;Rooms
                            </a>
                        </div>
                    </div>
                    @include('backend.templates.feedback')
                    <div class="row mt-2">
                        <div class="col-lg-12">
                            <form action="{{ url('admin/rooms/images') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <input type="hidden" name="room_id" value="{{ $room->id }}">

                                @foreach($roomPhotos as $key => $roomPhoto)
                                    <div class="roomPhotos" id="roomPhoto{{ $key }}">
                                        <div class="form-group">
                                            <h3>
                                                {{ ($key == 0) ? 'Main' : 'Additional' }} Image
                                                @if($key > 0)
                                                    <button class="btn btn-danger btnDeleteImage pull-right" type="button" data-id="{{ $roomPhoto->id }}">
                                                        <i class="fa fa-times"></i> Remove Image
                                                    </button>
                                                @endif
                                            </h3>

                                            {{--<label class="bmd-label-floating strong-label">Main Image</label>--}}

                                            <div class="setting image_picker">
                                                <div class="settings_wrap">
                                                    <label class="drop_target {{ (@$roomPhoto->image && @$roomPhoto->image != '') ? 'dropped' : '' }}">
                                                        <div class="image_preview" style="background-image: url('{{ (@$roomPhoto->image && @$roomPhoto->image != '') ? asset('uploads') . '/rooms/'.$room->name.'/'.@$roomPhoto->image : '' }}')"></div>
                                                        <input class="inputFile" type="file" name="roomPhoto[{{$key}}][image]" data-name="[image]" value="{{ @$roomPhoto->image }}"/>
                                                    </label>
                                                    <div class="settings_actions vertical"><a data-action="choose_from_uploaded"><i class="fa fa-picture-o"></i> Drop / choose image to uploads</a><a class="{{ (@$roomPhoto->image && @$roomPhoto->image != '') ? '' : 'disabled' }}" data-action="remove_current_image"><i class="fa fa-ban"></i> Remove Current Image</a></div>
                                                    <div class="image_details">
                                                        <label class="input_line image_title">
                                                            {{ (@$roomPhoto->image && @$roomPhoto->image != '') ? @$roomPhoto->image : '' }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <small id="photo" class="form-text text-muted">
                                                Supported image types: JPEG, JPG, PNG.
                                            </small>
                                        </div>
                                    </div>
                                    <input type="hidden" class="deleteImage{{ @$roomPhoto->id }}" name="delete[]" value="{{ @$roomPhoto->id }}" disabled>
                                @endforeach

                                <div id="additional-image"></div>

                                <button class="btn btn-primary mb-3 btnAddImage" type="button"><i class="fe fe-plus"></i> Add Image</button>

                                <button type="submit" class="btn btn-primary btn-block"><i class="fe fe-check"></i>&nbsp;&nbsp;Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.room.imageTemplate')
@endsection