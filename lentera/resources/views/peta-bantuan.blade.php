<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Peta Persebaran Bantuan</title>

<link rel="stylesheet"
href="https://unpkg.com/leaflet/dist/leaflet.css"/>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<style>

body{
font-family:Inter,sans-serif;
margin:0;
background:#f5f6f8;
}

.header{
padding:20px 30px;
background:#0d2b4d;
color:white;
}

#map{
height:90vh;
}

</style>

</head>

<body>

<div class="header">
<h2>Persebaran Bantuan Bojongsoang</h2>
<p>Lihat lokasi penerima bantuan secara transparan</p>
</div>

<div id="map"></div>

<script>

var map = L.map('map')
.setView([-6.9735,107.6332],13);

L.tileLayer(
'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
{
maxZoom:19
}
).addTo(map);

@foreach($data as $d)

L.marker([
{{ $d->latitude }},
{{ $d->longitude }}
])

.addTo(map)

.bindPopup(`
<b>{{ $d->name }}</b>
<br>
{{ $d->address ?? 'Alamat belum tersedia' }}
<br>
Score : {{ $d->score }}
`);

@endforeach

</script>

</body>
</html>