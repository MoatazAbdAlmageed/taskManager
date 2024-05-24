<?php

namespace App\Providers;

use App\Models\Task;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $tasks = Task::with(['assignedBy', 'assignedBy']);;
            if (!auth()->user() || !auth()->user()->is_admin) {
                $tasks = $tasks->where([
                    'assigned_to_id' => auth()->id()
                ]);
            }
            $view->with('tasks', $tasks->simplePaginate(10));
        });
    }
}
