<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Person;

class Delete30daysRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oldrecords:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete records older than 30 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Person::where('created_at', '<', now()->subDays(30))->delete();

        $this->info('Past 30 days records deleted successfully.');
    }
}
