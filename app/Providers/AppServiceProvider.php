<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        Validator::extend("check_category", function ($attribute, $value, $parameters, $validator)
        {
            // $category = Category::where("slug", $value)->first();
            // dd($value);
            $parent = Category::where('id', $value)->first();
            if ($parent?->parent_id == $value) {
                return false;
            }
            return true;
        },'Invalid parent category. Please select a valid parent category.');


        Paginator::useBootstrapFour();

    }
}
