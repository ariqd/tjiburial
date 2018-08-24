@extends('frontend.templates.main')

@push('title')
    Promotions
@endpush

@push('style')
    <style>
        .navbar {
            position: absolute;
            width: 100%;
        }
        .base {
            position: relative;
            top: 0;
            left: 0;
        }
        /*.base img {*/
            /*width: 100%;*/
            /*height: 300px;*/
        /*}*/
        .img-fluid {
            display: inline-block;
        }

        .card {
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
            border: 0;
        }

        input, textarea {
            border: 0;
        }

        .promo .carousel-caption {
            background: #212121;
            opacity: 0.8;
            padding: 25px;
        }
    </style>
@endpush

@section('content')
    <div class="base">
        <img class="img-fluid" src="{{ asset('assets') }}/images/about.png">
    </div>

    <div class="promo-images">
        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="text-center">
                        <h4>{{ $promotion->title }}</h4>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img class="img-fluid w-100" src="{{ asset('uploads').'/promotions/'.$promotion->title.'/'.$promotion->images()->where('main', 1)->first()->image }}">
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        @if(isset($images))
                            @foreach($images as $image)
                                <div class="col-lg-6 mb-2">
                                    <img class="img-fluid w-100 h-100" src="{{ asset('uploads').'/promotions/'.$promotion->title.'/'.$image->image }}">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                {!! $promotion->description !!}
                {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto cumque deleniti deserunt dolorum earum fugiat harum, magni molestias quas, sint temporibus unde ut voluptas. Fuga iusto tenetur totam ullam veniam.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab animi assumenda beatae, corporis culpa delectus dolores ea earum, ipsa ipsam iste mollitia officia quam ratione recusandae repellat reprehenderit repudiandae voluptatum.</p>--}}
                {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci at atque deleniti dolore est expedita hic labore, laboriosam, molestiae mollitia nesciunt nisi nobis odit porro qui rem saepe sequi vel.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab animi assumenda beatae, corporis culpa delectus dolores ea earum, ipsa ipsam iste mollitia officia quam ratione recusandae repellat reprehenderit repudiandae voluptatum.</p>--}}
                {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid amet atque consequuntur ea, eius enim eos excepturi exercitationem impedit inventore odio odit omnis quae quibusdam repellendus sequi similique suscipit vel.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab animi assumenda beatae, corporis culpa delectus dolores ea earum, ipsa ipsam iste mollitia officia quam ratione recusandae repellat reprehenderit repudiandae voluptatum.</p>--}}
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-12">
                <h4>Other Promotions</h4>
            </div>
            @if(isset($others))
                @foreach($others as $promotion)
                    <div class="col-lg-3">
                        <a href="{{ url('promotion/1') }}" class="carousel-item">
                            <img class="img-fluid w-100 h-100" src="{{ asset('uploads').'/promotions/'.$promotion->title.'/'.$promotion->images()->where('main', 1)->first()->image }}">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $promotion->title }}</h5>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    @include('frontend.templates.footer')

@endsection