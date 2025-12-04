<?php

namespace Vendor\UltimateStarterKit\Commands;

use Illuminate\Console\Command;
use Vendor\UltimateStarterKit\Services\RouteScannerService;

class ScanRoutesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ultimate:scan-routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan application routes and sync them to permissions table';

    /**
     * Execute the console command.
     */
    public function handle(RouteScannerService $scanner): int
    {
        $this->info('Scanning routes...');

        $result = $scanner->scanAndSync();

        $this->info("Scanned {$result['total']} routes.");
        $this->info("Created {$result['created']} new permissions.");
        $this->info("Updated {$result['updated']} existing permissions.");

        return Command::SUCCESS;
    }
}

