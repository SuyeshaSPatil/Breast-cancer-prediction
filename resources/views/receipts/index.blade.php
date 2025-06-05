@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Receipts</h1>
        <a href="{{ route('receipts.create') }}" class="bg-green-500 text-white p-2 rounded mb-4">Add New Receipt</a>

        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Transaction ID</th>
                    <th class="px-4 py-2 border">Amount</th>
                    <th class="px-4 py-2 border">Date</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($receipts as $receipt)
                    <tr>
                        <td class="px-4 py-2 border">{{ $receipt->id }}</td>
                        <td class="px-4 py-2 border">{{ $receipt->transaction_id }}</td>
                        <td class="px-4 py-2 border">{{ $receipt->amount }}</td>
                        <td class="px-4 py-2 border">{{ $receipt->created_at }}</td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('receipts.edit', $receipt->id) }}" class="text-blue-500">Edit</a>
                            <form action="{{ route('receipts.destroy', $receipt->id) }}" method="POST" class="inline-block ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
