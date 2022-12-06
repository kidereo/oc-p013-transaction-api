<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\V1\StoreBulkTransactionRequest;
use App\Http\Requests\V1\StoreTransactionRequest;
use App\Http\Requests\V1\UpdateTransactionRequest;
use App\Http\Resources\V1\TransactionCollection;
use App\Http\Resources\V1\TransactionResource;
use App\Models\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TransactionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meta = [
            'status'  => 200,
            'message' => "Transactions retrieved successfully.",
        ];

        $transactionCollection = new TransactionCollection(Transaction ::paginate());

        return $transactionCollection -> additional($meta);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\V1\StoreTransactionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        $meta = [
            'status'  => 201,
            'message' => "New transaction created.",
        ];

        $newTransaction = new  TransactionResource(Transaction ::create($request -> all()));

        return $newTransaction -> additional($meta);
    }

    /**
     * Store a bunch of newly created resources in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function bulkStore(StoreBulkTransactionRequest $request)
    {
        $bulk = collect($request -> all()) -> map(function ($arr, $key) {
            return Arr ::except($arr, ['accountId']);
        });

        Transaction ::insert($bulk -> toArray());

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $meta = [
            'status'  => 200,
            'message' => "Transaction details retrieved successfully.",
        ];

        $retrievedTransaction = new TransactionResource($transaction);

        return $retrievedTransaction -> additional($meta);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateTransactionRequest $request
     * @param \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $meta = [
            'body'    => $transaction,
            'status'  => 201,
            'message' => "Transaction modified successfully."
        ];
        $transaction -> update($request -> all());

        return response($meta);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $meta = [
            'body'    => [
                'id'    => auth() -> user() -> id,
                'email' => auth() -> user() -> email
            ],
            'status'  => 200,
            'message' => "Transaction deleted successfully.",
        ];

        $transaction -> delete();

        return response($meta);
    }
}
