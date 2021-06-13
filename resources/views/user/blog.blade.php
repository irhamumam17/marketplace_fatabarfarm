@extends('layouts.landing_template')
@section('title')
Fatabar Farm | Blog
@endsection
@section('content')
<!--====== App Content ======-->
        <div class="app-content">

            <!--====== Section 1 ======-->
            <div class="u-s-p-y-60">
                <div class="container">
                    <div class="blog-m">
                        <div class="row blog-m-init">
                            @foreach($posts as $post)
                            <div class="blog-m__element">
                                <div class="bp-mini bp-mini--img">
                                    <div class="bp-mini__thumbnail">

                                        <!--====== Image Code ======-->

                                        <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block" href="blog-detail.html">

                                            <img class="aspect__img" src="{{ asset('landing_assets/images/blog/post-2.jpg')}}" alt=""></a>
                                        <!--====== End - Image Code ======-->
                                    </div>
                                    <div class="bp-mini__content">
                                        <div class="bp-mini__stat">

                                            <span class="bp-mini__stat-wrap">

                                                <span class="bp-mini__publish-date">

                                                    <a href="blog-masonry.html">

                                                        <span>{{$post->created_at}}</span></a></span></span>

{{--                                             <span class="bp-mini__stat-wrap">

                                                <span class="bp-mini__preposition">By</span>

                                                <span class="bp-mini__author">

                                                    <a href="#">Dayle</a></span></span> --}}
                                                    </div>

                                        <span class="bp-mini__h1">

                                            <a href="blog-detail.html">{{$post->title}}</a></span>
                                        {{-- <p class="bp-mini__p">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> --}}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section 1 ======-->
        </div>
        <!--====== End - App Content ======-->
@endsection