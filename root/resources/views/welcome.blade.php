@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-map-marker"></span> Maps Tasikmalaya</h3>
            </div>
            <div class="panel-body">
                <div id="map" style="width:100%;height: 475px"></div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('scripts')
<script>
    function initMap() {
        var lokasi = [
            @foreach($hotels as $hotel)
            ['{{$hotel->nama}}','{{$hotel->lat}}','{{$hotel->lng}}'],
            @endforeach
        ];
        var tasik = {lat: -7.3429173, lng: 108.2164801};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: tasik,
        });
        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < lokasi.length; i++) { 
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(lokasi[i][1], lokasi[i][2]),
                map: map,
                title: lokasi[i][0],
                label: 'H',
                animation: google.maps.Animation.DROP
            });
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    map.setZoom(18);
                    map.setCenter(marker.getPosition());
                    infowindow.setContent(lokasi[i][0]+ '<br>' +lokasi[i][1]+','+lokasi[i][2]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDc9s4U-8A5rIEcXEzt3CYQnJGHy3BEjy4&callback=initMap"></script>
@endpush