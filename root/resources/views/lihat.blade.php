@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col-md-8 col-lg-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-home"></span> Info Hotel</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <form>
                            <div class="form-group">
                                <label for="nama">Nama Hotel:</label>
                                <input type="text" class="form-control" value="{{$hotel->nama}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nama">Deskripsi:</label>
                                <textarea class="form-control" rows="5" disabled>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</textarea>
                            </div>
                            <div class="form-group">
                                <label for="nama">Alamat:</label>
                                <input type="text" class="form-control" value="Alamat Hotel" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nama">Kontak:</label>
                                <input type="text" class="form-control" value="(0265) 123456" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nama">Bintang:</label><br>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                            <a class="btn btn-default" href="{{url('home')}}" role="button">Kembali</a>
                        </form>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <form>
                            <div class="form-group">
                                <label for="">Map:</label>
                                <div id="map" style="width:100%;height: 400px"></div>
                            </div>
                        </form>
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
        var lokasi = {lat: {{$hotel->lat}}, lng: {{$hotel->lng}}}
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 18,
            center: lokasi,
            clickableIcons: false
        });
        var marker = new google.maps.Marker({
            position: lokasi,
            map: map
        });
        marker.addListener('click', toggleBounce);

        map.addListener('center_changed', function() {
          window.setTimeout(function() {
            map.panTo(marker.getPosition());
          }, 3000);
        });
        function toggleBounce() {
        if (marker.getAnimation() !== null) {
          marker.setAnimation(null);
        } else {
          marker.setAnimation(google.maps.Animation.BOUNCE);
          setTimeout(function(){ marker.setAnimation(null); }, 2100);
        }
      }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDc9s4U-8A5rIEcXEzt3CYQnJGHy3BEjy4&callback=initMap" async defer></script>
@endpush