<?php


namespace Radevlabs\Bake;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class Bake
{
    const REQUIRE_PASSWORD = 'password';
    const REQUIRE_WARNING = 'warning';
    const REQUIRE_ALL = [
        self::REQUIRE_PASSWORD,
        self::REQUIRE_WARNING
    ];

    public function menus()
    {
        return DB::table('permissions')
            ->where('menu', true)
            ->orderBy('order')
            ->get()
            ->groupBy('group');
    }

    public function permission(string $route)
    {
        return DB::table('permissions')
            ->where('route', $route)
            ->first();
    }

    public function routes()
    {
        Route::get('select2/', function (Request $request) {
            if ($request->ajax()){
                $queryTable = decrypt($request->queryTable);
                $builder = DB::table(DB::raw('('.$queryTable.') ``'));
                $data = $builder->where('text', 'like', "%$request->q%")
                    ->limit(10)
                    ->get()
                    ->toArray();

                return response()->json($data);
            }

            return abort(404);
        })->name('select2');

        Route::livewire('login', 'auth.login')
            ->layout('bake::layouts.auth')
            ->name('login');

        Route::livewire('dashboard', 'dashboard')
            ->middleware(['auth'])
            ->layout('bake::layouts.home')
            ->name('dashboard');

        DB::table('permissions')
            ->get()
            ->each(function ($permission) {
                Route::livewire($permission->uri, $permission->route)
                    ->middleware(['auth'])
                    ->layout('bake::layouts.home')
                    ->name($permission->route);
            });
    }
}
