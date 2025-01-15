<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\KanbanBoardColumnsController;
use App\Http\Controllers\KanbanBoardsController;
use App\Http\Controllers\LeadsController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\StoreTenantController;
use App\Http\Resources\AuthResource;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'execute'])
    ->middleware('api')
    ->name('login');


Route::post('/register', [StoreTenantController::class, 'store'])
    ->middleware('api');


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return new AuthResource($request->user());
    });

    // Users
    Route::controller(UsersController::class)
        ->group(function () {
            Route::middleware('permission:users.read')->group(function () {
                Route::get('/users', 'index');
                Route::get('/users/{id}', 'show');
            });
            Route::post('/users', 'store')->middleware('permission:users.create');
            Route::put('/users/{id}', 'update')->middleware('permission:users.update');
            Route::delete('/users/{id}', 'destroy')->middleware('permission:users.delete');
        });

    // Permissions
    Route::controller(PermissionsController::class)
        ->group(function () {
            Route::get('/permissions', 'index')->middleware('permission:permissions.read');
            Route::get('/permissions/{id}', 'show')->middleware('permission:permissions.read');
        });

    // Roles
    Route::controller(RolesController::class)
        ->group(function () {
            Route::middleware(['permission:users.read'])->group(function () {
                Route::get('/roles', 'index');
                Route::get('/roles/{id}', 'show');
            });
            Route::post('/roles', 'store')->middleware('permission:roles.create');
            Route::put('/roles/{id}', 'update')->middleware('permission:roles.update');
            Route::delete('/roles/{id}', 'destroy')->middleware('permission:roles.delete');
        });

    // Kanban Boards
    Route::controller(KanbanBoardsController::class)
        ->group(function () {
            Route::post('/kanban-boards', 'store')->middleware('permission:kanban-boards.create');
            Route::get('/kanban-boards', 'index')->middleware('permission:kanban-boards.read');
            Route::get('/kanban-boards/{id}', 'show')->middleware('permission:kanban-boards.read');
            Route::put('/kanban-boards/{id}', 'update')->middleware('permission:kanban-boards.update');
            Route::delete('/kanban-boards/{id}', 'destroy')->middleware('permission:kanban-boards.delete');
        });

    // Reorder Kanban Board Columns Cards
    Route::controller(KanbanBoardColumnsController::class)
        ->group(function () {
            Route::post('/kanban-board-columns/reorder-cards', 'reorderColumnsCards');
        });

    // Companies
    Route::controller(CompaniesController::class)
        ->group(function () {
            Route::get('/companies', 'index');
            Route::get('/companies/{id}', 'show');
            Route::post('/companies', 'store')->middleware('permission:companies.create');
            Route::put('/companies/{id}', 'update')->middleware('permission:companies.update');
            Route::delete('/companies/{id}', 'destroy');
        });

    // Clients
    Route::controller(ClientsController::class)
        ->group(function () {
            Route::middleware('permission:clients.read')->group(function () {
                Route::get('/clients', 'index');
                Route::get('/clients/{id}', 'show');
            });
            Route::post('/clients', 'store')->middleware('permission:clients.create');
            Route::put('/clients/{id}', 'update')->middleware('permission:clients.update');
            Route::delete('/clients/{id}', 'destroy')->middleware('permission:clients.delete');
        });

    // Leads
    Route::controller(LeadsController::class)
        ->group(function () {
            Route::middleware('permission:leads.read')->group(function () {
                Route::get('/leads', 'index');
                Route::get('/leads/{id}', 'show');
            });
            Route::post('/leads', 'store')->middleware('permission:leads.create');
            Route::put('/leads/{id}', 'update')->middleware('permission:leads.update');
            Route::delete('/leads/{id}', 'destroy')->middleware('permission:leads.delete');
        });

    // Projects
    Route::controller(ProjectsController::class)
        ->group(function () {
            Route::middleware('permission:projects.read')->group(function () {
                Route::get('/projects', 'index');
                Route::get('/projects/{id}', 'show');
            });
            Route::post('/projects', 'store')->middleware('permission:projects.create');
            Route::put('/projects/{id}', 'update')->middleware('permission:projects.update');
            Route::delete('/projects/{id}', 'destroy')->middleware('permission:projects.delete');
        });
});
