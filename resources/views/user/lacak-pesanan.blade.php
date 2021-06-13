@extends('layouts.landing_template')
@section('title')
Fatabar Farm | Lacak Pesanan
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

                                        <a href="{{route('user.track_order.view')}}">Lacak Pesanan</a></li>
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

                                                    <a href="{{route('user.profil')}}">Profil</a></li>
                                                <li>

                                                    <a class="dash-active" href="{{ route('user.track_order.view') }}">Lacak Pesanan</a></li>
                                                <li>

                                                    <a href="{{ route('user.transaction') }}">Transaksi Saya</a></li>
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
                                            <h1 class="dash__h1 u-s-m-b-14">Lacak Pesanan Anda</h1>

                                            <span class="dash__text u-s-m-b-30">Untuk melacak pesanan anda, mohon untuk memasukkan ID transaksi dan email anda. Kami akan mengirimkan email kepada anda yang berisi nota pesanan anda.</span>
                                            <form class="dash-track-order" action="{{ route('user.track_order') }}" method="POST">
                                                @csrf
                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="order-id">ID Transaksi *</label>

                                                        <input class="input-text input-text--primary-style" type="text" id="order-id" placeholder="Found in your confirmation email"></div>
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="track-email">Email *</label>

                                                        <input class="input-text input-text--primary-style" type="text" id="track-email" placeholder="Email you used during checkout"></div>
                                                </div>

                                                <button class="btn btn--e-brand-b-2" type="submit">LACAK</button>
                                            </form>
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