<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beban Mengajar - SMPN 4 Seruyan Tengah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FA] font-sans antialiased text-gray-800">

    <div class="max-w-5xl mx-auto p-8">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Beban Mengajar</h2>
                <p class="text-xs text-gray-400 mt-0.5">Data ini jadi dasar untuk generate jadwal otomatis.</p>
            </div>
            <a href="{{ route('beban-mengajar.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-4 py-2.5 rounded-xl shadow-sm transition">
                + Tambah Beban Mengajar
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-xl text-xs">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-5 py-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Kelas</th>
                        <th class="px-5 py-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Mata Pelajaran</th>
                        <th class="px-5 py-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Guru</th>
                        <th class="px-5 py-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Jam/Minggu</th>
                        <th class="px-5 py-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($bebanList as $item)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-5 py-3.5 text-xs font-medium text-gray-700">{{ $item->kelas->nama_kelas ?? '-' }}</td>
                            <td class="px-5 py-3.5 text-xs text-gray-700">{{ $item->mataPelajaran->nama_mapel ?? '-' }}</td>
                            <td class="px-5 py-3.5 text-xs text-gray-700">{{ $item->guru->nama ?? '-' }}</td>
                            <td class="px-5 py-3.5 text-xs text-gray-700">{{ $item->jam_per_minggu }} jam</td>
                            <td class="px-5 py-3.5 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('beban-mengajar.edit', $item) }}"
                                        class="text-[11px] font-semibold text-indigo-600 hover:text-indigo-800 px-2.5 py-1 rounded-lg hover:bg-indigo-50 transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('beban-mengajar.destroy', $item) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus beban mengajar ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-[11px] font-semibold text-rose-500 hover:text-rose-700 px-2.5 py-1 rounded-lg hover:bg-rose-50 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center text-xs text-gray-400">
                                Belum ada data beban mengajar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <a href="{{ url()->previous() }}" class="text-xs text-gray-500 hover:text-gray-800 underline">&larr; Kembali</a>
        </div>

    </div>

</body>
</html>