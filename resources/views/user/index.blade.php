@extends('layouts.landing_template')
@section('title')
Fatabar Farm - Quality On Healthy
@endsection
@section('content')
<!--====== Primary Slider ======-->
<div class="s-skeleton s-skeleton--h-600 s-skeleton--bg-grey">
    <div class="owl-carousel primary-style-1" id="hero-slider">
        <div class="hero-slide" style="background-image: url('{{ asset('landing_assets/images/dokumentasi/slider1.png') }}');">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="slider-content slider-content--animation">

                            {{-- <span class="content-span-1 u-c-secondary">Latest Update Stock</span>

                            <span class="content-span-2 u-c-secondary">30% Off On Electronics</span>

                            <span class="content-span-3 u-c-secondary">Find electronics on best prices, Also Discover most selling products of electronics</span>

                            <span class="content-span-4 u-c-secondary">Starting At

                                <span class="u-c-brand">$1050.00</span></span>

                            <a class="shop-now-link btn--e-brand" href="shop-side-version-2.html">SHOP NOW</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-slide" style="background-image: url('{{ asset('landing_assets/images/dokumentasi/slider2.png') }}');">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="slider-content slider-content--animation">

                            {{-- <span class="content-span-1 u-c-secondary">Latest Update Stock</span>

                            <span class="content-span-2 u-c-secondary">30% Off On Electronics</span>

                            <span class="content-span-3 u-c-secondary">Find electronics on best prices, Also Discover most selling products of electronics</span>

                            <span class="content-span-4 u-c-secondary">Starting At

                                <span class="u-c-brand">$1050.00</span></span>

                            <a class="shop-now-link btn--e-brand" href="shop-side-version-2.html">SHOP NOW</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--====== End - Primary Slider ======-->

<!--====== Section 2 ======-->
<div class="u-s-p-b-60" style="margin-top: 20px;">

    <!--====== Section Intro ======-->
    <div class="section__intro u-s-m-b-16">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section__text-wrap">
                        <h1 class="section__heading u-c-secondary u-s-m-b-12">PRODUK</h1>

                        <span class="section__span u-c-silver">PILIH KATEGORI</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section Intro ======-->


    <!--====== Section Content ======-->
    <div class="section__content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="filter-category-container">
                        <div class="filter__category-wrapper">

                            <button class="btn filter__btn filter__btn--style-1 js-checked" type="button" data-filter="*">ALL</button></div>
                        @foreach($productCategory as $c)
                        <div class="filter__category-wrapper">
                            <button class="btn filter__btn filter__btn--style-1" type="button" data-filter=".category{{$c->id}}">{{ $c->name }}</button></div>
                        @endforeach
                    </div>
                    <div class="filter__grid-wrapper u-s-m-t-30">
                        <div class="row">
                            @foreach($product as $p)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30 filter__item {{ 'category'.$p->product->category->id }}">
                                <div class="product-o product-o--hover-on product-o--radius">
                                    <div class="product-o__wrap">

                                        <a class="aspect aspect--bg-grey aspect--square u-d-block" href="#">

                                            <img class="aspect__img" src="{{ asset('storage/'.$p->file->path) }}" alt=""></a>
                                        <div class="product-o__action-wrap">
                                            <ul class="product-o__action-list">
                                                <li>

                                                    <a data-modal="modal" data-modal-id="#add-to-cart" data-tooltip="tooltip" data-placement="top" title="Add to Cart"><i class="fas fa-plus-circle"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <span class="product-o__category">

                                        <a href="#">{{ $p->product->category->name }}</a>
                                    </span>
                                    <span class="product-o__name">
                                        <a href="#">{{ $p->product->name }}</a>
                                    </span>
                                        @foreach($p->detail as $d)
                                        <span class="product-o__category">
                                            <a href="#">{{ $d->name.': '.$d->value }}</a>
                                        </span>
                                        @endforeach
                                    <span class="product-o__price">{{ "Rp " . number_format($p->price,2,',','.') }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="load-more">

                        <button class="btn btn--e-brand" type="button" onclick="location.href = '{{ route('user.product') }}'">Cari Selengkapnya</button></div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section Content ======-->
</div>
<!--====== End - Section 2 ======-->

<!--====== Section 9 ======-->
{{-- <div class="u-s-p-b-60">

    <!--====== Section Content ======-->
    <div class="section__content">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 u-s-m-b-30">
                    <div class="service u-h-100">
                        <div class="service__icon"><i class="fas fa-truck"></i></div>
                        <div class="service__info-wrap">

                            <span class="service__info-text-1">Free Shipping</span>

                            <span class="service__info-text-2">Free shipping on all US order or order above $200</span></div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 u-s-m-b-30">
                    <div class="service u-h-100">
                        <div class="service__icon"><i class="fas fa-redo"></i></div>
                        <div class="service__info-wrap">

                            <span class="service__info-text-1">Shop with Confidence</span>

                            <span class="service__info-text-2">Our Protection covers your purchase from click to delivery</span></div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 u-s-m-b-30">
                    <div class="service u-h-100">
                        <div class="service__icon"><i class="fas fa-headphones-alt"></i></div>
                        <div class="service__info-wrap">

                            <span class="service__info-text-1">24/7 Help Center</span>

                            <span class="service__info-text-2">Round-the-clock assistance for a smooth shopping experience</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section Content ======-->
</div> --}}
<!--====== End - Section 9 ======-->


<!--====== Section 10 ======-->
<div class="u-s-p-b-60">

    <!--====== Section Intro ======-->
    <div class="section__intro u-s-m-b-46">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section__text-wrap">
                        <h1 class="section__heading u-c-secondary u-s-m-b-12">BLOG TERBARU</h1>

                        <span class="section__span u-c-silver">AWALI HARIMU DENGAN MEMBACA ULASAN KAMI</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section Intro ======-->


    <!--====== Section Content ======-->
    <div class="section__content">
        <div class="container">
            <div class="row">
                @foreach($posts as $post)
                <div class="col-lg-4 col-md-6 u-s-m-b-30">
                    <div class="bp-mini bp-mini--img u-h-100">
                        <div class="bp-mini__thumbnail">

                            <!--====== Image Code ======-->

                            <a class="aspect aspect--bg-grey aspect--1366-768 u-d-block" href="blog-detail.html">

                                <img class="aspect__img" src="{{ asset('landing_assets/images/blog/post-2.jpg') }}" alt=""></a>
                            <!--====== End - Image Code ======-->
                        </div>
                        <div class="bp-mini__content">
                            <div class="bp-mini__stat">

                                <span class="bp-mini__stat-wrap">

                                    <span class="bp-mini__publish-date">

                                        <a>

                                            <span>$post->created_at</span>
                                        </a>
                                    </span>
                                </span>

                            </div>
                            <span class="bp-mini__h1">

                                <a href="blog-detail.html">$post->titlw</a></span>
                            {{-- <p class="bp-mini__p">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> --}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--====== End - Section Content ======-->
</div>
<!--====== End - Section 10 ======-->
@endsection