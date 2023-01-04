@extends('layouts.app')

@section('title', __('outlet.create'))

@section('content')
<div class="row justify-content-center mb-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('outlet.create') }}</div>
            <form method="POST" action="{{ route('outlets.store') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                    {{-- input foto kos --}}
                    <div class="form-group">
                        <label for="file_foto_kos" class="control-label">Foto Kos</label>
                        <input id="file_foto_kos" type="file" name="file_foto_kos" placeholder="Pilih Foto Kos"
                            class="form-control-file {{ $errors->has('file_foto_kos') ? ' is-invalid' : '' }}" required>
                        {!! $errors->first('file_foto_kos', '<span class="invalid-feedback" role="alert">:message</span>') !!}

                        <label for="file_foto_kamar" class="control-label">Foto Kamar</label>
                        <input id="file_foto_kamar" type="file" name="file_foto_kamar"
                        class="form-control-file {{ $errors->has('file_foto_kamar') ? ' is-invalid' : '' }}" required>
                        {!! $errors->first('file_foto_kamar', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    {{-- input nama kos --}}
                    <div class="form-group">
                        <label for="name" class="control-label">{{ __('outlet.name') }}</label>
                        <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                            name="name" value="{{ old('name') }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    {{-- input alamat kos --}}
                    <div class="form-group">
                        <label for="address" class="control-label">{{ __('outlet.address') }}</label>
                        <textarea id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                            name="address" rows="4">{{ old('address') }}</textarea>
                        {!! $errors->first('address', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    {{-- input pemilik kos --}}
                    <div class="form-group">
                        <label for="pemilik" class="control-label">{{ __('outlet.owner') }}</label>
                        <input id="pemilik" type="text" class="form-control{{ $errors->has('pemilik') ? ' is-invalid' : '' }}"
                            name="pemilik" value="{{ old('pemilik') }}" required>
                        {!! $errors->first('owner', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    {{-- input kontak kos --}}
                    <div class="form-group">
                        <label for="kontak_pemilik" class="control-label">{{ __('outlet.contact') }}</label>
                        <input id="kontak_pemilik" type="text" class="form-control{{ $errors->has('kontak_pemilik') ? ' is-invalid' : '' }}"
                            name="kontak_pemilik" value="{{ old('kontak_pemilik') }}" required>
                        {!! $errors->first('kontak_pemilik', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    {{-- input tipe kos --}}
                    <div class="form-group">
                        <label for="tipe_kos" class="control-label">{{ __('outlet.type') }}</label>

                        <table style="width: 100%">
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input id="tipe_kos_laki" type="radio" class="form-check-input{{ $errors->has('tipe_kos') ? ' is -invalid' : '' }}"
                                            name="tipe_kos" value="Laki-Laki" required>
                                            <label for="tipe_kos_laki" class="form-check-label">Laki-Laki</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input id="tipe_kos_perempuan" type="radio" class="form-check-input{{ $errors->has('tipe_kos') ? ' is -invalid' : '' }}"
                                            name="tipe_kos" value="Perempuan" required>
                                            <label for="tipe_kos_perempuan" class="form-check-label">Perempuan</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input id="tipe_kos_campur" type="radio" class="form-check-input{{ $errors->has('tipe_kos') ? ' is -invalid' : '' }}"
                                            name="tipe_kos" value="Campur" required>
                                            <label for="tipe_kos_campur" class="form-check-label">Campur</label>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        {!! $errors->first('tipe_kos', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    {{-- input sewa kos --}}
                    <div class="form-group">
                        <label for="harga_sewa" class="control-label">{{ __('outlet.price') }}</label>
                        <input id="harga_sewa" type="text" class="form-control{{ $errors->has('harga_sewa') ? ' is-invalid' : '' }}"
                            name="harga_sewa" value="{{ old('harga_sewa') }}" required>
                        {!! $errors->first('harga_sewa', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    {{-- input sisa kamar kos --}}
                    <div class="form-group">
                        <label for="sisa_kamar" class="control-label">{{ __('outlet.room') }}</label>
                        <input id="sisa_kamar" type="text" class="form-control{{ $errors->has('sisa_kamar') ? ' is-invalid' : '' }}"
                            name="sisa_kamar" value="{{ old('sisa_kamar') }}" required>
                        {!! $errors->first('sisa_kamar', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    {{-- input fasilitas kos --}}
                    <div class="form-group">
                        <label for="fasilitas" class="control-label">{{ __('outlet.facility') }}</label>
                        <textarea id="fasilitas" class="form-control{{ $errors->has('fasilitas') ? ' is-invalid' : '' }}"
                                name="fasilitas" rows="4">{{ old('fasilitas') }}</textarea>
                        {!! $errors->first('fasilitas', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="latitude" class="control-label">{{ __('outlet.latitude') }}</label>
                                <input id="latitude" type="text" class="form-control{{ $errors->has('latitude') ? ' is-invalid' : '' }}" name="latitude" value="{{ old('latitude', request('latitude')) }}" required>
                                {!! $errors->first('latitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="longitude" class="control-label">{{ __('outlet.longitude') }}</label>
                                <input id="longitude" type="text" class="form-control{{ $errors->has('longitude') ? ' is-invalid' : '' }}" name="longitude" value="{{ old('longitude', request('longitude')) }}" required>
                                {!! $errors->first('longitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div id="mapid"></div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('outlet.create') }}" class="btn btn-success">
                    <a href="{{ route('outlets.index') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin=""/>

<style>
    #mapid { height: 300px; }
</style>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>
<script>
    var mapCenter = [{{ request('latitude', config('leaflet.map_center_latitude')) }}, {{ request('longitude', config('leaflet.map_center_longitude')) }}];
    var map = L.map('mapid').setView(mapCenter, {{ config('leaflet.zoom_level') }});

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker(mapCenter).addTo(map);
    function updateMarker(lat, lng) {
        marker
        .setLatLng([lat, lng])
        .bindPopup("Your location :  " + marker.getLatLng().toString())
        .openPopup();
        return false;
    };

    map.on('click', function(e) {
        let latitude = e.latlng.lat.toString().substring(0, 15);
        let longitude = e.latlng.lng.toString().substring(0, 15);
        $('#latitude').val(latitude);
        $('#longitude').val(longitude);
        updateMarker(latitude, longitude);
    });

    var updateMarkerByInputs = function() {
        return updateMarker( $('#latitude').val() , $('#longitude').val());
    }
    $('#latitude').on('input', updateMarkerByInputs);
    $('#longitude').on('input', updateMarkerByInputs);
</script>
@endpush
