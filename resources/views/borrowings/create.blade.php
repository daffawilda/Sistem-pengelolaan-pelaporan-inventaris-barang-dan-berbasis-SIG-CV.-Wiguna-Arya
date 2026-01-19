<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Pinjam Alat untuk Proyek</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <form method="POST" action="{{ route('borrowings.store') }}" id="borrowingForm">
                    @csrf

                    <!-- Alert untuk error stok -->
                    <div id="stockError" class="hidden mb-4 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <div id="stockErrorMessage" class="text-sm text-red-700"></div>
                    </div>

                    <!-- Info Alat Terpilih -->
                    <div id="toolInfo" class="hidden mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <h3 class="font-medium text-blue-900 mb-2">Informasi Alat</h3>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-blue-700">Nama Alat:</p>
                                <p id="toolName" class="font-semibold text-blue-900"></p>
                            </div>
                            <div>
                                <p class="text-blue-700">Stok Tersedia:</p>
                                <p id="toolAvailable" class="font-semibold text-blue-900 text-green-600"></p>
                            </div>
                            <div>
                                <p class="text-blue-700">Stok Total di Gudang:</p>
                                <p id="toolTotal" class="font-semibold text-blue-900"></p>
                            </div>
                            <div>
                                <p class="text-blue-700">Sedang Dipinjam:</p>
                                <p id="toolBorrowed" class="font-semibold text-blue-900 text-orange-600"></p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Alat -->
                        <div>
                            <label for="tool_id" class="block text-sm font-medium text-gray-700 mb-1">Alat *</label>
                            <select 
                                id="tool_id"
                                name="tool_id" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                required>
                                <option value="">-- Pilih Alat --</option>
                                @foreach($tools as $t)
                                    <option value="{{ $t->id }}" data-available="{{ $t->available_stock }}" data-total="{{ $t->stock }}" data-name="{{ $t->name }}" {{ $t->available_stock <= 0 ? 'disabled' : '' }}>
                                        {{ $t->name }} (Tersedia: {{ $t->available_stock }}) {{ $t->available_stock <= 0 ? '- Stok Habis' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-xs text-gray-500">Tersedia = Stok Total - Peminjaman Aktif</p>
                            @error('tool_id')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Proyek -->
                        <div>
                            <label for="project_id" class="block text-sm font-medium text-gray-700 mb-1">Proyek *</label>
                            <select 
                                id="project_id"
                                name="project_id" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                required>
                                <option value="">-- Pilih Proyek --</option>
                                @foreach($projects as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                            @error('project_id')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jumlah -->
                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Jumlah *</label>
                            <input 
                                type="number" 
                                id="quantity"
                                name="quantity" 
                                min="1" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                placeholder="1"
                                value="{{ old('quantity') }}"
                                required>
                            <p id="quantityInfo" class="mt-1 text-xs text-gray-500"></p>
                            @error('quantity')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Pinjam -->
                        <div>
                            <label for="borrow_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pinjam *</label>
                            <input 
                                type="date" 
                                id="borrow_date"
                                name="borrow_date" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                value="{{ old('borrow_date') }}"
                                required>
                            <p class="mt-1 text-xs text-gray-500">Minimum: hari ini</p>
                            @error('borrow_date')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Pengembalian Rencana -->
                        <div class="md:col-span-2">
                            <label for="return_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pengembalian Rencana</label>
                            <input 
                                type="date" 
                                id="return_date"
                                name="return_date" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                value="{{ old('return_date') }}">
                            <p class="mt-1 text-xs text-gray-500">Tanggal rencana pengembalian alat (opsional)</p>
                            @error('return_date')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex gap-3">
                        <button 
                            type="submit" 
                            id="submitBtn"
                            class="flex-1 sm:flex-none px-5 py-2.5 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition shadow-sm disabled:bg-gray-400 disabled:cursor-not-allowed">
                            Pinjam Alat
                        </button>
                        <a 
                            href="{{ route('borrowings.index') }}" 
                            class="flex-1 sm:flex-none px-5 py-2.5 bg-white text-gray-700 font-medium rounded-lg border border-gray-300 hover:bg-gray-50 focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toolSelect = document.getElementById('tool_id');
            const quantityInput = document.getElementById('quantity');
            const borrowDateInput = document.getElementById('borrow_date');
            const returnDateInput = document.getElementById('return_date');
            const submitBtn = document.getElementById('submitBtn');
            const stockError = document.getElementById('stockError');
            const stockErrorMessage = document.getElementById('stockErrorMessage');
            const toolInfo = document.getElementById('toolInfo');
            const quantityInfo = document.getElementById('quantityInfo');

            // Set minimum date to today
            const today = new Date().toISOString().split('T')[0];
            borrowDateInput.setAttribute('min', today);
            returnDateInput.setAttribute('min', today);

            // Handle tool selection
            toolSelect.addEventListener('change', function() {
                if (this.value) {
                    const option = this.options[this.selectedIndex];
                    const available = parseInt(option.dataset.available);
                    const total = parseInt(option.dataset.total);
                    const name = option.dataset.name;
                    const borrowed = total - available;

                    // Show tool info
                    document.getElementById('toolName').textContent = name;
                    document.getElementById('toolAvailable').textContent = available + ' unit';
                    document.getElementById('toolTotal').textContent = total + ' unit';
                    document.getElementById('toolBorrowed').textContent = borrowed + ' unit';
                    toolInfo.classList.remove('hidden');

                    // Reset quantity
                    quantityInput.value = '';
                    quantityInput.setAttribute('max', available);
                    validateForm();
                } else {
                    toolInfo.classList.add('hidden');
                    quantityInput.value = '';
                    quantityInput.removeAttribute('max');
                    validateForm();
                }
            });

            // Handle quantity input
            quantityInput.addEventListener('input', function() {
                validateForm();
            });

            // Handle date input
            borrowDateInput.addEventListener('change', function() {
                validateForm();
            });

            returnDateInput.addEventListener('change', function() {
                if (borrowDateInput.value && returnDateInput.value) {
                    if (new Date(returnDateInput.value) < new Date(borrowDateInput.value)) {
                        returnDateInput.classList.add('border-red-500');
                        quantityInfo.textContent = '⚠️ Tanggal pengembalian harus setelah tanggal pinjam';
                        quantityInfo.classList.add('text-red-600');
                    } else {
                        returnDateInput.classList.remove('border-red-500');
                        quantityInfo.textContent = '';
                        quantityInfo.classList.remove('text-red-600');
                    }
                }
            });

            // Validate form
            function validateForm() {
                const toolId = toolSelect.value;
                const quantity = parseInt(quantityInput.value) || 0;
                const borrowDate = borrowDateInput.value;
                let isValid = true;

                stockError.classList.add('hidden');

                // Validate tool selected
                if (!toolId) {
                    submitBtn.disabled = true;
                    return;
                }

                // Validate date
                if (borrowDate) {
                    const selectedDate = new Date(borrowDate);
                    const todayDate = new Date(today);
                    if (selectedDate < todayDate) {
                        stockError.classList.remove('hidden');
                        stockErrorMessage.textContent = '❌ Tanggal pinjam tidak boleh tanggal masa lalu';
                        isValid = false;
                    }
                }

                // Validate quantity
                if (quantity > 0) {
                    const option = toolSelect.options[toolSelect.selectedIndex];
                    const available = parseInt(option.dataset.available);

                    if (quantity > available) {
                        stockError.classList.remove('hidden');
                        stockErrorMessage.textContent = `❌ Jumlah melebihi stok tersedia. Maksimal: ${available} unit`;
                        isValid = false;
                    } else {
                        quantityInfo.textContent = `✓ Stok cukup (${available - quantity} unit tersisa)`;
                        quantityInfo.classList.remove('text-red-600');
                        quantityInfo.classList.add('text-green-600');
                    }
                } else {
                    quantityInfo.textContent = '';
                }

                // Enable/disable submit button
                submitBtn.disabled = !(toolId && borrowDate && quantity > 0 && isValid);
            }

            // Validate on form submission
            document.getElementById('borrowingForm').addEventListener('submit', function(e) {
                const toolId = toolSelect.value;
                const quantity = parseInt(quantityInput.value) || 0;
                const option = toolSelect.options[toolSelect.selectedIndex];
                const available = parseInt(option.dataset.available);

                if (quantity > available) {
                    e.preventDefault();
                    stockError.classList.remove('hidden');
                    stockErrorMessage.textContent = `❌ Jumlah alat tidak tersedia. Tersedia: ${available} unit`;
                }
            });
        });
    </script>
</x-app-layout>