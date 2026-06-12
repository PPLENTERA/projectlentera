@extends('layouts.admin')

@section('title', 'Lokasi Bantuan')

@section('content')

<h1 class="text-3xl font-bold text-slate-800 mb-2">
📍 Lokasi Bantuan
</h1>

<p class="text-slate-500 mb-6">
Kelola titik koordinat penerima bantuan di wilayah Bojongsoang
</p>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

<div class="bg-white p-6 rounded-3xl shadow-sm">

<form method="POST" action="{{ url('/admin/lokasi-bantuan/save') }}">
@csrf

<label>Penerima Bantuan</label>

<select name="recipient_id">

@foreach($data as $d)

<option value="{{ $d->id }}">
{{ $d->name }}
</option>

@endforeach

</select>

<label>Latitude</label>
<input
type="text"
id="latitude"
name="latitude"
readonly>

<label>Longitude</label>
<input
type="text"
id="longitude"
name="longitude"
readonly>

<button type="submit">
Simpan Lokasi
</button>

</form>

</div>

<div class="lg:col-span-2 bg-white p-4 rounded-3xl shadow-sm">
    <div id="map"></div>
</div>

</div>
<style>
#map{
    height:700px;
    border-radius:16px;
}
</style>
<script>

var map = L.map('map')
.setView([-6.9735,107.6332],13);

L.tileLayer(
'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
{
maxZoom:19
}
).addTo(map);

var marker;

map.on('click', function(e){

if(marker){
map.removeLayer(marker);
}

marker = L.marker(e.latlng)
.addTo(map);

document.getElementById('latitude').value =
e.latlng.lat;

document.getElementById('longitude').value =
e.latlng.lng;

});

</script>

@endsection