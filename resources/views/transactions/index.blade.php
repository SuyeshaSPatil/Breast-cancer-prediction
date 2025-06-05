@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#f1f8ff] flex flex-col items-center justify-start px-4 py-8">
        <div class="w-full max-w-6xl bg-white/90 backdrop-blur-md border border-blue-100 rounded-xl shadow-lg p-6">
            
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-blue-800">Transactions</h1>
                <a href="{{ route('transactions.create') }}"
                   class="bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded shadow transition duration-200">
                    + Add New Transaction
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-blue-200 rounded-md text-blue-900 shadow-sm">
                    <thead class="bg-blue-100 text-blue-700">
                        <tr>
                            <th class="px-6 py-3 border-b">Sr. No</th>
                            <th class="px-6 py-3 border-b">User</th>
                            <th class="px-6 py-3 border-b">Total Amount</th>
                            <th class="px-6 py-3 border-b">Paid Amount</th>
                            <th class="px-6 py-3 border-b">Date</th>
                            <th class="px-6 py-3 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $index => $transaction)
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-6 py-3 border-b text-center">{{ $index + 1 }}</td>
                                <td class="px-6 py-3 border-b">{{ $transaction->user->name }}</td>
                                <td class="px-6 py-3 border-b">₹{{ number_format($transaction->total_amount, 2) }}</td>
                                <td class="px-6 py-3 border-b">₹{{ number_format($transaction->paid_amount, 2) }}</td>
                                <td class="px-6 py-3 border-b">{{ $transaction->created_at->format('d M Y, h:i A') }}</td>
                                <td class="px-6 py-3 border-b">
                                    <div class="flex space-x-4 justify-center">
                                        <a href="{{ route('transactions.edit', $transaction->id) }}"
                                           class="text-blue-600 hover:underline font-medium">Edit</a>
                                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:underline font-medium"
                                                onclick="return confirm('Are you sure you want to delete this transaction?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No transactions found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
