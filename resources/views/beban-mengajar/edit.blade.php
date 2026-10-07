<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Beban Mengajar - SMPN 4 Seruyan Tengah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FA] font-sans antialiased text-gray-800">

    <div class="max-w-lg mx-auto p-8">

        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900">Edit Beban Mengajar</h2>
            <p class="text-xs text-gray-400 mt-0.5">Perbarui guru, kelas, mapel, atau jam per minggu.</p>
        </div>

        @if($errors->any())
            <div class="mb-4 p-3 bg-rose-50 text-rose-600 border border-rose-100 rounded-xl text-xs">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <form action="{{ route('beban-mengajar.update', $beban) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Kelas</label>
                    <select name="kelas_id" required
                        class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-400">
                        @foreach($kelasList as $kelas)
                            <option value="{{ $kelas->id_kelas }}" {{ old('kelas_id', $beban->kelas_id) == $kelas->id_kelas ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }} (Kelas {{ $kelas->tingkat }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Mata Pelajaran</label>
                    <select name="mata_pelajaran_id" required
                        class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-400">
                        @foreach($mapelList as $mapel)
                            <option value="{{ $mapel->id_mata_pelajaran }}" {{ old('mata_pelajaran_id', $beban->mata_pelajaran_id) == $mapel->id_mata_pelajaran ? 'selected' : '' }}>
                                {{ $mapel->nama_mapel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Guru Pengampu</label>
                    <select name="guru_id" required
                        class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-400">
                        @foreach($guruList as $guru)
                        <option value="{{ $guru->id }}" {{ old('guru_id') == $guru->id ? 'selected' : '' }}>
                            {{ $guru->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Jam per Minggu</label>
                    <input type="number" name="jam_per_minggu" value="{{ old('jam_per_minggu', $beban->jam_per_minggu) }}" required min="1" max="40"
                        class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-indigo-100 focus:border-indigo-400">
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold py-2.5 rounded-xl shadow-sm transition">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('beban-mengajar.index') }}"
                        class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold py-2.5 rounded-xl transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>

    </div>

</body>
</html>