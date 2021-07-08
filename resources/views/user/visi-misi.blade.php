@extends('layouts.landing_template')
@section('title')
Fatabar Farm | Visi Misi
@endsection
@section('content')
        <!--====== App Content ======-->
        <div class="app-content">

            <!--====== Section 1 ======-->
            <div class="u-s-p-y-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="breadcrumb">
                            <div class="breadcrumb__wrap">
                                <ul class="breadcrumb__list">
                                    <li class="has-separator">

                                        <a href="{{ route('user.home')}}">Home</a></li>
                                    <li class="is-marked">

                                        <a href="{{ route('user.visi_misi')}}">Visi Misi</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section 1 ======-->


            <!--====== Section 2 ======-->
            <div class="u-s-p-b-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="about">
                                    <div class="about__container">
                                        <div class="about__info">
                                            <h2 class="about__h2">Visi Misi Fatabar Farm</h2>
                                            <div class="about__p-wrap">
                                                <p class="about__p">{!! $visi_misi->detail !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 2 ======-->
        </div>
        <!--====== End - App Content ======-->
@endsection