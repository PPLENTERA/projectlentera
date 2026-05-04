<div class="fixed inset-x-0 top-0 z-50 flex justify-center px-4 py-4 sm:px-6 lg:px-10">
    <div class="w-full max-w-7xl rounded-[2.5rem] border border-white/70 bg-white/90 shadow-[0_8px_32px_rgba(30,58,95,0.08)] backdrop-blur-3xl">
        <div class="flex flex-wrap items-center justify-between gap-6 px-6 py-4 lg:px-8">
            <a href="{{ url('/') }}" class="text-slate-950 text-lg font-bold tracking-[-0.5px]">LENTERA</a>

            <nav class="flex flex-wrap items-center gap-8 text-sm font-medium">
                <a href="#" class="text-slate-500 transition hover:text-slate-950">Dashboard</a>
                <a href="#" class="text-slate-500 transition hover:text-slate-950">Verifikasi</a>
                <a href="{{ route('feedback.create') }}" class="text-slate-950 border-b-2 border-[#f9bd22] pb-1">Pelaporan</a>
                <a href="#" class="text-slate-500 transition hover:text-slate-950">Laporan</a>
            </nav>

            <div class="flex items-center gap-3">
                <button type="button" class="flex h-11 w-11 items-center justify-center rounded-full bg-slate-100 text-slate-700 transition hover:bg-slate-200">
                    <span class="text-base font-semibold">D</span>
                </button>
                <button type="button" class="flex h-11 w-11 items-center justify-center rounded-full bg-slate-100 text-slate-700 transition hover:bg-slate-200">
                    <span class="text-base font-semibold">N</span>
                </button>
                <div class="flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 bg-slate-100 text-slate-950 font-semibold">A</div>
            </div>
        </div>
    </div>
</div>
