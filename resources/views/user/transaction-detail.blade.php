@extends('layouts.landing_template')
@section('title')
Detail Transaksi
@endsection
@section('css')
  <link href="{{ asset('template_assets/vendor/lightbox2/css/lightbox.css')}}" rel="stylesheet" />
@endsection
@section('content')

<!--====== App Content ======-->
        <div class="app-content">

            <!--====== Section 1 ======-->
            <div class="u-s-p-y-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="breadcrumb">
                            <div class="breadcrumb__wrap">
                                <ul class="breadcrumb__list">
                                    <li class="has-separator">

                                        <a href="{{route('user.home')}}">Home</a></li>
                                    <li class="is-marked">

                                        <a href="{{route('user.transaction')}}">Detail Transaksi</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section 1 ======-->


            <!--====== Section 2 ======-->
            <div class="u-s-p-b-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="dash">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3 col-md-12">

                                    <!--====== Dashboard Features ======-->
                                    <div class="dash__box dash__box--bg-white dash__box--shadow u-s-m-b-30">
                                        <div class="dash__pad-1">

                                            <span class="dash__text u-s-m-b-16">Hello, {{ auth()->user()->name }}</span>
                                            <ul class="dash__f-list">
                                                <li>

                                                    <a href="{{route('user.profil')}}">Profil</a></li>
                                                {{-- <li>

                                                    <a href="{{ route('user.track_order.view') }}">Lacak Pesanan</a></li> --}}
                                                <li>

                                                    <a class="dash-active" href="{{ route('user.transaction') }}">Transaksi Saya</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="dash__box dash__box--bg-white dash__box--shadow dash__box--w">
                                        <div class="dash__pad-1">
                                            <ul class="dash__w-list">
                                                <li>
                                                    <div class="dash__w-wrap">

                                                        <span class="dash__w-icon dash__w-icon-style-1"><i class="fas fa-cart-arrow-down"></i></span>

                                                        <span class="dash__w-text">{{ $data_transaksi->n_transaksi }}</span>

                                                        <span class="dash__w-name">Transaksi Diproses</span></div>
                                                </li>
                                                <li>
                                                    <div class="dash__w-wrap">

                                                        <span class="dash__w-icon dash__w-icon-style-2"><i class="fas fa-check-circle"></i></span>

                                                        <span class="dash__w-text">{{ $data_transaksi->n_sukses_transaksi }}</span>

                                                        <span class="dash__w-name">Transaksi Sukses</span></div>
                                                </li>
                                                <li>
                                                    <div class="dash__w-wrap">

                                                        <span class="dash__w-icon dash__w-icon-style-1"><i class="fas fa-times"></i></span>

                                                        <span class="dash__w-text">{{ $data_transaksi->n_batal_transaksi }}</span>

                                                        <span class="dash__w-name">Transaksi Dibatalkan</span></div>
                                                </li>
                                                <li>
                                                    <div class="dash__w-wrap">

                                                        <span class="dash__w-icon dash__w-icon-style-3"><i class="far fa-heart"></i></span>

                                                        <span class="dash__w-text">{{ $data_transaksi->n_keranjang }}</span>

                                                        <span class="dash__w-name">Keranjang</span></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--====== End - Dashboard Features ======-->
                                </div>
                                <div class="col-lg-9 col-md-12">
                                    <h1 class="dash__h1 u-s-m-b-30">Order Details</h1>
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30" style="background-color: #ececec;">
                                        <div class="dash__pad-2">
                                            <div class="dash-l-r">
                                                <div>
                                                    <div class="manage-o__text-2 u-c-secondary">Order #{{ $data_transaksi_detail->uuid }}</div>
                                                    <div class="manage-o__text u-c-silver">Placed on {{ $data_transaksi_detail->created_at }}</div>
                                                </div>
                                                <div>
                                                    <div class="manage-o__text-2 u-c-silver">Total:
                                                        <span class="manage-o__text-2 u-c-secondary">
                                                            @php
                                                            $total = 0;
                                                            @endphp

                                                            @foreach($data_transaksi_detail->product as $p)
                                                            @php
                                                            $total += ((int)$p->price * (int)$p->amount);
                                                            @endphp
                                                            @endforeach

                                                            {{ "Rp " . number_format($total,2,',','.') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
                                        <div class="dash__pad-2">
                                            <div class="manage-o">
                                                <div class="manage-o__header u-s-m-b-30">
                                                    <div class="manage-o__icon"><i class="fas fa-box u-s-m-r-5"></i>

                                                        <span class="manage-o__text">Paket</span></div>
                                                </div>
                                                <div class="dash-l-r">
                                                    <div class="manage-o__text u-c-secondary">
                                                        @if($data_transaksi_detail->status == 3)
                                                            Dikirim Pada {{ $data_transaksi_detail->delivered_on }}
                                                        @elseif($data_transaksi_detail->status=='cancel')
                                                            Dibatalkan Pada {{ $data_transaksi_detail->canceled_on }}
                                                        @endif
                                                    </div>
                                                    <div class="manage-o__icon">
                                                        <i class="fas fa-truck u-s-m-r-5"></i>
                                                        @if($data_transaksi_detail->status != 5)
                                                            <span class="manage-o__text">{{ $data_transaksi_detail->kurir }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                @if($data_transaksi_detail->status != 5)
                                                <div class="manage-o__timeline">
                                                    <div class="timeline-row">
                                                        <div class="col-lg-4 u-s-m-b-30">
                                                            <div class="timeline-step">
                                                                <div class="timeline-l-i {{ $data_transaksi_detail->status <= 4  ? 'timeline-l-i--finish' : '' }}">

                                                                    <span class="timeline-circle"></span></div>

                                                                <span class="timeline-text">Diproses</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 u-s-m-b-30">
                                                            <div class="timeline-step">
                                                                <div class="timeline-l-i {{ $data_transaksi_detail->status > 2 && $data_transaksi_detail->status <= 4 ? 'timeline-l-i--finish' : '' }}">

                                                                    <span class="timeline-circle"></span></div>

                                                                <span class="timeline-text">Dikirim</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 u-s-m-b-30">
                                                            <div class="timeline-step">
                                                                <div class="timeline-l-i {{ $data_transaksi_detail->status == 4 ? 'timeline-l-i--finish' : '' }}">

                                                                    <span class="timeline-circle"></span></div>

                                                                <span class="timeline-text">Diterima</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif

                                                @foreach($data_transaksi_detail->product as $p)
                                                <div class="manage-o__description">
                                                    <div class="description__container">
                                                        <div class="description__img-wrap">
                                                            <img class="u-img-fluid" src="{{ asset('storage/'.$p->file->path) }}" alt="" style="max-height: 90px;"></div>

                                                        <div class="description-title">
                                                            {{ $p->product->name }}
                                                            @foreach($p->detail as $d)
                                                            {{ $d->name.' '.$d->value }}
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="description__info-wrap">
                                                        <div>

                                                            <span class="manage-o__text-2 u-c-silver">Quantity:

                                                                <span class="manage-o__text-2 u-c-secondary">{{ $p->amount }}</span></span></div>
                                                        <div>

                                                            <span class="manage-o__text-2 u-c-silver">Total:

                                                                <span class="manage-o__text-2 u-c-secondary">{{ "Rp " . number_format($p->amount*$p->price,2,',','.') }}</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="dash__box dash__box--bg-white dash__box--shadow dash__box--w" style="background-color: #ffe8eb; margin-bottom: 20px;">
                                                <div class="dash__pad-3">
                                                    <h2 class="dash__h2 u-s-m-b-8">Alamat Pengiriman</h2>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Atas Nama</div>
                                                        <div class="manage-o__text-2 u-c-secondary">{{ $data_transaksi_detail->atas_nama }}</div>
                                                    </div>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Alamat</div>
                                                        <div class="manage-o__text-2 u-c-secondary">{{ $data_transaksi_detail->alamat }}</div>
                                                    </div>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">No. HP</div>
                                                        <div class="manage-o__text-2 u-c-secondary">{{ $data_transaksi_detail->nohp }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dash__box dash__box--bg-white dash__box--shadow dash__box--w" style="background-color: #ddf9ff; margin-bottom: 20px;">
                                                <div class="dash__pad-3">
                                                    <h2 class="dash__h2 u-s-m-b-8">Pembayaran</h2>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Bank</div>
                                                        <div class="manage-o__text-2 u-c-secondary">{{ $data_transaksi_detail->bank->name }}</div>
                                                    </div>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Nomor Rekening</div>
                                                        <div class="manage-o__text-2 u-c-secondary">{{ $data_transaksi_detail->bank->account_number }}</div>
                                                    </div>

                                                    {{-- <span class="dash__text-2">(+0) 900901904</span> --}}
                                                </div>
                                            </div>
                                            @if($data_transaksi_detail->status != 5 && $data_transaksi_detail->ongkir != null)
                                            <div class="dash__box dash__box--bg-white dash__box--shadow dash__box--w" style="background-color: #fff8d9;">
                                                <div class="dash__pad-3">
                                                    <h2 class="dash__h2 u-s-m-b-8">Dikirim</h2>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Kurir</div>
                                                        <div class="manage-o__text-2 u-c-secondary">{{ strtoupper($data_transaksi_detail->kurir) }}</div>
                                                    </div>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Keterangan</div>
                                                        <div class="manage-o__text-2 u-c-secondary">{{ $data_transaksi_detail->ongkir->description }}</div>
                                                    </div>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Estimasi</div>
                                                        <div class="manage-o__text-2 u-c-secondary">{{ $data_transaksi_detail->ongkir->cost_etd }}</div>
                                                    </div>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Biaya Pengiriman</div>
                                                        <div class="manage-o__text-2 u-c-secondary">{{ $data_transaksi_detail->ongkir->cost_value }}</div>
                                                    </div>
                                                    @if($data_transaksi_detail->status < 1)
                                                    <div class="contact-f" style="margin-top: 20px;">
                                                        <button class="btn btn--e-brand-b-2" type="button" onclick="location.href = '{{ route('user.konfirmasi_ongkir',$data_transaksi_detail->uuid) }}'">
                                                            Konfirmasi Pengiriman
                                                        </button>
                                                    </div>
                                                    @endif

                                                    {{-- <span class="dash__text-2">(+0) 900901904</span> --}}
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="dash__box dash__box--bg-white dash__box--shadow" style="background-color: #eaffea;">
                                                <div class="dash__pad-3">
                                                    <h2 class="dash__h2 u-s-m-b-8">Total Pembayaran</h2>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Subtotal</div>
                                                        <div class="manage-o__text-2 u-c-secondary">{{ "Rp " . number_format($total,2,',','.') }}</div>
                                                    </div>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Ongkos Kirim</div>
                                                        <div class="manage-o__text-2 u-c-secondary">{{ $data_transaksi_detail->ongkir == null ? 'Diproses admin' : "Rp " . number_format($data_transaksi_detail->ongkir->cost_value,2,',','.') }}</div>
                                                    </div>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Total</div>
                                                        <div class="manage-o__text-2 u-c-secondary">{{ "Rp " . number_format((int)$total+(int)$data_transaksi_detail->ongkir->cost_value,2,',','.') }}</div>
                                                    </div>
                                                    <hr>
                                                    @if($data_transaksi_detail->file_transfer != null)
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div style="width: 100%; text-align: center;">
                                                        <a href="{{ asset('storage/'.$data_transaksi_detail->file_transfer->path) }}" data-lightbox="{{$data_transaksi_detail->uuid}}" v-bind:data-title="transaksi{{$data_transaksi_detail->uuid}}">
                                                            <img src="{{ asset('storage/'.$data_transaksi_detail->file_transfer->path) }}" alt="{{$data_transaksi_detail->uuid}}" style="width: 7rem; border-radius: 6px;">
                                                        </a>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if($data_transaksi_detail->status < 2)
                                                    <form class="contact-f" method="post" action="{{ route('user.upload_pembayaran',$data_transaksi_detail->uuid)}}">
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <input class="input-text input-text--border-radius input-text--primary-style" name="transfer_evidence" type="file" id="transfer_evidence" placeholder="Foto (Wajib)" required style="width: 100%;">
                                                    </div>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <button class="btn btn--e-brand-b-2" type="submit">
                                                        @if($data_transaksi_detail->file_transfer != null)
                                                        Ubah Bukti Transfer
                                                        @else
                                                        Upload Bukti Transfer
                                                        @endif
                                                        </button>
                                                    </div>
                                                    </form>
                                                    @endif
                                                    {{-- <span class="dash__text-2">Paid by Cash on Delivery</span> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 2 ======-->
        </div>
        <!--====== End - App Content ======-->
@endsection
@section('js')
  <script src="{{ asset('template_assets/vendor/lightbox2/js/lightbox.js')}}"></script>
    <script>
        lightbox.option({
          'resizeDuration': 400,
          'wrapAround': true
        })
    </script>
@endsection