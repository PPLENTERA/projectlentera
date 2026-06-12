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

<!-- FORM -->
<div class="bg-white p-6 rounded-3xl shadow-sm h-fit">

<form method="POST" action="{{ url('/admin/lokasi-bantuan/save') }}" class="space-y-5">
@csrf

<div>
<label class="block mb-2 text-sm font-semibold text-slate-700">
Penerima Bantuan
</label>

<select
name="recipient_id"
class="w-full border border-slate-300 rounded-xl px-4 py-3">

<option selected disabled>Pilih Penerima Bantuan</option>

@foreach($data as $d)
<option value="{{ $d->id }}">
{{ $d->name }}
</option>
@endforeach

</select>
</div>

<div>
<label class="block mb-2 text-sm font-semibold text-slate-700">
Latitude
</label>

<input
type="text"
id="latitude"
name="latitude"
readonly
class="w-full border border-slate-300 rounded-xl px-4 py-3 bg-slate-50">
</div>

<div>
<label class="block mb-2 text-sm font-semibold text-slate-700">
Longitude
</label>

<input
type="text"
id="longitude"
name="longitude"
readonly
class="w-full border border-slate-300 rounded-xl px-4 py-3 bg-slate-50">
</div>

<button
type="submit"
class="w-full bg-cyan-600 text-white py-3 rounded-xl">
📍 Simpan Lokasi
</button>

</form>

</div>

<!-- MAP -->
<div class="lg:col-span-2 bg-white p-4 rounded-3xl shadow-sm">

<div class="mb-4">
<h3 class="text-lg font-semibold">
Peta Persebaran Bantuan
</h3>
<p class="text-sm text-slate-500">
Klik peta untuk menentukan koordinat
</p>
</div>

<div id="map"></div>

</div>
</div>
<style>
#map{
    height:700px;
    border-radius:16px;
}
</style>
<link rel="stylesheet"
href="https://unpkg.com/leaflet/dist/leaflet.css"/>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
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