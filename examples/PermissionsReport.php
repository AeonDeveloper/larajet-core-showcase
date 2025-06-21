
// Part of LaraJet Core – Demo Only – Not Licensed for Production Use

<?php

namespace App\Console\Commands;

use App\Models\Security\Role;
use Illuminate\Console\Command;

class PermissionsReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:report';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display all roles and their associated permissions';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('📊 Role → Permissions Mapping');
        $this->line('');

        $roles = Role::with('permissions')->get();

        foreach ($roles as $role) {
            $this->line('🔐 ' . $role->name . ':');

            if ($role->permissions->isEmpty()) {
                $this->line('  (no permissions)');
                $this->line('');
                continue;
            }

            foreach ($role->permissions as $permission) {
                $this->line('  - ' . $permission->name);
            }

            $this->line('');
        }

        return 0;
    }
}
