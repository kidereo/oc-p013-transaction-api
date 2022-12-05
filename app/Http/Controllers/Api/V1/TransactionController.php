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
        return new TransactionCollection(Transaction ::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\V1\StoreTransactionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        return new  TransactionResource(Transaction ::create($request -> all()));
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
            return Arr::except($arr, ["accountId"]);
        });

        Transaction::insert($bulk->toArray());

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return new TransactionResource($transaction);
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
        $transaction -> update($request -> all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction -> delete();
    }
}
