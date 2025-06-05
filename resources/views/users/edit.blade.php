@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#fff0f5] flex items-center justify-center px-4">
        <div class="relative bg-white/90 backdrop-blur-md border border-pink-200 rounded-2xl shadow-xl w-full max-w-lg p-8">

            <!-- Back Button at Top Left -->
            <a href="{{ route('users.index') }}"
                class="absolute top-4 left-4 text-pink-600 hover:text-pink-800 font-medium transition">
                ← Back to Patients
            </a>

            <h1 class="text-3xl font-bold text-pink-700 text-center mb-8">Update Patient Details</h1>

            <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-semibold text-pink-700 mb-1">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}" required
                        class="w-full px-4 py-2 border border-pink-200 rounded-lg shadow-sm text-pink-900 bg-white focus:outline-none focus:ring-2 focus:ring-pink-300 focus:border-pink-400"
                        placeholder="Enter patient's full name">
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-pink-700 mb-1">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" required
                        class="w-full px-4 py-2 border border-pink-200 rounded-lg shadow-sm text-pink-900 bg-white focus:outline-none focus:ring-2 focus:ring-pink-300 focus:border-pink-400"
                        placeholder="Enter patient's email">
                </div>

                <div>
                    <label for="mobile" class="block text-sm font-semibold text-pink-700 mb-1">Contact Number</label>
                    <input type="text" id="mobile" name="mobile" value="{{ $user->mobile }}"
                        class="w-full px-4 py-2 border border-pink-200 rounded-lg shadow-sm text-pink-900 bg-white focus:outline-none focus:ring-2 focus:ring-pink-300 focus:border-pink-400"
                        placeholder="Enter patient's contact number (optional)">
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-pink-500 hover:bg-pink-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 shadow">
                        💾 Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
