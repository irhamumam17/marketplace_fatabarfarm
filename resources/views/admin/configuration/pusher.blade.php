@extends('admin.layouts.template')
@section('title')
Pengaturan Pusher
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
        <h3 class="card-title">Pengaturan Pusher</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form @submit.prevent="storeData()" @keydown="form.onKeydown($event)">
        {{-- <form method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data"> --}}
            @csrf
            <div class="modal-body mx-4">
                <div class="form-row">
                    <label class="col-lg-2" for="driver">Driver</label>
                    <div class="form-group col-md-8">
                        <input v-model="form.content.driver" id="driver" name="driver" type="text" placeholder="Input Driver" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('content.driver') }" required>
                        <div v-if="form.errors.has('content.driver')" v-html="form.errors.get('content.driver')"></div>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="app_id">APP ID</label>
                    <div class="form-group col-md-8">
                        <input v-model="form.content.app_id" id="app_id" name="app_id" type="text" placeholder="Input APP ID" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('content.app_id') }" required>
                        <div v-if="form.errors.has('content.app_id')" v-html="form.errors.get('content.app_id')"></div>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="app_key">APP Key</label>
                    <div class="form-group col-md-8">
                        <input v-model="form.content.app_key" id="app_key" name="app_key" type="text" placeholder="Input APP Key" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('content.app_key') }" required>
                        <div v-if="form.errors.has('content.app_key')" v-html="form.errors.get('content.app_key')"></div>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="port">App Secret</label>
                    <div class="form-group col-md-8">
                        <input v-model="form.content.app_secret" id="app_secret" name="app_secret" type="text" placeholder="Input App Secret" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('content.app_secret') }" required>
                        <div v-if="form.errors.has('content.app_secret')" v-html="form.errors.get('content.app_secret')"></div>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="app_cluster">APP Cluster</label>
                    <div class="form-group col-md-8">
                        <input v-model="form.content.app_cluster" id="app_cluster" name="app_cluster" type="text" placeholder="Input APP Cluster" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('content.app_cluster') }" required>
                        <div v-if="form.errors.has('content.app_cluster')" v-html="form.errors.get('content.app_cluster')"></div>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="encryption">Use TLS</label>
                    <div class="form-group col-md-8">
                        <div class="form-group">
	                        <div class="form-check">
	                          <input class="form-check-input" type="radio" name="useTLS" value="true" v-model="form.content.useTLS">
	                          <label class="form-check-label">True</label>
	                        </div>
	                        <div class="form-check">
	                          <input class="form-check-input" type="radio" name="useTLS" value="false" v-model="form.content.useTLS">
	                          <label class="form-check-label">False</label>
	                        </div>
                      </div>
                        <div v-if="form.errors.has('content.useTLS')" v-html="form.errors.get('content.useTLS')"></div>
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
        var data  = @json($data_p);
    let app = new Vue({
        el: '#app',
        data: {
          mainData: '',
          form: new Form({
                id: '',
                name: data == null ? 'pusher' : data.name,
                content: {
	                driver: data == null ? '' : data.content.driver,
	                app_id: data == null ? '' : data.content.app_id,
	                app_key: data == null ? '' : data.content.app_key,
	                app_secret: data == null ? '' : data.content.app_secret,
	                app_cluster: data == null ? '' : data.content.app_cluster,
	                useTLS: data == null ? '' : data.content.useTLS
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
                            window.location.href = "{{ route('config.pusher') }}"
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
