<x-app-layout>
    <x-slot name="header">Pinjam Alat untuk Proyek</x-slot>
    <div class="p-6 max-w-3xl">
        <form method="POST" action="{{ route('borrowings.store') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Alat</label>
                    <select name="tool_id" class="w-full border rounded p-2" required>
                        <option value="">-- Pilih Alat --</option>
                        @foreach($tools as $t)
                            <option value="{{ $t->id }}">
                                {{ $t->name }} (Stok: {{ $t->stock }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium">Proyek</label>
                    <select name="project_id" class="w-full border rounded p-2" required>
                        <option value="">-- Pilih Proyek --</option>
                        @foreach($projects as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium">Jumlah</label>
                    <input type="number" name="quantity" min="1" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Tanggal Pinjam</label>
                    <input type="date" name="borrow_date" class="w-full border rounded p-2" required>
                </div>
            </div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded mt-4">
                Pinjam Alat
            </button>
        </form>
    </div>
</x-app-layout>