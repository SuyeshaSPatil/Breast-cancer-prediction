@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#fff0f5] px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white/90 backdrop-blur-md border border-pink-100 rounded-2xl shadow-xl p-8">

            <h1 class="text-3xl font-bold text-pink-700 mb-8">➕ Generate New Report</h1>

            <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Report Title --}}
                <div>
                    <label for="title" class="block text-pink-700 font-semibold mb-1">📄 Report Title</label>
                    <input type="text" id="title" name="title" class="text-black w-full border border-pink-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-300" required>
                </div>

                {{-- Student Selection --}}
<div>
    <label for="student_id" class="block text-pink-700 font-semibold mb-1">🎓 Select Student</label>
    <select id="student_id" name="student_id"
        class="w-full bg-white text-pink-900 border border-pink-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400 shadow-sm"
        required>
        <option value="" disabled selected>-- Choose a Student --</option>
        @foreach ($students as $student)
            <option value="{{ $student->id }}">{{ $student->name }}</option>
        @endforeach
    </select>
</div>


                {{-- Description --}}
                <div>
                    <label for="description" class="block text-pink-700 font-semibold mb-1">📝 Description (optional)</label>
                    <textarea id="description" name="description" rows="4" class="text-black w-full border border-pink-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-300"></textarea>
                </div>

                {{-- Attachment --}}
                <div>
                    <label for="attachment" class="block text-pink-700 font-semibold mb-1">📎 Attachment (optional)</label>
                    <input type="file" id="attachment" name="attachment" class="w-full text-sm text-pink-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100" />
                </div>

                {{-- Submit Button --}}
                <div>
                    <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white font-semibold px-6 py-2 rounded-lg shadow transition duration-200">
                        ✅ Create Report
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
