<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;


class TransactionController extends Controller
{
    //
    
public function index()
{
    $transactions = Transaction::whereNull('deleted_at')->get();
    return view('transactions.index', compact('transactions'));
}

public function create()
{
    $users = User::all(); // Fetch all users
    $products = Product::all(); // Fetch all products

    return view('transactions.create', compact('users', 'products'));
}

public function store(Request $request)
{
    $request->validate([
        'products' => 'required|array',
        'products.*.product_id' => 'required|integer',
        'products.*.price' => 'required|numeric',
        'products.*.quantity' => 'required|integer',
    ]);

    // Create a new transaction
    $transaction = new Transaction();
    $transaction->user_id = auth()->id();  // assuming the user is logged in
    $transaction->total_amount = $request->total_amount;
    $transaction->paid_amount = 0.00;  // or set the paid amount if available
    $transaction->status = 'unpaid'; // default status
    $transaction->save();

    // Save each product in transaction_products table
    foreach ($request->products as $productData) {
        $product = Product::find($productData['product_id']);
        $amount = $productData['price'] * $productData['quantity'];

        TransactionProduct::create([
            'bill_no' => $transaction->id,
            'product_id' => $productData['product_id'],
            'price' => $productData['price'],
            'quantity' => $productData['quantity'],
            'amount' => $amount,
        ]);
    }

    // Create a receipt for the transaction
    Receipt::create([
        'bill_no' => $transaction->id,
        'total_amount' => $transaction->total_amount,
        'paid_amount' => $transaction->paid_amount,
    ]);

    return redirect()->route('transactions.index')->with('success', 'Transaction created successfully');
}



public function show(Transaction $transaction)
{
    return view('transactions.show', compact('transaction'));
}

public function edit($id)
{
    // Get the transaction by its ID
    $transaction = Transaction::with('products')->findOrFail($id);

    // Get all available products
    $products = Product::all();

    return view('transactions.edit', compact('transaction', 'products'));
}


// public function update(Request $request, $id)
// {
//     $request->validate([
//         'products' => 'required|array',
//         'products.*.product_id' => 'required|integer',
//         'products.*.price' => 'required|numeric',
//         'products.*.quantity' => 'required|integer',
//     ]);

//     // Find the transaction
//     $transaction = Transaction::findOrFail($id);
//     $transaction->total_amount = $request->total_amount;
//     $transaction->paid_amount = $request->paid_amount; // If available
//     $transaction->status = $request->status;  // Assuming the status can be updated
//     $transaction->save();

//     // Delete existing transaction products to replace them
//     $transaction->products()->delete();

//     // Save each product in transaction_products table
//     foreach ($request->products as $productData) {
//         $product = Product::find($productData['product_id']);
//         $amount = $productData['price'] * $productData['quantity'];

//         TransactionProduct::create([
//             'bill_no' => $transaction->id,
//             'product_id' => $productData['product_id'],
//             'price' => $productData['price'],
//             'quantity' => $productData['quantity'],
//             'amount' => $amount,
//         ]);
//     }

//     // Update or create receipt for the transaction
//     $receipt = Receipt::updateOrCreate(
//         ['bill_no' => $transaction->id],
//         [
//             'total_amount' => $transaction->total_amount,
//             'paid_amount' => $transaction->paid_amount,
//         ]
//     );

//     return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully');
// }
// public function update(Request $request, $id)
// {
//     // Start a database transaction to ensure atomicity
//     DB::beginTransaction();

//     try {
//         // Find the transaction to be updated
//         $transaction = Transaction::findOrFail($id);

//         // Update the transaction details (receipt, other fields, etc.)
//         $transaction->update([
//             'receipt' => $request->input('receipt'),  // Assuming you have a 'receipt' field
//             // other transaction fields to update...
//         ]);

//         // Loop through the provided products to update transaction_product table
//         foreach ($request->input('products') as $index => $productData) {
//             $productId = $productData['product_id'];
//             $quantity = $productData['quantity'];  // Assuming you are tracking quantity
            
//             // Find or create the record in transaction_product
//             $transactionProduct = TransactionProduct::where('transaction_id', $id)
//                                                      ->where('product_id', $productId)
//                                                      ->first();
            
//             if ($transactionProduct) {
//                 // Update the product details in transaction_product
//                 $transactionProduct->update([
//                     'quantity' => $quantity,
//                     'price' => $productData['price'],
//                     'rate_type' => $productData['rate_type'],
//                     // other necessary fields...
//                 ]);
//             } else {
//                 // Add new record to transaction_product if it doesn't exist
//                 TransactionProduct::create([
//                     'transaction_id' => $id,
//                     'product_id' => $productId,
//                     'quantity' => $quantity,
//                     'price' => $productData['price'],
//                     'rate_type' => $productData['rate_type'],
//                 ]);
//             }
//         }

//         // Commit the transaction
//         DB::commit();

//         // Redirect back with a success message
//         return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully');
//     } catch (\Exception $e) {
//         // If any error occurs, rollback the transaction
//         DB::rollBack();

//         // Log the error or handle it
//         return back()->with('error', 'An error occurred while updating the transaction');
//     }
// }

public function update(Request $request, $id)
{
    $transaction = Transaction::findOrFail($id);

    // Example: Update products with the given data from the form
    $productData = $request->input('products'); // This should be an array

    $transaction->products()->sync($productData); // This will update the pivot table with the selected products

    // Optionally update other fields in the transactions table, like receipt
    $transaction->receipt = $request->input('receipt');
    $transaction->save();

    return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully');
}



public function destroy(Transaction $transaction)
{
    $transaction->delete();
    return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully');
}
}
