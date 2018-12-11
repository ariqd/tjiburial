@extends('backend.templates.main')

@push('title')
    Settings
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
                        <div id="newFaq">
                            <h4>{{ @$edit ? 'Edit' : 'Add New' }} FAQ Item</h4>
                            <form action="{{ $url }}" method="post">
                                {!! csrf_field() !!}
                                {{ @$edit ? method_field('PUT') : '' }}

                                <div class="form-group">
                                    <label for="order" class="bmd-label-floating">Order</label>
                                    <input type="number" class="form-control" id="order" name="order" aria-describedby="orderHelp"
                                           value="{{ @old('order') ? old('order') : (@$edit ? $faq->order : '') }}" required>
                                    <small id="orderHelp" class="form-text text-muted">
                                        Must be a number, cannot be less than 1
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label class="bmd-label-floating" for="question">Question</label>
                                    <input type="text" class="form-control" id="question" name="question"
                                           value="{{ @old('question') ? old('question') : (@$edit ? $faq->question : '') }}" required>
                                </div>

                                <div class="form-group">
                                    <label class="bmd-label-floating" for="answer">Answer</label>
                                    <textarea name="answer" id="answer" class="form-control" rows="5">{{ @old('answer') ? old('answer') : (@$edit ? $faq->answer : '') }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-success btn-raised float-right mt-2">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
