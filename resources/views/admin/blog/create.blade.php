@extends('admin.layouts.template')
@section('title')
Tambah Berita
@endsection
@section('css')
<!-- dropzonejs -->
<link rel="stylesheet" href="{{asset('template_assets/vendor/dropzone/min/dropzone.min.css')}}">
<link rel="stylesheet" href="{{ asset('template_assets/vendor/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('template_assets/vendor/summernote/summernote-bs4.min.css') }}">
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"
            integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw=="
            crossorigin="anonymous" /> --}}
<style>

</style>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Berita</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form @submit.prevent="storeData()" @keydown="form.onKeydown($event)">
        {{-- <form method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data"> --}}
            @csrf
            <div class="modal-body mx-4">
                <div class="form-row">
                    <label class="col-lg-2" for="title">Judul</label>
                    <div class="form-group col-md-8">
                        <input v-model="form.title" id="title" name="title" type="text" placeholder="Input Judul" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('title') }" required>
                        {{-- <div v-if="form.errors.has('detail')" v-html="form.errors.get('detail')"></div> --}}
                        @if ($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <label class="col-lg-2" for="detail">Detail</label>
                    <div class="form-group col-md-8">
                        <textarea @change = "detailTrigger" name="detail" id="detail" placeholder="Masukkan Detail Produk"
                            class="form-control" ></textarea>
                        {{-- <div v-if="form.errors.has('detail')" v-html="form.errors.get('detail')"></div> --}}
                        @if ($errors->has('detail'))
                            <span class="text-danger">{{ $errors->first('detail') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="Profil">Gambar</label>
                    <div class="form-group col-md-8">
                        <div class="input-group">
                            <input ref="file" accept="image/*" @change="imageTrigger" type="file" name="image"
                                placeholder="Tambah Gambar" class="form-control " required>
                        </div>
                        @if ($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="status">Status</label>
                    <div class="form-group col-md-8">
                        <select @change="statusTrigger" v-model="form.status" name="status" style="width: 100%"
                            id="status" class="form-control" required>
                            <option value="public">Publik</option>
                            <option value="hidden">Arsip</option>
                        </select>
                        <div v-if="form.errors.has('status')" v-html="form.errors.get('status')" ></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{route('blog.index')}}"><button type="button" class="btn btn-light">Batal</button></a>
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
    <script>
    </script>
    <script>
        var imgUrl = "{{ asset('') }}";
    let app = new Vue({
        el: '#app',
        data: {
          mainData: '',
          form: new Form({
                id: '',
                title: '',
                detail: '',
                image: '',
                status: '',
            }),
        },
        created(){
        },
        mounted(){
            $('#detail').summernote({
                height: 300,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture']],
                  ]
            });
        },
        methods: {
            async storeData(){
                Swal.fire({
                    title: 'Loading Data...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                this.form.detail = $('#detail').summernote('code')
                await this.form.post("{{ route('blog.store') }}").then(response => {
                    if(response.data.success == true){
                        Swal.fire(
                            'Sukses',
                            response.data.message,
                            'success'
                        ).then((result) => {
                            window.location.href = "{{ route('blog.index') }}"
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
            statusTrigger(){
                this.form.status = $("#status").val();
            },
            imageTrigger(e){
                const file = e.target.files[0];
                  this.preview = URL.createObjectURL(file);
                  let gambar = e.target.files;
                  if(gambar.length){
                    this.form.image = gambar[0];
                  }
            },
        },
    });
    </script>
    @endsection
