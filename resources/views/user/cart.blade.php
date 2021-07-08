@extends('layouts.landing_template')
@section('title')
Keranjang
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

                                        <a href="{{ route('user.cart')}}">Cart</a></li>
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
                                    <h1 class="section__heading u-c-secondary">Keranjang</h1>
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
                            <div class="col-lg-12 col-md-12 col-sm-12 u-s-m-b-30">
                                <div class="table-responsive">
                                    <table class="table-p">
                                        <tbody>
                                            @if(count($carts) > 0)
                                            @foreach($carts as $cart)
                                            <!--====== Row ======-->
                                            <tr>
                                                <td>
                                                    <div class="table-p__box">
                                                        <div class="table-p__img-wrap">

                                                            <img class="u-img-fluid" style="max-height: 120px;" src="{{ asset('storage/'.$cart->product_variant->file->path)}}" alt=""></div>
                                                        <div class="table-p__info">

                                                            <span class="table-p__name">

                                                                <a href="{{ route('user.product_detail',$cart->product_variant->uuid) }}">{{$cart->product_variant->product->name}}</a></span>

                                                            <span class="table-p__category">

                                                                <a href="{{route('user.category',$cart->product_variant->product->category->id)}}">{{$cart->product_variant->product->category->name}}</a></span>
                                                            <ul class="table-p__variant-list">
                                                                @foreach($cart->product_variant->detail as $d)
                                                                <li>

                                                                    <span>{{$d->name.': '.$d->value}}</span></li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>

                                                    {{-- <span class="table-p__price">{{"Rp " . number_format($cart->amount*$cart->product_variant->price,2,',','.')}}</span></td> --}}
                                                    <span class="table-p__price">{{"Rp " . number_format($cart->product_variant->price,2,',','.')}}</span></td>

                                                <td>
                                                    <div class="table-p__input-counter-wrap">

                                                        <!--====== Input Counter ======-->
                                                        <div class="input-counter">

                                                            <span class="input-counter__minus fas fa-minus"></span>

                                                            <input id="amount{{$cart->product_variant->uuid}}" class="input-counter__text input-counter--text-primary-style" type="text" value="{{$cart->amount}}" data-min="1" data-max="{{$cart->product_variant->stock}}">

                                                            <span class="input-counter__plus fas fa-plus"></span></div>
                                                        <!--====== End - Input Counter ======-->
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="table-p__del-wrap">

                                                        <a class="far fa-trash-alt table-p__delete-link" href="{{ route('user.delete_cart_product',$cart->product_variant->uuid) }}"></a></div>
                                                </td>
                                            </tr>
                                            <!--====== End - Row ======-->
                                            @endforeach
                                            @else
                                            <!--====== Row ======-->
                                            <tr>
                                                <td>
                                                    <center><span class="gl-text u-s-m-b-30">Keranjang Kosong</span></center>
                                                </td>
                                            </tr>
                                            <!--====== End - Row ======-->
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="route-box">
                                    <div class="route-box__g1">

                                        <a class="route-box__link" href="{{route('user.product')}}"><i class="fas fa-long-arrow-alt-left"></i>

                                            <span>Lanjut Belanja</span></a></div>
                                    <div class="route-box__g2">

                                        <a class="route-box__link" href="{{route('user.delete_all_cart_product')}}"><i class="fas fa-trash"></i>

                                            <span>CLEAR CART</span></a>

                                        <a class="route-box__link" id="updateCart"><i class="fas fa-sync"></i>

                                            <span>UPDATE CART</span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 2 ======-->


            <!--====== Section 3 ======-->
            <div class="u-s-p-b-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 u-s-m-b-30">
                                <div class="f-cart">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6 u-s-m-b-30">
                                            <div class="f-cart__pad-box">
                                                <div class="u-s-m-b-30">
                                                    <table class="f-cart__table">
                                                        <tbody>
                                                            @php
                                                            $total = 0;
                                                            @endphp
                                                            @foreach($carts as $cart)
                                                            <tr>
                                                                <td>
                                                                    {{$cart->product_variant->product->name}}
                                                                    (@foreach($cart->product_variant->detail as $d)
                                                                    {{$d->value.' '}}
                                                                    @endforeach) : {{$cart->amount}}
                                                                </td>
                                                                <td>{{"Rp " . number_format($cart->amount*$cart->product_variant->price,2,',','.')}}</td>
                                                            </tr>
                                                            @php
                                                            $total += ((int)$cart->amount*(int)$cart->product_variant->price);
                                                            @endphp
                                                            @endforeach
                                                            <tr>
                                                                <td>Harga TOTAL</td>
                                                                <td>{{"Rp " . number_format($total,2,',','.')}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div>

                                                    <button class="btn btn--e-brand-b-2" id="prosesCheckout"> PROSES KE PEMBAYARAN</button></div>
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
            <!--====== End - Section 3 ======-->
        </div>
        <!--====== End - App Content ======-->

@endsection
@section('js')
<script>
    $(document).ready(function(){
        $('#prosesCheckout').on('click',function(){
            window.location.href = "{{route('user.checkout')}}";
        });
        var request;
        let data = @json($carts);
        console.log(data);
        $('#updateCart').on('click',function(event){
            data.forEach((val, i) => {
                data[i].amount = $('#amount'+val.product_varian_id).val();
            });
            Swal.fire({
                title: 'Loading Data...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            // Abort any pending request
            if (request) {
                request.abort();
            }
            // setup some local variables
            var $form = $(this);

            // Let's select and cache all the fields
            var $inputs = $form.find("input,button");

            // Let's disable the inputs for the duration of the Ajax request.
            // Note: we disable elements AFTER the form data has been serialized.
            // Disabled form elements will not be serialized.
            $inputs.prop("disabled", true);
            let amount = "1";
            $.ajax({
                url: "{{ route('user.update_cart_product') }}",
                type:"POST",
                data:{
                  new_cart: data,
                  "_token": "{{ csrf_token() }}",
                },
                success:function(response){
                  if(response.success == true) {
                    Swal.fire(
                        'Sukses',
                        response.message,
                        'success'
                    ).then((result) => {
                        window.location.href = "{{ route('user.cart') }}"
                    })
                  }else{
                    Swal.fire(
                        'Gagal',
                        response.message,
                        'error'
                        )
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    Swal.fire(
                        'Gagal',
                        textStatus,
                        'error'
                        )
                    console("Status: " + textStatus);
                    console("Error: " + errorThrown); 
                },
                always:function(){
                    $inputs.prop("disabled", false);
                }
               });
        });
    });
</script>
@endsection