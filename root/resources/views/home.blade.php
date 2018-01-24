@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col-md-4 col-lg-4 col-md-offset-2">
        <a class="btn btn-success" href="{{url('add')}}" role="button" style="margin-bottom: 10px;"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
    </div>
    <div class="col-md-2 col-lg-2 col-md-offset-2">
        <form action="{{url('cari')}}" method="GET" role="form">
            <div class="input-group">
                <input name="hotel" type="text" class="form-control" placeholder="Cari Hotel...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-8 col-lg-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> Daftar Hotel Di Tasikmalaya</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 20px;">No</th>
                            <th class="text-center">Nama Hotel</th>
                            <th class="text-center" style="width: 200px;">Latitude</th>
                            <th class="text-center" style="width: 200px;">Longitude</th>
                            <th class="text-center" style="width: 90px;"><span class="glyphicon glyphicon-cog"></span></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($hotel as $no=>$item)
                        <tr>
                            <td style="vertical-align: middle;text-align: center;">{{$no+1}}.</td>
                            <td style="vertical-align: middle;">{{$item->nama}}</td>
                            <td style="vertical-align: middle;text-align: center;">{{$item->lat}}</td>
                            <td style="vertical-align: middle;text-align: center;">{{$item->lng}}</td>
                            <td>
                            <form action="{{url('hapus/'.$item->id)}}" method="post" role="form">
                            {{csrf_field()}}
                                <a class="btn btn-default btn-sm" href="{{url('hotel/'.$item->id)}}" role="button" data-toggle="tooltip" data-placement="top" title="Lihat"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <input type="hidden" name="_method" value="delete">
                                <button class="btn btn-danger btn-sm" type="submit" data-toggle="tooltip" data-placement="top" title="Hapus"><span class="glyphicon glyphicon-trash"></span></button>
                            </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">
            {{ $hotel->links() }}
        </div>
    </div>
</div>
</div>
@endsection
@push('scripts')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip({
            container: 'body'
        });
    });
</script>
@endpush