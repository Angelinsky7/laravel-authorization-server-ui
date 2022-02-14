<?php

namespace Darkink\AuthorizationServerUI;

use Darkink\AuthorizationServerUI\Http\Controllers\RoleController;
use Darkink\AuthorizationServerUI\Http\Controllers\PermissionController;
use Darkink\AuthorizationServerUI\Http\Controllers\ResourceController;
use Darkink\AuthorizationServerUI\Http\Controllers\ScopeController;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class PolicyUI
{
    public static function routes()
    {
        Route::prefix('policy')->middleware(config('policy.route.web'))->group(function () {
            Route::group(['prefix' => 'role'], function () {
                Route::get('/', [RoleController::class, 'index'])->middleware('can:role.see')->name('policy-ui.role.index');
                // Route::get('/delete-multiple', [RoleController::class, 'deleteMultiple'])->middleware('can:role.delete')->name('policy-ui.role.delete-multiple');
                Route::get('/create', [RoleController::class, 'create'])->middleware('can:role.create')->name('policy-ui.role.create');
                Route::post('/create', [RoleController::class, 'store'])->middleware('can:role.create')->name('policy-ui.role.store');
                Route::get('/{role}', [RoleController::class, 'show'])->middleware('can:role.see')->name('policy-ui.role.show');
                Route::get('/{role}/edit', [RoleController::class, 'edit'])->middleware('can:role.update')->name('policy-ui.role.edit');
                Route::put('/{role}', [RoleController::class, 'update'])->middleware('can:role.update')->name('policy-ui.role.update');
                Route::get('/{role}/delete', [RoleController::class, 'delete'])->middleware('can:role.delete')->name('policy-ui.role.delete');
                // Route::delete('/destroy-multiple', [RoleController::class, 'destroyMultiple'])->middleware('can:role.delete')->name('policy-ui.role.destroy-multiple');
                Route::delete('/{role}', [RoleController::class, 'destroy'])->middleware('can:role.delete')->name('policy-ui.role.destroy');
            });

            Route::group(['prefix' => 'resource'], function () {
                Route::get('/', [ResourceController::class, 'index'])->middleware('can:resource.see')->name('policy-ui.resource.index');
                Route::get('/create', [ResourceController::class, 'create'])->middleware('can:resource.create')->name('policy-ui.resource.create');
                Route::post('/create', [ResourceController::class, 'store'])->middleware('can:resource.create')->name('policy-ui.resource.store');
                Route::get('/{resource}', [ResourceController::class, 'show'])->middleware('can:resource.see')->name('policy-ui.resource.show');
                Route::get('/{resource}/edit', [ResourceController::class, 'edit'])->middleware('can:resource.update')->name('policy-ui.resource.edit');
                Route::put('/{resource}', [ResourceController::class, 'update'])->middleware('can:resource.update')->name('policy-ui.resource.update');
                Route::get('/{resource}/delete', [ResourceController::class, 'delete'])->middleware('can:resource.delete')->name('policy-ui.resource.delete');
                Route::delete('/{resource}', [ResourceController::class, 'destroy'])->middleware('can:resource.delete')->name('policy-ui.resource.destroy');
            });

            Route::group(['prefix' => 'scope'], function () {
                Route::get('/', [ScopeController::class, 'index'])->middleware('can:scope.see')->name('policy-ui.scope.index');
                Route::get('/create', [ScopeController::class, 'create'])->middleware('can:scope.create')->name('policy-ui.scope.create');
                Route::post('/create', [ScopeController::class, 'store'])->middleware('can:scope.create')->name('policy-ui.scope.store');
                Route::get('/{scope}', [ScopeController::class, 'show'])->middleware('can:scope.see')->name('policy-ui.scope.show');
                Route::get('/{scope}/edit', [ScopeController::class, 'edit'])->middleware('can:scope.update')->name('policy-ui.scope.edit');
                Route::put('/{scope}', [ScopeController::class, 'update'])->middleware('can:scope.update')->name('policy-ui.scope.update');
                Route::get('/{scope}/delete', [ScopeController::class, 'delete'])->middleware('can:scope.delete')->name('policy-ui.scope.delete');
                Route::delete('/{scope}', [ScopeController::class, 'destroy'])->middleware('can:scope.delete')->name('policy-ui.scope.destroy');
            });

            Route::group(['prefix' => 'permission'], function () {
                Route::get('/', [PermissionController::class, 'index'])->middleware('can:permission.see')->name('policy-ui.permission.index');
                Route::get('/create', [PermissionController::class, 'create'])->middleware('can:permission.create')->name('policy-ui.permission.create');
                // Route::get('/create/scope', [PermissionController::class, 'createScope'])->middleware('can:permission.create-scope')->name('policy-ui.permission.create-scope');
                // Route::get('/create/resource', [PermissionController::class, 'createResource'])->middleware('can:permission.create-resource')->name('policy-ui.permission.create-resource');
                Route::post('/create', [PermissionController::class, 'store'])->middleware('can:permission.create')->name('policy-ui.permission.store');
                // Route::post('/create/resource', [PermissionController::class, 'storeresource'])->middleware('can:permission.create-resource')->name('policy-ui.permission.store-resource');
                Route::get('/{permission}', [PermissionController::class, 'show'])->middleware('can:permission.see')->name('policy-ui.permission.show');
                Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->middleware('can:permission.update')->name('policy-ui.permission.edit');
                Route::put('/{permission}', [PermissionController::class, 'update'])->middleware('can:permission.update')->name('policy-ui.permission.update');
                Route::get('/{permission}/delete', [PermissionController::class, 'delete'])->middleware('can:permission.delete')->name('policy-ui.permission.delete');
                Route::delete('/{permission}', [PermissionController::class, 'destroy'])->middleware('can:permission.delete')->name('policy-ui.permission.destroy');
            });







            Route::group(['prefix' => 'client'], function () {
                Route::get('/', [ClientController::class, 'index'])->middleware('can:client.see')->name('policy-ui.client.index');
            });
            Route::group(['prefix' => 'user'], function () {
                Route::get('/', [UserController::class, 'index'])->middleware('can:user.see')->name('policy-ui.user.index');
            });
            Route::group(['prefix' => 'group'], function () {
                Route::get('/', [GroupController::class, 'index'])->middleware('can:group.see')->name('policy-ui.group.index');
            });
            Route::group(['prefix' => 'policy'], function () {
                Route::get('/', [PolicyController::class, 'index'])->middleware('can:policy.see')->name('policy-ui.policy.index');
            });



        });
    }

    // public static function gates()
    // {
    //     Gate::after(function ($user, $ability, $result, $arguments) {
    //         if ($user->hasRole('admin')) {
    //             return true;
    //         }
    //         return $user->hasPermission($ability);
    //     });
    // }

}
