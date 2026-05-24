<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Lokasi Bantuan</title>

<link rel="stylesheet"
href="https://unpkg.com/leaflet/dist/leaflet.css"/>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<style>
body{
font-family:Arial,sans-serif;
background:#f3f4f6;
padding:20px;
}

.container{
display:grid;
grid-template-columns:350px 1fr;
gap:20px;
}

.card{
background:white;
padding:20px;
border-radius:15px;
}

#map{
height:700px;
border-radius:15px;
}

input,select{
width:100%;
padding:10px;
margin-bottom:15px;
}

button{
background:#0f2a44;
color:white;
padding:12px;
border:none;
border-radius:10px;
cursor:pointer;
}
</style>

</head>
<body>

<h2>Lokasi Bantuan</h2>

<div class="container">

<div class="card">

<form method="POST" action="/lokasi-bantuan/save">
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

<div id="map"></div>

</div>

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

</body>
</html>