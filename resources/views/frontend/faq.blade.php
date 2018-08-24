@extends('frontend.templates.main')

@push('title')
    Blog
@endpush

@push('style')
    <style>
        .navbar {
            position: absolute;
            width: 100%;
        }
        .base {
            width: 100%;
            height: 300px;
            position: relative;
            margin-left: auto;
            margin-right: auto;
            overflow: hidden;
        }
        .base img {
            width: 100%;
            position: absolute;
            margin: auto;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
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
        .card-columns a:hover {
            text-decoration: none;
        }

        #integration-list {
            font-family: 'Open Sans', sans-serif;
            width: 100%;
            margin: 0 auto;
            display: table;
            border: 1px solid #BDBDBD;
            border-radius: 3px;
        }
        #integration-list ul {
            padding: 0;
            margin: 0;
            color: #555;
        }
        #integration-list ul > li {
            list-style: none;
            border-top: 1px solid #ddd;
            display: block;
            padding: 15px;
            overflow: hidden;
        }
        #integration-list ul:last-child {
            border-bottom: 1px solid #ddd;
        }
        #integration-list ul > li:hover {
            background: #efefef;
        }
        #integration-list ul > li > a:hover {
            text-decoration:none;
        }
        .expand {
            display: block;
            text-decoration: none;
            color: #555;
            cursor: pointer;
        }
        h2 {
            padding: 0;
            margin: 0;
            font-size: 24px;
            /*font-family: ''*/
            font-weight: 800;
        }
        span {
            font-size: 12.5px;
        }
        #left,#right{
            display: table;
        }
        #sup{
            display: table-cell;
            vertical-align: middle;
            width: 80%;
        }
        .detail {
            margin: 10px 0 10px 0px;
            display: none;
            line-height: 22px;
            padding: 20px 0 10px 0;
            /*height: 150px;*/
        }

        .detail a {
            text-decoration: none;
        }
        .right-arrow {
            margin-left: 20px;
            width: 10px;
            height: 100%;
            float: right;
            font-weight: bold;
            font-size: 20px;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function(){
            $(".expand").on( "click", function() {
                $(this).next().slideToggle(200);
                $expand = $(this).find(">:first-child");

                if($expand.text() == "+") {
                    $expand.text("-");
                } else {
                    $expand.text("+");
                }
            });
        });
    </script>
@endpush

@section('content')
    <div class="base">
        <img class="img-fluid" src="{{ asset('assets') }}/images/bgfaq.jpg">
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-center">FAQ</h4>
                <p class="text-center">Frequently Asked Question around and about Pondokan Tjiburial Hotel</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div id="integration-list">
                    <ul>
                        <li>
                            <a class="expand">
                                <div class="right-arrow">+</div>
                                <div>
                                    <h2>Question that has been asked periodically?</h2>
                                </div>
                            </a>

                            <div class="detail">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquam deleniti et eveniet exercitationem, facere facilis fugit impedit laudantium maiores molestiae nemo quibusdam rerum similique temporibus ut vero vitae voluptatem!
                                </p>
                            </div>
                        </li>

                        <li>
                            <a class="expand">
                                <div class="right-arrow">+</div>
                                <h2>Question that has been asked periodically?</h2>
                            </a>
                            <div class="detail">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis ea eius facere hic impedit inventore molestiae quisquam quod sit tenetur? Doloremque ducimus molestiae quasi saepe ut! Commodi eveniet ipsa quasi.
                                </p>
                            </div>
                        </li>

                        <li>
                            <a class="expand">
                                <div class="right-arrow">+</div>
                                <h2>Question that has been asked periodically?</h2>
                            </a>
                            <div class="detail">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis ea eius facere hic impedit inventore molestiae quisquam quod sit tenetur? Doloremque ducimus molestiae quasi saepe ut! Commodi eveniet ipsa quasi.
                                </p>
                            </div>
                        </li>

                        <li>
                            <a class="expand">
                                <div class="right-arrow">+</div>
                                <h2>Question that has been asked periodically?</h2>
                            </a>
                            <div class="detail">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis ea eius facere hic impedit inventore molestiae quisquam quod sit tenetur? Doloremque ducimus molestiae quasi saepe ut! Commodi eveniet ipsa quasi.
                                </p>
                            </div>
                        </li>

                        <li>
                            <a class="expand">
                                <div class="right-arrow">+</div>
                                <h2>Question that has been asked periodically?</h2>
                            </a>
                            <div class="detail">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis ea eius facere hic impedit inventore molestiae quisquam quod sit tenetur? Doloremque ducimus molestiae quasi saepe ut! Commodi eveniet ipsa quasi.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.templates.footer')

@endsection