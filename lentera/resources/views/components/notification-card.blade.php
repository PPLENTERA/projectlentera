@php
    $isUnread = is_null($notification->read_at);
    $leftBorder = '';
    $iconBg = 'bg-slate-100 text-slate-500';

    if ($notification->type === 'status_update') {
        $iconBg = 'bg-blue-50 text-blue-600';
        if ($isUnread) {
            $leftBorder = 'border-l-4 border-l-blue-500';
        }
    } elseif ($notification->type === 'reminder') {
        $iconBg = 'bg-amber-50 text-amber-500';
        $leftBorder = 'border-l-4 border-l-[#F5A623]';
    } elseif ($notification->type === 'system_update') {
        $iconBg = 'bg-slate-100 text-slate-400';
        if ($isUnread) {
            $leftBorder = 'border-l-4 border-l-slate-400';
        }
    }
@endphp

@if($isUnread)
<form action="{{ route('masyarakat.notifikasi.read', $notification->id) }}" method="POST" id="read-form-{{ $notification->id }}" class="block">
    @csrf
@endif

<div 
    @if($isUnread) onclick="document.getElementById('read-form-{{ $notification->id }}').submit();" @endif
    class="bg-white rounded-3xl p-6 border border-[#E2E8F0] shadow-sm flex items-start gap-4 transition-all duration-300 hover:shadow-md hover:translate-x-1 {{ $leftBorder }} {{ $isUnread ? 'cursor-pointer hover:bg-slate-50' : '' }}"
>
    <!-- Icon Circle -->
    <div class="w-12 h-12 rounded-full flex-shrink-0 flex items-center justify-center font-bold text-lg {{ $iconBg }}">
        @if($notification->icon === 'check')
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
            </svg>
        @elseif($notification->icon === 'calendar')
            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
        @else
            <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.852l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"></path>
            </svg>
        @endif
    </div>

    <!-- Content Area -->
    <div class="flex-1 min-w-0">
        <div class="flex items-start justify-between gap-4">
            <h3 class="font-bold text-sm text-[#112340] sm:text-base truncate leading-snug">
                {{ $notification->title }}
            </h3>
            <span class="text-[10px] font-semibold text-[#94A3B8] uppercase whitespace-nowrap pt-1">
                {{ $notification->created_at->format('h:i A') }}
            </span>
        </div>
        
        <p class="text-xs sm:text-sm text-[#64748B] mt-1.5 leading-relaxed">
            {{ $notification->message }}
        </p>

        <!-- Dynamic elements based on notifications -->
        @if($notification->status_badge)
            <div class="mt-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-blue-50 text-blue-600 tracking-wider">
                    {{ $notification->status_badge }}
                </span>
            </div>
        @endif

        @if($notification->type === 'reminder')
            <div class="mt-4">
                <a href="#" class="inline-flex items-center text-xs font-bold text-[#3b82f6] hover:text-[#1d4ed8] transition-colors gap-1">
                    Lihat Lokasi Pengambilan
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        @endif
    </div>

    @if($isUnread)
        <!-- Unread Blue Dot -->
        <div class="w-2.5 h-2.5 rounded-full bg-blue-500 flex-shrink-0 mt-2"></div>
    @endif
</div>

@if($isUnread)
</form>
@endif
