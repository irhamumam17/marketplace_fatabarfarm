@extends('layouts.landing_template')
@section('title')
Detail Produk
@endsection
@section('content')
        <!--====== App Content ======-->
        <div class="app-content">

            <!--====== Section 1 ======-->
            <div class="u-s-p-t-90">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">

                            <!--====== Product Breadcrumb ======-->
                            <div class="pd-breadcrumb u-s-m-b-30">
                                <ul class="pd-breadcrumb__list">
                                    <li class="has-separator">

                                        <a href="{{route('user.home')}}">Home</a></li>
                                    <li class="">

                                        <a href="{{route('user.category',$productVariant->product->category->id)}}">{{ $productVariant->product->category->name }}</a></li>
                                </ul>
                            </div>
                            <!--====== End - Product Breadcrumb ======-->


                            <!--====== Product Detail Zoom ======-->
                            <div class="pd u-s-m-b-30">
                                <div class="slider-fouc pd-wrap">
                                    <div id="pd-o-initiate">
                                        <div class="pd-o-img-wrap" data-src="{{asset('storage/'.$productVariant->file->path)}}">

                                            <img class="u-img-fluid" src="{{asset('storage/'.$productVariant->file->path)}}" data-zoom-image="{{asset('storage/'.$productVariant->file->path)}}" alt=""></div>
                                    </div>

                                    <span class="pd-text">Click for larger zoom</span>
                                </div>
                                <div class="u-s-m-t-15">
                                    <div class="slider-fouc">
                                        <div id="pd-o-thumbnail">
                                            <div>
                                                <img class="u-img-fluid" src="{{asset('storage/'.$productVariant->file->path)}}" alt=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--====== End - Product Detail Zoom ======-->
                        </div>
                        <div class="col-lg-7">

                            <!--====== Product Right Side Details ======-->
                            <div class="pd-detail">
                                <div>

                                    <span class="pd-detail__name">
                                        {{$productVariant->product->name}}
                                        @foreach($productVariant->detail as $d)
                                        {{ $d->name.' '.$d->value }}
                                        @endforeach
                                    </span></div>
                                
                                </div>
                                <div class="u-s-m-b-15">
                                    <div class="pd-detail__inline">
                                        @if($productVariant->stock > 5)
                                        <span class="pd-detail__stock">{{$productVariant->stock}} in stock</span>
                                        @else
                                        <span class="pd-detail__left">Only 2 left</span></div>
                                        @endif
                                </div>
                                <div class="u-s-m-b-15">

                                    <span class="pd-detail__preview-desc">{{$productVariant->product->detail}}</span></div>
                                <div class="u-s-m-b-15">
                                    <form class="pd-detail__form" id="addCart">
                                        <input type="hidden" name="product_varian_id" value="{{$productVariant->uuid}}">
                                        <div class="pd-detail-inline-2">
                                            <div class="u-s-m-b-15">

                                                <!--====== Input Counter ======-->
                                                <div class="input-counter">

                                                    <span class="input-counter__minus fas fa-minus"></span>

                                                    <input name="amount" class="input-counter__text input-counter--text-primary-style" type="text" value="1" data-min="1" data-max="{{$productVariant->stock}}">

                                                    <span class="input-counter__plus fas fa-plus"></span></div>
                                                <!--====== End - Input Counter ======-->
                                            </div>
                                            <div class="u-s-m-b-15">

                                                <button class="btn btn--e-brand-b-2" type="submit">Add to Cart</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--====== End - Product Right Side Details ======-->
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
        $("#addCart").submit(function(event){

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
            let product_varian_id = $("input[name=product_varian_id]").val();
            let amount = $("input[name=amount]").val();
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