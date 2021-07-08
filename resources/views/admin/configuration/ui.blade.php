@extends('admin.layouts.template')
@section('title')
Pengaturan UI
@endsection
@section('css')
<!-- dropzonejs -->
<link rel="stylesheet" href="{{ asset('template_assets/vendor/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('template_assets/vendor/summernote/summernote-bs4.min.css') }}">
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"
            integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw=="
            crossorigin="anonymous" /> --}}
<style>
#preview {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #preview img {
        max-width: 100%;
        max-height: 150px;
    }
</style>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Pengaturan UI</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form @submit.prevent="storeData()" @keydown="form.onKeydown($event)">
            @csrf
            <div class="modal-body mx-4">
                <div class="form-row">
                    <label class="col-lg-2" for="app_name">Nama Aplikasi</label>
                    <div class="form-group col-md-8">
                        <input v-model="form.app_name" id="app_name" name="app_name" type="text" placeholder="Input Nama Aplikasi" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('app_name') }" required>
                        {{-- <div v-if="form.errors.has('detail')" v-html="form.errors.get('detail')"></div> --}}
                        @if ($errors->has('app_name'))
                            <span class="text-danger">{{ $errors->first('app_name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="logo">Logo</label>
                    <div class="form-group col-md-8">
                        <div class="input-group">
                            <input accept="image/*" type="file" name="logo" @change="imageTrigger"
                                placeholder="Tambah Logo" class="form-control ">
                        </div>
                        <div v-if="form.errors.has('logo')" v-html="form.errors.get('logo')"></div>
                    </div>
                </div>
                <div class="form-row" v-if="preview!=''">
                    <label class="col-lg-2" for="preview"></label>
                    <div class="col-lg-8">
                        <img class="profile" :src="preview" alt="" style="margin-bottom: 10px;" height='80px'>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
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
        var data  = @json($data_ui);
    let app = new Vue({
        el: '#app',
        data: {
          mainData: '',
          form: new Form({
                id: '',
                name: data == null ? 'ui' : data.name,
                logo: data.content == null ? '' : data.content.logo.uuid,
                app_name: data.content == null ? '' : data.content.app_name,
            }),
          preview: data == null ? '' : imgUrl+'/storage/'+data.content.logo.path,
        },
        mounted(){
            
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
                await this.form.post("{{ route('configuration.store') }}").then(response => {
                    if(response.data.success == true){
                        Swal.fire(
                            'Sukses',
                            response.data.message,
                            'success'
                        ).then((result) => {
                            window.location.href = "{{ route('config.ui') }}"
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
            imageTrigger(e){
                const file = e.target.files[0];
                  this.preview = URL.createObjectURL(file);
                  let gambar = e.target.files;
                  if(gambar.length){
                    this.form.logo = gambar[0];
                  }
            },
        },
    });
    </script>
    @endsection
