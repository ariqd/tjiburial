@push('style')
    <style>
        #footer{
            color: #fff;
            background: #359400;
            min-height: 100px;
            margin-top: 100px;
        }
        .footer{
            padding: 15px;
            color: #fff;
            background: #1D5700;
            /*position: fixed;*/
            /*left: 0;*/
            /*bottom: 0;*/
            /*width: 100%;*/
        }
        .img-fluid {
            display: inline-block;
        }
        .social {
            margin-top: 40px;
        }
    </style>
@endpush
{{--<div id="footer">--}}
    {{--<div class="container-fluid">--}}
        {{--<div class="row">--}}
            {{--<div class="col-lg-2">--}}
                {{--<div class="text-center mt-3">--}}
                    {{--<img src="{{ asset('assets') }}/images/logo.png" alt="logo tjiburial" class="img-fluid" width="80">--}}
                    {{--<p class="text-center">Pondokan Tjiburial</p>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-lg-8">--}}
                {{--<div class="d-flex justify-content-center social">--}}
                    {{--<a href="#">--}}
                        {{--<img src="{{ asset('assets') }}/images/fb.png" class="img-fluid" width="40">--}}
                    {{--</a>--}}
                    {{--<a href="#" class="pl-4">--}}
                        {{--<img src="{{ asset('assets') }}/images/ig.png" class="img-fluid" width="40">--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
<footer class="footer mt-5 ">
    <div class="row">
        <div class="col-lg-6">
            &copy; Copyright {{ date('Y') }} Pondokan Tjiburial Hotels. All rights reserved.
        </div>
        <div class="col-lg-6">
            <div class="text-right">
                <a href="#">
                    <img src="{{ asset('assets') }}/images/fb.png" class="img-fluid" width="20">
                </a>
                <a href="#" class="pl-4">
                    <img src="{{ asset('assets') }}/images/ig.png" class="img-fluid" width="20">
                </a>
            </div>
        </div>
    </div>
</footer>