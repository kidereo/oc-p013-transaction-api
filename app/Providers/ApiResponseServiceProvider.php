<?php

namespace App\Providers;

use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;

class ApiResponseServiceProvider extends ServiceProvider {

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $response = app(ResponseFactory::class);

        $response -> macro('success', function ($status, $message, $body = null) use ($response) {
            $responseData = [
                'status'  => $status,
                'message' => $message,
                'body'    => $body
            ];

            return $response -> json($responseData, $status);
        });

        $response -> macro('error', function ($status, $message) use ($response) {
            $responseData = [
                'status'  => $status,
                'message' => $message,
                'body'    => [
                    'id'    => auth() -> user() -> id,
                    'email' => auth() -> user() -> email
                ],
            ];

            return $response -> json($responseData, $status);
        });
    }
}
