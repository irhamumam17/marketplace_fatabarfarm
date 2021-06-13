@extends('layouts.landing_template')
@section('title')
Fatabar Farm | Profil
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

                                        <a href="{{route('user.profil')}}">Akun</a></li>
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
                    <div class="dash">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3 col-md-12">

                                    <!--====== Dashboard Features ======-->
                                    <div class="dash__box dash__box--bg-white dash__box--shadow u-s-m-b-30">
                                        <div class="dash__pad-1">

                                            <span class="dash__text u-s-m-b-16">Hello, {{ auth()->user()->name }}</span>
                                            <ul class="dash__f-list">
                                                <li>

                                                    <a class="dash-active" href="{{route('user.profil')}}">Profil</a></li>
                                                <li>

                                                    <a href="{{route('user.track_order.view')}}">Lacak Pesanan</a></li>
                                                <li>

                                                    <a href="{{route('user.transaction')}}">Transaksi Saya</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="dash__box dash__box--bg-white dash__box--shadow dash__box--w">
                                        <div class="dash__pad-1">
                                            <ul class="dash__w-list">
                                                <li>
                                                    <div class="dash__w-wrap">

                                                        <span class="dash__w-icon dash__w-icon-style-1"><i class="fas fa-cart-arrow-down"></i></span>

                                                        <span class="dash__w-text">{{ $data->n_transaksi }}</span>

                                                        <span class="dash__w-name">Transaksi Diproses</span></div>
                                                </li>
                                                <li>
                                                    <div class="dash__w-wrap">

                                                        <span class="dash__w-icon dash__w-icon-style-2"><i class="fas fa-check-circle"></i></span>

                                                        <span class="dash__w-text">{{ $data->n_sukses_transaksi }}</span>

                                                        <span class="dash__w-name">Transaksi Sukses</span></div>
                                                </li>
                                                <li>
                                                    <div class="dash__w-wrap">

                                                        <span class="dash__w-icon dash__w-icon-style-1"><i class="fas fa-times"></i></span>

                                                        <span class="dash__w-text">{{ $data->n_batal_transaksi }}</span>

                                                        <span class="dash__w-name">Transaksi Dibatalkan</span></div>
                                                </li>
                                                <li>
                                                    <div class="dash__w-wrap">

                                                        <span class="dash__w-icon dash__w-icon-style-3"><i class="far fa-heart"></i></span>

                                                        <span class="dash__w-text">{{ $data->n_keranjang }}</span>

                                                        <span class="dash__w-name">Keranjang</span></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--====== End - Dashboard Features ======-->
                                </div>
                                <div class="col-lg-9 col-md-12">
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white">
                                        <div class="dash__pad-2">
                                            <h1 class="dash__h1 u-s-m-b-14">Ubah Profil</h1>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <form class="contact-f" method="post" action="{{ route('user.profil.update')}}">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 u-h-100">
                                                                <div class="u-s-m-b-30">

                                                                    <label for="c-name"></label>

                                                                    <input class="input-text input-text--border-radius input-text--primary-style" type="text" name="name" id="c-name" placeholder="Nama (Wajib)" value="{{ auth()->user()->name }}" required></div>
                                                                <div class="u-s-m-b-30">

                                                                    <label for="c-email"></label>

                                                                    <input class="input-text input-text--border-radius input-text--primary-style" type="text" id="c-email" name="email" placeholder="Email (Wajib)"  value="{{ auth()->user()->email }}" required></div>
                                                                <div class="u-s-m-b-30">

                                                                    <label for="c-password"></label>

                                                                    <input class="input-text input-text--border-radius input-text--primary-style" type="password" name="password" id="c-password" placeholder="Password (Opsional)">
                                                                </div>
                                                                <div class="u-s-m-b-30">

                                                                    <label for="c-name"></label>

                                                                    <input class="input-text input-text--border-radius input-text--primary-style" type="password" name="password_confirmation" id="c-name" placeholder="Konfirmasi Password (Opsional)">
                                                                </div>
                                                                <div class="u-s-m-b-30">

                                                                    <label for="c-subject"></label>

                                                                    <input class="input-text input-text--border-radius input-text--primary-style" type="file" id="c-subject" placeholder="Foto (Wajib)" required></div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 u-h-100">
                                                                <div class="u-s-m-b-30">

                                                                    <label for="c-message"></label><textarea class="text-area text-area--border-radius text-area--primary-style" id="c-message" placeholder="Alamat (Wajib)" required>{{ auth()->user()->address }}</textarea></div>
                                                            </div>
                                                            <div class="col-lg-12">

                                                                <button class="btn btn--e-brand-b-2" type="submit">Update</button></div>
                                                        </div>
                                                    </form>
                                                </div>
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
@endsection