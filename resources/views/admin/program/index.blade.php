@extends('admin.layouts.template')
@section('title')
    Berita
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('template_assets/vendor/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('template_assets/vendor/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('template_assets/vendor/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <style>
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
      <h3 class="card-title">Data Program</h3>
      <div class="float-right">
        <button class="btn btn-outline-success" @click="create()">Tambah Data</button>
        <button class="btn btn-outline-secondary" @click="refreshData()">Muat Ulang Data</button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No.</th>
          <th>Judul</th>
          <th>Detail</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, index) in mainData" :key="index">
          <td>@{{ index+1 }}</td>
          <td>@{{ item.detail.title == 'null' ? '' : item.detail.title }}</td>
          <td v-html="item.detail.content"></td>
          <td>
            <a :href="url+'/program/'+item.id+'/edit'" class="text-success"
                data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i
                    class="far fa-edit"></i></a>
            <a href="javascript:void(0);" @click="deleteData(item.id)" class="text-danger"
                data-toggle="tooltip" data-placement="top" data-original-title="Hapus"><i
                    class="far fa-trash-alt"></i></a>
            {{-- <a :href="url+'/product/'+item.uuid" class="text-secondary"
                data-toggle="tooltip" data-placement="top" data-original-title="Info"><i
                    class="fas fa-info-circle"></i></a> --}}
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
          <th>No.</th>
          <th>Judul</th>
          <th>Detail</th>
          <th>Aksi</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection
@section('js')
<script src="{{asset('template_assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template_assets/vendor/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('template_assets/vendor/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('template_assets/vendor/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('template_assets/vendor/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('template_assets/vendor/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('template_assets/vendor/jszip/jszip.min.js')}}"></script>
<script src="{{asset('template_assets/vendor/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('template_assets/vendor/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('template_assets/vendor/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('template_assets/vendor/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('template_assets/vendor/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script>
    var imgUrl = "{{ asset('') }}";
    let app = new Vue({
        el: '#app',
        data: {
          mainData: '',
          url : window.location.origin,
          form : new Form({
              id: ''
          })
        },
        mounted(){
            this.refreshData()
        },
        methods: {
          settingDatatable(){
            $(function () {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": [
                        "copy", "csv", "excel", "pdf", "print", "colvis"
                    ]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });
          },
          create(){
            window.location.href = "{{ route('program.create') }}";
        },
            deleteData(id) {
                Swal.fire({
                    title: 'Apakah Anda Yakin Menghapus Program Ini?',
                    text: "Aksi Tidak Dapat Dikembalikan",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.value) {
                        Swal.fire({
                            title: 'Processing Data...',
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        url = "{{ route('program.destroy', ':id') }}".replace(':id', id)
                        this.form.delete(url)
                            .then(response => {
                                if(response.data.success == true){
                                    Swal.fire(
                                        'Berhasil',
                                        'Program Dihapus Dari Sistem.',
                                        'success'
                                    ).then((result) => {
                                        this.refreshData()
                                    });
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
                    }
                })
            },

            refreshData() {
                Swal.fire({
                    title: 'Loading Data...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                axios.get("{{ route('program.getdata') }}")
                    .then(response => {
                        $('#example1').DataTable().destroy()
                        this.mainData = response.data.data
                        this.$nextTick(function () {
                            this.settingDatatable();
                        })
                        Swal.close()
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
