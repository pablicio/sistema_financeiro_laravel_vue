<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('date', function ($expression) {
            return "<?php echo ((\$t = \\App\\Support\\Convert::DBToCarbonFormat($expression)) && \$t instanceof \\Carbon\\Carbon) ? \$t->format('d/m/Y') : null; ?>";
        });

        Blade::directive('datetime', function ($expression) {
            return "<?php echo ((\$t = \\App\\Support\\Convert::DBToCarbonFormat($expression)) && \$t instanceof \\Carbon\\Carbon) ? \$t->format('d/m/Y H:i:s') : null; ?>";
        });

        Blade::directive('datetimesalas', function ($expression) {
            return "<?php echo ((\$t = \\App\\Support\\Convert::DBToCarbonFormat($expression)) && \$t instanceof \\Carbon\\Carbon) ? \$t->format('d/m/Y H:i') : null; ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
