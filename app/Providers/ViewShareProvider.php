<?php

namespace App\Providers;

use App\Models\ProductCategory;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewShareProvider extends ServiceProvider
{
    public function boot()
    {
        if (! app()->runningInConsole()) {
            Paginator::useBootstrap();
            Carbon::setLocale(config('app.locale'));
            URL::forceScheme('https');
            config()->set('settings', Setting::pluck('value','item')->all());

            View::share([
                'services' => Service::all(),
                'servicecategories' => ServiceCategory::all(),
                'categories' => ProductCategory::orderBy('rank', 'asc')->get()
            ]);
       }
    }
}
