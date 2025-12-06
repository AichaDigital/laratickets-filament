<?php

namespace AichaDigital\LaraticketsFilament\Commands;

use Illuminate\Console\Command;

class LaraticketsFilamentCommand extends Command
{
    public $signature = 'laratickets-filament';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
