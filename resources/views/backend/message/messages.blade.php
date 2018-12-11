@extends('backend.templates.main')

@push('title')
    Messages
@endpush

@push('css')
    <link href="{{ asset('backend') }}/assets/plugins/DataTables/datatables.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="{{ asset('backend') }}/assets/plugins/DataTables/datatables.min.js"></script>
@endpush

{{--@push('styles')--}}
    {{--<style>--}}
        {{--table tbody tr.clickable-row {--}}
            {{--cursor: pointer!important;--}}
        {{--}--}}
    {{--</style>--}}
{{--@endpush--}}

@push('script')
    <script>
        $(document).ready(function(){
            $('.data-table').dataTable({
                responsive: true
            });
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Messages</h1>
                <div class="card">
                    <div class="card-body">
                        @if(!$messages->isEmpty())
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter table-hover data-table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>E-Mail</th>
                                        <th>Subject</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($messages as $message)
                                        <tr class='clickable-row' data-href='{{ url('admin/messages/'.$message->id) }}' style="cursor:pointer">
                                            <td>{{ $message->name }}</td>
                                            <td>{{ $message->email }}</td>
                                            <td>{{ $message->subject }}</td>
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