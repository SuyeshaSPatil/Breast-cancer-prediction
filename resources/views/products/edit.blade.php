@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#e0f7fa] flex items-center justify-center px-4">
        <div class="bg-white/90 backdrop-blur-md border border-blue-100 rounded-xl shadow-lg w-full max-w-lg p-8">
            <a href="{{ route('products.index') }}"
                class="absolute top-4 left-4 text-blue-600 hover:text-blue-800 font-medium transition">
                ← Back to Products
            </a>  
            
            <h1 class="text-2xl font-semibold text-blue-800 text-center mb-6">Edit Product</h1>

            <form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-medium text-blue-700 mb-1">Product Name</label>
                    <input type="text" id="name" name="name" value="{{ $product->name }}" required
                        class="w-full px-4 py-2 border border-blue-200 rounded-md shadow-sm text-blue-900 bg-white focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400"
                        placeholder="Enter product name">
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-blue-700 mb-1">Product Type</label>
                    <input type="text" id="type" name="type" value="{{ $product->type }}" required
                        class="w-full px-4 py-2 border border-blue-200 rounded-md shadow-sm text-blue-900 bg-white focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400"
                        placeholder="Enter product type">
                </div>

                <div>
                    <label for="rate_type" class="block text-sm font-medium text-blue-700 mb-1">Rate Type</label>
                    <select id="rate_type" name="rate_type" required
                        class="w-full px-4 py-2 border border-blue-200 rounded-md shadow-sm text-blue-900 bg-white focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400">
                        <option value="kg" {{ $product->rate_type == 'kg' ? 'selected' : '' }}>kg</option>
                        <option value="pack" {{ $product->rate_type == 'pack' ? 'selected' : '' }}>pack</option>
                        <option value="box" {{ $product->rate_type == 'box' ? 'selected' : '' }}>box</option>
                        <option value="gms" {{ $product->rate_type == 'gms' ? 'selected' : '' }}>grams</option>
                    </select>
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-blue-700 mb-1">Product Price</label>
                    <input type="text" id="price" name="price" value="{{ $product->price }}" required
                        class="w-full px-4 py-2 border border-blue-200 rounded-md shadow-sm text-blue-900 bg-white focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400"
                        placeholder="Enter product price">
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md transition duration-200 shadow">
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
