@extends('backend.templates.main')

@push('title')
    {{ $message->subject }}
@endpush

{{--@push('css')--}}
    {{--<link href="{{ asset('backend') }}/assets/plugins/DataTables/datatables.min.css" rel="stylesheet" />--}}
{{--@endpush--}}

{{--@push('js')--}}
    {{--<script src="{{ asset('backend') }}/assets/plugins/DataTables/datatables.min.js"></script>--}}
{{--@endpush--}}

{{--@push('styles')--}}
{{--<style>--}}
{{--table tbody tr.clickable-row {--}}
{{--cursor: pointer!important;--}}
{{--}--}}
{{--</style>--}}
{{--@endpush--}}

{{--@push('script')--}}
    {{--<script>--}}
        {{--$(document).ready(function(){--}}
            {{--$('.data-table').dataTable({--}}
                {{--responsive: true--}}
            {{--});--}}
            {{--$(".clickable-row").click(function() {--}}
                {{--window.location = $(this).data("href");--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
{{--@endpush--}}

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1><a href="{{ url('admin/messages') }}" class="text-dark">Messages</a> / {{ $message->subject }}</h1>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2">
                                <b>Sender Name</b>
                            </div>
                            <div class="col-lg-10">
                                {{ $message->name }}
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-2">
                                <b>Sender E-Mail</b>
                            </div>
                            <div class="col-lg-10">
                                {{ $message->email }}
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-2">
                                <b>Subject</b>
                            </div>
                            <div class="col-lg-10">
                                {{ $message->subject }}
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-2">
                                <b>Message</b>
                            </div>
                            <div class="col-lg-10">
                                {{ $message->message }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection