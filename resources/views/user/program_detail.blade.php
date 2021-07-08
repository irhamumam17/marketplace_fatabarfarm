@extends('layouts.landing_template')
@section('title')
Detail Program
@endsection
@section('content')
        <!--====== App Content ======-->
        <div class="app-content">

            <!--====== Section 1 ======-->
            <div class="u-s-p-y-90">

                <!--====== Detail Post ======-->
                <div class="detail-post">
                    <div class="bp-detail">
                        <div class="bp-detail__info-wrap">
                            <div class="bp-detail__stat">

                                <span class="bp-detail__stat-wrap">

                                    <span class="bp-detail__publish-date">

                                        <a href="javascript:void(0)">

                                            <span>{{$program->created_at}}</span></a></span></span>

                                <span class="bp-detail__stat-wrap">

                                    <span class="bp-detail__author">

                                        <a href="javascript:void(0)">Admin</a></span></span>

                                {{-- <span class="bp-detail__stat-wrap">

                                    <span class="bp-detail__category">

                                        <a href="blog-right-sidebar.html">Learning</a>

                                        <a href="blog-right-sidebar.html">News</a>

                                        <a href="blog-right-sidebar.html">Health</a>
                                    </span>
                                    </span>
                                    </div> --}}

                            <span class="bp-detail__h1">

                                <a href="javascript:void(0)">{{$program->detail->title}}</a></span>
                            <p class="bp-detail__p">{!! $program->detail->content !!}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Detail Post ======-->
            </div>
            <!--====== End - Section 1 ======-->
        </div>
        <!--====== End - App Content ======-->
@endsection