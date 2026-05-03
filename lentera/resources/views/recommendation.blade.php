<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>LENTERA</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:Inter,sans-serif;background:#f3f4f6;color:#1f2937}

/* LAYOUT */
.layout{display:flex}

/* SIDEBAR */
.sidebar{
    width:240px;
    height:100vh;
    background:#fff;
    padding:25px;
    border-right:1px solid #eee;
}
.logo{font-weight:700;font-size:20px;margin-bottom:30px}
.menu a{
    display:block;
    padding:10px;
    border-radius:10px;
    margin-bottom:8px;
    text-decoration:none;
    color:#555;
}
.menu a.active{
    background:#eef2ff;
    color:#4f46e5;
    font-weight:600;
}

/* MAIN */
.main{flex:1;padding:30px}

/* HEADER */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}
.search{
    padding:10px 15px;
    border-radius:20px;
    border:1px solid #ddd;
    width:250px;
}

/* FILTER */
.filter-box{
    background:#fff;
    padding:20px;
    border-radius:20px;
    display:flex;
    gap:15px;
    margin-bottom:20px;
}
.filter-box select{
    padding:12px;
    border-radius:10px;
    border:1px solid #ddd;
}
.filter-btn{
    background:#0f2a44;
    color:#fff;
    padding:12px 20px;
    border-radius:20px;
    border:none;
}

/* CARD */
.card{
    background:#f9fafb;
    border-radius:30px;
    padding:18px 25px;
    margin-bottom:15px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    position:relative;
}

/* garis kuning kiri */
.card.high::before{
    content:'';
    position:absolute;
    left:0;
    top:10%;
    bottom:10%;
    width:6px;
    border-radius:10px;
    background:#facc15;
}

/* LEFT */
.left{display:flex;align-items:center;gap:15px}
.rank{
    background:#e5e7eb;
    padding:10px 14px;
    border-radius:50%;
    font-weight:600;
}
.avatar{
    width:45px;
    height:45px;
    border-radius:50%;
    object-fit:cover;
}
.name{font-weight:600}
.meta{font-size:12px;color:#6b7280}

/* RIGHT */
.right{
    display:flex;
    align-items:center;
    gap:20px;
}
.score-box{text-align:center}
.score{font-size:22px;font-weight:700}
.score-label{font-size:10px;color:#6b7280}

/* BADGE */
.badge{
    padding:6px 14px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}
.high-badge{background:#fde68a;color:#92400e}
.medium-badge{background:#c7d2fe;color:#1e3a8a}
.low-badge{background:#e5e7eb;color:#6b7280}

/* BUTTON */
.btn-primary{
    background:#0f2a44;
    color:#fff;
    padding:12px 18px;
    border-radius:25px;
    border:none;
}
.btn-secondary{
    background:#e5e7eb;
    color:#374151;
    padding:12px 18px;
    border-radius:25px;
    border:none;
}
</style>
</head>

<body>

<div class="layout">

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="logo">LENTERA</div>

    <div class="menu">
        <a href="#">Dashboard</a>
        <a href="#">Verifikasi</a>
        <a class="active" href="#">Rekomendasi</a>
        <a href="#">Laporan</a>
    </div>
</div>

<!-- MAIN -->
<div class="main">

    <!-- HEADER -->
    <div class="header">
        <div>
            <h2>Rekomendasi Prioritas</h2>
            <small style="color:gray">Analysis of high-eligibility applicants</small>
        </div>

        <input class="search" placeholder="Cari pemohon...">
    </div>

    <!-- FILTER -->
    <div class="filter-box">
        <select>
            <option>Semua Wilayah</option>
        </select>

        <select>
            <option>Semua Bantuan</option>
        </select>

        <button class="filter-btn">Apply Filters</button>
    </div>

    <!-- LIST -->
    @foreach($data as $i => $d)

    @php
        $priority = $d->score >= 80 ? 'high' : ($d->score >= 60 ? 'medium' : 'low');
    @endphp

    <div class="card {{ $priority == 'high' ? 'high' : '' }}">

        <!-- LEFT -->
        <div class="left">
            <div class="rank">{{ str_pad($i+1,2,'0',STR_PAD_LEFT) }}</div>

            <img class="avatar"
                 src="{{ $d->photo ? asset('storage/'.$d->photo) : 'https://ui-avatars.com/api/?name='.$d->name }}">

            <div>
                <div class="name">{{ $d->name }}</div>
                <div class="meta">
                    {{ $d->address ?? 'Alamat belum ada' }}
                </div>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="right">

            <div class="score-box">
                <div class="score">{{ number_format($d->score,1) }}</div>
                <div class="score-label">ELIGIBILITY SCORE</div>
            </div>

            @if($priority == 'high')
                <div class="badge high-badge">● HIGH PRIORITY</div>
                <button class="btn-primary">Recommend for Approval</button>
            @elseif($priority == 'medium')
                <div class="badge medium-badge">MEDIUM PRIORITY</div>
                <button class="btn-secondary">Review Detailed</button>
            @else
                <div class="badge low-badge">LOW PRIORITY</div>
                <button class="btn-secondary">Review Detailed</button>
            @endif

        </div>

    </div>

    @endforeach

</div>
</div>

</body>
</html>