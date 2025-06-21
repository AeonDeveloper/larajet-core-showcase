<?php

use App\Services\Security\SpamDetectionService;


beforeEach(function () {
    $this->service = new SpamDetectionService();
});

test('it detects empty honeypot as valid', function () {
    $input = ['form_token' => ''];
    expect($this->service->isSpam($input))->toBeFalse();
});

test('it detects filled honeypot as spam', function () {
    $input = ['form_token' => 'i am a bot'];
    expect($this->service->isSpam($input))->toBeTrue();
});

test('it detects too-fast submissions as spam', function () {
    $input = ['my_time' => microtime(true) - 1]; // < 3 seconds ago
    expect($this->service->isSpam($input))->toBeTrue();
});

test('it ignores reasonable submission timing', function () {
    $input = ['my_time' => microtime(true) - 5]; // > 3 seconds ago
    expect($this->service->isSpam($input))->toBeFalse();
});

test('it detects links in name as spam', function () {
    $input = ['name' => 'click here http://badstuff.com'];
    expect($this->service->isSpam($input))->toBeTrue();
});

test('clean input is not spam', function () {
    $input = [
        'name' => 'Regular Name',
        'form_token' => '',
        'my_time' => microtime(true) - 10
    ];

    expect($this->service->isSpam($input))->toBeFalse();
});

test('assertNotSpam aborts for spam input', function () {
    $this->expectException(\Symfony\Component\HttpKernel\Exception\HttpException::class);

    $this->service->assertNotSpam([
        'form_token' => 'something', // triggers spam
        'my_time' => microtime(true),
        'name' => 'http://bad.com'
    ]);
});
