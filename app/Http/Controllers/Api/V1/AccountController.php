<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\V1\StoreAccountRequest;
use App\Http\Requests\V1\UpdateAccountRequest;
use App\Models\Account;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AccountResource;
use App\Http\Resources\V1\AccountCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Closure;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AccountController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meta = [
            'status'  => 200,
            'message' => "Accounts retrieved successfully.",
        ];

        $accountCollection = new AccountCollection(Account ::paginate());

        return $accountCollection -> additional($meta);
        //return new AccountCollection(Account ::with('transactions') -> paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreAccountRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountRequest $request)
    {
        $meta = [
            'status'  => 201,
            'message' => "New account created.",
        ];

        $newAccount = new AccountResource(Account ::create($request -> all()));

        return $newAccount -> additional($meta);
        //return new AccountResource(Account ::create($request -> all()));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Account $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        $retrievedAccount = new AccountResource($account -> loadMissing('transactions'));

        return response() -> success(200, 'Account details retrieved successfully.', $retrievedAccount);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateAccountRequest $request
     * @param \App\Models\Account $account
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request, Account $account)
    {
        $meta = [
            'body'    => $account,
            'status'  => 200,
            'message' => "Account $account->name modified successfully."
        ];
        $account -> update($request -> all());

        return response($meta);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Account $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        $meta = [
            'body'    => [
                'id'    => auth() -> user() -> id,
                'email' => auth() -> user() -> email
            ],
            'status'  => 200,
            'message' => "Account $account->name deleted successfully.",
        ];
        $account -> delete();

        return response($meta);
    }
}
