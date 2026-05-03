<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LENTERA</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}body{font-family:Inter,sans-serif;background:#f5f6f8;color:#0d2b4d}a{text-decoration:none;color:inherit}.wrap{max-width:1180px;margin:auto;padding:0 24px}.nav{height:82px;display:flex;align-items:center;justify-content:space-between}.logo{font-weight:800;font-size:20px}.menu{display:flex;gap:28px;font-size:14px;color:#7b8794}.menu .on{color:#0d2b4d;font-weight:700;position:relative}.menu .on:after{content:'';position:absolute;left:0;right:0;bottom:-12px;height:2px;background:#f7b733}.pill{padding:11px 20px;border-radius:999px;font-weight:700;font-size:14px}.dark{background:#0d2b4d;color:#fff}.light{background:#fff;border:1px solid #e7eaee}.hero{padding:70px 0 130px;text-align:center}.tag{display:inline-block;background:#fff8e8;color:#9a6b00;font-size:12px;padding:8px 14px;border-radius:999px;margin-bottom:24px}.hero h1{font-size:66px;line-height:1.02;max-width:760px;margin:0 auto 16px;font-weight:800}.hero p{max-width:700px;margin:auto;color:#6b7280;line-height:1.8}.btns{display:flex;justify-content:center;gap:14px;margin-top:28px}.box{background:#fff;border-radius:34px;padding:38px}.section{padding:70px 0}.title{font-size:38px;font-weight:800;margin-bottom:10px}.muted{color:#6b7280;line-height:1.8}.cards{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;margin-top:30px}.card{background:#fbfcfe;border:1px solid #eef2f6;border-radius:24px;padding:24px}.ic{width:44px;height:44px;border-radius:14px;display:flex;align-items:center;justify-content:center;background:#eef2ff;margin-bottom:16px}.card h3{font-size:18px;margin-bottom:8px}.impact{display:grid;grid-template-columns:1.15fr .85fr;gap:24px;align-items:center}.stats{display:grid;gap:16px}.stat{background:#fff;border-radius:24px;padding:24px;box-shadow:0 10px 30px rgba(0,0,0,.03)}.small{font-size:13px;color:#6b7280}.big{font-size:36px;font-weight:800;margin-top:6px}.avatars{margin-top:22px}.avatars span{display:inline-block;width:38px;height:38px;border-radius:50%;background:#dbeafe;border:2px solid #fff;margin-right:-10px}.foot{padding:60px 0;color:#6b7280}.cols{display:grid;grid-template-columns:1fr 1fr 1fr;gap:20px}.cols strong{color:#0d2b4d}@media(max-width:900px){.hero h1{font-size:44px}.cards,.impact,.cols{grid-template-columns:1fr}.menu{display:none}}
html{scroll-behavior:smooth}.navfix{position:sticky;top:0;z-index:50;background:rgba(245,246,248,.75);backdrop-filter:blur(12px)}.reveal{opacity:0;transform:translateY(28px);transition:all .8s ease}.reveal.show{opacity:1;transform:none}.chart{height:180px;display:flex;align-items:flex-end;gap:12px;margin-top:14px}.bar{flex:1;border-radius:16px 16px 6px 6px;background:linear-gradient(180deg,#1d4ed8,#60a5fa)}.testi{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;margin-top:28px}.quote{background:#fff;border-radius:24px;padding:22px;box-shadow:0 10px 30px rgba(0,0,0,.03)}@media(max-width:900px){.testi{grid-template-columns:1fr}}
body:before{content:'';position:fixed;inset:-20%;background:radial-gradient(circle at 20% 20%,rgba(59,130,246,.10),transparent 30%),radial-gradient(circle at 80% 10%,rgba(245,158,11,.10),transparent 28%),radial-gradient(circle at 70% 70%,rgba(16,185,129,.08),transparent 30%);z-index:-1;animation:bgmove 18s linear infinite}@keyframes bgmove{0%{transform:translate(0,0)}50%{transform:translate(-2%,2%)}100%{transform:translate(0,0)}}.float{animation:float 4s ease-in-out infinite}@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}.glow{box-shadow:0 20px 50px rgba(13,43,77,.12)}.card:hover,.quote:hover,.stat:hover{transform:translateY(-8px);transition:.35s ease}.cursor{position:fixed;width:18px;height:18px;border-radius:50%;background:rgba(13,43,77,.12);pointer-events:none;z-index:99;transform:translate(-50%,-50%)}
</style>
</head>
<body>
<header class="wrap nav navfix">
<div class="logo">LENTERA</div>
<nav class="menu"><a class="on">Home</a><a>Dashboard</a><a>Bantuan</a><a>Pengajuan</a></nav>
<div style="display:flex;gap:10px;align-items:center"><a style="font-size:14px">Login</a><a class="pill dark">Register</a></div>
</header>
<section class="hero wrap reveal">
<div class="tag">✦ CAKUPAN BANTUAN RESMI</div>
<h1>Transparansi Bantuan untuk Semua</h1>
<p>LENTERA hadir sebagai jembatan kepercayaan antara pemerintah dan masyarakat. Memastikan setiap bantuan sampai ke tangan yang tepat dengan kebijakan penuh.</p>
<div class="btns float"><a class="pill dark">Ajukan Bantuan →</a><a class="pill light">Lihat Dashboard</a></div>
</section>
<section class="section reveal">
<div class="wrap box glow">
<div class="title">Pilar Transparansi Kami</div>
<p class="muted">Memberdayakan masyarakat melalui akses informasi yang mudah, akurat, dan dapat dipertanggungjawabkan.</p>
<div class="cards">
<div class="card"><div class="ic">⚡</div><h3>Bantuan Cepat</h3><p class="muted">Proses pengajuan yang lebih ringan dengan verifikasi cepat dan status real-time.</p></div>
<div class="card"><div class="ic" style="background:#ecfdf5">💵</div><h3>Transparansi Dana</h3><p class="muted">Lihat setiap distribusi dana bantuan dan progres penyaluran.</p></div>
<div class="card"><div class="ic" style="background:#fff7ed">📝</div><h3>Pelaporan Mudah</h3><p class="muted">Laporkan penyalahgunaan langsung melalui portal resmi.</p></div>
</div>
</div>
</section>
<section class="section reveal">
<div class="wrap impact">
<div>
<div class="title">Dampak Nyata Dalam Angka Terbuka</div>
<p class="muted">Kepercayaan adalah fondasi utama LENTERA. Melalui dashboard publik, siapapun dapat memantau efektivitas program bantuan secara langsung.</p>
<div class="avatars"><span></span><span></span><span></span><span></span></div>
<div class="small" style="margin-top:10px">10,000+ bantuan tervalidasi dan sudah tersalurkan</div>
</div>
<div class="stats">
<div class="stat"><div class="small">Distribusi 6 Bulan</div><div class="chart"><div class="bar" style="height:40%"></div><div class="bar" style="height:62%"></div><div class="bar" style="height:55%"></div><div class="bar" style="height:78%"></div><div class="bar" style="height:88%"></div><div class="bar" style="height:96%"></div></div></div>
<div class="stat glow"><div class="small">Total Bantuan Disalurkan</div><div class="big">Rp {{ number_format($totalDana ?? 12400000000000,0,',','.') }}</div></div>
<div class="stat glow"><div class="small">Penerima Manfaat</div><div class="big">{{ number_format($totalPenerima ?? 4200000,0,',','.') }}</div></div>
<div class="stat glow"><div class="small">Data Tersinkron Real-Time</div><div class="big">100%</div></div>
</div>
</div>
</section>
<section class="section reveal">
<div class="wrap box glow">
<div class="title">Suara Masyarakat</div>
<p class="muted">Cerita nyata dari penerima manfaat dan warga yang memantau distribusi bantuan.</p>
<div class="testi">
<div class="quote"><strong>Siti Rahma</strong><p class="muted" style="margin-top:10px">Pengajuan lebih cepat dan status bantuan jelas. Tidak perlu datang berkali-kali.</p></div>
<div class="quote"><strong>Budi Santoso</strong><p class="muted" style="margin-top:10px">Dashboard publik membantu kami memantau penyaluran di wilayah kami.</p></div>
<div class="quote"><strong>Rina Kartika</strong><p class="muted" style="margin-top:10px">Pelaporan digital membuat penyalahgunaan lebih cepat ditindak.</p></div>
</div>
</div>
</section>
<footer class="wrap foot">
<div class="cols">
<div><strong>LENTERA</strong><div class="small" style="margin-top:10px">Menjaga amanah negara lewat inovasi digital transparan.</div></div>
<div><strong>Navigasi</strong><div class="small" style="margin-top:10px">Tentang Kami<br>Dashboard Publik<br>Kontak</div></div>
<div><strong>Hubungi Kami</strong><div class="small" style="margin-top:10px">Gedung Nusantara Lt.12<br>support@lentera.id</div></div>
</div>
</footer>
<div class='cursor' id='cursor'></div><script>
document.addEventListener('mousemove',e=>{const c=document.getElementById('cursor');c.style.left=e.clientX+'px';c.style.top=e.clientY+'px';});const obs=new IntersectionObserver(es=>{es.forEach(e=>{if(e.isIntersecting)e.target.classList.add('show')})},{threshold:.12});document.querySelectorAll('.reveal').forEach(el=>obs.observe(el));
function countUp(el,target,prefix=''){let n=0;const step=Math.ceil(target/60);const run=()=>{n=Math.min(target,n+step);el.textContent=prefix+n.toLocaleString('id-ID');if(n<target)requestAnimationFrame(run)};run();}
window.addEventListener('load',()=>{document.body.classList.add('loaded');});window.addEventListener('load',()=>{document.querySelectorAll('.big').forEach((el,i)=>{if(i==0)countUp(el,{{ $totalDana ?? 12400000000000 }},'Rp ');if(i==1)countUp(el,{{ $totalPenerima ?? 4200000 }},'');});});
</script>
</body>
</html>