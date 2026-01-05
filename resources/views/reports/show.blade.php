<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Detail Laporan Progres
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Informasi Proyek -->
            <div class="bg-white rounded-lg shadow p-5 mb-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">{{ $report->project->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $report->project->location }}</p>
                        @if(auth()->user()->role !== 'mandor')
                            <p class="text-sm mt-1">Mandor: <span class="font-medium">{{ $report->reporter->name }}</span></p>
                        @endif
                    </div>
                    <span class="text-sm text-gray-500">
                        {{ $report->report_date->format('d M Y') }}
                    </span>
                </div>

                <!-- Progres -->
                @if($report->progress_percentage !== null)
                    <div class="mt-4">
                        <div class="flex items-center">
                            <div class="w-full bg-gray-200 rounded-full h-3 mr-3">
                                <div class="bg-green-600 h-3 rounded-full" 
                                     style="width: {{ $report->progress_percentage }}%"></div>
                            </div>
                            <span class="text-sm font-bold text-gray-800">{{ $report->progress_percentage }}%</span>
                        </div>
                    </div>
                @endif

                <!-- Gambar (jika ada) -->
                @if($report->image)
                    <div class="mt-4">
                        <img src="{{ $report->image_url() }}" 
                             alt="Bukti Progres" 
                             class="max-w-full h-auto rounded border">
                    </div>
                @endif

                <!-- Deskripsi -->
                <div class="mt-4">
                    <h4 class="font-medium text-gray-900">Deskripsi Pekerjaan</h4>
                    <p class="mt-1 text-gray-800">{{ $report->description }}</p>
                </div>
            </div>

            <!-- Form Feedback (Hanya untuk Pelaksana/Admin) -->
            @php
                $canGiveFeedback = in_array(auth()->user()->role, ['pelaksana', 'admin']) &&
                    (auth()->user()->role === 'admin' || auth()->user()->id === $report->project->executor_id);
            @endphp

            @if($canGiveFeedback)
                <div class="bg-white rounded-lg shadow p-5 mb-6">
                    <h3 class="font-medium text-lg text-gray-900 mb-3">Berikan Feedback untuk Mandor</h3>
                    <form method="POST" action="{{ route('reports.feedback', $report) }}">
                        @csrf
                        <textarea name="comment"
                                  required
                                  class="w-full p-3 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                  rows="3"
                                  placeholder="Tulis komentar, saran, atau instruksi lanjutan untuk mandor..."></textarea>
                        <button type="submit"
                                class="mt-3 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 font-medium">
                            Kirim Feedback
                        </button>
                    </form>
                </div>
            @endif

            <!-- Daftar Feedback -->
            @if($report->feedbacks->count())
                <div class="bg-white rounded-lg shadow p-5">
                    <h3 class="font-medium text-lg text-gray-900 mb-3">Feedback dari Atasan</h3>
                    <div class="space-y-4">
                        @foreach($report->feedbacks as $fb)
                            <div class="border-l-4 border-blue-500 pl-4 py-1">
                                <div class="flex items-center text-sm text-gray-500 mb-1">
                                    <span class="font-medium text-gray-800">{{ $fb->user->name }}</span>
                                    <span class="mx-2">•</span>
                                    <span>{{ $fb->created_at->format('d M Y H:i') }}</span>
                                </div>
                                <p class="text-gray-800">{{ $fb->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Tombol Kembali -->
            <div class="mt-6">
                <a href="{{ route('reports.index') }}" 
                   class="inline-flex items-center text-gray-600 hover:text-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Kembali ke Daftar Laporan
                </a>
            </div>
        </div>
    </div>
</x-app-layout>