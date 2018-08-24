@push('style')
    <style>
        .close:before {
            content: '\ea00';
            font-family: "feather";
        }
    </style>
@endpush

@if(@session('info'))
    <div class="alert alert-info alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert"></button>
        <strong><i class="fa fa-info-circle"></i> Success!</strong> {{ @session('info') }}
    </div>
@endif

@if(@session('error'))
    <div class="alert alert-warning alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert"></button>
        <strong><i class="fa fa-exclamation-circle"></i> Warning!</strong> {{ @session('error') }}
    </div>
@endif

@if(count($errors) > 0)
    <div class="alert alert-warning alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert"></button>
        <strong><i class="fa fa-exclamation-circle"></i> Please correct your input data :</strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif