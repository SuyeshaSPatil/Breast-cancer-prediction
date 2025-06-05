@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#fff0f5] px-4 py-8">
        <div class="max-w-6xl mx-auto bg-white/90 backdrop-blur-md border border-pink-100 rounded-2xl shadow-xl p-8">

            {{-- Success Flash Message --}}
            @if (session('success'))
                <div class="mb-6 bg-pink-100 border border-pink-400 text-pink-800 px-4 py-3 rounded-lg shadow">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-bold text-pink-700">Breast Cancer Patients</h1>
                <a href="{{ route('users.create') }}"
                    class="bg-pink-500 hover:bg-pink-600 text-white py-2 px-6 rounded-lg shadow-md transition duration-200">
                    ➕ Add New Patient
                </a>
            </div>

            <div class="overflow-x-auto rounded-lg shadow-inner">
                <table class="min-w-full bg-white border border-pink-200 rounded-xl overflow-hidden">
                    <thead class="bg-pink-100 text-pink-800 text-left text-md">
                        <tr>
                            <th class="px-4 py-3 border-b">ID</th>
                            <th class="px-4 py-3 border-b">Name</th>
                            <th class="px-4 py-3 border-b">Email</th>
                            <th class="px-4 py-3 border-b">Mobile</th>
                            <th class="px-4 py-3 border-b text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-pink-900">
                        @forelse($users as $user)
                            <tr class="hover:bg-pink-50 transition duration-150">
                                <td class="px-4 py-3 border-b">{{ $user->id }}</td>
                                <td class="px-4 py-3 border-b font-medium">{{ $user->name }}</td>
                                <td class="px-4 py-3 border-b">{{ $user->email }}</td>
                                <td class="px-4 py-3 border-b">{{ $user->mobile }}</td>
                                <td class="px-4 py-3 border-b text-center">
                                    <div class="flex items-center justify-center space-x-3">
                                        {{-- Edit Icon --}}
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="text-pink-600 hover:text-pink-800 text-xl" title="Edit Patient">
                                            ✏️
                                        </a>

                                        {{-- Delete Icon --}}
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this patient?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 text-xl" title="Delete Patient">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-pink-600 py-6 font-semibold">No patients found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
