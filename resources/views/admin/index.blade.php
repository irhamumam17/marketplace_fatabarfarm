@extends('admin.layouts.template')
@section('title')
Dashboard
@endsection
@section('css')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@endsection
@section('content')
    <!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ $n_users }}</h3>

          <p>Pengguna Terdaftar</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        {{-- <a href="{{ route('customer.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{ $n_product }}</h3>

          <p>Produk Tersedia</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        {{-- <a href="{{ route('product.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{ $n_transaksi }}</h3>

          <p>Semua Transaksi</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        {{-- <a href="{{ route('transaction.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ $n_sukses_transaksi }}<sup style="font-size: 20px">%</sup></h3>

          <p>Transaksi Sukses</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row -->
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Statistik Transaksi</h3>
        </div>
        <div class="card-body">
          <div class="chart">
            <h4 class="card-title chart" id="chart-title"></h4>
                <div id="linechart_material"></div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </section>
    <!-- right col -->
  </div>
  <!-- /.row (main row) -->
@endsection
@section('js')
  <script>
        google.charts.load('current', {'packages':['line']});
        google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        let url = "{{ url('/') }}";
        axios.get(url+'/dashboard/get-data')
            .then(response => {
                var data = new google.visualization.DataTable();
                data.addColumn('number', 'Tanggal');
                data.addColumn('number', 'Pending');
                data.addColumn('number', 'Konfirmasi');
                data.addColumn('number', 'Dikemas');
                data.addColumn('number', 'Dikirim');
                data.addColumn('number', 'Sukses');
                data.addColumn('number', 'Batal');
                data.addRows(response.data);


                let date = new Date();
                const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                                    ];
                var options = {
                    chart: {
                        title: 'Grafik Transaksi Bulan '+monthNames[date.getMonth()]+' '+date.getFullYear(),
                    //   subtitle: 'in millions of dollars (USD)'
                    },
                    width: $(window).width() * 0.75,
                    height: 500,
                    colors: ['#fdc16a', '#5f76e8', ,'#6318ad', '#b7ff00', '#22ca80', '#ff4f70'],
                    hAxis: {
                            title: 'Tanggal'
                        },
                    vAxis: {
                        title: 'Jumlah Transaksi'
                    },
                    legend: {
                            position: 'top'
                        },
                };
                var chart = new google.charts.Line(document.getElementById('linechart_material'));
                chart.draw(data, google.charts.Line.convertOptions(options));
                window.addEventListener('resize', drawChart, false);
            })
            .catch(error => {
                console.log(error)
            })
    }
    </script>
@endsection
