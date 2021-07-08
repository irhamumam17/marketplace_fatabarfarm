@extends('layouts.landing_template')
@section('title')
Lokasi
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

                                        <a href="{{ route('user.home')}}">Home</a></li>
                                    <li class="is-marked">

                                        <a href="{{ route('user.location')}}">Lokasi</a></li>
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
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="g-map">
                                    <div id="map"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 2 ======-->


            <!--====== Section 3 ======-->
            <div class="u-s-p-b-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 u-s-m-b-30">
                                <div class="contact-o u-h-100">
                                    <div class="contact-o__wrap">
                                        <div class="contact-o__icon"><i class="fas fa-phone-volume"></i></div>

                                        <span class="contact-o__info-text-1">Kontak Kami</span>

                                        <span class="contact-o__info-text-2">{{$lokasi->detail->kontak}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 u-s-m-b-30">
                                <div class="contact-o u-h-100">
                                    <div class="contact-o__wrap">
                                        <div class="contact-o__icon"><i class="fas fa-map-marker-alt"></i></div>

                                        <span class="contact-o__info-text-1">Lokasi Kami</span>

                                        <span class="contact-o__info-text-2">{!!$lokasi->detail->alamat!!}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 u-s-m-b-30">
                                <div class="contact-o u-h-100">
                                    <div class="contact-o__wrap">
                                        <div class="contact-o__icon"><i class="far fa-clock"></i></div>

                                        <span class="contact-o__info-text-1">Waktu Kerja</span>

                                        <span class="contact-o__info-text-2">{{ucfirst($lokasi->detail->waktu_kerja->hari_mulai)}} - {{ucfirst($lokasi->detail->waktu_kerja->hari_selesai)}}</span>

                                        <span class="contact-o__info-text-2">Pukul {{$lokasi->detail->waktu_kerja->waktu_mulai}} - {{$lokasi->detail->waktu_kerja->waktu_selesai}} WIB</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 3 ======-->
        </div>
        <!--====== End - App Content ======-->
@endsection
@section('js')
<script>
    // When the window has finished loading create our google map below
google.maps.event.addDomListener(window, 'load', init);
function init() {
    var data = @json($lokasi);
    // Basic options for a simple Google Map
    // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
    var mapOptions = {
        // How zoomed in you want the map to start at (always required)
        zoom: 12,
        scrollwheel: false,
        // The latitude and longitude to center the map (always required)
        center: new google.maps.LatLng(data.detail.longitude, data.detail.latitude),
    };
    // Get the HTML DOM element that will contain your map
    // We are using a div with id="map" seen below in the <body>
    var mapElement = document.getElementById('map');
    // Create the Google Map using our element and options defined above
    var map = new google.maps.Map(mapElement, mapOptions);
    // Let's also add a marker while we're at it
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(data.detail.longitude, data.detail.latitude),
        map: map,
    });
}
</script>
@endsection