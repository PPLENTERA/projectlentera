<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Statistik Bantuan</title>

<style>

body{
font-family:Arial,sans-serif;
background:#f5f6f8;
padding:30px;
}

.card{
background:white;
padding:25px;
border-radius:20px;
box-shadow:0 5px 15px rgba(0,0,0,.05);
}

table{
width:100%;
border-collapse:collapse;
margin-top:20px;
}

th{
background:#0f2a44;
color:white;
padding:12px;
}

td{
padding:12px;
border-bottom:1px solid #ddd;
}

</style>

</head>

<body>

<div class="card">

<h2>Statistik Distribusi Bantuan</h2>

<table>

<tr>
<th>Wilayah</th>
<th>Total Bantuan</th>
</tr>

@foreach($data as $d)

<tr>
<td>{{ $d->address }}</td>
<td>{{ $d->total }}</td>
</tr>

@endforeach

</table>

</div>

</body>
</html>