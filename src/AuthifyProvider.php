<?php

namespace Larawise\Authify;

use Illuminate\Support\Facades\Route;
use Larawise\Authify\Contracts\ActionContract;
use Larawise\Authify\Contracts\AddressContract;
use Larawise\Authify\Contracts\DepartmentContract;
use Larawise\Authify\Contracts\GroupContract;
use Larawise\Authify\Contracts\PositionContract;
use Larawise\Authify\Contracts\ProviderContract;
use Larawise\Authify\Contracts\RoleContract;
use Larawise\Authify\Contracts\TeamContract;
use Larawise\Authify\Contracts\UserContract;
use Larawise\Authify\Contracts\WorkspaceContract;
use Larawise\Authify\Repository\ActionRepository;
use Larawise\Authify\Repository\AddressRepository;
use Larawise\Authify\Repository\DepartmentRepository;
use Larawise\Authify\Repository\GroupRepository;
use Larawise\Authify\Repository\PositionRepository;
use Larawise\Authify\Repository\ProviderRepository;
use Larawise\Authify\Repository\RoleRepository;
use Larawise\Authify\Repository\TeamRepository;
use Larawise\Authify\Repository\UserRepository;
use Larawise\Authify\Repository\WorkspaceRepository;
use Larawise\Packagify\Packagify;
use Larawise\Packagify\PackagifyProvider;

/**
 * Srylius - The ultimate symphony for technology architecture!
 *
 * @package     Larawise
 * @subpackage  Authify
 * @version     v1.0.0
 * @author      Selçuk Çukur <hk@selcukcukur.com.tr>
 * @copyright   Srylius Teknoloji Limited Şirketi
 *
 * @see https://docs.larawise.com/ Larawise : Docs
 */
class AuthifyProvider extends PackagifyProvider
{
    /**
     * Configure the packagify package.
     *
     * @param Packagify $package
     *
     * @return void
     */
    public function configure(Packagify $package)
    {
        $package->name('authify');
        $package->description('Authify - ');

        $package->hasConfigurations();

        // Enable bindings discovery for the Authify package.
        $package->hasBindings([
            ActionRepository::class => ActionContract::class,
            AddressRepository::class => AddressContract::class,
            DepartmentRepository::class => DepartmentContract::class,
            GroupRepository::class => GroupContract::class,
            PositionRepository::class => PositionContract::class,
            ProviderRepository::class => ProviderContract::class,
            RoleRepository::class => RoleContract::class,
            TeamRepository::class => TeamContract::class,
            UserRepository::class => UserContract::class,
            WorkspaceRepository::class => WorkspaceContract::class,
        ]);
    }

    public function packageRegistered()
    {
        // Authentication
//        Route::aliasMiddleware('guest', GuestMiddleware::class);
//        Route::aliasMiddleware('auth', AuthMiddleware::class);

    }


    protected function appendConfigurations()
    {
        $repository = $this->app->make('config');

        $repository->set('auth.guards', config('authify.guards'));
        $repository->set('auth.providers', config('authify.providers'));
    }

}
