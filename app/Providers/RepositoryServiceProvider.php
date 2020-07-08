<?php

namespace App\Providers;

use App\Repositories\Category\CategoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Vendor\VendorInterface;
use App\Repositories\Vendor\VendorRepository;
use App\Repositories\Requirement\RequirementInterface;
use App\Repositories\Requirement\RequirementRepository;
use App\Repositories\Notifications\NotificationsInterface;
use App\Repositories\Notifications\NotificationsRepository;
use App\Repositories\Account\AccountInterface;
use App\Repositories\Account\AccountRepository;

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
        $this->app->bind(NotificationsInterface::class, NotificationsRepository::class);
        $this->app->bind(AccountInterface::class, AccountRepository::class);
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

    public function provides() {
        return [
            
            CategoryInterface::class,
            VendorInterface::class,
            RequirementInterface::class,
            NotificationsInterface::class,
            AccountInterface::class, 
        ];
    }
}
