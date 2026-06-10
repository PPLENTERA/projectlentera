<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Statistik Bantuan Publik</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial,sans-serif;
}

body{
background:#f4f6f9;
padding:30px;
}

.header{
margin-bottom:30px;
}

.header h1{
font-size:32px;
color:#0f2a44;
}

.header p{
color:#666;
margin-top:8px;
}

.cards{
display:grid;
grid-template-columns:repeat(4,1fr);
gap:20px;
margin-bottom:30px;
}

.card{
background:white;
padding:25px;
border-radius:20px;
box-shadow:0 5px 15px rgba(0,0,0,.05);
text-align:center;
}

.number{
font-size:42px;
font-weight:bold;
color:#0f2a44;
}

.chart-box,
.table-box{
background:white;
padding:25px;
border-radius:20px;
box-shadow:0 5px 15px rgba(0,0,0,.05);
margin-bottom:30px;
}

table{
width:100%;
border-collapse:collapse;
}

th{
background:#0f2a44;
color:white;
padding:12px;
}

td{
padding:12px;
border-bottom:1px solid #eee;
text-align:center;
}

</style>

</head>
<body>

<div class="header">
<h1>📊 Statistik Bantuan Publik</h1>
<p>Informasi distribusi bantuan untuk masyarakat</p>
</div>

<div class="cards">

<div class="card">
<div class="number">{{ $total }}</div>
<div>Total Penerima</div>
</div>

<div class="card">
<div class="number">{{ $tinggi }}</div>
<div>Prioritas Tinggi</div>
</div>

<div class="card">
<div class="number">{{ $sedang }}</div>
<div>Prioritas Sedang</div>
</div>

<div class="card">
<div class="number">{{ $rendah }}</div>
<div>Prioritas Rendah</div>
</div>

</div>

<div class="chart-box">

<h3>Distribusi Penerima Bantuan</h3>

<br>

<canvas id="chart"></canvas>

</div>

<div class="table-box">

<h3>Jenis Bantuan yang Disalurkan</h3>

<br>

<table>

<tr>
<th>Jenis Bantuan</th>
<th>Total</th>
</tr>

@foreach($jenisBantuan as $item)

<tr>
<td>{{ $item['nama'] }}</td>
<td>{{ $item['total'] }}</td>
</tr>

@endforeach

</table>

</div>

<script>

new Chart(
document.getElementById('chart'),
{
type:'bar',
data:{
labels:[
'Tinggi',
'Sedang',
'Rendah'
],
datasets:[{
label:'Jumlah Penerima',
data:[
{{ $tinggi }},
{{ $sedang }},
{{ $rendah }}
]
}]
}
}
);

</script>

</body>
</html>