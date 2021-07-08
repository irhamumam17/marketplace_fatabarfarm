@extends('admin.layouts.template')
@section('title')
Ubah Program
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
    #preview {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #preview img {
        max-width: 100%;
        max-height: 150px;
    }
    .profile{
        align-items: center;
        max-width: 50px;
        max-heigth: 50px;
    }
</style>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Ubah Program</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form @submit.prevent="updateData()" @keydown="form.onKeydown($event)">
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
                        <textarea name="detail" id="detail" placeholder="Masukkan detail Program"
                            class="form-control" ></textarea>
                        {{-- <div v-if="form.errors.has('detail')" v-html="form.errors.get('detail')"></div> --}}
                        @if ($errors->has('detail'))
                            <span class="text-danger">{{ $errors->first('detail') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{route('program.index')}}"><button type="button" class="btn btn-light">Batal</button></a>
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
        var data = @json($data);
    let app = new Vue({
        el: '#app',
        data: {
          mainData: '',
          form: new Form({
                id: data.id,
                title: data.detail.title,
                detail: data.detail.content,
            }),
          url : window.location.origin,
        },
        created(){

        },
        mounted(){
            $('#detail').summernote({
                height: 300,
            });
            $('#detail').summernote('code',this.form.detail);
        },
        methods: {
            async updateData(){
                Swal.fire({
                    title: 'Loading Data...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                this.form.detail = $('#detail').summernote('code')
                url = "{{ route('program.update', ':id') }}".replace(':id', this.form.id)
                await this.form.submit("post",url).then(response => {
                    if(response.data.success == true){
                        Swal.fire(
                            'Sukses',
                            response.data.message,
                            'success'
                        ).then((result) => {
                            window.location.href = "{{ route('program.index') }}"
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
