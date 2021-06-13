@extends('layouts.landing_template')
@section('title')
Fatabar Farm | Produk
@endsection
@section('content')
        <!--====== App Content ======-->
        <div class="app-content">

            <!--====== Section 1 ======-->
            <div class="u-s-p-y-90">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shop-p">
                                <div class="shop-p__collection">
                                    <div class="row is-grid-active">
                                        @foreach($product as $p)
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <div class="product-m">
                                                <div class="product-m__thumb">

                                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="#">

                                                        <img class="aspect__img" src="{{ asset('storage/'.$p->file->path) }}" alt=""></a>
                                                    <div class="product-m__quick-look">

                                                        <a class="fas fa-search" data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip" data-placement="top" title="Quick Look"></a></div>
                                                    <div class="product-m__add-cart">

                                                        <a class="btn--e-brand" data-modal="modal" data-modal-id="#add-to-cart">Add to Cart</a></div>
                                                </div>
                                                <div class="product-m__content">
                                                    <div class="product-m__category">

                                                        <a href="shop-side-version-2.html">{{ $p->product->category->name }}</a></div>
                                                    <div class="product-m__name">

                                                        <a href="product-detail.html">{{ $p->product->name }}</a></div>
                                                    <div class="product-m__price">{{ "Rp " . number_format($p->price,2,',','.') }}</div>
                                                    @foreach($p->detail as $d)
                                                    <span class="product-o__category">
                                                        <a href="#">{{ $d->name.': '.$d->value }}</a>
                                                    </span>
                                                    @endforeach
                                                    <div class="product-m__hover">
                                                        <div class="product-m__preview-description">

                                                            <span>{{ $p->product->detail }}</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section 1 ======-->
        </div>
        <!--====== End - App Content ======-->
@endsection