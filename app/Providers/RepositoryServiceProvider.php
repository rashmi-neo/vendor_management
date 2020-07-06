<?php

namespace App\Providers;

use App\Repositories\Category\CategoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Vendor\VendorInterface;
use App\Repositories\Vendor\VendorRepository;
use App\Repositories\Requirement\RequirementInterface;
use App\Repositories\Requirement\RequirementRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(VendorInterface::class, VendorRepository::class);
        $this->app->bind(RequirementInterface::class, RequirementRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
