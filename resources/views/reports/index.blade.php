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
                <h1 class="text-3xl font-bold text-pink-700">Reports</h1>
                <a href="{{ route('reports.create') }}"
                    class="bg-pink-500 hover:bg-pink-600 text-white py-2 px-6 rounded-lg shadow-md transition duration-200">
                    ➕ Generate New Report
                </a>
            </div>

            <div class="overflow-x-auto rounded-lg shadow-inner">
                <table class="min-w-full bg-white border border-pink-200 rounded-xl overflow-hidden">
                    <thead class="bg-pink-100 text-pink-800 text-left text-md">
                        <tr>
                            <th class="px-4 py-3 border-b">ID</th>
                            <th class="px-4 py-3 border-b">Title</th>
                            <th class="px-4 py-3 border-b">Patient Name</th>
                            <th class="px-4 py-3 border-b">Dashboard</th>
                            <th class="px-4 py-3 border-b">Description</th>
                            <th class="px-4 py-3 border-b">Generated On</th>
                            <th class="px-4 py-3 border-b">Attachment</th>
                            <th class="px-4 py-3 border-b text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-pink-900">
                        @forelse($reports as $report)
                            <tr class="hover:bg-pink-50 transition duration-150">
                                <td class="px-4 py-3 border-b">{{ $report->id }}</td>
                                <td class="px-4 py-3 border-b">{{ $report->title }}</td>
                                <td class="px-4 py-3 border-b">{{ $report->user->name ?? 'N/A' }}</td>
                                <td class="px-4 py-3 border-b text-center">
                                @if ($report->attachment && $report->user)
    <a href="{{ route('dashboard.show',  $report->user->id) }}"
       class="text-green-600 underline hover:text-green-800">
       📊 View Dashboard
    </a>
@else
    <span class="text-gray-400">No Data</span>
@endif

    </td>
    
                                <td class="px-4 py-3 border-b">{{ $report->description ?: 'No description available' }}</td>
                                <td class="px-4 py-3 border-b">{{ $report->created_at->format('Y-m-d') }}</td>
                                <td class="px-4 py-3 border-b">
                                    @if ($report->attachment)
                                        <a href="{{ route('reports.file', $report->attachment) }}"
                                            target="_blank" class="text-blue-600 underline">
                                            📎 View
                                        </a>
                                    @else
                                        <span class="text-gray-500">No attachment</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 border-b text-center">
                                    <div class="flex items-center justify-center space-x-3">
                                        <a href="{{ route('reports.edit', $report->id) }}"
                                            class="text-pink-600 hover:text-pink-800 text-xl" title="Edit Report">
                                            ✏️
                                        </a>
                                        <form action="{{ route('reports.destroy', $report->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this report?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 text-xl" title="Delete Report">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-pink-600 py-6 font-semibold">No reports found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
