<?php

namespace Darkink\AuthorizationServerUI;

use Darkink\AuthorizationServerUI\Http\Controllers\GroupController;
use Darkink\AuthorizationServerUI\Http\Controllers\RoleController;
use Darkink\AuthorizationServerUI\Http\Controllers\PermissionController;
use Darkink\AuthorizationServerUI\Http\Controllers\PolicyController;
use Darkink\AuthorizationServerUI\Http\Controllers\ResourceController;
use Darkink\AuthorizationServerUI\Http\Controllers\ScopeController;
use Darkink\AuthorizationServerUI\Http\Controllers\UserController;
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
                Route::post('/create', [PermissionController::class, 'store'])->middleware('can:permission.create')->name('policy-ui.permission.store');
                Route::get('/{permission}', [PermissionController::class, 'show'])->middleware('can:permission.see')->name('policy-ui.permission.show');
                Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->middleware('can:permission.update')->name('policy-ui.permission.edit');
                Route::put('/{permission}', [PermissionController::class, 'update'])->middleware('can:permission.update')->name('policy-ui.permission.update');
                Route::get('/{permission}/delete', [PermissionController::class, 'delete'])->middleware('can:permission.delete')->name('policy-ui.permission.delete');
                Route::delete('/{permission}', [PermissionController::class, 'destroy'])->middleware('can:permission.delete')->name('policy-ui.permission.destroy');
            });

            Route::group(['prefix' => 'group'], function () {
                Route::get('/', [GroupController::class, 'index'])->middleware('can:group.see')->name('policy-ui.group.index');
                Route::get('/create', [GroupController::class, 'create'])->middleware('can:group.create')->name('policy-ui.group.create');
                Route::post('/create', [GroupController::class, 'store'])->middleware('can:group.create')->name('policy-ui.group.store');
                Route::get('/{group}', [GroupController::class, 'show'])->middleware('can:group.see')->name('policy-ui.group.show');
                Route::get('/{group}/edit', [GroupController::class, 'edit'])->middleware('can:group.update')->name('policy-ui.group.edit');
                Route::put('/{group}', [GroupController::class, 'update'])->middleware('can:group.update')->name('policy-ui.group.update');
                Route::get('/{group}/delete', [GroupController::class, 'delete'])->middleware('can:group.delete')->name('policy-ui.group.delete');
                Route::delete('/{group}', [GroupController::class, 'destroy'])->middleware('can:group.delete')->name('policy-ui.group.destroy');
            });

            Route::group(['prefix' => 'user'], function () {
                Route::get('/', [UserController::class, 'index'])->middleware('can:user.see')->name('policy-ui.user.index');
                Route::get('/create', [UserController::class, 'create'])->middleware('can:user.create')->name('policy-ui.user.create');
                Route::post('/create', [UserController::class, 'store'])->middleware('can:user.create')->name('policy-ui.user.store');
                Route::get('/{user}', [UserController::class, 'show'])->middleware('can:user.see')->name('policy-ui.user.show');
                Route::get('/{user}/edit', [UserController::class, 'edit'])->middleware('can:user.update')->name('policy-ui.user.edit');
                Route::put('/{user}', [UserController::class, 'update'])->middleware('can:user.update')->name('policy-ui.user.update');
                Route::get('/{user}/delete', [UserController::class, 'delete'])->middleware('can:user.delete')->name('policy-ui.user.delete');
                Route::delete('/{user}', [UserController::class, 'destroy'])->middleware('can:user.delete')->name('policy-ui.user.destroy');
            });

            Route::group(['prefix' => 'policy'], function () {
                Route::get('/', [PolicyController::class, 'index'])->middleware('can:policy.see')->name('policy-ui.policy.index');
                Route::get('/create', [PolicyController::class, 'create'])->middleware('can:policy.create')->name('policy-ui.policy.create');
                Route::post('/create', [PolicyController::class, 'store'])->middleware('can:policy.create')->name('policy-ui.policy.store');
                Route::get('/{policy}', [PolicyController::class, 'show'])->middleware('can:policy.see')->name('policy-ui.policy.show');
                Route::get('/{policy}/edit', [PolicyController::class, 'edit'])->middleware('can:policy.update')->name('policy-ui.policy.edit');
                Route::put('/{policy}', [PolicyController::class, 'update'])->middleware('can:policy.update')->name('policy-ui.policy.update');
                Route::get('/{policy}/delete', [PolicyController::class, 'delete'])->middleware('can:policy.delete')->name('policy-ui.policy.delete');
                Route::delete('/{policy}', [PolicyController::class, 'destroy'])->middleware('can:policy.delete')->name('policy-ui.policy.destroy');
            });


            Route::group(['prefix' => 'client'], function () {
                Route::get('/', [ClientController::class, 'index'])->middleware('can:client.see')->name('policy-ui.client.index');
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
