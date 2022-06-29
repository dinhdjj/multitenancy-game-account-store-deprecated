<?php

declare(strict_types=1);

namespace App\Actions;

use File;
use Lorisleiva\Actions\Concerns\AsAction;
use Stancl\Tenancy\Contracts\Tenant;
use Stancl\Tenancy\Events\DeletingTenant;
use Storage;

class TenantDeleteRelatedDirectories
{
    use AsAction;

    public function handle(Tenant $tenant): void
    {
        $tenant->run(function ($tenant): void {
            foreach (config('tenancy.filesystem.disks') as $disk) {
                Storage::disk($disk)->deleteDirectory('/');
            }

            File::deleteDirectory(storage_path());
        });
    }

    public function asListener(DeletingTenant $event): void
    {
        $this->handle($event->tenant);
    }
}
