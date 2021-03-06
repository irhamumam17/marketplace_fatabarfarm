@extends('admin.layouts.template')
@section('title')
Edit Produk
@endsection
@section('css')
<!-- dropzonejs -->
<link rel="stylesheet" href="{{asset('template_assets/vendor/dropzone/min/dropzone.min.css')}}">
<link rel="stylesheet" href="{{ asset('template_assets/vendor/select2/css/select2.min.css')}}">
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"
            integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw=="
            crossorigin="anonymous" /> --}}
<style>
.profile{
        align-items: center;
        max-width: 100px;
        max-heigth: 100px;
    }
</style>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Produk</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {{-- <form @submit.prevent="storeData()" @keydown="form.onKeydown($event)"> --}}
        <form method="POST" action="{{ route('product.update',$data->uuid) }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            <div class="modal-body mx-4">
                <div class="form-row">
                    <label class="col-lg-2" for="category_id">Kategori</label>
                    <div class="form-group col-md-8">
                        <select  name="category_id" style="width: 100%"
                            id="category_id" class="form-control" required>
                            @foreach ($category as $cat)
                                <option value="{{ $cat->id }}" {{ $data->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('category_id'))
                            <span class="text-danger">{{ $errors->first('category_id') }}</span>
                        @endif
                        {{-- <div v-if="form.errors.has('category_id')" v-html="form.errors.get('category_id')"></div> --}}
                    </div>
                </div>

                <div class="form-row">
                    <label class="col-lg-2" for="name">Nama</label>
                    <div class="form-group col-md-8">
                        <input id="name" name="name" type="text" placeholder="Input Nama" class="form-control" value="{{ $data->name }}"
                            :class="{ 'is-invalid': form.errors.has('name') }" required>
                        {{-- <div v-if="form.errors.has('detail')" v-html="form.errors.get('detail')"></div> --}}
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <label class="col-lg-2" for="detail">Detail</label>
                    <div class="form-group col-md-8">
                        <textarea name="detail" id="detail" type="text" placeholder="Masukkan Detail lapangan"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('detail') }"
                            required>{{ $data->detail }}</textarea>
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
    <script src="{{ asset('template_assets/vendor/select2/js/select2.full.min.js')}}"></script>
    <script>
        var imgUrl = "{{ asset('') }}";
    let app = new Vue({
        el: '#app',
        data: {
          mainData: '',
          form: new Form({
                id: '',
                name: '',
                category_id: '',
                detail: '',
            }),
            categories: '',
        },
        created(){

        },
        mounted(){
            this.getCategory();
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
            },
            categoryTrigger(){

            },
            getCategory(){
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
