<?php

namespace Darkink\AuthorizationServerUI;

use Darkink\AuthorizationServerUI\Http\Controllers\RoleController;
use Darkink\AuthorizationServer\Models\Role;
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
                Route::get('/', [RoleController::class, 'index'])->middleware('can:premission.see')->name('policy-ui.premission.index');
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
