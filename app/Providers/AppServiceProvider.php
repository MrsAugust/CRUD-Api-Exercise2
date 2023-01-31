<?php

namespace App\Providers;

use App\Http\Resources\driverResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function boot()
    {
        Response::macro('success', function($response) {
            return response()->json([
                'status' => $response->status,
                'success' => $response->success,
                'message' => $response->message,
                'data' => $response->data
            ]);
        });

        JsonResource::withoutWrapping();
    }


}
