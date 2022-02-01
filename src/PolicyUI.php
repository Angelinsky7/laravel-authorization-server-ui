<?php

namespace Darkink\AuthorizationServerUI;

use Darkink\AuthorizationServerUI\Http\Controllers\RoleController;
use Darkink\AuthorizationServer\Models\Role;
use Darkink\AuthorizationServerUI\Http\Controllers\PermissionController;
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

            Route::group(['prefix' => 'permission'], function () {
                Route::get('/', [PermissionController::class, 'index'])->middleware('can:permission.see')->name('policy-ui.permission.index');
                Route::get('/create', [PermissionController::class, 'create'])->middleware('can:permission.create')->name('policy-ui.permission.create');
                Route::get('/create/scope', [PermissionController::class, 'createScope'])->middleware('can:permission.create-scope')->name('policy-ui.permission.create-scope');
                Route::get('/create/resource', [PermissionController::class, 'createResource'])->middleware('can:permission.create-resource')->name('policy-ui.permission.create-resource');
                Route::post('/create/scope', [PermissionController::class, 'storeScope'])->middleware('can:permission.create-scope')->name('policy-ui.permission.store-scope');
                Route::post('/create/resource', [PermissionController::class, 'storeresource'])->middleware('can:permission.create-resource')->name('policy-ui.permission.store-resource');
                Route::get('/{permission}', [PermissionController::class, 'show'])->middleware('can:permission.see')->name('policy-ui.permission.show');
                Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->middleware('can:permission.update')->name('policy-ui.permission.edit');
                Route::put('/{permission}', [PermissionController::class, 'update'])->middleware('can:permission.update')->name('policy-ui.permission.update');
                Route::get('/{permission}/delete', [PermissionController::class, 'delete'])->middleware('can:permission.delete')->name('policy-ui.permission.delete');
                Route::delete('/{permission}', [PermissionController::class, 'destroy'])->middleware('can:permission.delete')->name('policy-ui.permission.destroy');
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
