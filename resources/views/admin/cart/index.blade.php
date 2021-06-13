@extends('admin.layouts.template')
@section('title')
    Keranjang
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
      <h3 class="card-title">Data Varian Produk</h3>
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
          <th>Nama Produk</th>
          <th>Varian</th>
          <th>Pengguna</th>
          <th>Jumlah</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, index) in mainData" :key="index">
          <td>@{{ index+1 }}</td>
          <td>
                @{{ item.product_varian.product.name == null ? '' : item.product_varian.product.name }}
            </td>
          <td>
              <div v-for="(item2,index2) in item.product_variant.detail">
                  @{{ item2.name+': '+item2.value }}
              </div>
          </td>
          <td>@{{ item.user.name == null ? '' : item.user.name }}</td>
          <td>@{{ item.amount == null ? '' : item.amount }}</td>
          <td>
            <a :href="url+'/product/varian/'+item.uuid+'/edit'" class="text-success"
                data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i
                    class="far fa-edit"></i></a>
            <a href="javascript:void(0);" @click="deleteData(item.uuid)" class="text-danger"
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
              <th>Nama Produk</th>
              <th>Varian</th>
              <th>Pengguna</th>
              <th>Jumlah</th>
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
                <h4 class="modal-title" v-show="!editMode" id="myLargeModalLabel">Tambah Data Keranjang</h4>
                <h4 class="modal-title" v-show="editMode" id="myLargeModalLabel">Edit Data Keranjang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <form @submit.prevent="editMode ? updateData() : storeData()" @keydown="form.onKeydown($event)" id="form">
                <div class="modal-body mx-4">
                    <div class="form-row">
                        <label class="col-lg-2" for="Nama">Produk</label>
                        <div class="form-group col-md-8">
                            <select name="sel-product" id="product_id" class="form-control custom-select"
                                {{-- :class="{ 'is-invalid': form.errors.has('tipe_user') }" --}} style="width: 100%" disabled>
                                <option v-for="item in product" value="item.uuid">@{{ item.name }}</option>
                            </select>
                            <div v-if="form.errors.has('name')" v-html="form.errors.get('name')" ></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <label class="col-lg-2" for="Email">Varian</label>
                        <div class="form-group col-md-8">
                            <input v-model="form.email" id="email" type="email" min=0 placeholder="Masukkan Email"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                            <div v-if="form.errors.has('email')" v-html="form.errors.get('email')" ></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <label class="col-lg-2" for="member">Customer</label>
                        <div class="form-group col-md-8">
                            <select name="sel-tipeuser" id="role" class="form-control custom-select"
                                {{-- :class="{ 'is-invalid': form.errors.has('tipe_user') }" --}} style="width: 100%" disabled>
                                <option value="admin" selected>Admin</option>
                            </select>
                            <input type="hidden" v-model="form.role">
                            <div v-if="form.errors.has('role')" v-html="form.errors.get('role')" ></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <label class="col-lg-2" for="Password">Jumlah Barang</label>
                        <div class="form-group col-md-8">
                            <input v-model="form.amount" id="amount" type="number" min="0" 
                                placeholder="Masukkan Jumlah Barang" class="form-control"
                                :class="{ 'is-invalid': form.errors.has('amount') }">
                            <div v-if="form.errors.has('amount')" v-html="form.errors.get('amount')" ></div>
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
            window.location.href = "{{ route('product.varian.create') }}";
        },
            deleteData(id) {
                Swal.fire({
                    title: 'Apakah Anda Yakin Menghapus Varian Produk Ini?',
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
                        url = "{{ route('product.varian.destroy', ':id') }}".replace(':id', id)
                        this.form.delete(url)
                            .then(response => {
                                if(response.data.success == true){
                                    Swal.fire(
                                        'Berhasil',
                                        'Varian Produk Dihapus Dari Sistem.',
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
                axios.get("{{ route('product.varian.getdata') }}")
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
