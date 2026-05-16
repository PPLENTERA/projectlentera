<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Pelayanan | Lentera</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <style>
        * {
            -webkit-font-smoothing: antialiased;
            box-sizing: border-box;
        }
        html, body {
            margin: 0px;
            height: 100%;
        }
        button:focus-visible {
            outline: 2px solid #4a90e2 !important;
            outline: -webkit-focus-ring-color auto 5px !important;
        }
        a {
            text-decoration: none;
        }

        @font-face {
            font-family: "Inter-Bold";
            src: local("Inter-Bold");
        }
        @font-face {
            font-family: "Plus Jakarta Sans-ExtraBold";
            src: local("Plus Jakarta Sans-ExtraBold");
        }
        @font-face {
            font-family: "Inter-Regular";
            src: local("Inter-Regular");
        }
        @font-face {
            font-family: "Inter-SemiBold";
            src: local("Inter-SemiBold");
        }
        @font-face {
            font-family: "Plus Jakarta Sans-Bold";
            src: local("Plus Jakarta Sans-Bold");
        }
        @font-face {
            font-family: "Plus Jakarta Sans-SemiBold";
            src: local("Plus Jakarta Sans-SemiBold");
        }
        @font-face {
            font-family: "Plus Jakarta Sans-Medium";
            src: local("Plus Jakarta Sans-Medium");
        }

        .LENTERA-feedback {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 0px 64px 1.25px;
            position: relative;
            background-color: #f8f9fa;
        }

        .LENTERA-feedback .main {
            display: flex;
            flex-direction: column;
            max-width: 1152px;
            align-items: flex-start;
            gap: 64px;
            padding: 112px 24px 80px;
            position: relative;
            width: 100%;
            flex: 0 0 auto;
        }

        .LENTERA-feedback .div {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
            position: relative;
            align-self: stretch;
            width: 100%;
            flex: 0 0 auto;
        }

        .LENTERA-feedback .background {
            display: inline-flex;
            align-items: flex-start;
            padding: 6px 16px;
            position: relative;
            flex: 0 0 auto;
            background-color: #ffdf9f;
            border-radius: 9999px;
        }

        .LENTERA-feedback .text {
            position: relative;
            display: flex;
            align-items: center;
            width: 76.91px;
            height: 15px;
            margin-top: -1px;
            font-family: "Inter-Bold", Helvetica;
            font-weight: 700;
            color: #261a00;
            font-size: 10px;
            letter-spacing: 1px;
            line-height: 15px;
            white-space: nowrap;
        }

        .LENTERA-feedback .div-wrapper {
            position: relative;
            align-self: stretch;
            flex: 0 0 auto;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
        }

        .LENTERA-feedback .saran-masukan {
            position: relative;
            align-self: stretch;
            margin-top: -1px;
            font-family: "Plus Jakarta Sans-ExtraBold", Helvetica;
            font-weight: 800;
            color: transparent;
            font-size: 60px;
            line-height: 60px;
        }

        .LENTERA-feedback .text-wrapper {
            color: #022448;
            letter-spacing: -0.9px;
        }

        .LENTERA-feedback .span {
            color: #0058be;
            letter-spacing: 0;
        }

        .LENTERA-feedback .container {
            display: flex;
            flex-direction: column;
            max-width: 672px;
            width: 672px;
            align-items: flex-start;
            padding: 8px 0px 0px;
            position: relative;
            flex: 0 0 auto;
        }

        .LENTERA-feedback .p {
            width: 584.38px;
            height: 59px;
            font-family: "Inter-Regular", Helvetica;
            font-weight: 400;
            color: #43474e;
            font-size: 18px;
            letter-spacing: 0;
            line-height: 29.2px;
            position: relative;
            margin-top: -1px;
        }

        .LENTERA-feedback .container-2 {
            display: grid;
            grid-template-columns: repeat(12, minmax(0, 1fr));
            grid-template-rows: 974.25px;
            height: fit-content;
            gap: 48px;
        }

        .LENTERA-feedback .form-section {
            position: relative;
            grid-row: 1 / 2;
            grid-column: 1 / 8;
            width: 100%;
            height: fit-content;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 0px 0px 210.25px;
        }

        .LENTERA-feedback .background-2 {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 40px 40px 56px;
            position: relative;
            align-self: stretch;
            width: 100%;
            flex: 0 0 auto;
            background-color: #ffffff;
            border-radius: 48px;
        }

        .LENTERA-feedback .overlay-shadow {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-color: #ffffff01;
            border-radius: 48px;
            box-shadow: 0px 32px 64px -12px #191c1d0d;
        }

        .LENTERA-feedback .form {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 40px;
            position: relative;
            align-self: stretch;
            width: 100%;
            flex: 0 0 auto;
        }

        .LENTERA-feedback .label {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            position: relative;
            align-self: stretch;
            width: 100%;
            flex: 0 0 auto;
            opacity: 0.7;
        }

        .LENTERA-feedback .bagaimana-kualitas {
            position: relative;
            display: flex;
            align-items: center;
            align-self: stretch;
            margin-top: -1px;
            font-family: "Inter-Bold", Helvetica;
            font-weight: 700;
            color: #43474e;
            font-size: 14px;
            letter-spacing: 1.4px;
            line-height: 20px;
        }

        .LENTERA-feedback .img {
            display: none;
        }

        .LENTERA-feedback .input-fields {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 32px;
            width: 100%;
        }

        .LENTERA-feedback .container-3,
        .LENTERA-feedback .container-5,
        .LENTERA-feedback .container-6 {
            position: relative;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .LENTERA-feedback .label-2 {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 0px 0px 0px 8px;
            position: relative;
            align-self: stretch;
            width: 100%;
            flex: 0 0 auto;
        }

        .LENTERA-feedback .text-wrapper-2 {
            position: relative;
            display: flex;
            align-items: center;
            align-self: stretch;
            margin-top: -1px;
            font-family: "Inter-SemiBold", Helvetica;
            font-weight: 600;
            color: #191c1d;
            font-size: 14px;
            letter-spacing: 0;
            line-height: 20px;
        }

        .LENTERA-feedback .input {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 18px 24px;
            position: relative;
            align-self: stretch;
            width: 100%;
            flex: 0 0 auto;
            background-color: #e7e8e9;
            border-radius: 6px;
            overflow: hidden;
        }

        .LENTERA-feedback .container-4 {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            position: relative;
            flex: 1;
            flex-grow: 1;
        }

        .LENTERA-feedback .text-wrapper-3 {
            position: relative;
            display: flex;
            align-items: center;
            align-self: stretch;
            margin-top: -1px;
            font-family: "Inter-Regular", Helvetica;
            font-weight: 400;
            color: #6b7280;
            font-size: 16px;
            letter-spacing: 0;
            line-height: normal;
        }

        .LENTERA-feedback .container-5 {
            position: relative;
            grid-row: 1 / 2;
            grid-column: 2 / 3;
            width: 100%;
            height: fit-content;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .LENTERA-feedback .container-6 {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            position: relative;
            align-self: stretch;
            width: 100%;
            flex: 0 0 auto;
        }

        .LENTERA-feedback .options {
            position: relative;
            align-self: stretch;
            width: 100%;
            min-height: 56px;
            background-color: #e7e8e9;
            border-radius: 6px;
            display: flex;
            align-items: center;
            padding: 0 16px;
        }

        .LENTERA-feedback .options::after {
            content: "▾";
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.85rem;
            color: #64748b;
            pointer-events: none;
        }

        .LENTERA-feedback .options select {
            width: 100%;
            height: 56px;
            border: none;
            background: transparent;
            font-family: "Inter-Regular", Helvetica;
            font-size: 16px;
            color: #191c1d;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            outline: none;
            padding-right: 32px;
        }

        .LENTERA-feedback .image-fill,
        .LENTERA-feedback .SVG,
        .LENTERA-feedback .vector,
        .LENTERA-feedback .container-7 {
            display: none;
        }

        .LENTERA-feedback .text-2 {
            display: flex;
            align-items: center;
            width: 99.41px;
            height: 24px;
            font-family: "Inter-Regular", Helvetica;
            font-weight: 400;
            color: #191c1d;
            font-size: 16px;
            letter-spacing: 0;
            line-height: 24px;
            white-space: nowrap;
            position: relative;
            margin-top: -1px;
        }

        .LENTERA-feedback .textarea {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 16px 24px;
            position: relative;
            align-self: stretch;
            width: 100%;
            min-height: 170px;
            flex: 0 0 auto;
            background-color: #e7e8e9;
            border-radius: 6px;
            overflow: hidden;
        }

        .LENTERA-feedback .text-wrapper-4,
        .LENTERA-feedback .text-wrapper-3 {
            position: relative;
            display: block;
            width: 100%;
            margin-top: -1px;
            font-family: "Inter-Regular", Helvetica;
            font-weight: 400;
            color: #191c1d;
            font-size: 16px;
            letter-spacing: 0;
            line-height: 24px;
            background: transparent;
            border: none;
            outline: none;
        }

        .LENTERA-feedback .text-wrapper-3 {
            height: 100%;
        }

        .LENTERA-feedback .textarea textarea {
            width: 100%;
            height: 100%;
            resize: none;
            border: none;
            background: transparent;
            font: inherit;
            color: #191c1d;
        }

        .LENTERA-feedback .input input {
            width: 100%;
            border: none;
            background: transparent;
            font: inherit;
            color: #191c1d;
            outline: none;
        }

        .LENTERA-feedback .error-message {
            display: block;
            margin-top: 8px;
            font-size: 0.875rem;
            color: #dc2626;
        }

        .LENTERA-feedback .submit-button {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 16px 0px 0px;
            position: relative;
            align-self: stretch;
            width: 100%;
            flex: 0 0 auto;
        }

        .LENTERA-feedback .button {
            all: unset;
            box-sizing: border-box;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 20px 48px;
            position: relative;
            flex: 0 0 auto;
            border-radius: 48px;
            background: linear-gradient(171deg, rgba(2, 36, 72, 1) 0%, rgba(30, 58, 95, 1) 100%);
        }

        .LENTERA-feedback .text-3 {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 136.19px;
            height: 28px;
            font-family: "Plus Jakarta Sans-Bold", Helvetica;
            font-weight: 700;
            color: #ffffff;
            font-size: 18px;
            text-align: center;
            letter-spacing: 0;
            line-height: 28px;
            white-space: nowrap;
            position: relative;
            margin-top: -1px;
        }

        .LENTERA-feedback .aside-banner-sidebar {
            position: relative;
            grid-row: 1 / 2;
            grid-column: 8 / 13;
            width: 100%;
            height: fit-content;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 48px;
        }

        .LENTERA-feedback .educational-banner {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 40px;
            position: relative;
            align-self: stretch;
            width: 100%;
            flex: 0 0 auto;
            background-color: #022448;
            border-radius: 48px;
            overflow: hidden;
            box-shadow: 0px 32px 64px -12px #191c1d0d;
        }

        .LENTERA-feedback .aesthetic-background {
            position: absolute;
            right: -80px;
            bottom: -80px;
            width: 256px;
            height: 256px;
            background-color: #2170e433;
            border-radius: 9999px;
            filter: blur(50px);
        }

        .LENTERA-feedback .container-8 {
            position: relative;
            align-self: stretch;
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .LENTERA-feedback .heading {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
        }

        .LENTERA-feedback .container-9 {
            display: flex;
            flex-direction: column;
            width: 100%;
            align-items: flex-start;
            position: relative;
        }

        .LENTERA-feedback .list {
            display: flex;
            flex-direction: column;
            width: 100%;
            align-items: flex-start;
            gap: 16px;
            position: relative;
        }

        .LENTERA-feedback .item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            position: relative;
            align-self: stretch;
            width: 100%;
            flex: 0 0 auto;
        }

        .LENTERA-feedback .margin {
            display: none;
        }

        .LENTERA-feedback .text-4 {
            width: 100%;
            font-family: "Plus Jakarta Sans-Bold", Helvetica;
            font-weight: 700;
            color: #ffffff;
            font-size: 30px;
            letter-spacing: 0;
            line-height: 36px;
            position: relative;
            margin-top: -1px;
        }

        .LENTERA-feedback .text-5 {
            width: 100%;
            font-family: "Inter-Regular", Helvetica;
            font-weight: 400;
            color: #8aa4cf;
            font-size: 16px;
            letter-spacing: 0;
            line-height: 26px;
            position: relative;
            margin-top: -1px;
        }

        .LENTERA-feedback .text-6 {
            display: flex;
            align-items: center;
            width: 246.98px;
            height: 20px;
            font-family: "Inter-Regular", Helvetica;
            font-weight: 400;
            color: #ffffff;
            font-size: 14px;
            letter-spacing: 0;
            line-height: 20px;
            white-space: nowrap;
            position: relative;
            margin-top: -1px;
        }

        .LENTERA-feedback .icon-3 {
            position: relative;
            width: 16px;
            height: 20px;
        }

        .LENTERA-feedback .text-7 {
            display: flex;
            align-items: center;
            width: 257.31px;
            height: 20px;
            font-family: "Inter-Regular", Helvetica;
            font-weight: 400;
            color: #ffffff;
            font-size: 14px;
            letter-spacing: 0;
            line-height: 20px;
            white-space: nowrap;
            position: relative;
            margin-top: -1px;
        }

        .LENTERA-feedback .info-card {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 14.8px;
            padding: 32px;
            position: relative;
            align-self: stretch;
            width: 100%;
            flex: 0 0 auto;
            background-color: #f3f4f5;
            border-radius: 48px;
            border: 1px solid;
            border-color: #c4c6cf1a;
        }

        .LENTERA-feedback .text-wrapper-5 {
            position: relative;
            display: flex;
            align-items: center;
            align-self: stretch;
            margin-top: -1px;
            font-family: "Plus Jakarta Sans-Bold", Helvetica;
            font-weight: 700;
            color: #022448;
            font-size: 20px;
            letter-spacing: 0;
            line-height: 28px;
        }

        .LENTERA-feedback .jika-anda-memerlukan {
            position: relative;
            align-self: stretch;
            margin-top: -1px;
            font-family: "Inter-Regular", Helvetica;
            font-weight: 400;
            color: #43474e;
            font-size: 14px;
            letter-spacing: 0;
            line-height: 22.8px;
        }

        .LENTERA-feedback .div-2 {
            display: inline-flex;
            flex-direction: column;
            align-items: flex-start;
            position: relative;
            flex: 0 0 auto;
        }


        .LENTERA-feedback .top-navigation-shell {
            display: flex;
            flex-direction: column;
            width: 1280px;
            align-items: flex-start;
            position: absolute;
            top: 0;
            left: 0;
            background-color: #ffffffcc;
            box-shadow: 0px 8px 32px #1e3a5f0a;
            backdrop-filter: blur(12px) brightness(100%);
            -webkit-backdrop-filter: blur(12px) brightness(100%);
        }

        .LENTERA-feedback .container-12 {
            display: flex;
            max-width: 1536px;
            align-items: center;
            justify-content: space-between;
            padding: 16px 32px;
            position: relative;
            width: 100%;
            flex: 0 0 auto;
        }

        .LENTERA-feedback .text-11 {
            display: flex;
            align-items: center;
            width: 158.64px;
            height: 28px;
            font-family: "Plus Jakarta Sans-Bold", Helvetica;
            font-weight: 700;
            color: #1e3a5f;
            font-size: 20px;
            letter-spacing: -0.5px;
            line-height: 28px;
            white-space: nowrap;
            position: relative;
            margin-top: -1px;
        }

        .LENTERA-feedback .container-13 {
            display: inline-flex;
            align-items: center;
            gap: 32px;
            position: relative;
            flex: 0 0 auto;
        }

        .LENTERA-feedback .text-12 {
            display: flex;
            align-items: center;
            width: 77.59px;
            height: 20px;
            font-family: "Plus Jakarta Sans-Medium", Helvetica;
            font-weight: 500;
            color: #64748b;
            font-size: 14px;
            letter-spacing: 0.35px;
            line-height: 20px;
            white-space: nowrap;
            position: relative;
            margin-top: -1px;
        }

        .LENTERA-feedback .text-13 {
            display: flex;
            align-items: center;
            width: 64.03px;
            height: 20px;
            font-family: "Plus Jakarta Sans-Medium", Helvetica;
            font-weight: 500;
            color: #64748b;
            font-size: 14px;
            letter-spacing: 0.35px;
            line-height: 20px;
            white-space: nowrap;
            position: relative;
            margin-top: -1px;
        }

        .LENTERA-feedback .link {
            display: flex;
            width: 74px;
            padding: 0px 0px 4px;
            border-bottom-width: 2px;
            border-bottom-style: solid;
            border-color: #f9bd22;
            flex-direction: column;
            align-items: flex-start;
            position: relative;
        }

        .LENTERA-feedback .text-wrapper-6 {
            position: relative;
            display: flex;
            align-items: center;
            width: 86px;
            height: 20px;
            margin-top: -2px;
            margin-right: -12px;
            font-family: "Plus Jakarta Sans-Medium", Helvetica;
            font-weight: 500;
            color: #1e3a5f;
            font-size: 14px;
            letter-spacing: 0.35px;
            line-height: 20px;
            white-space: nowrap;
        }

        .LENTERA-feedback .text-14 {
            display: flex;
            align-items: center;
            width: 57.59px;
            height: 20px;
            font-family: "Plus Jakarta Sans-Medium", Helvetica;
            font-weight: 500;
            color: #64748b;
            font-size: 14px;
            letter-spacing: 0.35px;
            line-height: 20px;
            white-space: nowrap;
            position: relative;
            margin-top: -1px;
        }

        .LENTERA-feedback .container-14 {
            position: relative;
            flex: 0 0 auto;
        }
    </style>
</head>
<body>
<div class="LENTERA-feedback">
    <div class="top-navigation-shell">
        <div class="container-12">
            <div class="div-2">
                <div class="text-11">LENTERA</div>
            </div>
            <div class="container-13">
                <div class="div-2">
                    <div class="text-12">Dashboard</div>
                </div>
                <div class="div-2">
                    <div class="text-13">Verifikasi</div>
                </div>
                <div class="link">
                    <div class="text-wrapper-6">Pelaporan</div>
                </div>
                <div class="div-2">
                    <div class="text-14">Laporan</div>
                </div>
            </div>
            <div class="container-14">
                <img class="container-14" src="img/container.svg" />
            </div>
        </div>
    </div>
    <div class="main">
        <div class="div">
            <div class="background">
                <div class="text">SUARA ANDA</div>
            </div>
            <div class="div-wrapper">
                <p class="saran-masukan">
                    <span class="text-wrapper">Saran &amp; Masukan<br/></span>
                    <span class="span">Layanan Publik</span>
                </p>
            </div>
            <div class="container">
                <p class="p">Setiap masukan Anda adalah lentera yang membimbing kami menuju<br/>pelayanan yang lebih transparan dan berintegritas.</p>
            </div>
        </div>
        <div class="container-2">
            <div class="form-section">
                <div class="background-2">
                    <div class="overlay-shadow"></div>
                    <div class="form">
                        <div class="div">
                            <div class="label">
                                <div class="bagaimana-kualitas">BAGAIMANA KUALITAS LAYANAN KAMI?</div>
                            </div>
                        </div>

                        @if(session('success'))
                            <div class="mb-6 rounded-3xl border border-emerald-200/70 bg-emerald-50 p-4 text-sm text-emerald-900">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('feedback.store') }}" method="POST" class="space-y-8">
                            @csrf

                            <div class="input-fields">
                                <div class="container-3">
                                    <div class="label-2">
                                        <div class="text-wrapper-2">Nama Lengkap</div>
                                    </div>
                                    <div class="input">
                                        <div class="container-4">
                                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Contoh: Budi Santoso" class="text-wrapper-3" />
                                        </div>
                                    </div>
                                    @error('nama_lengkap')<span class="error-message">{{ $message }}</span>@enderror
                                </div>

                                <div class="container-5">
                                    <div class="label-2">
                                        <div class="text-wrapper-2">Nomor Telepon</div>
                                    </div>
                                    <div class="input">
                                        <div class="container-4">
                                            <input type="text" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" name="nomor_telepon" value="{{ old('nomor_telepon') }}" placeholder="0812XXXX" class="text-wrapper-3" />
                                        </div>
                                    </div>
                                    @error('nomor_telepon')<span class="error-message">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="container-6">
                                <div class="label-2">
                                    <div class="text-wrapper-2">Kategori Masukan</div>
                                </div>
                                <div class="options">
                                    <select name="kategori_masukan" class="text-2">
                                        <option value="" disabled selected>Pilih Kategori</option>
                                        <option value="Saran" {{ old('kategori_masukan') === 'Saran' ? 'selected' : '' }}>Saran</option>
                                        <option value="Laporan" {{ old('kategori_masukan') === 'Laporan' ? 'selected' : '' }}>Laporan</option>
                                        <option value="Keluhan" {{ old('kategori_masukan') === 'Keluhan' ? 'selected' : '' }}>Keluhan</option>
                                        <option value="Pertanyaan" {{ old('kategori_masukan') === 'Pertanyaan' ? 'selected' : '' }}>Pertanyaan</option>
                                    </select>
                                </div>
                                @error('kategori_masukan')<span class="error-message">{{ $message }}</span>@enderror
                            </div>

                            <div class="container-6">
                                <div class="label-2">
                                    <div class="text-wrapper-2">Deskripsi Masukan</div>
                                </div>
                                <div class="textarea">
                                    <textarea name="deskripsi_masukan" rows="6" placeholder="Ceritakan pengalaman Anda secara detail di sini..." class="text-wrapper-4">{{ old('deskripsi_masukan') }}</textarea>
                                </div>
                                @error('deskripsi_masukan')<span class="error-message">{{ $message }}</span>@enderror
                            </div>

                            <div class="submit-button">
                                <button type="submit" class="button">
                                    <div class="text-3">Kirim Feedback</div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="aside-banner-sidebar">
                <div class="educational-banner">
                    <div class="aesthetic-background"></div>
                    <div class="container-8">
                        <div class="heading">
                            <div class="text-4">Transparansi Tanpa<br/>Batas</div>
                        </div>
                        <div class="container-9">
                            <p class="text-5">Kami percaya bahwa keterbukaan adalah<br/>fondasi kepercayaan. Setiap laporan Anda<br/>akan diproses secara terbuka dan dapat<br/>dipantau melalui dashboard publik kami.</p>
                        </div>
                        <div class="list">
                            <div class="item">
                                <p class="text-6">Verifikasi data otomatis dalam 24 jam</p>
                            </div>
                            <div class="item">
                                <div class="text-7">Privasi pelapor terlindungi sepenuhnya</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="info-card">
                    <div class="div-wrapper">
                        <div class="text-wrapper-5">Butuh Bantuan Segera?</div>
                    </div>
                    <div class="div-wrapper">
                        <p class="jika-anda-memerlukan">Jika Anda memerlukan bantuan teknis terkait pengisian<br/>formulir, hubungi pusat layanan kami yang beroperasi<br/>24/7.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

