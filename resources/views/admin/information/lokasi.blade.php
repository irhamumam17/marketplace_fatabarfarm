@extends('admin.layouts.template')
@section('title')
Ubah Lokasi
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
        <h3 class="card-title">Ubah Lokasi</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form @submit.prevent="storeData()" @keydown="form.onKeydown($event)">
        {{-- <form method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data"> --}}
            @csrf
            <div class="modal-body mx-4">
                <div class="form-row">
                    <label class="col-lg-2" for="longitude">Longitude</label>
                    <div class="form-group col-md-8">
                        <input v-model="form.detail.longitude" id="longitude" name="longitude" type="text" placeholder="Input Longitude" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('longitude') }" required>
                        {{-- <div v-if="form.errors.has('detail')" v-html="form.errors.get('detail')"></div> --}}
                        @if ($errors->has('detail.longitude'))
                            <span class="text-danger">{{ $errors->first('detail.longitude') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="latitude">Latitude</label>
                    <div class="form-group col-md-8">
                        <input v-model="form.detail.latitude" id="latitude" name="latitude" type="text" placeholder="Input Latitude" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('latitude') }" required>
                        {{-- <div v-if="form.errors.has('detail')" v-html="form.errors.get('detail')"></div> --}}
                        @if ($errors->has('detail.latitude'))
                            <span class="text-danger">{{ $errors->first('detail.latitude') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="kontak">Kontak</label>
                    <div class="form-group col-md-8">
                        <input v-model="form.detail.kontak" id="kontak" name="kontak" type="text" placeholder="Input kontak" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('kontak') }" required>
                        {{-- <div v-if="form.errors.has('detail')" v-html="form.errors.get('detail')"></div> --}}
                        @if ($errors->has('detail.kontak'))
                            <span class="text-danger">{{ $errors->first('detail.kontak') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="alamat">Alamat</label>
                    <div class="form-group col-md-8">
                        <textarea name="alamat" id="alamat" placeholder="Masukkan alamat"
                            class="form-control" ></textarea>
                        {{-- <div v-if="form.errors.has('alamat')" v-html="form.errors.get('alamat')"></div> --}}
                        @if ($errors->has('detail.alamat'))
                            <span class="text-danger">{{ $errors->first('detail.alamat') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="province_id">Provinsi</label>
                    <div class="form-group col-md-8">
                        <select @change="provinceTrigger" v-model="form.detail.province_id" id="province_id" name="province_id" style="width: 100%"
                            id="status" class="form-control" required>
                            @foreach($provinces as $prov)
                                <option value="{{$prov->province_id}}">{{$prov->name}}</option>
                            @endforeach
                        </select>
                        <div v-if="form.errors.has('detail.waktu_kerja.hari_selesai')" v-html="form.errors.get('detail.waktu_kerja.hari_selesai')" ></div>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="city_id">Kota/Kabupaten</label>
                    <div class="form-group col-md-8">
                        <select v-model="form.detail.city_id" name="city_id" style="width: 100%"
                            id="status" class="form-control" required>
                            <option v-for="city in cities" :value="city.city_id">@{{city.name}}</option>
                        </select>
                        <div v-if="form.errors.has('detail.waktu_kerja.hari_selesai')" v-html="form.errors.get('detail.waktu_kerja.hari_selesai')" ></div>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="waktu_kerja">Waktu Kerja</label>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="hari_mulai">Mulai Hari</label>
                    <div class="form-group col-md-8">
                        <select v-model="form.detail.waktu_kerja.hari_mulai" name="hari_mulai" style="width: 100%"
                            id="status" class="form-control" required>
                            <option value="senin">Senin</option>
                            <option value="selasa">Selasa</option>
                            <option value="rabu">Rabu</option>
                            <option value="kamis">Kamis</option>
                            <option value="jumat">Jumat</option>
                            <option value="sabtu">Sabtu</option>
                            <option value="ahad">Ahad</option>
                        </select>
                        <div v-if="form.errors.has('detail.waktu_kerja.hari_mulai')" v-html="form.errors.get('detail.waktu_kerja.hari_mulai')" ></div>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="hari_selesai">Selesai Hari</label>
                    <div class="form-group col-md-8">
                        <select v-model="form.detail.waktu_kerja.hari_selesai" name="hari_selesai" style="width: 100%"
                            id="status" class="form-control" required>
                            <option value="senin">Senin</option>
                            <option value="selasa">Selasa</option>
                            <option value="rabu">Rabu</option>
                            <option value="kamis">Kamis</option>
                            <option value="jumat">Jumat</option>
                            <option value="sabtu">Sabtu</option>
                            <option value="ahad">Ahad</option>
                        </select>
                        <div v-if="form.errors.has('detail.waktu_kerja.hari_selesai')" v-html="form.errors.get('detail.waktu_kerja.hari_selesai')" ></div>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="waktu_mulai">Waktu Mulai</label>
                    <div class="form-group col-md-8">
                        <input v-model="form.detail.waktu_kerja.waktu_mulai" id="waktu_mulai" name="waktu_mulai" type="time" placeholder="Input waktu_mulai" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('waktu_mulai') }" required>
                        {{-- <div v-if="form.errors.has('detail')" v-html="form.errors.get('detail')"></div> --}}
                        @if ($errors->has('detail.waktu_kerja.waktu_mulai'))
                            <span class="text-danger">{{ $errors->first('detail.waktu_kerja.waktu_mulai') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-lg-2" for="waktu_selesai">Waktu Selesai</label>
                    <div class="form-group col-md-8">
                        <input v-model="form.detail.waktu_kerja.waktu_selesai" id="waktu_selesai" name="waktu_selesai" type="time" placeholder="Input Waktu Selesai" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('waktu_selesai') }" required>
                        {{-- <div v-if="form.errors.has('detail')" v-html="form.errors.get('detail')"></div> --}}
                        @if ($errors->has('detail.waktu_kerja.waktu_selesai'))
                            <span class="text-danger">{{ $errors->first('detail.waktu_kerja.waktu_selesai') }}</span>
                        @endif
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
        var imgUrl = "{{ asset('') }}";
        var data = @json($lokasi);
        var $cities = @json($cities);
    let app = new Vue({
        el: '#app',
        data: {
          mainData: '',
          cities: data == null ? [] : $cities,
          form: new Form({
                id: '',
                type: 'lokasi',
                detail: {
                	longitude: data == null ? '' : data.detail.longitude,
                	latitude: data == null ? '' : data.detail.latitude,
                	alamat: data == null ? '' : data.detail.alamat,
                    province_id: data == null ? '' : data.detail.province_id,
                    city_id: data == null ? '' : data.detail.city_id,
                	waktu_kerja: {
                		hari_mulai: data == null ? '' : data.detail.waktu_kerja.hari_mulai,
                		hari_selesai: data == null ? '' : data.detail.waktu_kerja.hari_selesai,
                		waktu_mulai: data == null ? '' : data.detail.waktu_kerja.waktu_mulai,
                		waktu_selesai: data == null ? '' : data.detail.waktu_kerja.waktu_selesai,
                	},
                	kontak: data == null ? '' : data.detail.kontak
                },
            }),
        },
        created(){
        },
        mounted(){
            $('#alamat').summernote({
                height: 300,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                  ]
            });
            $('#alamat').summernote('code',this.form.detail.alamat);
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
                this.form.detail.alamat = $('#alamat').summernote('code')
                await this.form.post("{{ route('store_information.store') }}").then(response => {
                    if(response.data.success == true){
                        Swal.fire(
                            'Sukses',
                            response.data.message,
                            'success'
                        ).then((result) => {
                            window.location.href = "{{ route('info.lokasi') }}"
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
            provinceTrigger(){
                Swal.fire({
                    title: 'Loading Data...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                let url = window.location.origin;
                let province_id = $('#province_id').val();
                axios.get(url+"/cart/"+province_id+"/getcity")
                    .then(response => {
                        this.cities = response.data.data
                        Swal.close()
                    })
                    .catch(error => {
                        console.log(error)
                        Swal.close()
                    })
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
