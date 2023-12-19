<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
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
        // Eloquent strict mode (원천 차단)
        Model::shouldBeStrict(!$this->app->isProduction() /* 상용환경 off, 개발환경 on */);

        /**
         * 일부만 쓰고 싶을때
         */
        
        /* lazy loading 을 감지하면 에러페이지를 출력해준다. */
        // Model::preventLazyLoading();

        /* fillable, guarded 허용되지 않은 필드를 CRUD 시도하려고 하면 에러페이지를 출력 */
        // Model::preventSilentlyDiscardingAttributes();

        /* Eloquent 객체의 존재하지 않은 프로퍼티를 출력하려고 할 때 null 값이 아닌 에러페이지를 출력 ($articles->hello) */
        // Model::preventAccessingMissingAttributes();
    }
}
