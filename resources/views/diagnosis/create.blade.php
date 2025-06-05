@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#fff0f5] px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white/90 backdrop-blur-md border border-pink-100 rounded-2xl shadow-xl p-8">

            <h1 class="text-3xl font-bold text-pink-700 text-center mb-8">➕ Add New Diagnosis</h1>

            <form action="{{ route('diagnosis.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Patient Selection --}}
                <div>
                    <label for="patient_id" class="block text-sm font-semibold text-pink-700 mb-1">Select Patient</label>
                    <select id="patient_id" name="patient_id" required
                        class="w-full px-4 py-2 border border-pink-200 rounded-lg shadow-sm bg-white text-pink-900 focus:outline-none focus:ring-2 focus:ring-pink-300">
                        <option value="" disabled selected>Choose patient</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->name }} ({{ $patient->email }})</option>
                        @endforeach
                    </select>
                </div>

                {{-- Diagnosis Result --}}
                <div>
                    <label for="diagnosis_result" class="block text-sm font-semibold text-pink-700 mb-1">Diagnosis Result</label>
                    <select id="diagnosis_result" name="diagnosis_result" required
                        class="w-full px-4 py-2 border border-pink-200 rounded-lg shadow-sm bg-white text-pink-900 focus:outline-none focus:ring-2 focus:ring-pink-300">
                        <option value="Positive">Positive</option>
                        <option value="Negative">Negative</option>
                        <option value="Suspected">Suspected</option>
                    </select>
                </div>

                {{-- Cancer Stage --}}
                <div>
                    <label for="stage" class="block text-sm font-semibold text-pink-700 mb-1">Cancer Stage</label>
                    <select id="stage" name="stage" required
                        class="w-full px-4 py-2 border border-pink-200 rounded-lg shadow-sm bg-white text-pink-900 focus:outline-none focus:ring-2 focus:ring-pink-300">
                        <option value="0">Stage 0</option>
                        <option value="I">Stage I</option>
                        <option value="II">Stage II</option>
                        <option value="III">Stage III</option>
                        <option value="IV">Stage IV</option>
                    </select>
                </div>

                {{-- Submit --}}
                <div class="pt-6">
                    <button type="submit"
                        class="w-full bg-pink-500 hover:bg-pink-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 shadow-md">
                        💾 Save Diagnosis
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
