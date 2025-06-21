<?php

// Part of LaraJet Core – Demo Only – Not Licensed for Production Use


namespace App\Services\Security;
use Symfony\Component\HttpKernel\Exception\HttpException;


class SpamDetectionService
{

    public function isSpam(array $input): bool
    {
        if ($this->hasHoneypot($input)) return true;
        if ($this->submittedTooFast($input)) return true;
        if ($this->containsLinks($input['name'] ?? '')) return true;

        return false;
    }

    public function assertNotSpam(array $input): void
    {
        if ($this->isSpam($input)) {
            throw new HttpException(422, 'Spam Detected');
        }
    }

    protected function hasHoneypot(array $input): bool
    {
        return !empty(trim(strip_tags($input['form_token'] ?? '')));
    }

    protected function submittedTooFast(array $input): bool
    {
        $elapsed = microtime(true) - (float) ($input['my_time'] ?? 0);
        return $elapsed < 3;
    }

    protected function containsLinks(string $text): bool
    {
        return preg_match('/\b(?:https?|ftp):\/\/\S+/i', $text);
    }
}
