<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LENTERA</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}body{font-family:Inter,sans-serif;background:#f5f6f8;color:#0d2b4d}a{text-decoration:none;color:inherit}.wrap{max-width:1180px;margin:auto;padding:0 24px}.nav{height:82px;display:flex;align-items:center;justify-content:space-between}.logo{font-weight:800;font-size:20px}.pill{padding:11px 20px;border-radius:999px;font-weight:700;font-size:14px}.dark{background:#0d2b4d;color:#fff}.light{background:#fff;border:1px solid #e7eaee}.hero{padding:70px 0 130px;text-align:center}.tag{display:inline-block;background:#fff8e8;color:#9a6b00;font-size:12px;padding:8px 14px;border-radius:999px;margin-bottom:24px}.hero h1{font-size:66px;line-height:1.02;max-width:760px;margin:0 auto 16px;font-weight:800}.hero p{max-width:700px;margin:auto;color:#6b7280;line-height:1.8}.btns{display:flex;justify-content:center;gap:14px;margin-top:28px}@media(max-width:900px){.hero h1{font-size:44px}}
html{scroll-behavior:smooth}.navfix{position:sticky;top:0;z-index:50;background:rgba(245,246,248,.75);backdrop-filter:blur(12px)}.reveal{opacity:0;transform:translateY(28px);transition:all .8s ease}.reveal.show{opacity:1;transform:none}
body:before{content:'';position:fixed;inset:-20%;background:radial-gradient(circle at 20% 20%,rgba(59,130,246,.10),transparent 30%),radial-gradient(circle at 80% 10%,rgba(245,158,11,.10),transparent 28%),radial-gradient(circle at 70% 70%,rgba(16,185,129,.08),transparent 30%);z-index:-1;animation:bgmove 18s linear infinite}@keyframes bgmove{0%{transform:translate(0,0)}50%{transform:translate(-2%,2%)}100%{transform:translate(0,0)}}.float{animation:float 4s ease-in-out infinite}@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}.glow{box-shadow:0 20px 50px rgba(13,43,77,.12)}.cursor{position:fixed;width:18px;height:18px;border-radius:50%;background:rgba(13,43,77,.12);pointer-events:none;z-index:99;transform:translate(-50%,-50%)}
</style>
</head>
<body>
<header class="wrap nav navfix">
<div class="logo">LENTERA</div>
<div style="display:flex;gap:10px;align-items:center">
@auth
    @if(auth()->user()->role === 'admin')
        <span class="pill dark" style="cursor: default;">Admin</span>
    @else
        <span class="pill dark" style="cursor: default;">Masyarakat</span>
    @endif
    <a href="{{ url('/logout') }}">Logout</a>
@else
    <a href="{{ url('/login') }}" style="margin-right:15px; font-weight: 500; font-size: 14px; color: #7b8794;">Login</a>
    <a href="{{ url('/register') }}" class="pill dark">Register</a>
@endauth
</div>
</header>
<section class="hero wrap reveal">
<div class="tag">✦ CAKUPAN BANTUAN RESMI</div>
<h1>Transparansi Bantuan untuk Semua</h1>
<p>LENTERA hadir sebagai jembatan kepercayaan antara pemerintah dan masyarakat. Memastikan setiap bantuan sampai ke tangan yang tepat dengan kebijakan penuh.</p>
<div class="btns float">

@guest

<a href="{{ url('/login') }}" class="pill dark">
    Masuk ke Sistem →
</a>

<a href="{{ url('/login') }}" class="pill light">
    Dashboard
</a>

@endguest

@auth

@if(auth()->user()->role === 'admin')

<a href="{{ url('/admin/dashboard') }}" class="pill dark">
    Dashboard Admin →
</a>

@else

<a href="{{ url('/masyarakat/dashboard') }}" class="pill dark">
    Dashboard Masyarakat →
</a>

@endif

<a href="{{ url('/statistik-publik') }}" class="pill light">
    Statistik Bantuan
</a>

@endauth

</div>
</section>
<div class='cursor' id='cursor'></div>
<script>
document.addEventListener('mousemove',e=>{const c=document.getElementById('cursor');c.style.left=e.clientX+'px';c.style.top=e.clientY+'px';});const obs=new IntersectionObserver(es=>{es.forEach(e=>{if(e.isIntersecting)e.target.classList.add('show')})},{threshold:.12});document.querySelectorAll('.reveal').forEach(el=>obs.observe(el));
window.addEventListener('load',()=>{document.body.classList.add('loaded');});
</script>
</body>
</html>
