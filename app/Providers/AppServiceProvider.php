<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; 
use App\Models\Setting; 
use Illuminate\Pagination\LengthAwarePaginator; 
use Illuminate\Support\Collection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $waSetting = Setting::where('key', 'admin_whatsapp')->first();
            $view->with('waSetting', $waSetting);
        });



        Collection::macro('paginate', function ($perPage, $page = null, $options = []) {
            /** @var \Illuminate\Support\Collection $this */
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage();

            return new LengthAwarePaginator(
                $this->forPage($page, $perPage)->values(),
                $this->count(),
                $perPage,
                $page,
                $options
            );
        });

    }

    
}
