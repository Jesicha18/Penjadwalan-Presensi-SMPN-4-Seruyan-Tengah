<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Kata Sandi Baru - Sistem Penjadwalan dan Presensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="relative flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/foto-sekolah-1.png') }}');">
    <div class="absolute inset-0 bg-black/30 backdrop-blur-[2px]"></div>

    <div class="absolute top-6 left-6 z-20 flex items-center space-x-3 text-white">
        <div class="w-10 h-10 bg-white/10 backdrop-blur-md border border-white/20 rounded-full flex items-center justify-center p-1 shadow-lg">
            <svg viewBox="0 0 24 24" class="w-6 h-6 fill-white" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
            </svg>
        </div>
        <div>
            <h1 class="text-sm md:text-base font-bold tracking-wide drop-shadow-md">SMPN 4 SERUYAN TENGAH</h1>
        </div>
    </div>

    <div class="relative z-10 w-full max-w-md bg-white/20 backdrop-blur-md rounded-2xl shadow-2xl p-8 md:p-10 border border-white/30 text-white m-4">
        
        <div class="mb-8">
            <h2 class="text-3xl font-bold tracking-tight text-white drop-shadow-sm">Reset Sandi</h2>
            <p class="text-xs text-gray-200 mt-1">Buat kata sandi baru untuk akunmu.</p>
        </div>

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-500/80 text-white rounded-lg text-xs backdrop-blur-sm">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
        
            <div class="relative border-b border-white/60 focus-within:border-white pb-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-1 pointer-events-none text-white/70">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <input type="email" name="email" id="email" value="{{ request()->email }}" required
                    class="w-full pl-8 pr-3 py-2 bg-transparent text-white placeholder-white/70 text-sm focus:outline-none"
                    placeholder="Email Konfirmasi">
            </div>

            <div class="relative border-b border-white/60 focus-within:border-white pb-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-1 pointer-events-none text-white/70">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <input type="password" name="password" id="password" required
                    class="w-full pl-8 pr-10 py-2 bg-transparent text-white placeholder-white/70 text-sm focus:outline-none"
                    placeholder="Kata Sandi Baru">
                
                <button type="button" onclick="togglePassword('password', 'eye-icon-1')" class="absolute inset-y-0 right-0 flex items-center pr-2 text-white/70 hover:text-white focus:outline-none">
                    <svg id="eye-icon-1" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>

            <div class="relative border-b border-white/60 focus-within:border-white pb-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-1 pointer-events-none text-white/70">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full pl-8 pr-10 py-2 bg-transparent text-white placeholder-white/70 text-sm focus:outline-none"
                    placeholder="Konfirmasi Kata Sandi Baru">
                
                <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-2')" class="absolute inset-y-0 right-0 flex items-center pr-2 text-white/70 hover:text-white focus:outline-none">
                    <svg id="eye-icon-2" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>

            <button type="submit" 
                class="w-full py-3 px-4 bg-white hover:bg-gray-100 text-gray-900 font-bold rounded-lg shadow-lg transition duration-200 text-xs tracking-widest uppercase mt-4">
                PERBARUI SANDI
            </button>
        </form>

        <div class="mt-6 text-left">
            <a href="{{ url('/') }}" class="text-xs text-white/80 hover:text-white transition underline">Kembali ke Login</a>
        </div>
    </div>

    <script>
        function togglePassword(fieldId, iconId) {
            const passwordInput = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(iconId);
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.057 10.057 0 012.062-3.328M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                `;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    </script>
</body>
</html>