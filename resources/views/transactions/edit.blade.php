@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#e0f7fa] flex items-center justify-center px-4 py-10">
    <div class="bg-white/90 backdrop-blur-md border border-blue-100 rounded-xl shadow-lg w-full max-w-4xl p-8 relative">
        
        <a href="{{ route('transactions.index') }}"
            class="absolute top-4 left-4 text-blue-600 hover:text-blue-800 font-medium transition">
            ← Back to Transactions
        </a>  

        <h1 class="text-2xl font-semibold text-blue-800 text-center mb-6">Edit Transaction</h1>

        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" id="transactionForm">
    @csrf
    @method('PUT')

    <div class="space-y-4" id="productRows">
        @foreach($transaction->products as $index => $product)
            <div class="flex items-center gap-4 product-row">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-blue-700 mb-1">Product</label>
                    <select name="products[{{ $index }}][product_id]" class="product-select w-full px-2 py-2 border border-blue-200 rounded-md bg-white text-gray-900" required>
                        <option value="" disabled selected>-- Select Product --</option>
                        @foreach($products as $productOption)
                            <option value="{{ $productOption->id }}" data-price="{{ $productOption->price }}" data-ratetype="{{ $productOption->rate_type }}"
                                {{ $productOption->id == $product->product_id ? 'selected' : '' }}>
                                {{ $productOption->name }} - {{ $productOption->rate_type }} - ₹{{ $productOption->price }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Additional fields for price, rate_type, etc. -->
                <input type="number" name="products[{{ $index }}][quantity]" value="{{ $product->quantity }}" required class="w-24 px-2 py-2 border border-blue-200 rounded-md" />
                <input type="hidden" name="products[{{ $index }}][price]" value="{{ $product->price }}" />
                <input type="hidden" name="products[{{ $index }}][rate_type]" value="{{ $product->rate_type }}" />
            </div>
        @endforeach
    </div>

    <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-md">Update Transaction</button>
</form>

    </div>
</div>

<script>
    let rowIndex = {{ count($transaction->products) }};
    
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
