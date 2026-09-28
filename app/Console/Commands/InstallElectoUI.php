<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallElectoUI extends Command
{
    /**
     * Command Signature
     */
    protected $signature = 'electo:install';

    /**
     * Description
     */
    protected $description = 'Install the Electo UI Framework';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->newLine();

        $this->info('===========================================');
        $this->info('      ELECTO UI INSTALLER');
        $this->info('===========================================');

        /*
        |--------------------------------------------------------------------------
        | Directories
        |--------------------------------------------------------------------------
        */

        $directories = [

            resource_path('views/components/electo/auth'),
            resource_path('views/components/electo/ui'),
            resource_path('views/components/electo/dashboard'),
            resource_path('views/components/electo/election'),
            resource_path('views/components/electo/organization'),
            resource_path('views/components/electo/candidate'),
            resource_path('views/components/electo/voter'),
            resource_path('views/components/electo/shared'),

            resource_path('css'),
            resource_path('js'),

        ];

        foreach ($directories as $directory) {

            File::ensureDirectoryExists($directory);

            $this->line("✓ {$directory}");

        }

        /*
        |--------------------------------------------------------------------------
        | Blade Files
        |--------------------------------------------------------------------------
        */

        $files = [

            // AUTH
            'views/components/electo/auth/card.blade.php',
            'views/components/electo/auth/layout.blade.php',
            'views/components/electo/auth/header.blade.php',
            'views/components/electo/auth/footer.blade.php',
            'views/components/electo/auth/logo.blade.php',
            'views/components/electo/auth/illustration.blade.php',

            // UI
            'views/components/electo/ui/button.blade.php',
            'views/components/electo/ui/loading-button.blade.php',
            'views/components/electo/ui/input.blade.php',
            'views/components/electo/ui/textarea.blade.php',
            'views/components/electo/ui/select.blade.php',
            'views/components/electo/ui/checkbox.blade.php',
            'views/components/electo/ui/radio.blade.php',
            'views/components/electo/ui/switch.blade.php',
            'views/components/electo/ui/divider.blade.php',
            'views/components/electo/ui/badge.blade.php',
            'views/components/electo/ui/avatar.blade.php',
            'views/components/electo/ui/alert.blade.php',
            'views/components/electo/ui/tooltip.blade.php',
            'views/components/electo/ui/spinner.blade.php',
            'views/components/electo/ui/progress.blade.php',
            'views/components/electo/ui/skeleton.blade.php',
            'views/components/electo/ui/card.blade.php',
            'views/components/electo/ui/modal.blade.php',
            'views/components/electo/ui/drawer.blade.php',
            'views/components/electo/ui/dropdown.blade.php',
            'views/components/electo/ui/page-header.blade.php',
            'views/components/electo/ui/section-header.blade.php',
            'views/components/electo/ui/breadcrumb.blade.php',
            'views/components/electo/ui/container.blade.php',
            'views/components/electo/ui/tabs.blade.php',
            'views/components/electo/ui/wizard.blade.php',
            'views/components/electo/ui/step.blade.php',

            // DASHBOARD
            'views/components/electo/dashboard/metric-card.blade.php',
            'views/components/electo/dashboard/quick-action.blade.php',
            'views/components/electo/dashboard/recent-activity.blade.php',
            'views/components/electo/dashboard/analytics-card.blade.php',
            'views/components/electo/dashboard/chart-card.blade.php',
            'views/components/electo/dashboard/empty-dashboard.blade.php',

            // ELECTION
            'views/components/electo/election/election-card.blade.php',
            'views/components/electo/election/election-status.blade.php',
            'views/components/electo/election/election-summary.blade.php',
            'views/components/electo/election/position-card.blade.php',
            'views/components/electo/election/candidate-card.blade.php',
            'views/components/electo/election/vote-progress.blade.php',
            'views/components/electo/election/result-card.blade.php',

            // ORGANIZATION
            'views/components/electo/organization/organization-card.blade.php',
            'views/components/electo/organization/organization-header.blade.php',
            'views/components/electo/organization/organization-stat.blade.php',
            'views/components/electo/organization/organization-banner.blade.php',

            // SHARED
            'views/components/electo/shared/empty-state.blade.php',
            'views/components/electo/shared/search-box.blade.php',
            'views/components/electo/shared/filter-bar.blade.php',
            'views/components/electo/shared/pagination.blade.php',
            'views/components/electo/shared/table.blade.php',
            'views/components/electo/shared/status-pill.blade.php',

        ];

        foreach ($files as $file) {

            $path = resource_path($file);

            if (! File::exists($path)) {

                File::put($path, '');

            }

            $this->line("✓ {$file}");

        }

        /*
        |--------------------------------------------------------------------------
        | CSS
        |--------------------------------------------------------------------------
        */

        if (! File::exists(resource_path('css/electo.css'))) {

            File::put(resource_path('css/electo.css'), "/* Electo UI Framework */");

        }

        /*
        |--------------------------------------------------------------------------
        | JS
        |--------------------------------------------------------------------------
        */

        if (! File::exists(resource_path('js/electo.js'))) {

            File::put(resource_path('js/electo.js'), "// Electo UI");

        }

        $this->newLine();

        $this->info('===========================================');
        $this->info(' Electo UI Installed Successfully');
        $this->info('===========================================');

        return self::SUCCESS;
    }
}