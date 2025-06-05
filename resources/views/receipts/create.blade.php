@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Add New Receipt</h1>

        <form action="{{ route('receipts.store') }}" method="POST" class="w-full max-w-lg">
            @csrf
            <div class="mb-4">
                <label for="transaction_id" class="block text-sm font-medium text-gray-700">Transaction</label>
                <select id="transaction_id" name="transaction_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @foreach($transactions as $transaction)
                        <option value="{{ $transaction->id }}">{{ $transaction->id }} - {{ $transaction->user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                <input type="text" id="amount" name="amount" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Create Receipt</button>
        </form>
    </div>
@endsection
