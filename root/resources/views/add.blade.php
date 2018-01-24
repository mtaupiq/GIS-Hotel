@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-plus-sign"></span> Tambah Data Hotel</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <form action="{{url('add')}}" method="POST" role="form">
                        {{csrf_field()}}
                            <div class="form-group">
                                <label for="nama">Nama Hotel:</label>
                                <input name="nama" type="text" class="form-control" id="">
                            </div>
                            <div class="form-group">
                                <label for="lokasi">Map:</label>
                                <input type="text" class="form-control" id="lokasi" placeholder="Cari Lokasi">
                            </div>
                            <div class="form-group">
                                <label for="lat">Latitude:</label>
                                <input name="lat" type="text" class="form-control" id="lat">
                            </div>
                            <div class="form-group">
                                <label for="lng">Longitude:</label>
                                <input name="lng" type="text" class="form-control" id="lng">
                            </div>
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                            <a class="btn btn-default" href="{{url('home')}}" role="button"><span class="glyphicon glyphicon-remove"></span> Batal</a>
                        </form>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div id="map" style="width:100%;height: 400px"></div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('scripts')
<script>
    function initMap() {
        var tasik = {lat: -7.3505808, lng: 108.2171633};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: tasik
        });
        var marker = new google.maps.Marker({
            position: tasik,
            map: map,
            draggable: true
        });
        var defaultBounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(-7.390892, 108.174728),
            new google.maps.LatLng(-7.311896, 108.241333)
            );
        var searchBox = new google.maps.places.SearchBox(document.getElementById('lokasi'), {bounds: defaultBounds});
        google.maps.event.addListener(searchBox,'places_changed',function(){
            var places = searchBox.getPlaces();
            var bounds = new google.maps.LatLngBounds();
            var i, place;
            for(i=0;place=places[i];i++){
                bounds.extend(place.geometry.location);
                marker.setPosition(place.geometry.location);
            }
            map.fitBounds(bounds);
            map.setZoom(17);
        });
        google.maps.event.addListener(marker,'position_changed',function(){
            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();
            $('#lat').val(lat);
            $('#lng').val(lng);
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDc9s4U-8A5rIEcXEzt3CYQnJGHy3BEjy4&libraries=places&callback=initMap&region=id" async defer></script>
@endpush