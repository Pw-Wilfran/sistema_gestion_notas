<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Observers\GenericObserver;

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
        foreach (
            [
                Student::class,
                Teacher::class,
                Enrollment::class,
                Grade::class
            ] as $model
        ) {
            $model::observe(GenericObserver::class);
        }
    }
}
