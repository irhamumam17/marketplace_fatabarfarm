@extends('admin.layouts.template')
@section('title')
Ubah Keranjang
@endsection
@section('css')
<!-- dropzonejs -->
<link rel="stylesheet" href="{{asset('template_assets/vendor/dropzone/min/dropzone.min.css')}}">
<link rel="stylesheet" href="{{ asset('template_assets/vendor/select2/css/select2.min.css')}}">
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"
            integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw=="
            crossorigin="anonymous" /> --}}
<style>

</style>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Ubah Keranjang</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form @submit.prevent="storeData()" @keydown="form.onKeydown($event)">
        {{-- <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data"> --}}
            @csrf
            <div class="modal-body mx-4">
                <div class="form-row">
                    <label class="col-lg-2" for="product_varian_id">Produk</label>
                    <div class="form-group col-md-8">
                        <select v-model="form.product_varian_id" name="product_varian_id" style="width: 100%"
                            id="product_varian_id" class="form-control" required>

                            <option v-for="item in product_variants" :value="item.uuid">
                                @{{ item.product.name+' - '+item.detail[0].value }}
                                {{-- <div v-for="item2 in item.detail">
                                    @{{ item2.value }}
                                </div> --}}
                            </option>
                        </select>
                        @if ($errors->has('product_varian_id'))
                            <span class="text-danger">{{ $errors->first('product_varian_id') }}</span>
                        @endif
                        {{-- <div v-if="form.errors.has('product_varian_id')" v-html="form.errors.get('product_varian_id')"></div> --}}
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="user_id">Customer</label>
                    <div class="form-group col-md-8">
                        <select v-model="form.user_id" name="user_id" style="width: 100%"
                            id="user_id" class="form-control" required>

                            <option v-for="item in users" :value="item.uuid">@{{ item.name }}</option>
                        </select>
                        @if ($errors->has('user_id'))
                            <span class="text-danger">{{ $errors->first('user_id') }}</span>
                        @endif
                        {{-- <div v-if="form.errors.has('product_varian_id')" v-html="form.errors.get('product_varian_id')"></div> --}}
                    </div>
                </div>

                <div class="form-row">
                    <label class="col-lg-2" for="amount">Jumlah</label>
                    <div class="form-group col-md-8">
                        <input v-model="form.amount" id="amount" amount="amount" type="text" placeholder="Input Jumlah" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('amount') }" required>
                        {{-- <div v-if="form.errors.has('detail')" v-html="form.errors.get('detail')"></div> --}}
                        @if ($errors->has('amount'))
                            <span class="text-danger">{{ $errors->first('amount') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <label class="col-lg-2" for="detail">Detail</label>
                    <div class="form-group col-md-8">
                        <textarea name="detail" v-model="form.detail" id="detail" type="text" placeholder="Masukkan Detail Keranjang"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('detail') }"
                            required></textarea>
                        {{-- <div v-if="form.errors.has('detail')" v-html="form.errors.get('detail')"></div> --}}
                        @if ($errors->has('detail'))
                            <span class="text-danger">{{ $errors->first('detail') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{route('product.index')}}"><button type="button" class="btn btn-light">Batal</button></a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    @endsection
    @section('js')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"
    integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA=="
    crossorigin="anonymous"></script> --}}
    <script src="{{ asset('template_assets/vendor/select2/js/select2.full.min.js')}}"></script>
    {{-- <script src="{{asset('tinymce/tinymce.min.js')}}"></script> --}}
    {{-- <script>
        tinymce.init({
                selector: "textarea",theme: "silver",width: 680,height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                    "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
            ],

            toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
            toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
            image_advtab: true ,

            external_filemanager_path:"/filemanager/",
            filemanager_title:"Responsive Filemanager" ,
            external_plugins: { "filemanager" : "/filemanager/plugin.min.js"}
            });
    </script> --}}
    <script>
        var imgUrl = "{{ asset('') }}";
    let app = new Vue({
        el: '#app',
        data: {
            data
          mainData: '',
          form: new Form({
                id: '',
                uuid: '',
                product_varian_id: '',
                user_id: '',
                amount: '',
            }),
            users: @json($users),
            product_variants: @json($product_variants),
        },
        created(){

        },
        mounted(){
            // this.refreshData();
        },
        methods: {
            storeData(){
                Swal.fire({
                    title: 'Loading Data...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                this.form.post("{{ route('cart.store') }}")
                .then((response) => {
                    if(response.data.success == true){
                        Swal.fire(
                            'Berhasil',
                            response.data.message,
                            'success'
                        ).then((result) => {
                            window.location.href = "{{ route('cart.index') }}"
                        });
                    }else{
                        Swal.fire(
                            'Gagal',
                            response.data.message,
                            'error'
                        )
                    }
                })
            },
            userTrigger(){
                this.form.user_id = $('#user_id').val()
            },
            variantTrigger(){
                this.form.product_varian_id = $('#product_varian_id').val()
            },
        },
    });
    </script>
    @endsection
