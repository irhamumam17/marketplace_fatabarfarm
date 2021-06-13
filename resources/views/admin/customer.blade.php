@extends('admin.layouts.template')
@section('title')
    Customer
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
      <h3 class="card-title">Data Pengguna</h3>
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
          <th>Foto</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Alamat</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, index) in mainData" :key="index">
          <td>@{{ index+1 }}</td>
          <td><img class="profile" :src="url+'/storage/'+(item.file == null ? '' : item.file.path)" alt=""></td>
          <td>@{{ item.name == null ? '' : item.name }}</td>
          <td>@{{ item.email == null ? '' : item.email }}</td>
          <td>@{{ item.address == null ? '' : item.address }}</td>
          <td>
            <a href="javascript:void(0);" @click="editModal(item)" class="text-success"
                data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i
                    class="far fa-edit"></i></a>
            <a href="javascript:void(0);" @click="deleteData(item.uuid)" class="text-danger"
                data-toggle="tooltip" data-placement="top" data-original-title="Hapus"><i
                    class="far fa-trash-alt"></i></a>
            <a :href="url+'/users/'+item.uuid" class="text-secondary"
                data-toggle="tooltip" data-placement="top" data-original-title="Info"><i
                    class="fas fa-info-circle"></i></a>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <th>No.</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Alamat</th>
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
                <h4 class="modal-title" v-show="!editMode" id="myLargeModalLabel">Tambah Data Customer</h4>
                <h4 class="modal-title" v-show="editMode" id="myLargeModalLabel">Edit Data Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <form @submit.prevent="editMode ? updateData() : storeData()" @keydown="form.onKeydown($event)" id="form">
                <div class="modal-body mx-4">
                    <div class="form-row">
                        <label class="col-lg-2" for="Nama">Nama</label>
                        <div class="form-group col-md-8">
                            <input v-model="form.name" id="name" type="text" min=0 placeholder="Masukkan Nama"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <div v-if="form.errors.has('name')" v-html="form.errors.get('name')" ></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <label class="col-lg-2" for="Email">Email</label>
                        <div class="form-group col-md-8">
                            <input v-model="form.email" id="email" type="email" min=0 placeholder="Masukkan Email"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                            <div v-if="form.errors.has('email')" v-html="form.errors.get('email')" ></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <label class="col-lg-2" for="member">Tipe User</label>
                        <div class="form-group col-md-8">
                            <select name="sel-tipeuser" id="role" class="form-control custom-select"
                                {{-- :class="{ 'is-invalid': form.errors.has('tipe_user') }" --}} style="width: 100%" disabled>
                                <option value="customer" selected>Customer</option>
                            </select>
                            <input type="hidden" v-model="form.role">
                            <div v-if="form.errors.has('role')" v-html="form.errors.get('role')" ></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <label class="col-lg-2" for="Profil">Foto Profil</label>
                        <div class="form-group col-md-8">
                            <input @change="changeImage" id="image" type="file" accept="image/*"
                                placeholder="Please Select A Photo" readonly="readonly" class="form-control ">
                            <div id="preview">
                                <img v-if="preview" :src="preview" />
                            </div>
                            <div v-if="form.errors.has('image')" v-html="form.errors.get('image')" ></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <label class="col-lg-2" for="address">Alamat</label>
                        <div class="form-group col-md-8">
                            <textarea id="address" @change="addressChanged" v:model="form.address" class="form-control" placeholder="Masukkan Alamat"></textarea>
                            <div v-if="form.errors.has('address')" v-html="form.errors.get('address')" ></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <label class="col-lg-2" for="Password">Password</label>
                        <div class="form-group col-md-8">
                            <input v-model="form.password" id="password" type="password"
                                placeholder="Masukkan Password" class="form-control"
                                :class="{ 'is-invalid': form.errors.has('password') }">
                            <div v-if="form.errors.has('password')" v-html="form.errors.get('password')" ></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <label class="col-lg-2" for="Password">Password Konfirmasi</label>
                        <div class="form-group col-md-8">
                            <input v-model="form.password_confirmation" id="password_confirmation" type="password"
                                placeholder="Masukkan Konfirmasi Password" class="form-control"
                                :class="{ 'is-invalid': form.errors.has('password_confirmation') }">
                            <div v-if="form.errors.has('password_confirmation')" v-html="form.errors.get('password_confirmation')" ></div>
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
              email: '',
              address: '',
              password: '',
              password_confirmation: '',
              role: 'customer',
              image : ''
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
            addressChanged(){
                this.form.address = $('#address').val();
            },
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
          changeImage(e){
              const file = e.target.files[0];
              this.preview = URL.createObjectURL(file);
              let gambar = e.target.files;
              if(gambar.length){
                this.form.image = gambar[0];
              }
          },
          clearForm(){
            this.form.reset();
            this.form.clear();
            $('#address').val('');
            $('#image').val('');
            this.preview = null;
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
                this.preview = data.file==null ? null : this.url+'/storage/'+data.file.path;
                $('#address').val(data.address);
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
                this.form.post("{{ route('users.store') }}")
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
                url = "{{ route('users.update', ':id') }}".replace(':id', this.form.id)
                this.form.submit('post',url,{
                  transformRequest: [function(data, headers){
                    return objectToFormData(data)
                  }]
                }).then(response => {
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
                    title: 'Apakah Anda Yakin Menghapus Customer Ini?',
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
                        url = "{{ route('users.destroy', ':id') }}".replace(':id', id)
                        this.form.delete(url)
                            .then(response => {
                                if(response.data.success == true){
                                    Swal.fire(
                                        'Berhasil',
                                        'Customer Dihapus Dari Sistem.',
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
                axios.get("{{ route('customer.getdata') }}")
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
