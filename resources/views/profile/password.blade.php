<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password - SIPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white font-sans antialiased text-neutral-900">

    <div class="max-w-lg mx-auto px-6 py-12">

        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold tracking-tight text-neutral-900">Ganti Password</h1>
            <p class="text-sm text-neutral-500 mt-0.5">Perbarui kata sandi akun demi keamanan sistem.</p>
        </div>

        <!-- Validation Errors / Alert -->
        @if($errors->any())
            <div class="mb-6 p-4 bg-neutral-50 text-neutral-900 border border-neutral-200 rounded-xl text-xs space-y-1 shadow-sm">
                @foreach($errors->all() as $error)
                    <p class="font-medium flex items-center gap-2">
                        <svg class="w-4 h-4 text-neutral-900 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path></svg>
                        <span>{{ $error }}</span>
                    </p>
                @endforeach
            </div>
        @endif

        @if(session('success'))
            <div class="mb-6 p-4 bg-neutral-50 text-neutral-900 border border-neutral-200 rounded-xl text-xs flex items-center gap-3 shadow-sm">
                <svg class="w-5 h-5 text-neutral-900 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white rounded-2xl border border-neutral-200 shadow-sm p-8">
            <form action="{{ route('password.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-semibold text-neutral-700 uppercase tracking-wider mb-2">Password Saat Ini</label>
                    <input type="password" name="current_password" required
                        class="w-full px-4 py-3 bg-neutral-50 border border-neutral-200 rounded-xl text-sm text-neutral-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-neutral-900 focus:border-transparent transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-neutral-700 uppercase tracking-wider mb-2">Password Baru</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 bg-neutral-50 border border-neutral-200 rounded-xl text-sm text-neutral-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-neutral-900 focus:border-transparent transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-neutral-700 uppercase tracking-wider mb-2">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-3 bg-neutral-50 border border-neutral-200 rounded-xl text-sm text-neutral-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-neutral-900 focus:border-transparent transition-all">
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="flex-1 bg-neutral-900 hover:bg-neutral-800 text-white text-xs font-semibold py-3 px-4 rounded-xl shadow-sm transition-all duration-200 text-center">
                        Simpan Password Baru
                    </button>
                    <a href="{{ route('dashboard.admin') }}"
                        class="flex-1 text-center bg-neutral-100 hover:bg-neutral-200 text-neutral-700 text-xs font-semibold py-3 px-4 rounded-xl border border-neutral-200 transition-all duration-200">
                        Kembali
                    </a>
                </div>
            </form>
        </div>

    </div>

</body>
</html>