@extends('admin.layouts.template')
@section('title')
Pengaturan SMTP
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
        <h3 class="card-title">Pengaturan SMTP</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form @submit.prevent="storeData()" @keydown="form.content.onKeydown($event)">
        {{-- <form method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data"> --}}
            @csrf
            <div class="modal-body mx-4">
                <div class="form-row">
                    <label class="col-lg-2" for="email">Email Pengirim</label>
                    <div class="form-group col-md-8">
                        <input v-model="form.content.email" id="email" name="email" type="text" placeholder="Input Email Pengirim" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('content.email') }" required>
                        <div v-if="form.errors.has('content.email')" v-html="form.errors.get('content.email')"></div>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="sender_name">Nama Pengirim</label>
                    <div class="form-group col-md-8">
                        <input v-model="form.content.sender_name" id="sender_name" name="sender_name" type="text" placeholder="Input Nama Aplikasi" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('content.sender_name') }" required>
                        <div v-if="form.errors.has('content.sender_name')" v-html="form.errors.get('content.sender_name')"></div>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="host">Host</label>
                    <div class="form-group col-md-8">
                        <input v-model="form.content.host" id="host" name="host" type="text" placeholder="Input Host" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('content.host') }" required>
                        <div v-if="form.errors.has('content.host')" v-html="form.errors.get('content.host')"></div>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="port">Port</label>
                    <div class="form-group col-md-8">
                        <input v-model="form.content.port" id="port" name="port" type="number" placeholder="Input Port" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('content.port') }" required>
                        <div v-if="form.errors.has('content.port')" v-html="form.errors.get('content.port')"></div>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="username">Username</label>
                    <div class="form-group col-md-8">
                        <input v-model="form.content.username" id="username" name="username" type="text" placeholder="Input Username" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('content.username') }" required>
                        <div v-if="form.errors.has('content.username')" v-html="form.errors.get('content.username')"></div>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="password">Password</label>
                    <div class="form-group col-md-8">
                        <input v-model="form.content.password" id="password" name="password" type="text" placeholder="Input Password" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('content.password') }" required>
                        <div v-if="form.errors.has('content.password')" v-html="form.errors.get('content.password')"></div>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="password_confirmation">Konfirmasi Password</label>
                    <div class="form-group col-md-8">
                        <input v-model="form.content.password_confirmation" id="password_confirmation" name="password_confirmation" type="text" placeholder="Konfirmasi Password" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('content.password_confirmation') }" required>
                        <div v-if="form.errors.has('content.password_confirmation')" v-html="form.errors.get('content.password_confirmation')"></div>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="encryption">Enkripsi</label>
                    <div class="form-group col-md-8">
                        <div class="form-group">
	                        <div class="form-check">
	                          <input class="form-check-input" type="radio" name="encryption" value="tls" v-model="form.content.encryption">
	                          <label class="form-check-label">TLS</label>
	                        </div>
	                        <div class="form-check">
	                          <input class="form-check-input" type="radio" name="encryption" value="ssl" v-model="form.content.encryption">
	                          <label class="form-check-label">SSL</label>
	                        </div>
                      </div>
                        <div v-if="form.errors.has('content.encryption')" v-html="form.errors.get('content.encryption')"></div>
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
        var data  = @json($data_s);
    let app = new Vue({
        el: '#app',
        data: {
          mainData: '',
          form: new Form({
                id: '',
                name: data == null ? 'smtp' : data.name,
                content: {
	                email: data == null ? '' : data.content.email,
	                sender_name: data == null ? '' : data.content.sender_name,
	                host: data == null ? '' : data.content.host,
	                port: data == null ? '' : data.content.port,
	                username: data == null ? '' : data.content.username,
	                password: '',
	                password_confirmation: '',
	                encryption: data == null ? '' : data.content.encryption,
	            }
            }),
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
                            window.location.href = "{{ route('config.smtp') }}"
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
        },
    });
    </script>
    @endsection
