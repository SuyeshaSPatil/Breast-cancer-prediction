@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#e0f7fa] px-4 py-8">
        <div class="max-w-6xl mx-auto bg-white/90 backdrop-blur-md border border-blue-100 rounded-xl shadow-lg p-6">

           

            {{-- Success Flash Message --}}
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-semibold text-blue-800">Products</h1>
                <a href="{{ route('products.create') }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow transition duration-200">
                    Add New Product
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-md shadow">
                    <thead class="bg-blue-100 text-blue-800 text-left">
                        <tr>
                            <th class="px-4 py-3 border-b">ID</th>
                            <th class="px-4 py-3 border-b">Name</th>
                            <th class="px-4 py-3 border-b">Type</th>
                            <th class="px-4 py-3 border-b">Rate Type</th>
                            <th class="px-4 py-3 border-b">Price</th>
                            <th class="px-4 py-3 border-b text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-blue-900">
                        @forelse($products as $product)
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-4 py-3 border-b">{{ $product->id }}</td>
                                <td class="px-4 py-3 border-b">{{ $product->name }}</td>
                                <td class="px-4 py-3 border-b">{{ $product->type }}</td>
                                <td class="px-4 py-3 border-b">{{ $product->rate_type }}</td>
                                <td class="px-4 py-3 border-b">{{ $product->price }}</td>
                                <td class="px-4 py-3 border-b text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="text-blue-600 hover:text-blue-800" title="Edit">
                                            ✏️
                                        </a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this product?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700" title="Delete">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-blue-600 py-4">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
