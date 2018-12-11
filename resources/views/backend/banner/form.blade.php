@extends('backend.templates.main')

@push('title')
    {{ @$edit ? 'Edit' : 'Add' }} Banner
@endpush

@push('js')
    <script src="{{ asset('assets') }}/plugins/jquery-uploader/jquery-uploader.js"></script>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/jquery-uploader/jquery-uploader.css">
@endpush

@push('script')
    <script>
        $(document).ready(function(){
            imageUploader();
        });
    </script>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1><small>Banners</small> / {{ @$edit ? 'Edit' : 'Add' }} Banner</h1>
            </div>
            <div class="col-lg-6">
                <div class="float-right">
                    <a href="{{ url('admin/banners') }}" class="btn btn-danger">
                        <i class="fe fe-chevron-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @include('backend.templates.feedback')
                        <form action="{{ @$edit ? url('admin/banners/'.$banner->id) : url('admin/banners') }}"
                              method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ @$edit ? method_field('PUT') : '' }}

                            <div class="form-group">
                                <label class="bmd-label-floating font-75 strong-label">Image Banner</label>
                                <div class="setting image_picker">
                                    <div class="settings_wrap">
                                        <label class="drop_target {{ (@$banner->image && @$banner->image != '') ? 'dropped' : '' }}">
                                            <div class="image_preview" style="background-image: url('{{ (@$banner->image && @$banner->image != '') ? asset('uploads/banner/'.$banner->image) : '' }}')"></div>
                                            <input class="inputFile" type="file" name="image"/>
                                            <input class="hidden" type="hidden" name="current-image" value="{{ @$banner->image }}"/>
                                        </label>
                                        <div class="settings_actions vertical"><a data-action="choose_from_uploaded"><i class="fa fa-picture-o"></i> Drop / choose image to uploads</a><a class="{{ (@$banner->image && @$banner->image != '') ? '' : 'disabled' }}" data-action="remove_current_image"><i class="fa fa-ban"></i> Remove Current Image</a></div>
                                        <div class="image_details">
                                            <label class="input_line image_title">
                                                {{ (@$banner->image && @$banner->image != '') ? $banner->image : '' }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <small id="image" class="form-text text-muted">
                                    Supported image types: JPEG, JPG, PNG.
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="title" class="bmd-label-floating">Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                       value="{{ @old('title') ? old('title') : (@$banner->title ? $banner->title : '') }}">
                            </div>

                            <div class="form-group">
                                <label for="description" class="bmd-label-floating">Description</label>
                                <input type="text" name="description" id="description" class="form-control"
                                       value="{{ @old('description') ? old('description') : (@$banner->description ? $banner->description : '') }}">
                            </div>

                            <div class="form-group">
                                <label for="order" class="bmd-label-floating">Order</label>
                                <input type="number" name="order" id="order" class="col-lg-2 form-control"
                                       value="{{ @old('order') ? old('order') : (@$banner->order ? $banner->order : '') }}">
                                <small class="text-secondary">Banner order in number</small>
                            </div>

                            <div class="form-row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Set Banner Status</label>
                                        <div class="radio mb-3">
                                            <label>
                                                <input type="radio" name="status" value="1" {{ @$banner->status == '1' || empty($banner->status) ? 'checked' : '' }}>
                                                Active
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="radio mb-3">
                                            <label>
                                                <input type="radio" name="status" value="0" {{ @$banner->status == '0' ? 'checked' : '' }}>
                                                Disabled
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success btn-block"><i class="fe fe-check"></i> Submit</button>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection