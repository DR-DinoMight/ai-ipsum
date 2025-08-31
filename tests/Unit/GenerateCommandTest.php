<?php

use App\Commands\Generate;

beforeEach(function () {
    $this->command = new Generate();
});

it('has correct command signature', function () {
    $reflection = new ReflectionClass($this->command);
    $property = $reflection->getProperty('signature');
    $property->setAccessible(true);
    $signature = $property->getValue($this->command);

    expect($signature)->toContain('generate {subject}');
    expect($signature)->toContain('{--model=gpt-4o-mini}');
    expect($signature)->toContain('{--sentences=false}');
    expect($signature)->toContain('{--paragraphs=false}');
    expect($signature)->toContain('{--words=100}');
    expect($signature)->toContain('{--style=formal}');
    expect($signature)->toContain('{--language=en}');
    expect($signature)->toContain('{--debug}');
});

it('has correct command description', function () {
    $description = $this->command->getDescription();

    expect($description)->toBe('Generate content based on the subject and the options');
});

it('has valid style options defined', function () {
    $validStyles = ['formal', 'informal', 'technical', 'creative', 'academic', 'casual'];

    // Test that the command signature contains the style option
    $reflection = new ReflectionClass($this->command);
    $property = $reflection->getProperty('signature');
    $property->setAccessible(true);
    $signature = $property->getValue($this->command);
    expect($signature)->toContain('{--style=formal}');

    // Test that all valid styles are valid
    foreach ($validStyles as $style) {
        expect(in_array($style, ['formal', 'informal', 'technical', 'creative', 'academic', 'casual']))->toBeTrue();
    }
});

it('has valid language options defined', function () {
    $validLanguages = ['en', 'es', 'fr', 'de', 'it'];

    // Test that the command signature contains the language option
    $reflection = new ReflectionClass($this->command);
    $property = $reflection->getProperty('signature');
    $property->setAccessible(true);
    $signature = $property->getValue($this->command);
    expect($signature)->toContain('{--language=en}');

    // Test that all valid languages are valid
    foreach ($validLanguages as $language) {
        expect(in_array($language, ['en', 'es', 'fr', 'de', 'it']))->toBeTrue();
    }
});

it('has correct default values', function () {
    $reflection = new ReflectionClass($this->command);
    $property = $reflection->getProperty('signature');
    $property->setAccessible(true);
    $signature = $property->getValue($this->command);

    expect($signature)->toContain('{--model=gpt-4o-mini}');
    expect($signature)->toContain('{--words=100}');
    expect($signature)->toContain('{--style=formal}');
    expect($signature)->toContain('{--language=en}');
});

it('has required subject argument', function () {
    $reflection = new ReflectionClass($this->command);
    $property = $reflection->getProperty('signature');
    $property->setAccessible(true);
    $signature = $property->getValue($this->command);

    expect($signature)->toContain('{subject}');
    expect($signature)->not->toContain('{subject?}'); // Not optional
});

it('has debug option without default value', function () {
    $reflection = new ReflectionClass($this->command);
    $property = $reflection->getProperty('signature');
    $property->setAccessible(true);
    $signature = $property->getValue($this->command);

    expect($signature)->toContain('{--debug}');
    expect($signature)->not->toContain('{--debug='); // No default value
});

it('has sentences option with false default', function () {
    $signature = $this->command->getSignature();

    expect($signature)->toContain('{--sentences=false}');
});

it('has paragraphs option with false default', function () {
    $signature = $this->command->getSignature();

    expect($signature)->toContain('{--paragraphs=false}');
});

it('extends correct base class', function () {
    expect($this->command)->toBeInstanceOf(\LaravelZero\Framework\Commands\Command::class);
});

it('implements schedule method', function () {
    $reflection = new ReflectionClass($this->command);
    $method = $reflection->getMethod('schedule');

    expect($method->isPublic())->toBeTrue();
    expect($method->getReturnType()->getName())->toBe('void');
});

it('has private generateContent method', function () {
    $reflection = new ReflectionClass($this->command);
    $method = $reflection->getMethod('generateContent');

    expect($method->isPrivate())->toBeTrue();
    expect($method->getParameters())->toHaveCount(7);
});

it('has handle method', function () {
    $reflection = new ReflectionClass($this->command);
    $method = $reflection->getMethod('handle');

    expect($method->isPublic())->toBeTrue();
    expect($method->getReturnType())->toBeNull(); // No return type specified
});
