@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#fff0f5] px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white/90 backdrop-blur-md border border-pink-100 rounded-2xl shadow-xl p-8">

            <h1 class="text-3xl font-bold text-pink-700 text-center mb-8">✏️ Edit Diagnosis</h1>

            <form action="{{ route('diagnosis.update', $diagnosis->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Diagnosis Result --}}
                <div>
                    <label for="diagnosis_result" class="block text-sm font-semibold text-pink-700 mb-1">Diagnosis Result</label>
                    <select id="diagnosis_result" name="diagnosis_result" required
                        class="w-full px-4 py-2 border border-pink-200 rounded-lg shadow-sm bg-white text-pink-900 focus:outline-none focus:ring-2 focus:ring-pink-300">
                        <option value="Positive" {{ $diagnosis->diagnosis_result == 'Positive' ? 'selected' : '' }}>Positive</option>
                        <option value="Negative" {{ $diagnosis->diagnosis_result == 'Negative' ? 'selected' : '' }}>Negative</option>
                        <option value="Suspected" {{ $diagnosis->diagnosis_result == 'Suspected' ? 'selected' : '' }}>Suspected</option>
                    </select>
                </div>

                {{-- Cancer Stage --}}
                <div>
                    <label for="stage" class="block text-sm font-semibold text-pink-700 mb-1">Cancer Stage</label>
                    <select id="stage" name="stage" required
                        class="w-full px-4 py-2 border border-pink-200 rounded-lg shadow-sm bg-white text-pink-900 focus:outline-none focus:ring-2 focus:ring-pink-300">
                        <option value="0" {{ $diagnosis->stage == '0' ? 'selected' : '' }}>Stage 0</option>
                        <option value="I" {{ $diagnosis->stage == 'I' ? 'selected' : '' }}>Stage I</option>
                        <option value="II" {{ $diagnosis->stage == 'II' ? 'selected' : '' }}>Stage II</option>
                        <option value="III" {{ $diagnosis->stage == 'III' ? 'selected' : '' }}>Stage III</option>
                        <option value="IV" {{ $diagnosis->stage == 'IV' ? 'selected' : '' }}>Stage IV</option>
                    </select>
                </div>

                {{-- Submit --}}
                <div class="pt-6">
                    <button type="submit"
                        class="w-full bg-pink-500 hover:bg-pink-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 shadow-md">
                        🔄 Update Diagnosis
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
