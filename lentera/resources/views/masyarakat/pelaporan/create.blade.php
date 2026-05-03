<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor Penyalahgunaan Bantuan | LENTERA</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --surface: rgba(255, 255, 255, 0.85);
            --surface-border: rgba(255, 255, 255, 0.5);
            --text-dark: #1e293b;
            --text-light: #64748b;
            --error: #ef4444;
            --success: #10b981;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #cbebff 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 2rem;
            box-sizing: border-box;
        }

        .glass-container {
            background: var(--surface);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--surface-border);
            border-radius: 24px;
            padding: 3rem;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1);
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .header h1 {
            color: var(--text-dark);
            font-size: 1.875rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
            letter-spacing: -0.025em;
        }

        .header p {
            color: var(--text-light);
            font-size: 1rem;
            margin: 0;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            color: var(--text-dark);
            background: rgba(255, 255, 255, 0.9);
            transition: all 0.2s ease;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .file-upload {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            background: rgba(248, 250, 252, 0.5);
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
        }

        .file-upload:hover {
            border-color: var(--primary);
            background: rgba(239, 246, 255, 0.5);
        }

        .file-upload input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .file-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .file-text {
            color: var(--text-light);
            font-size: 0.95rem;
        }

        .file-text span {
            color: var(--primary);
            font-weight: 600;
        }

        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.125rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25);
            margin-top: 1rem;
        }

        .btn-submit:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #34d399;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #f87171;
            margin-top: 0.5rem;
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
            border-radius: 8px;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 1.5rem;
            color: var(--text-light);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: var(--primary);
        }

        .file-name-display {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: var(--text-dark);
            font-weight: 500;
            display: none;
        }

        @media (max-width: 640px) {
            .glass-container {
                padding: 2rem;
            }
        }
    </style>
</head>
<body>

    <div class="glass-container">
        <a href="{{ route('masyarakat.dashboard') }}" class="back-link">&larr; Kembali ke Dashboard</a>
        
        <div class="header">
            <h1>Lapor Penyalahgunaan</h1>
            <p>Bantu kami memastikan distribusi bantuan tepat sasaran dengan melaporkan indikasi kecurangan.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('masyarakat.pelaporan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="deskripsi_kejadian" class="form-label">Deskripsi Kejadian</label>
                <textarea id="deskripsi_kejadian" name="deskripsi_kejadian" class="form-control" placeholder="Jelaskan indikasi kecurangan yang Anda temui secara detail..." required>{{ old('deskripsi_kejadian') }}</textarea>
                @error('deskripsi_kejadian')
                    <div class="alert-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="lokasi_kejadian" class="form-label">Lokasi Kejadian</label>
                <input type="text" id="lokasi_kejadian" name="lokasi_kejadian" class="form-control" placeholder="Contoh: Desa Makmur, RT 01/RW 02" value="{{ old('lokasi_kejadian') }}" required>
                @error('lokasi_kejadian')
                    <div class="alert-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Unggah Bukti (Foto/Video)</label>
                <div class="file-upload">
                    <input type="file" id="bukti" name="bukti" accept="image/jpeg,image/png,video/mp4,video/quicktime" required onchange="showFileName(this)">
                    <div>
                        <div class="file-icon">📁</div>
                        <div class="file-text"><span>Klik untuk unggah</span> atau seret file ke sini</div>
                        <div style="font-size: 0.8rem; color: #94a3b8; margin-top: 0.25rem;">Maksimal 10MB (JPG, PNG, MP4)</div>
                    </div>
                </div>
                <div id="file-name" class="file-name-display">File terpilih: <span id="file-name-text"></span></div>
                @error('bukti')
                    <div class="alert-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Kirim Laporan</button>
        </form>
    </div>

    <script>
        function showFileName(input) {
            const fileNameDisplay = document.getElementById('file-name');
            const fileNameText = document.getElementById('file-name-text');
            if (input.files && input.files[0]) {
                fileNameText.textContent = input.files[0].name;
                fileNameDisplay.style.display = 'block';
            } else {
                fileNameDisplay.style.display = 'none';
            }
        }
    </script>
</body>
</html>