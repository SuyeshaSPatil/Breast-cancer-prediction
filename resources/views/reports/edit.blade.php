@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#fff0f5] px-4 py-8">
        <div class="max-w-3xl mx-auto bg-white/90 backdrop-blur-md border border-pink-100 rounded-2xl shadow-xl p-8">
            
            {{-- Page Heading --}}
            <h1 class="text-3xl font-bold text-pink-700 mb-8">📝 Edit Report</h1>

            {{-- Form Start --}}
            <form action="{{ route('reports.update', $report->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Report Title --}}
                <div>
                    <label for="title" class="block text-pink-700 font-semibold mb-1">📌 Report Title</label>
                    <input type="text" id="title" name="title" value="{{ $report->title }}"
                        class="text-black w-full border border-pink-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400 shadow-sm"
                        required>
                </div>

                {{-- Student Selection --}}
                <div>
                    <label for="student_id" class="block text-pink-700 font-semibold mb-1">🎓 Select Student</label>
                    <select id="student_id" name="student_id"
                        class="w-full bg-white text-pink-900 border border-pink-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400 shadow-sm"
                        required>
                        <option value="">-- Choose a Student --</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}" {{ $report->student_id == $student->id ? 'selected' : '' }}>
                                {{ $student->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-pink-700 font-semibold mb-1">🗒️ Description (Optional)</label>
                    <textarea id="description" name="description" rows="4"
                        class="text-black w-full border border-pink-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400 shadow-sm resize-none">{{ $report->description }}</textarea>
                </div>

                {{-- Attachment --}}
                <div>
                    <label for="attachment" class="block text-pink-700 font-semibold mb-1">📎 Attachment (Optional)</label>
                    <input type="file" id="attachment" name="attachment"
                        class="block w-full text-sm text-pink-800 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-pink-100 file:text-pink-700 hover:file:bg-pink-200" />
                    
                    @if($report->attachment)
                        <p class="text-sm mt-2 text-pink-600">
                            Current File: 
                            <a href="{{ route('reports.file', $report->attachment) }}" target="_blank" class="underline text-blue-600 hover:text-blue-800">
                                View Attachment
                            </a>
                        </p>
                    @endif
                </div>

                {{-- Submit Button --}}
                <div class="text-right">
                    <button type="submit"
                        class="bg-pink-500 hover:bg-pink-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200">
                        💾 Update Report
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
