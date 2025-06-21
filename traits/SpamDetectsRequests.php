<?php

namespace App\Traits;

use App\Services\Security\SpamDetectionService;

trait SpamDetectsRequests
{
    protected function detectSpam(array $input): void
    {
        app(SpamDetectionService::class)->assertNotSpam($input);
    }
}
