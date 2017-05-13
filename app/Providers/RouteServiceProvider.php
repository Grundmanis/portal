<?php

namespace App\Providers;

use App\Advert;
use App\Category;
use App\Subcategory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    protected $data = [];


    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {

        Route::bind('categories', function($value) {

            // Slugs
            $slugs = explode('/', $value);
            $totalSlugs = count($slugs);
            $onlyOneCategory = $totalSlugs < 2;

            // Get categories
            $this->data['categories'] = $categories = Category::whereIn('slug',$slugs)->orderBy('id')->get();

            // Exception
            if ($categories->isEmpty()) dd('exception');

            $this->data['category'] = $category = $categories->last();

            // Get parent
            $parentKey = !$onlyOneCategory ? count($categories) - 2 : 0;
            $categoryParents = $category->parents->keyBy('id');

            // Check errors
            $allFound = $totalSlugs == count($categories);
            $parentExist = isset(
                $categories[$parentKey],
                $categoryParents[$categories[$parentKey]->id]
            );

            // Exception
            if (!$allFound || !$onlyOneCategory && !$parentExist) dd('exception');

            // Add parentCategory
            if (!$onlyOneCategory) {
                $this->data['categoryParent'] = $categories[$parentKey];
            }

            return $this->data;

        });

        Route::bind('locale', function($value) {
            App::setLocale($value);
        });
        Route::bind('category', function($value) {
            return Category::where('slug',$value)->first();
        });
        Route::bind('subcategory', function($value) {
            return Category::where('slug',$value)->first();
        });
        Route::bind('childsubcategory', function($value) {
            return Category::where('slug',$value)->first();
        });

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

}
