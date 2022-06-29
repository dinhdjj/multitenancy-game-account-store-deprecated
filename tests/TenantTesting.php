<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Domain;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\URL;

trait TenantTesting
{
    use LazilyRefreshDatabase;

    protected function setUpTenantTesting(): void
    {
        $this->initializeTenancy();
    }

    protected function tearDownTenantTesting(): void
    {
        $this->deleteTenants();
    }

    protected function initializeTenancy(): void
    {
        $tenant = Tenant::factory()->has(Domain::factory())->create();
        tenancy()->initialize($tenant);
        config(['app.url' => 'http://'.$tenant->domains[0]->domain]);
        URL::forceRootUrl(config('app.url'));
    }

    protected function deleteTenants(): void
    {
        Tenant::all()->each->delete();
    }
}
