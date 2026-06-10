<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Statistik Distribusi Bantuan</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Inter,sans-serif;
}

body{
background:#f4f6f9;
padding:30px;
}

.header{
margin-bottom:30px;
}

.header h1{
color:#0f2a44;
font-size:32px;
}

.header p{
color:#6b7280;
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
border-radius:24px;
box-shadow:0 10px 25px rgba(0,0,0,.05);
}

.card .number{
font-size:42px;
font-weight:800;
color:#0f2a44;
}

.card .label{
margin-top:10px;
color:#6b7280;
}

.chart{
background:white;
padding:30px;
border-radius:24px;
box-shadow:0 10px 25px rgba(0,0,0,.05);
}

.table-box{
margin-top:30px;
background:white;
padding:25px;
border-radius:24px;
box-shadow:0 10px 25px rgba(0,0,0,.05);
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

@media(max-width:900px){
.cards{
grid-template-columns:1fr;
}
}

</style>
</head>

<body>

<div class="header">
<h1>📊 Statistik Distribusi Bantuan</h1>
<p>Monitoring distribusi bantuan wilayah Bojongsoang</p>
</div>

<div class="cards">

<div class="card">
<div class="number">{{ $total }}</div>
<div class="label">Total Bantuan</div>
</div>

<div class="card">
<div class="number">{{ $mapped }}</div>
<div class="label">Sudah Dipetakan</div>
</div>

<div class="card">
<div class="number">{{ $unmapped }}</div>
<div class="label">Belum Dipetakan</div>
</div>

<div class="card">
<div class="number">{{ $coverage }}%</div>
<div class="label">Cakupan Lokasi</div>
</div>

</div>

<div class="chart">
<h3>Distribusi Bantuan Wilayah Bojongsoang</h3>
<br>
<canvas id="chart"></canvas>
</div>

<div class="table-box">

<h3>Ringkasan Wilayah</h3>

<br>

<table>

<tr>
<th>Wilayah</th>
<th>Total Bantuan</th>
<th>Dipetakan</th>
<th>Cakupan</th>
</tr>

<tr>
<td>Bojongsoang</td>
<td>{{ $total }}</td>
<td>{{ $mapped }}</td>
<td>{{ $coverage }}%</td>
</tr>

</table>

</div>

<script>

new Chart(
document.getElementById('chart'),
{
type:'bar',
data:{
labels:['Bojongsoang'],
datasets:[
{
label:'Total Bantuan',
data:[{{ $total }}]
},
{
label:'Sudah Dipetakan',
data:[{{ $mapped }}]
}
]
}
}
);

</script>

</body>
</html>