@extends('layouts.landing_template')

@section('title')
Reset Password
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

                                        <a href="{{route('user.home')}}">Home</a></li>
                                    <li class="is-marked">

                                        <a href="#">Reset Password</a></li>
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
                                        @error('system')
                                                <span class="gl-text u-s-m-b-30">{{ $message }}</span>
                                        @enderror
                                        <form class="l-f-o__form" action="{{ route('forgot_password') }}" method="POST">
                                            @csrf
                                            <div class="u-s-m-b-30">

                                                <label class="gl-label" for="login-password">Kata Sandi *</label>

                                                <input class="input-text input-text--primary-style" name="password" type="password" id="login-password" placeholder="Masukkan Kata Sandi">
                                                @error('password')
                                                <span class="gl-text" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="u-s-m-b-30">

                                                <label class="gl-label" for="login-password">Kata Sandi Konfirmasi*</label>

                                                <input class="input-text input-text--primary-style" name="password_confirmation" type="password" id="login-password" placeholder="Masukkan Kata Sandi Konfirmasi">
                                                @error('password_confirmation')
                                                <span class="gl-text" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="gl-inline">
                                                <div class="u-s-m-b-30">

                                                    <button class="btn btn--e-transparent-brand-b-2" type="submit">Ubah Password</button></div>
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

