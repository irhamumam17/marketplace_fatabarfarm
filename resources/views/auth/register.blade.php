@extends('layouts.landing_template')

@section('title')
Fatabar Farm | Daftar
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

                                        <a href="signup.html">Daftar</a></li>
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
                                    <h1 class="section__heading u-c-secondary">Buat Akun</h1>
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
                                        <h1 class="gl-h1">Informasi Pribadi</h1>
                                        <form class="l-f-o__form" action="{{ route('register') }}" method="POST">
                                            @csrf
                                            <div class="u-s-m-b-30">

                                                <label class="gl-label" for="reg-fname">Nama *</label>

                                                <input class="input-text input-text--primary-style" name="name" type="text" id="reg-name" placeholder="Masukkan Nama" value="{{ old('name') }}">
                                                @error('name')
                                                <span class="gl-text" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="u-s-m-b-30">

                                                <label class="gl-label" for="reg-email">E-MAIL *</label>

                                                <input class="input-text input-text--primary-style" name="email" type="text" id="reg-email" placeholder="Masukkan E-Mail" value="{{ old('email') }}">
                                                @error('email')
                                                <span class="gl-text" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="u-s-m-b-30">

                                                <label class="gl-label" for="reg-password">KATA SANDI *</label>

                                                <input class="input-text input-text--primary-style" name="password" type="password" id="reg-password" placeholder="Masukkan Kata Sandi">
                                                @error('password')
                                                <span class="gl-text" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="u-s-m-b-30">

                                                <label class="gl-label" for="reg-password">KONFIRMASI KATA SANDI *</label>

                                                <input class="input-text input-text--primary-style" name="password_confirmation" type="password" id="reg-password" placeholder="Masukkan Konfirmasi Kata Sandi">
                                            </div>
                                            <div class="u-s-m-b-15">

                                                <button class="btn btn--e-transparent-brand-b-2" type="submit">CREATE</button></div>

                                            <a class="gl-link" href="#">Kembali Ke Halaman Utama</a>
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