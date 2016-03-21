<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'document.residues_entering', 'App\Http\ViewComposers\documentResiduesEnteringComposer'
        );
        view()->composer('report.purchase', 'App\Http\ViewComposers\documentPurchaseComposer'
        );
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}