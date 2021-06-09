@extends('admin.layouts.template')
@section('title')
    Kategori Produk
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('template_assets/vendor/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('template_assets/vendor/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('template_assets/vendor/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
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
      <h3 class="card-title">Data Kategori Produk</h3>
      <div class="float-right">
        <button class="btn btn-outline-success" @click="createModal()">Tambah Data</button>
        <button class="btn btn-outline-secondary" @click="refreshData()">Muat Ulang Data</button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No.</th>
          <th>Nama</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, index) in mainData" :key="index">
          <td>@{{ index+1 }}</td>
          <td>@{{ item.name == 'null' ? '' : item.name }}</td>
          <td>
            <a href="javascript:void(0);" @click="editModal(item)" class="text-success"
                data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i
                    class="far fa-edit"></i></a>
            <a href="javascript:void(0);" @click="deleteData(item.id)" class="text-danger"
                data-toggle="tooltip" data-placement="top" data-original-title="Hapus"><i
                    class="far fa-trash-alt"></i></a>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

<!-- MODAL -->
<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="modal">
        <div class="modal-content">
            <div class="modal-header ">
                <h4 class="modal-title" v-show="!editMode" id="myLargeModalLabel">Tambah Data Kategori Produk</h4>
                <h4 class="modal-title" v-show="editMode" id="myLargeModalLabel">Edit Data Kategori Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <form @submit.prevent="editMode ? updateData() : storeData()" @keydown="form.onKeydown($event)" id="form">
                <div class="modal-body mx-4">
                    <div class="form-row">
                        <label class="col-lg-2" for="Nama">Nama Kategori</label>
                        <div class="form-group col-md-8">
                            <input v-model="form.name" id="name" type="text" min=0 placeholder="Masukkan Nama Kategori"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <div v-if="form.errors.has('name')" v-html="form.errors.get('name')" ></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    <button v-show="!editMode" type="submit" class="btn btn-primary">Simpan</button>
                    <button v-show="editMode" type="submit" class="btn btn-success">Ubah</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
          editMode: false,
          form:  new Form({
              id: '',
              name: '',
          }),
          preview: null,
          url : window.location.origin,
        },
        created() {
            // this.settingDatatable();
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
          clearForm(){
            this.form.reset();
            this.form.clear();
          },
            createModal() {
                this.clearForm();
                this.editMode = false;
                $('#modal').modal('show');
            },
            editModal(data) {
                this.clearForm();
                this.editMode = true;
                this.form.fill(data)
                $('#modal').modal('show');
            },
            storeData() {
                Swal.fire({
                    title: 'Processing Data...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                this.form.post("{{ route('product.category.store') }}")
                    .then(response => {
                        if(response.data.success == true){
                            Swal.fire(
                                'Sukses',
                                response.data.message,
                                'success'
                            ).then((result) => {
                                $('#modal').modal('hide');
                                this.refreshData()
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
            updateData() {
                Swal.fire({
                    title: 'Processing Data...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                url = "{{ route('product.category.update', ':id') }}".replace(':id', this.form.id)
                this.form.put(url)
                .then(response => {
                    if(response.data.success == true){
                        Swal.fire(
                            'Sukses',
                            response.data.message,
                            'success'
                        ).then((result) => {
                            $('#modal').modal('hide');
                            this.refreshData()
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

            deleteData(id) {
                Swal.fire({
                    title: 'Apakah Anda Yakin Menghapus Kategori Ini?',
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
                        url = "{{ route('product.category.destroy', ':id') }}".replace(':id', id)
                        this.form.delete(url)
                            .then(response => {
                                if(response.data.success == true){
                                    Swal.fire(
                                        'Berhasil',
                                        'Kategori Produk Dihapus Dari Sistem.',
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
                axios.get("{{ route('product.category.getdata') }}")
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
