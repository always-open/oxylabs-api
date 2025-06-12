<?php

namespace AlwaysOpen\OxylabsApi\Commands;

use Illuminate\Console\Command;

class OxylabsApiCommand extends Command
{
    public $signature = 'oxylabs-api';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
