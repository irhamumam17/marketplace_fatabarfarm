@extends('layouts.landing_template')
@section('title')
Produk
@endsection
@section('content')
        <!--====== App Content ======-->
        <div class="app-content">

            <!--====== Section 1 ======-->
            <div class="u-s-p-y-90">
                <div class="container">
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-lg-12">
                            <!--====== Search Form ======-->
                            <form class="main-form" method="post" action="{{ route('user.category.cari', $category) }}">
                                @csrf
                                <label for="main-search"></label>

                                <input class="input-text input-text--border-radius input-text--style-1" type="text" id="main-search" name="key" placeholder="Cari" value="{{ $key ?? '' }}">

                                <button class="btn btn--icon fas fa-search main-search-button" type="submit"></button>
                            </form>
                            <!--====== End - Search Form ======-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shop-p">
                                <div class="shop-p__collection">
                                    <div class="row is-grid-active">
                                        @if(count($product) > 0)
                                            @foreach($product as $p)
                                            <div class="col-lg-3 col-md-4 col-sm-6">
                                                <div class="product-m">
                                                    <div class="product-m__thumb">

                                                        <a class="aspect aspect--bg-grey aspect--square u-d-block" href="{{ route('user.product_detail',$p->uuid) }}">

                                                            <img class="aspect__img" src="{{ asset('storage/'.$p->file->path) }}" alt=""></a>
                                                        <div class="product-m__quick-look">

                                                            <a class="fas fa-search" data-modal="modal" data-modal-id="#quick-look" data-tooltip="tooltip" data-placement="top" title="Quick Look"></a></div>
                                                        <div class="product-m__add-cart">

                                                            <a class="btn--e-brand" data-modal="modal" name="addCart" data-id="{{ $p->uuid }}" data-modal-id="#add-to-cart">Add to Cart</a></div>
                                                    </div>
                                                    <div class="product-m__content">
                                                        <div class="product-m__category">

                                                            <a href="{{route('user.category',$p->product->category->id)}}">{{ $p->product->category->name }}</a></div>
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
                                        @else
                                            <div class="col-lg-3 col-md-4 col-sm-6">
                                                Data Tidak Ditemukan
                                            </div>
                                        @endif
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
@section('js')
<script>
    $(document).ready(function(){
            // Variable to hold request
            var request;
            // Bind to the submit event of our form
            $("a[name=addCart").on('click',function(event){
                let id = $(this).data('id');

                // Prevent default posting of form - put here to work in case of errors
                event.preventDefault();
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
                let product_varian_id = id;
                let amount = "1";
                $.ajax({
                    url: "{{ route('user.add_cart_product') }}",
                    type:"POST",
                    data:{
                      product_varian_id:product_varian_id,
                      amount:amount,
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