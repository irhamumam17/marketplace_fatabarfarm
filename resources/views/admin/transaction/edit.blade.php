@extends('admin.layouts.template')
@section('title')
Edit Transaksi
@endsection
@section('css')
<style>

</style>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Transaksi</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {{-- <form @submit.prevent="storeData()" @keydown="form.onKeydown($event)"> --}}
        <form @submit.prevent="updateData()" @keydown="form.onKeydown($event)" id="form">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Produk</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                    <div v-for="(item,index) in form.product">
                    <!-- row -->
                        <label>Produk @{{ index+1 }}</label>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <select class="form-control" v-model="item.product_id" name="product_id" :id="index" style="width: 100%;">
                                <option v-for="(item, index) in product_variants" :value="item.uuid">
                                    @{{ item.product.name }}
                                    <template v-for="(item2, index) in item.detail">
                                        @{{ item2.value }}
                                    </template>
                                </option>
                              </select>
                            </div>
                            <div class="form-group col-md-4">
                                <input type="number" max="10" min="1" v-model="item.amount" class="form-control" id="amount" placeholder="Jumlah" required>
                            </div>
                          <div class="form-group col-md-2">
                            <button type="button" class="btn btn-success" @click="addItem(index)" v-if='!index'><i
                                    class="fas fa-plus"></i></button>
                            <button type="button" class="btn btn-secondary" @click="removeItem(index)"
                                v-if="index"><i class="fas fa-minus"></i></button>
                          </div>
                        </div>
                    </div>
                    <!-- row -->
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Pengguna</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="form-group">
                    <label>Nama</label>
                    <select class="form-control" v-model="form.user_id" :id="'user_id'" style="width: 100%;" required>
                        <option></option>
                        <option v-for="(item, index) in users" :value="item.uuid">
                            @{{ item.name }}
                        </option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label>Atas Nama</label>
                    <input type="text" class="form-control" id="atas_nama" v-model="form.atas_nama" placeholder="Masukkan Atas Nama" required>
                  </div>
                  <div class="form-group">
                    <label>No HP</label>
                    <input type="text" class="form-control" id="nohp" v-model="form.nohp" placeholder="Masukkan No. HP" required>
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Alamat Pengiriman</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="form-group">
                    <label>Provinsi</label>
                    <select class="form-control" v-model="form.province_id" :id="'province_id'" style="width: 100%;" required>
                        <option></option>
                        <option v-for="(item, index) in provinces" :value="item.province_id">
                            @{{ item.name }}
                        </option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label>Kota</label>
                    <select class="form-control" v-model="form.city_id" :id="'city_id'" style="width: 100%;" required>
                        <option></option>
                        <option v-for="(item, index) in cities" :value="item.city_id">
                            @{{ item.name }}
                        </option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat" rows="3" v-model="form.alamat" placeholder="Masukkan Alamat" required></textarea>
                  </div>
                  <div class="form-group">
                    <label>Kode Pos</label>
                    <input type="text" class="form-control" v-model="form.kodepos" placeholder="Masukkan Kode Pos" required>
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Pengiriman</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="form-group">
                    <label>Kurir</label>
                    <select class="form-control" v-model="form.kurir" :id="'kurir'" style="width: 100%;" required>
                        <option></option>
                        <option value="jne">JNE</option>
                        <option value="tiki">TIKI</option>
                        <option value="pos">POS</option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label>Berat Barang</label>
                    <input type="number" id="berat" class="form-control" v-model="form.berat" placeholder="Masukkan Berat Barang(Gram)" required>
                    <br>
                            <button type="button" @click="countOngkir" class="btn btn-info btn-flat">Hitung</button>
                  </div>
                  <div class="form-group">
                    <label>Ongkos Kirim</label>
                      <select class="form-control" v-model="form.ongkir" :id="'ongkir'" style="width: 100%;" required>
                        <option></option>
                        <template v-for="(item, index) in costs">
                            <option v-for="(item2, index) in item.cost" :value="item.service">
                                @{{ item.description+' | '+item2.etd+' Hari'+' : '+item2.value }}
                            </option>
                        </template>
                      </select>
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Pembayaran</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                  <div class="card-body">
                    <div class="form-group">
                      <label>Bank</label>
                      <select class="form-control" v-model="form.bank_id" :id="'bank_id'" style="width: 100%;" required>
                          <option></option>
                          <option v-for="(item, index) in banks" :value="item.uuid">
                              @{{ item.name }}
                          </option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Bukti Pembayaran</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" @change="imageTrigger" id="transfer_evidence" class="custom-file-input" id="exampleInputFile">
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                      </div>
                      <a v-if="preview != null" :href="preview" v-bind:data-lightbox="form.id" v-bind:data-title="'transaksi'+form.uuid">
                          <img :src="preview" v-bind:alt="'transaksi'+form.uuid" style="width: 7rem; border-radius: 6px; margin-top: 10px;">
                      </a>
                    </div>
                  </div>
                  <!-- /.card-body -->
              </div>
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Summary</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="form-group">
                    <label>Catatan</label>
                    <textarea class="form-control" name="note" id="note" rows="3" v-model="form.note" placeholder="Masukkan Catatan" required></textarea>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" v-model="form.status" :id="'status'" style="width: 100%;" required>
                        <option></option>
                        <option value="0">Pending</option>
                        <option value="1">Konfirmasi Ongkir</option>
                        <option value="2">Packing</option>
                        <option value="3">Dikirim</option>
                        <option value="4">Sukses</option>
                        <option value="5">Batal</option>
                      </select>
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-danger" onclick="window.history.go(-1); return false;">Batal</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <!-- /.card -->
        </form>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    @endsection
    @section('js')
    <script>
        $(document).ready(function(){
            $("select#province_id").on('change',function(e){
                app.selectProvince();
            });
            $("select#city_id").on('change',function(e){
                app.selectCity();
            });
            $("select#user_id").on('change',function(e){
                app.selectUser();
            });
            $("select#bank_id").on('change',function(e){
                app.selectBank();
            });
            $("select#kurir").on('change',function(e){
                app.selectKurir();
            });
            $("#berat").on('change',function(e){
                app.changeBerat();
            });
            $("#ongkir").on('change',function(e){
                app.changeOngkir();
            });
            $("#status").on('change',function(e){
                app.changeStatus();
            });
            // $("#0").on('change',function(e){
            //     app.selectProduct($(this).attr('id'));
            // });
        });
        var imgUrl = "{{ asset('') }}";
        var data = @JSON($transaction);
    let app = new Vue({
        el: '#app',
        data: {
          mainData: '',
          url : window.location.origin,
          form: new Form({
                id: data.id,
                uuid: data.uuid,
                product: data.product,
                user_id: data.user_id,
                atas_nama: data.atas_nama,
                bank_id: data.bank_id,
                province_id: data.province_id,
                city_id: data.city_id,
                alamat: data.alamat,
                kodepos: data.kodepos,
                nohp: data.nohp,
                berat: data.berat,
                ongkir: data.ongkir.service,
                description: data.ongkir.description,
                cost_value: data.ongkir.cost_value,
                cost_etd: data.ongkir.cost_etd,
                cost_note: data.ongkir.cost_note,
                kurir: data.kurir,
                note: data.note,
                status: data.status,
                transfer_evidence: data.file_transfer == null ? '' : data.file_transfer.path,
            }),
            formOngkir: new Form({
                city_id: data.city_id,
                berat: data.berat,
                kurir: data.kurir
            }),
            preview: data.file_transfer == null ? null : imgUrl+'/storage/'+data.file_transfer.path,
            users: @JSON($users),
            banks: @JSON($banks),
            provinces: @JSON($provinces),
            cities: @JSON($cities),
            product_variants: @JSON($product_variants),
            costs: @JSON($costs),
        },
        created(){

        },
        mounted(){
            // $('#0').select2({
            //     placeholder: "Pilih Produk",
            // });
            $('#user_id').select2({
                placeholder: "Pilih Pengguna",
            });
            $('#province_id').select2({
                placeholder: "Pilih Provinsi",
            });
            $('#city_id').select2({
                placeholder: "Pilih Kota",
            });
            $('#bank_id').select2({
                placeholder: "Pilih Bank",
            });
            $('#kurir').select2({
                placeholder: "Pilih Kurir",
            });
            $('#ongkir').select2({
                placeholder: "Pilih Ongkos Kirim",
            });
            $('#status').select2({
                placeholder: "Pilih Status",
            });
        },
        methods: {

            countOngkir(){
                Swal.fire({
                    title: 'Menghitung Ongkir...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                this.formOngkir.post("{{ route('ongkir.count') }}")
                    .then(response => {
                        if(response.data.success == true){
                            this.costs = response.data.data[0].costs;
                            Swal.close()
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
            changeOngkir(){
                this.form.ongkir = $('#ongkir').val();
                let $arr = this.costs.find(x => x.service === this.form.ongkir);
                this.form.description = $arr.description;
                this.form.cost_value = $arr.cost[0].value;
                this.form.cost_etd = $arr.cost[0].etd;
                this.form.cost_note = $arr.cost[0].note;
            },
            changeStatus(){
                this.form.status = $('#status').val();
            },
            changeBerat(){
                this.formOngkir.berat = $('#berat').val();
            },
            selectProduct(index){
                this.form.product[index].product_id = $('#'+index).val();
            },
            selectUser(){
                this.form.user_id = $('#user_id').val();
            },
            selectBank(){
                this.form.bank_id = $('#bank_id').val();
            },
            selectKurir(){
                this.form.kurir = $('#kurir').val();
                this.formOngkir.kurir = $('#kurir').val();
            },
            selectCity(){
                this.form.city_id = $('#city_id').val();
                this.formOngkir.city_id = $('#city_id').val();
            },
            selectProvince(){
                this.form.province_id = $('#province_id').val();
                this.cities = [];
                url = "{{ route('user.getcity', ':id') }}".replace(':id', this.form.province_id)
                axios.get(url)
                    .then(response => {
                        this.cities = response.data.data
                    })
                    .catch(error => {
                        console.log(error)
                        Swal.close()
                    })
            },
            addItem(index) {
                this.form.product.push({
                    product_id: '',
                    amount: 1
                });
                setTimeout(function() {
                    let newid = (parseInt(index)+1);
                    // let initSelect2 = $('#'+newid).select2({
                    //     placeholder: "Pilih Produk",
                    // });
                    // $('#'+newid).on('select2:select', function (e) {
                    //   this.selectProduct(e)
                    // });
                }, 1);
            },
            removeItem(index) {
                this.form.product.splice(index, 1);
            },
            updateData(){
                Swal.fire({
                    title: 'Loading Data...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                this.form.product = JSON.stringify(this.form.product);
                this.form.post("{{ route('transaction.update') }}")
                    .then(response => {
                        this.form.product = JSON.parse(this.form.product);
                        if(response.data.success == true){
                            Swal.fire(
                                'Sukses',
                                response.data.message,
                                'success'
                            ).then((result) => {
                                // window.location.href = "{{ route('transaction.pending.index') }}"
                                window.history.go(-1);
                                return false;
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
                        this.form.product = JSON.parse(this.form.product);
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
              let gambar = e.target.files;
              this.preview = URL.createObjectURL(file);
              if(gambar.length){
                this.form.transfer_evidence = gambar[0];
              }
          },
        },
    });
    </script>
    @endsection
