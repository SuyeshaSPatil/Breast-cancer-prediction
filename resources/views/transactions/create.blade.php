@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#e0f7fa] flex items-center justify-center px-4 py-10">
    <div class="bg-white/90 backdrop-blur-md border border-blue-100 rounded-xl shadow-lg w-full max-w-4xl p-8 relative">
        
        <a href="{{ route('transactions.index') }}"
            class="absolute top-4 left-4 text-blue-600 hover:text-blue-800 font-medium transition">
            ← Back to Transactions
        </a>  

        <h1 class="text-2xl font-semibold text-blue-800 text-center mb-6">Add New Transaction</h1>

        <form action="{{ route('transactions.store') }}" method="POST" id="transactionForm">
            @csrf

            <div class="space-y-4" id="productRows">
                <div class="flex items-center gap-4 product-row">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-blue-700 mb-1">Product</label>
                        <select name="products[0][product_id]" class="product-select w-full px-2 py-2 border border-blue-200 rounded-md bg-white text-gray-900" required>

                            <option value="" disabled selected>-- Select Product --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}" data-ratetype="{{ $product->rate_type }}">
                                    {{ $product->name }} - {{ $product->rate_type }} - ₹{{ $product->price }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-blue-700 mb-1">Price</label>
                        <input type="text" name="products[0][price]" class="price-input w-24 px-2 py-2 border border-blue-200 rounded-md bg-gray-100 text-gray-900" >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-blue-700 mb-1">Quantity</label>
                        <input type="number" name="products[0][quantity]" class="qty-input w-20 px-2 py-2 border border-blue-200 rounded-md text-gray-900" min="1" value="1">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-blue-700 mb-1">Amount</label>
                        <input type="text" name="products[0][amount]" class="amount-input w-24 px-2 py-2 border border-blue-200 rounded-md bg-gray-100 text-gray-900" readonly>
                    </div>

                    <button type="button" class="remove-btn text-red-600 font-bold mt-6 hidden">×</button>
                </div>
            </div>

            <div class="mt-6">
                <button type="button" id="addRowBtn"
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded">
                    + Add Product
                </button>
            </div>

            <div class="mt-6 text-right">
                <label class="text-lg font-medium text-blue-700">Total: ₹</label>
                <span id="totalAmount" class="text-xl font-bold text-blue-900">0.00</span>
                <input type="hidden" name="total_amount" id="totalInput">
            </div>

            <div class="pt-6">
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md transition duration-200 shadow">
                    Save Transaction
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let rowIndex = 1;

    function calculateAmount(row) {
        const price = parseFloat(row.querySelector('.price-input').value || 0);
        const qty = parseFloat(row.querySelector('.qty-input').value || 0);
        const amountField = row.querySelector('.amount-input');
        const amount = price * qty;
        amountField.value = amount.toFixed(2);
        calculateTotal();
    }

    function calculateTotal() {
        const amountInputs = document.querySelectorAll('.amount-input');
        let total = 0;
        amountInputs.forEach(input => {
            total += parseFloat(input.value || 0);
        });
        document.getElementById('totalAmount').textContent = total.toFixed(2);
        document.getElementById('totalInput').value = total.toFixed(2);
    }

    function bindRowEvents(row) {
        row.querySelector('.product-select').addEventListener('change', function() {
            const price = this.selectedOptions[0].dataset.price;
            row.querySelector('.price-input').value = price;
            calculateAmount(row);
        });

        row.querySelector('.qty-input').addEventListener('input', () => calculateAmount(row));

        row.querySelector('.remove-btn').addEventListener('click', () => {
            row.remove();
            calculateTotal();
        });
    }

    document.getElementById('addRowBtn').addEventListener('click', () => {
        const newRow = document.querySelector('.product-row').cloneNode(true);
        newRow.querySelectorAll('input, select').forEach(el => {
            const name = el.getAttribute('name');
            if (name) {
                const newName = name.replace(/\[\d+\]/, `[${rowIndex}]`);
                el.setAttribute('name', newName);
            }
            if (el.tagName === 'INPUT') el.value = '';
            if (el.classList.contains('amount-input') || el.classList.contains('price-input')) el.readOnly = true;
        });
        newRow.querySelector('.remove-btn').classList.remove('hidden');
        document.getElementById('productRows').appendChild(newRow);
        bindRowEvents(newRow);
        rowIndex++;
    });

    document.querySelectorAll('.product-row').forEach(row => bindRowEvents(row));
</script>
@endsection
