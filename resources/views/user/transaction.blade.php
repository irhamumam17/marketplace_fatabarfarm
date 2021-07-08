@extends('layouts.landing_template')
@section('title')
Transaksi Saya
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

                                        <a href="{{route('user.transaction')}}">Transaksi</a></li>
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
                                                {{-- <li>

                                                    <a href="{{ route('user.track_order.view') }}">Lacak Pesanan</a></li> --}}
                                                <li>

                                                    <a class="dash-active" href="{{ route('user.transaction') }}">Transaksi Saya</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="dash__box dash__box--bg-white dash__box--shadow dash__box--w">
                                        <div class="dash__pad-1">
                                            <ul class="dash__w-list">
                                                <li>
                                                    <div class="dash__w-wrap">

                                                        <span class="dash__w-icon dash__w-icon-style-1"><i class="fas fa-cart-arrow-down"></i></span>

                                                        <span class="dash__w-text">{{ $data_transaksi->n_transaksi }}</span>

                                                        <span class="dash__w-name">Transaksi Diproses</span></div>
                                                </li>
                                                <li>
                                                    <div class="dash__w-wrap">

                                                        <span class="dash__w-icon dash__w-icon-style-2"><i class="fas fa-check-circle"></i></span>

                                                        <span class="dash__w-text">{{ $data_transaksi->n_sukses_transaksi }}</span>

                                                        <span class="dash__w-name">Transaksi Sukses</span></div>
                                                </li>
                                                <li>
                                                    <div class="dash__w-wrap">

                                                        <span class="dash__w-icon dash__w-icon-style-1"><i class="fas fa-times"></i></span>

                                                        <span class="dash__w-text">{{ $data_transaksi->n_batal_transaksi }}</span>

                                                        <span class="dash__w-name">Transaksi Dibatalkan</span></div>
                                                </li>
                                                <li>
                                                    <div class="dash__w-wrap">

                                                        <span class="dash__w-icon dash__w-icon-style-3"><i class="far fa-heart"></i></span>

                                                        <span class="dash__w-text">{{ $data_transaksi->n_keranjang }}</span>

                                                        <span class="dash__w-name">Keranjang</span></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--====== End - Dashboard Features ======-->
                                </div>
                                <div class="col-lg-9 col-md-12">
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
                                        <div class="dash__pad-2">
                                            <h1 class="dash__h1 u-s-m-b-14">Transaksi Saya</h1>

                                            <span class="dash__text u-s-m-b-30">Disini anda dapat melihat semua transaksi yang pernah anda lakukan.</span>
                                            <div class="m-order__list">
                                                @foreach($data_transaksi->transaksi as $t)
                                                <div class="m-order__get">
                                                    <div class="manage-o__header u-s-m-b-30">
                                                        <div class="dash-l-r">
                                                            <div>
                                                                <div class="manage-o__text-2 u-c-secondary">Order #{{ $t->uuid }}</div>
                                                                <div class="manage-o__text u-c-silver">Placed on {{ $t->created_at }}</div>
                                                            </div>
                                                            <div>
                                                                <div class="dash__link dash__link--brand">

                                                                    <a href="{{ route('user.transaction_detail',$t->uuid) }}">DETAIL</a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @foreach($t->product as $p)
                                                    <div class="manage-o__description" style="margin-bottom: 20px;">
                                                        <div class="description__container">
                                                            <div class="description__img-wrap">

                                                                <img class="u-img-fluid" src="{{ asset('storage/'.$p->file->path) }}" alt="" style="max-height: 90px;"></div>
                                                            <div class="description-title">
                                                                {{ $p->product->name }}
                                                                @foreach($p->detail as $d)
                                                                {{ $d->name.' '.$d->value }}
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="description__info-wrap">
                                                            <div>
                                                                @if($t->status == 4)
                                                                    <span class="manage-o__badge badge--shipped">Sukses</span>
                                                                @elseif($t->status <= 3)
                                                                    <span class="manage-o__badge badge--delivered">Proses</span>
                                                                @else
                                                                    <span class="manage-o__badge badge--processing">Dibatalkan</span>
                                                                @endif
                                                            </div>
                                                            <div>

                                                                <span class="manage-o__text-2 u-c-silver">Quantity:

                                                                    <span class="manage-o__text-2 u-c-secondary">{{ $p->amount }}</span></span></div>
                                                            <div>

                                                                <span class="manage-o__text-2 u-c-silver">Total:

                                                                    <span class="manage-o__text-2 u-c-secondary">{{ "Rp " . number_format($p->amount*$p->price,2,',','.') }}</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @endforeach
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