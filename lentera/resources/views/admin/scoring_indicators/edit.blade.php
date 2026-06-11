<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Indikator - LENTERA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F3F4F6] min-h-screen p-6 font-['Inter']">

<div class="max-w-4xl mx-auto">

    <div class="mb-6 flex justify-between items-end">
        <div>
            <h1 class="text-2xl font-bold text-[#1C2C4E]">Ubah Indikator Penilaian</h1>
            <p class="text-sm text-slate-500 mt-1">Ubah kriteria aspek pengajuan bantuan dan aturan skor kelayakannya.</p>
        </div>
        <a href="{{ route('admin.scoring_indicators.index') }}" class="text-sm font-bold text-slate-500 hover:text-[#1C2C4E] transition-colors">
            &larr; Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 text-red-600 text-sm p-4 rounded-xl border border-red-100 mb-6 font-semibold shadow-xs">
            <p class="font-bold mb-1">Periksa kembali inputan Anda:</p>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.scoring_indicators.update', $indicator->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-6">
            <h2 class="text-sm font-bold text-slate-600 uppercase tracking-widest mb-4">Informasi Indikator</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">Nama Indikator</label>
                    <input type="text" name="name" value="{{ old('name', $indicator->name) }}" required
                           class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#1C2C4E] focus:bg-white transition-all outline-none"
                           placeholder="Contoh: Penghasilan Bulanan">
                </div>

                <div>
                    <label class="block text-[0.7rem] font-bold text-slate-600 uppercase tracking-widest mb-2">Kolom Database Terkait</label>
                    <select name="column_name" required
                            class="w-full px-4 py-3.5 bg-[#F0F2F5] rounded-xl text-sm font-medium text-slate-800 focus:ring-2 focus:ring-[#1C2C4E] focus:bg-white transition-all outline-none">
                        <option value="" disabled>Pilih kolom</option>
                        <option value="penghasilan" {{ old('column_name', $indicator->column_name) == 'penghasilan' ? 'selected' : '' }}>penghasilan (Desimal)</option>
                        <option value="jumlah_tanggungan" {{ old('column_name', $indicator->column_name) == 'jumlah_tanggungan' ? 'selected' : '' }}>jumlah_tanggungan (Integer)</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-sm font-bold text-slate-600 uppercase tracking-widest">Aturan Kriteria Skor</h2>
                <button type="button" onclick="addRuleRow()"
                        class="text-xs font-bold text-[#1F54CE] bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-xl transition-all">
                    + Aturan Baru
                </button>
            </div>

            <div class="overflow-x-auto -mx-6">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-left">
                            <th class="px-4 py-3 text-xs font-bold text-slate-400 uppercase tracking-widest w-[30%]">Label Aturan</th>
                            <th class="px-4 py-3 text-xs font-bold text-slate-400 uppercase tracking-widest w-[18%]">Operator</th>
                            <th class="px-4 py-3 text-xs font-bold text-slate-400 uppercase tracking-widest text-right w-[18%]">Nilai 1</th>
                            <th class="px-4 py-3 text-xs font-bold text-slate-400 uppercase tracking-widest text-right w-[18%]">Nilai 2 (Max)</th>
                            <th class="px-4 py-3 text-xs font-bold text-slate-400 uppercase tracking-widest text-right w-[10%]">Skor</th>
                            <th class="px-4 py-3 text-xs font-bold text-slate-400 uppercase tracking-widest text-center w-[6%]"></th>
                        </tr>
                    </thead>
                    <tbody id="rules-table-body" class="divide-y divide-slate-100">
                        <!-- Dynamic rows loaded here -->
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex gap-4">
            <a href="{{ route('admin.scoring_indicators.index') }}"
               class="flex-1 text-center py-3.5 rounded-xl text-sm font-bold text-slate-600 bg-white border border-slate-200 hover:bg-slate-50 transition-all">
                Batal
            </a>
            <button type="submit"
                    class="flex-1 flex justify-center items-center py-3.5 rounded-xl text-sm font-bold text-white bg-linear-to-r from-[#172545] to-[#1F335C] shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                Simpan Perubahan
            </button>
        </div>
    </form>

</div>

<script>
    let ruleIndex = 0;

    function addRuleRow(label = '', operator = '<', value = '', valueMax = '', score = '') {
        const tableBody = document.getElementById('rules-table-body');
        const row = document.createElement('tr');
        row.id = `rule-row-${ruleIndex}`;
        row.className = 'hover:bg-slate-50 transition-colors border-b border-slate-100';

        row.innerHTML = `
            <td class="px-4 py-3">
                <input type="text" name="rules[${ruleIndex}][label]" value="${label}" required
                       class="w-full px-3 py-2 bg-[#F0F2F5] rounded-xl text-xs font-semibold text-slate-800 focus:ring-2 focus:ring-[#1C2C4E] focus:bg-white outline-none"
                       placeholder="Label (contoh: Kurang dari 1 Juta)">
            </td>
            <td class="px-4 py-3">
                <select name="rules[${ruleIndex}][operator]" onchange="toggleValueMax(this, ${ruleIndex})" required
                        class="w-full px-3 py-2 bg-[#F0F2F5] rounded-xl text-xs font-bold text-slate-800 focus:ring-2 focus:ring-[#1C2C4E] focus:bg-white outline-none">
                    <option value="<" ${operator === '<' ? 'selected' : ''}>&lt;</option>
                    <option value="<=" ${operator === '<=' ? 'selected' : ''}>&lt;=</option>
                    <option value=">" ${operator === '>' ? 'selected' : ''}>&gt;</option>
                    <option value=">=" ${operator === '>=' ? 'selected' : ''}>&gt;=</option>
                    <option value="=" ${operator === '=' ? 'selected' : ''}>=</option>
                    <option value="between" ${operator === 'between' ? 'selected' : ''}>BETWEEN</option>
                </select>
            </td>
            <td class="px-4 py-3">
                <input type="number" name="rules[${ruleIndex}][value]" value="${value}" required
                       class="w-full px-3 py-2 bg-[#F0F2F5] rounded-xl text-xs font-semibold text-slate-800 focus:ring-2 focus:ring-[#1C2C4E] focus:bg-white outline-none text-right"
                       placeholder="Nilai 1">
            </td>
            <td class="px-4 py-3">
                <input type="number" id="value-max-${ruleIndex}" name="rules[${ruleIndex}][value_max]" value="${valueMax}"
                       ${operator !== 'between' ? 'disabled' : ''}
                       class="w-full px-3 py-2 bg-[#F0F2F5] rounded-xl text-xs font-semibold text-slate-800 focus:ring-2 focus:ring-[#1C2C4E] focus:bg-white outline-none text-right disabled:opacity-40"
                       placeholder="Nilai 2 (Max)">
            </td>
            <td class="px-4 py-3">
                <input type="number" name="rules[${ruleIndex}][score]" value="${score}" required
                       class="w-full px-3 py-2 bg-[#F0F2F5] rounded-xl text-xs font-bold text-slate-800 focus:ring-2 focus:ring-[#1C2C4E] focus:bg-white outline-none text-right"
                       placeholder="Skor">
            </td>
            <td class="px-4 py-3 text-center">
                <button type="button" onclick="removeRuleRow(${ruleIndex})"
                        class="text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 p-2.5 rounded-xl transition-all">
                    Hapus
                </button>
            </td>
        `;
        tableBody.appendChild(row);
        ruleIndex++;
    }

    function removeRuleRow(index) {
        const row = document.getElementById(`rule-row-${index}`);
        if (row) {
            row.remove();
        }
    }

    function toggleValueMax(selectElement, index) {
        const valueMaxField = document.getElementById(`value-max-${index}`);
        if (selectElement.value === 'between') {
            valueMaxField.removeAttribute('disabled');
            valueMaxField.setAttribute('required', 'required');
        } else {
            valueMaxField.setAttribute('disabled', 'disabled');
            valueMaxField.removeAttribute('required');
            valueMaxField.value = '';
        }
    }

    // Load existing rules into JS builder
    document.addEventListener('DOMContentLoaded', function() {
        @foreach($indicator->rules as $rule)
            addRuleRow(
                "{{ $rule->label }}",
                "{{ $rule->operator }}",
                "{{ (float)$rule->value }}",
                "{{ $rule->value_max ? (float)$rule->value_max : '' }}",
                "{{ $rule->score }}"
            );
        @endforeach

        if (ruleIndex === 0) {
            addRuleRow();
        }
    });
</script>

</body>
</html>
