@extends('layouts.landing_template')

@section('title')
Fatabar Farm | Masuk
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

                                        <a href="index.html">Home</a></li>
                                    <li class="is-marked">

                                        <a href="signin.html">Masuk</a></li>
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
                                    <h1 class="section__heading u-c-secondary">Sudah Punya Akun?</h1>
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
                                        <h1 class="gl-h1">Saya Pengguna Baru</h1>

                                        <span class="gl-text u-s-m-b-30">Dengan membuat akun pada website kami, anda akan tercatat sebagai customer pada usaha kami. Sehingga anda dapat menikmati fitur yang kami sediakan. Happy Healthy....</span>
                                        <div class="u-s-m-b-15">

                                            <a class="l-f-o__create-link btn--e-transparent-brand-b-2" href="{{ route('register') }}">Buat Akun Baru</a></div>
                                        <h1 class="gl-h1">Masuk</h1>

                                        <span class="gl-text u-s-m-b-30">Jika anda sudah mempunyai akun, silahan masukkan data anda.</span>
                                        <form class="l-f-o__form" action="{{ route('login') }}" method="POST">
                                            @csrf
                                            <div class="u-s-m-b-30">
                                                <label class="gl-label" for="login-email">E-MAIL *</label>

                                                <input class="input-text input-text--primary-style" name="email" type="text" id="login-email" placeholder="Masukkan E-Mail" value="{{ old('email') }}">
                                                @error('email')
                                                <span class="gl-text" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="u-s-m-b-30">

                                                <label class="gl-label" for="login-password">Kata Sandi *</label>

                                                <input class="input-text input-text--primary-style" name="password" type="password" id="login-password" placeholder="Masukkan Kata Sandi">
                                                @error('password')
                                                <span class="gl-text" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="gl-inline">
                                                <div class="u-s-m-b-30">

                                                    <button class="btn btn--e-transparent-brand-b-2" type="submit">Masuk</button></div>
                                                <div class="u-s-m-b-30">

                                                    <a class="gl-link" href="lost-password.html">Lupa Kata Sandi?</a></div>
                                            </div>
                                            <div class="u-s-m-b-30">

                                                <!--====== Check Box ======-->
                                                <div class="check-box">

                                                    <input type="checkbox" id="remember-me">
                                                    <div class="check-box__state check-box__state--primary">

                                                        <label class="check-box__label" for="remember-me">Remember Me</label></div>
                                                </div>
                                                <!--====== End - Check Box ======-->
                                            </div>
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

