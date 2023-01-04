@extends('layouts.app')

@section('title', __('outlet.detail'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header">{{ __('outlet.detail') }}</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr>
                            <td colspan="2" style="text-align: center">
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                      <div class="carousel-item active">
                                        <img src="data:image/jpeg;base64,{{$outlet->file_foto_kos}}" class="img-fluid rounded" style="height: 50vh"/>
                                      </div>
                                      <div class="carousel-item">
                                        <img src="data:image/jpeg;base64,{{$outlet->file_foto_kamar}}" class="img-fluid rounded" style="height: 50vh"/>
                                      </div>
                                    </div>

                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                      <span class="sr-only">Previous</span>
                                    </a>

                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                      <span class="sr-only">Next</span>
                                    </a>
                                  </div>

                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">{{ __('outlet.name') }}</td>
                            <td>{{ $outlet->name }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('outlet.address') }}</td>
                            <td>{{ $outlet->address }}</td>
                        </tr>
                        <tr>
                            <td>Jarak Tempuh</td>
                            <td><span id="jarak"></span></td>
                        </tr>
                        <tr>
                            <td>{{ __('outlet.owner') }}</td>
                            <td>{{ $outlet->pemilik }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('outlet.contact') }}</td>
                            <td>{{ $outlet->kontak_pemilik }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('outlet.type') }}</td>
                            <td>{{ $outlet->tipe_kos }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('outlet.price') }}</td>
                            <td>{{ $outlet->harga_sewa }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('outlet.room') }}</td>
                            <td>{{ $outlet->sisa_kamar }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('outlet.facility') }}</td>
                            <td>{{ $outlet->fasilitas }}</td>
                        </tr>

                        @if(auth()->check())
                        <tr>
                            <td>{{ __('outlet.latitude') }}</td>
                            <td>{{ $outlet->latitude }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('outlet.longitude') }}</td>
                            <td>{{ $outlet->longitude }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @can('update', $outlet)
                    <a href="{{ route('outlets.edit', $outlet) }}" id="edit-outlet-{{ $outlet->id }}" class="btn btn-warning">{{ __('outlet.edit') }}</a>
                @endcan
                @if(auth()->check())
                    <a href="{{ route('outlets.index') }}" class="btn btn-link">{{ __('outlet.back_to_index') }}</a>
                @else
                    <a href="{{ route('outlet_map.index') }}" class="btn btn-link">{{ __('outlet.back_to_index') }}</a>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-1">
            <div class="card-header">{{ trans('outlet.location') }}</div>
            @if ($outlet->coordinate)
            <div class="card-body" id="mapid"></div>
            @else
            <div class="card-body">{{ __('outlet.no_coordinate') }}</div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

<style>
    #mapid { height: 400px; }
</style>
@endsection

@push('scripts')
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

<script>
    var map = L.map('mapid').setView([{{ $outlet->latitude }}, {{ $outlet->longitude }}], {{ config('leaflet.detail_zoom_level') }});

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    L.marker([{{ $outlet->latitude }}, {{ $outlet->longitude }}]).addTo(map)
        .bindPopup('{!! $outlet->map_popup_content !!}');

    // Pin ITTP
    var markerITTP = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    })
    // end

    // routing
    var route = L.Routing.control({
        lineOptions: {
            addWaypoints: false,
            styles: [{color: "#00b0ff", opacity: 1, weight: 5}]
        },
        waypoints: [
            L.latLng([{{ $outlet->latitude }},{{ $outlet->longitude }}], {icon: markerITTP}),
            L.latLng([-7.434682463125, 109.25178319215])
        ],
        routeWhileDragging: false
        }).addTo(map);

    route.on('routesfound', function(e) {
        var routes = e.routes;
        var summary = routes[0].summary;
        document.getElementById("jarak").innerHTML = Math.round(summary.totalDistance) / 1000 +' Km';
    });
    route.hide();
    //end
</script>
@endpush
