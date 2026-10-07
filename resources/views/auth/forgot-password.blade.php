<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - Sistem Penjadwalan dan Presensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="relative flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/foto-sekolah-2.png') }}');">
    <div class="absolute inset-0 bg-black/30 backdrop-blur-[2px]"></div>

<div class="absolute top-6 left-6 z-20 flex items-center space-x-3 text-white">
    <!-- Ubah bg-white/10 jadi bg-white (putih solid) atau bg-white/90 agar logonya kontras -->
    <div class="w-11 h-11 bg-white rounded-full flex items-center justify-center p-1.5 shadow-xl border border-white/40">
        <img src="{{ asset('images/logo-smpn4.png') }}" alt="Logo SMPN 4 Seruyan Tengah" class="w-full h-full object-contain">
    </div>
    <div>
        <h1 class="text-sm md:text-base font-bold tracking-wide drop-shadow-md">SMPN 4 SERUYAN TENGAH</h1>
    </div>
</div>

    <div class="relative z-10 w-full max-w-md bg-white/20 backdrop-blur-md rounded-2xl shadow-2xl p-8 md:p-10 border border-white/30 text-white m-4">
        
        <div class="mb-8">
            <h2 class="text-3xl font-bold tracking-tight text-white drop-shadow-sm">Pemulihan Sandi</h2>
            <p class="text-xs text-gray-200 mt-1">Masukkan email terdaftar untuk menerima tautan reset.</p>
        </div>

        @if (session('status'))
            <div class="mb-4 p-3 bg-emerald-500/80 text-white rounded-lg text-xs backdrop-blur-sm">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-500/80 text-white rounded-lg text-xs backdrop-blur-sm">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
            @csrf
        
            <div class="relative border-b border-white/60 focus-within:border-white pb-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-1 pointer-events-none text-white/70">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full pl-8 pr-3 py-2 bg-transparent text-white placeholder-white/70 text-sm focus:outline-none"
                    placeholder="Email Instansi / Terdaftar">
            </div>

            <button type="submit" 
                class="w-full py-3 px-4 bg-white hover:bg-gray-100 text-gray-900 font-bold rounded-lg shadow-lg transition duration-200 text-xs tracking-widest uppercase mt-4">
                KIRIM TAUTAN RESET
            </button>
        </form>

        <div class="mt-6 text-left">
            <a href="{{ url('/') }}" class="text-xs text-white/80 hover:text-white transition underline">Kembali ke Login</a>
        </div>
    </div>
</body>
</html>