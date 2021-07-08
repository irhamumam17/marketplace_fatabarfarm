@extends('layouts.landing_template')
@section('title')
Checkout
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

                                        <a href="#">Checkout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section 1 ======-->
            <!--====== Section 3 ======-->
            <div class="u-s-p-b-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="checkout-f">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h1 class="checkout-f__h1">INFORMASI PENGIRIMAN</h1>
                                    <div class="checkout-f__delivery" id="formCheckout">
                                        <div class="u-s-m-b-30">
                                            <!--====== First Name, Last Name ======-->
                                            <div class="gl-inline">
                                                <div class="u-s-m-b-15">

                                                    <label class="gl-label" for="name">NAMA *</label>

                                                    <input class="input-text input-text--primary-style" type="text" name="name" id="name" data-bill="" value="{{Auth::user()->name}}" required></div>
                                            </div>
                                            <!--====== End - First Name, Last Name ======-->


                                            <!--====== E-MAIL ======-->
                                            <div class="u-s-m-b-15">

                                                <label class="gl-label" for="email">E-MAIL *</label>

                                                <input class="input-text input-text--primary-style" type="text" name="email" id="email" data-bill="" value="{{Auth::user()->email}}" required></div>
                                            <!--====== End - E-MAIL ======-->


                                            <!--====== PHONE ======-->
                                            <div class="u-s-m-b-15">

                                                <label class="gl-label" for="nohp">NO. HP *</label>

                                                <input class="input-text input-text--primary-style" name="nohp" type="text" id="nohp" data-bill="" required></div>
                                            <!--====== End - PHONE ======-->


                                            <!--====== Street Address ======-->
                                            <div class="u-s-m-b-15">

                                                <label class="gl-label" for="alamat">Alamat *</label>

                                                <input class="input-text input-text--primary-style" type="text" name="alamat" id="alamat" placeholder="House name and street name" data-bill="" required></div>
                                            <!--====== End - Street Address ======-->


                                            <!--====== Country ======-->
                                            <div class="u-s-m-b-15">

                                                <!--====== Select Box ======-->

                                                <label class="gl-label" for="province_id">Provinsi *</label><select class="select-box select-box--primary-style" name="province_id" id="province_id" data-bill="" required>
                                                    <option selected value="">Pilih Provinsi</option>
                                                    @foreach($provinces as $prov)
                                                    <option value="{{$prov->province_id}}">{{$prov->name}}</option>
                                                    @endforeach
                                                </select>
                                                <!--====== End - Select Box ======-->
                                            </div>
                                            <!--====== End - Country ======-->


                                            <!--====== Town / City ======-->
                                            <div class="u-s-m-b-15">

                                                <!--====== Select Box ======-->

                                                <label class="gl-label" for="city_id">Kota/Kabupaten *</label><select class="select-box select-box--primary-style" id="city_id" name="city_id" data-bill="" required>
                                                    <option selected value="">Pilih Kota/Kabupaten</option>
                                                </select>
                                                <!--====== End - Select Box ======-->
                                            </div>
                                            <!--====== End - Town / City ======-->

                                            <!--====== ZIP/POSTAL ======-->
                                            <div class="u-s-m-b-15">

                                                <label class="gl-label" for="kodepos">Kode POS *</label>

                                                <input class="input-text input-text--primary-style" type="text" name="kodepos" id="kodepos" placeholder="Kode Pos" data-bill="" required></div>
                                            <!--====== End - ZIP/POSTAL ======-->
                                            <div class="u-s-m-b-10">

                                                <label class="gl-label" for="note">Catatan</label><textarea class="text-area text-area--primary-style" id="note" name="note"></textarea></div>
                                            <div>

                                                {{-- <button class="btn btn--e-transparent-brand-b-2" type="submit">SIMPAN</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h1 class="checkout-f__h1">RINGKASAN TRANSAKSI</h1>

                                    <!--====== Order Summary ======-->
                                    <div class="o-summary">
                                        <div class="o-summary__section u-s-m-b-30">
                                            <div class="o-summary__item-wrap gl-scroll">
                                                @php
                                                $total = 0;
                                                @endphp
                                                @foreach($carts as $cart)
                                                <div class="o-card">
                                                    <div class="o-card__flex">
                                                        <div class="o-card__img-wrap">

                                                            <img class="u-img-fluid" src="{{ asset('storage/'.$cart->product_variant->file->path)}}" alt=""></div>
                                                        <div class="o-card__info-wrap">

                                                            <span class="o-card__name">

                                                                <a href="{{ route('user.product_detail',$cart->product_variant->uuid) }}">
                                                                    {{$cart->product_variant->product->name}}
                                                                    (@foreach($cart->product_variant->detail as $d)
                                                                        {{$d->value.' '}}
                                                                    @endforeach)
                                                                </a>
                                                            </span>

                                                            <span class="o-card__quantity">Quantity x {{$cart->amount}}</span>

                                                            <span class="o-card__price">{{"Rp " . number_format($cart->product_variant->price,2,',','.')}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                $total+=((int)$cart->product_variant->price*(int)$cart->amount);
                                                @endphp
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="o-summary__section u-s-m-b-30">
                                            <div class="o-summary__box">
                                                <table class="o-summary__table">
                                                    <tbody>
                                                        <tr>
                                                            <td>TOTAL HARGA PRODUK</td>
                                                            <td>{{"Rp " . number_format($total,2,',','.')}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>ONGKIR</td>
                                                            <td>Menunggu Konfirmasi Admin</td>
                                                        </tr>
                                                        <tr>
                                                            <td>HARGA TOTAL</td>
                                                            <td>{{"Rp " . number_format($total,2,',','.')}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="o-summary__section u-s-m-b-30">
                                            <div class="o-summary__box">
                                                <h1 class="checkout-f__h1">INFORMASI PEMBAYARAN</h1>
                                                <div class="checkout-f__payment">
                                                    @foreach($banks as $bank)
                                                    <div class="u-s-m-b-10">

                                                        <!--====== Radio Box ======-->
                                                        <div class="radio-box">

                                                            <input type="radio" id="{{$bank->uuid}}" name="bank_id" value="{{$bank->uuid}}">
                                                            <div class="radio-box__state radio-box__state--primary">

                                                                <label class="radio-box__label" for="cash-on-delivery">{{$bank->name}}</label></div>
                                                        </div>
                                                        <!--====== End - Radio Box ======-->

                                                        <span class="gl-text u-s-m-t-6">{{$bank->account_number}}</span>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="o-summary__section u-s-m-b-30">
                                            <div class="o-summary__box">
                                                <h1 class="checkout-f__h1">INFORMASI PENGIRIMAN</h1>
                                                <div class="checkout-f__payment">
                                                    <div class="u-s-m-b-10">

                                                        <!--====== Radio Box ======-->
                                                        <div class="radio-box">

                                                            <input type="radio" id="jne" name="kurir" value="jne">
                                                            <div class="radio-box__state radio-box__state--primary">

                                                                <label class="radio-box__label" for="cash-on-delivery">JNE</label></div>
                                                        </div>
                                                        <!--====== End - Radio Box ======-->
                                                    </div>
                                                    <div class="u-s-m-b-10">

                                                        <!--====== Radio Box ======-->
                                                        <div class="radio-box">

                                                            <input type="radio" id="tiki" name="kurir" value="tiki">
                                                            <div class="radio-box__state radio-box__state--primary">

                                                                <label class="radio-box__label" for="cash-on-delivery">TIKI</label></div>
                                                        </div>
                                                        <!--====== End - Radio Box ======-->
                                                    </div>
                                                    <div class="u-s-m-b-10">

                                                        <!--====== Radio Box ======-->
                                                        <div class="radio-box">

                                                            <input type="radio" id="pos" name="kurir" value="pos">
                                                            <div class="radio-box__state radio-box__state--primary">

                                                                <label class="radio-box__label" for="cash-on-delivery">POS</label></div>
                                                        </div>
                                                        <!--====== End - Radio Box ======-->
                                                    </div>
                                                    <div>

                                                        <button class="btn btn--e-brand-b-2" id="btnSubmit">SIMPAN</button></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--====== End - Order Summary ======-->
                                </div>
                            </div>
                        </div>
                        {{-- </div> --}}
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
        $("select#province_id").on('change',function(e){
            console.log(e);
            $('#city_id')
                .find('option')
                .remove()
                .end()
                .append('<option selected value="">Pilih Kota/Kabupaten</option>');
            let province_id = this.value;
            let url = window.location.origin;
            $.ajax({
                url: url+"/cart/"+province_id+"/getcity",
                type:"GET",
                success:function(response){
                  if(response.success == true) {
                    $.each(response.data,function(key, value)
                    {
                        $("#city_id").append('<option value=' + value.city_id + '>' + value.name + '</option>');
                    });
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
               });
        });
        $("#btnSubmit").on('click', function(){
            var $form = $("form#formCheckout");
            var $inputs = $form.find("input,button");
            var data = $inputs.serialize();
            var name = $('input[name=name]').val();
            var email = $('input[name=email]').val();
            var nohp = $('input[name=nohp]').val();
            var alamat = $('input[name=alamat]').val();
            var province_id = $('select[name=province_id]').val();
            var city_id = $('select[name=city_id]').val();
            var kodepos = $('input[name=kodepos]').val();
            var note = $('textarea[name=note]').val();
            var bank_id = $('input[name=bank_id]:checked').val();
            var kurir = $('input[name=kurir]:checked').val();
            $.ajax({
                url: "{{ route('user.checkout_submit') }}",
                type:"POST",
                data:{
                  name: name,
                  email: email,
                  nohp: nohp,
                  alamat: alamat,
                  province_id: province_id,
                  city_id: city_id,
                  kodepos: kodepos,
                  note: note,
                  bank_id: bank_id,
                  kurir: kurir,
                  "_token": "{{ csrf_token() }}",
                },
                success:function(response){
                  if(response.success == true) {
                    Swal.fire(
                        'Sukses',
                        response.message,
                        'success'
                    )
                    .then((result) => {
                        window.location.href = "{{ route('user.transaction') }}"
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