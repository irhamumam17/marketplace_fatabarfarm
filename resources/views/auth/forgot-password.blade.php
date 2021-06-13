@extends('layouts.landing_template')

@section('title')
Fatabar Farm | Lupa Kata Sandi
@endsection

@section('css')
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

                                        <a href="{{ route('user.home') }}">Home</a></li>
                                    <li class="is-marked">

                                        <a href="{{ route('forgot_password_view')}}">Reset</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section 1 ======-->


            <!--====== Section 2 ======-->
            <div class="u-s-p-b-60">

                <!--====== Section Intro ======-->
                <div class="section__intro u-s-m-b-60">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section__text-wrap">
                                    <h1 class="section__heading u-c-secondary">LUPA KATA SANDI?</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Intro ======-->


                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row row--center">
                            <div class="col-lg-6 col-md-8 u-s-m-b-30">
                                <div class="l-f-o">
                                    <div class="l-f-o__pad-box">
                                        <h1 class="gl-h1">ATUR ULANG KATA SANDI</h1>

                                        <span class="gl-text u-s-m-b-30">Masukkan email anda di form dibawah ini, kami akan mengirim link pengubahan kata sandi kepada anda.</span>
                                        <form class="l-f-o__form" action="{{ route('forgot_password') }}" method="POST">
                                            <div class="u-s-m-b-30">

                                                <label class="gl-label" for="reset-email">E-MAIL *</label>

                                                <input class="input-text input-text--primary-style" type="text" name="email" id="reset-email" placeholder="Enter E-mail"></div>
                                            <div class="u-s-m-b-30">

                                                <button class="btn btn--e-transparent-brand-b-2" type="submit">SUBMIT</button></div>
                                            <div class="u-s-m-b-30">

                                                <a class="gl-link" href="{{ route('login_view') }}">Back to Login</a></div>
                                        </form>
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