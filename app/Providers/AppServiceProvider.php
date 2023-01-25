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
        Response::macro('success', function($message,$data) {
            return response()->json([
                'status' => 'OK',
                'success' => true,
                'message' => $message,
                'data' => $data
            ]);
        });

    Response::macro('error', function($message,$data) {
        return response()->json([
                'status' => 'ERROR',
                'success' => false,
                'message' => $message,
                'data' => $data
            ]
        );
    });
        JsonResource::withoutWrapping();
    }


}
