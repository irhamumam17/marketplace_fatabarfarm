@extends('admin.layouts.template')
@section('title')
Tambah Varian Produk
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
        <h3 class="card-title">Tambah Varian Produk</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {{-- <form @submit.prevent="storeData()" @keydown="form.onKeydown($event)"> --}}
        <form @submit.prevent="storeData()" @keydown="form.onKeydown($event)" id="form">
            <div class="modal-body mx-4">
                <div class="form-row">
                    <label class="col-lg-2" for="category_id">Produk</label>
                    <div class="form-group col-md-8">
                        <select v-model="form.product_id" name="product_id" style="width: 100%"
                            id="product_id" class="form-control" required>
                            @foreach ($product as $p)
                                <option value="{{ $p->uuid }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                        <div v-if="form.errors.has('product_id')" v-html="form.errors.get('product_id')" ></div>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="gambar">Varian</label>
                </div>
                <template v-for="(item,index) in form.detail">
                <div class="form-row">
                    <label class="col-lg-2" for="gambar"></label>
                    <div class="input-group mb-3 col-md-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Nama</span>
                        </div>
                        <input v-model="item.name" :id="'detail'+index+'name'" type="text"
                            class="form-control"
                            :class="{ 'is-invalid': form.errors.has('detail.'+index+'.name') }" placeholder='name' required>
                        <div v-if="form.errors.has('detail.'+index+'.name')" v-html="form.errors.get('detail.'+index+'.name')" ></div>
                    </div>
                    <div class="input-group mb-3 col-md-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Nilai</span>
                        </div>
                        <input v-model="item.value" :id="'detail'+index+'value'" type="text"
                            class="form-control"
                            :class="{ 'is-invalid': form.errors.has('detail.'+index+'.value') }" placeholder='value' required>
                        <div v-if="form.errors.has('detail.'+index+'.value')" v-html="form.errors.get('detail.'+index+'.value')" ></div>
                    </div>
                    <div class="form-group col-md-2 ml-1">
                        <button type="button" class="btn btn-success" @click="addItem()" v-if='!index'><i
                                class="fas fa-plus"></i></button>
                        <button type="button" class="btn btn-secondary" @click="removeItem(index)"
                            v-if="index"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                </template>
                <div class="form-row">
                    <label class="col-lg-2" for="Profil">Gambar</label>
                    <div class="form-group col-md-8">
                        <div class="input-group">
                            <input ref="file" accept="image/*"  type="file" name="image" @change="changeImage"
                                placeholder="Tambah Gambar" class="form-control " required>
                        </div>
                        <div v-if="form.errors.has('image')" v-html="form.errors.get('image')"></div>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="price">Harga</label>
                    <div class="form-group col-md-8">
                        <input v-model="form.price" id="price" price="price" type="number" placeholder="Input Harga" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('price') }" required>
                        <div v-if="form.errors.has('price')" v-html="form.errors.get('price')" ></div>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="stock">Stok</label>
                    <div class="form-group col-md-8">
                        <input v-model="form.stock" id="stock" stock="stock" type="number" placeholder="Input Stock" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('stock') }" required>
                        <div v-if="form.errors.has('stock')" v-html="form.errors.get('stock')" ></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{route('product.varian.index')}}"><button type="button" class="btn btn-light">Batal</button></a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    @endsection
    @section('js')
    <script src="{{ asset('template_assets/vendor/select2/js/select2.full.min.js')}}"></script>
    <script>
        var imgUrl = "{{ asset('') }}";
    let app = new Vue({
        el: '#app',
        data: {
          mainData: '',
          form: new Form({
                id: '',
                uuid: '',
                product_id: '',
                detail: [{
                    name: '',
                    value: ''
                }],
                price: '',
                stock: '',
                image: '',
            }),
            categories: '',
        },
        created(){

        },
        mounted(){

        },
        methods: {
            addItem() {
                this.form.detail.push({
                    name: '',
                    value: '',
                });
            },
            removeItem(index) {
                this.form.detail.splice(index, 1);
            },
            storeData(){
                Swal.fire({
                    title: 'Loading Data...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                this.form.post("{{ route('product.varian.store') }}")
                    .then(response => {
                        if(response.data.success == true){
                            Swal.fire(
                                'Sukses',
                                response.data.message,
                                'success'
                            ).then((result) => {
                                window.location.href = "{{ route('product.varian.index') }}"
                            })
                        }else{
                            Swal.fire(
                                'Gagal',
                                response.data.message,
                                'error'
                            )
                        }
                    })
                    .catch(e => {
                        Swal.fire(
                            'Gagal',
                            "Operasi Gagal",
                            'error'
                        )
                        e.response.status != 422 ? console.log(e) : '';
                    })
            },
            changeImage(e){
              const file = e.target.files[0];
              this.preview = URL.createObjectURL(file);
              let gambar = e.target.files;
              if(gambar.length){
                this.form.image = gambar[0];
              }
          },
            getProduct(){
                axios.get("{{ route('product.category.getdata') }}")
                    .then(response => {
                        this.categories = response.data.data
                    })
                    .catch(error => {
                        console.log(error)
                        Swal.close()
                    })
            }
        },
    });
    </script>
    @endsection
