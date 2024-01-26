<?php

namespace App\Console\Commands;

use App\Models\Vehicle;
use Illuminate\Console\Command;

class DeleteVehicle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vehicle:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will delete the vehicle who are softDeletes, and also who insurance date are expired';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Vehicle::where('deleted_at', '<=', date('Y-m-d H:i:s', now()))
            ->orWhere('insurance_date', '<=', date('Y-m-d H:i:s', now()))
            ->delete();
    }
}
