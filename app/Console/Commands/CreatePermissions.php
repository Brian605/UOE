<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class CreatePermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Permissions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating permissions...');
        // Show loading message
//        $this->output->write('Creating...');
        // Get all routes
        $routes = Route::getRoutes()->getRoutes();

        $authRoutes = ['login','login.store', 'register', 'password.request', 'password.reset', 'password.confirm', 'password.email', 'verification.send', 'verification.verify', 'verification.resend', 'sanctum.csrf-cookie', 'dark-mode-switcher', 'color-scheme-switcher', 'password.update', 'logout', 'verification.notice'];

        foreach ($routes as $route) {
            if ($route->getName() != '' && $route->getAction()['middleware']['0'] === 'web' && !in_array($route->getName(), $authRoutes) ) {
                $permission = Permission::where('name', $route->getName())->first();

                if (is_null($permission)) {
                    Permission::create(['name' => $route->getName(), "guard_name" => 'web']);
                }
            }
        }

        $this->info('Permission routes added successfully.');
    }
}
