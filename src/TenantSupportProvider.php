<?php

namespace Tenant\Support;

use Illuminate\Foundation\Http\Kernel;
use Illuminate\Support\ServiceProvider;

class TenantSupportProvider extends ServiceProvider
{
    public function boot(Kernel $kernel)
    {
        $this->offerPublishing();
    }

    protected function offerPublishing() {

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/errors/error'),
        ]);
    }
}
