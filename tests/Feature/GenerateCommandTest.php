<?php

use App\Commands\Generate;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Prism;
use Prism\Prism\Text\Response;
use Prism\Prism\ValueObjects\Meta;
use Prism\Prism\ValueObjects\Usage;

beforeEach(function () {
    // Mock the Prism facade to avoid actual API calls during testing
    $this->mockPrism = Mockery::mock('alias:' . Prism::class);

    // Create a mock for the text() method that returns a chainable object
    $mockText = Mockery::mock();
    $mockText->shouldReceive('using')->andReturnSelf();
    $mockText->shouldReceive('withSystemPrompt')->andReturnSelf();
    $mockText->shouldReceive('withPrompt')->andReturnSelf();
    $mockText->shouldReceive('asText')->andReturn(createMockResponse('Mocked response'));

    $this->mockPrism->shouldReceive('text')->andReturn($mockText);
});

afterEach(function () {
    Mockery::close();
});

function createMockResponse(string $text): Response
{
    return new Response(
        new \Illuminate\Support\Collection(),
        $text,
        \Prism\Prism\Enums\FinishReason::Stop,
        [],
        [],
        new Usage(0, 0, 0, 0, 0),
        new Meta('test-id', 'test-model'),
        new \Illuminate\Support\Collection(),
        []
    );
}

it('generates content with default options', function () {
    $this->artisan('generate', ['subject' => 'test subject'])
        ->assertExitCode(0);
});

it('generates content with custom model', function () {
    $this->artisan('generate', [
        'subject' => 'test subject',
        '--model' => 'gpt-4o'
    ])->assertExitCode(0);
});

it('generates content with custom word count', function () {
    $this->artisan('generate', [
        'subject' => 'test subject',
        '--words' => '250'
    ])->assertExitCode(0);
});

it('generates content with sentences and words', function () {
    $this->artisan('generate', [
        'subject' => 'test subject',
        '--sentences' => '3',
        '--words' => '50'
    ])->assertExitCode(0);
});

it('generates content with paragraphs, sentences and words', function () {
    $this->artisan('generate', [
        'subject' => 'test subject',
        '--paragraphs' => '4',
        '--sentences' => '2',
        '--words' => '30'
    ])->assertExitCode(0);
});

it('generates content with custom style', function () {
    $this->artisan('generate', [
        'subject' => 'test subject',
        '--style' => 'creative'
    ])->assertExitCode(0);
});

it('generates content with custom language', function () {
    $this->artisan('generate', [
        'subject' => 'test subject',
        '--language' => 'es'
    ])->assertExitCode(0);
});

it('enables debug mode when debug option is passed', function () {
    $this->artisan('generate', [
        'subject' => 'test subject',
        '--debug'
    ])->assertExitCode(0);
});

it('fails with invalid style', function () {
    $this->artisan('generate', [
        'subject' => 'test subject',
        '--style' => 'invalid-style'
    ])->expectsOutput('Invalid style')
        ->assertExitCode(0);
});

it('fails with invalid language', function () {
    $this->artisan('generate', [
        'subject' => 'test subject',
        '--language' => 'invalid-lang'
    ])->expectsOutput('Invalid language')
        ->assertExitCode(0);
});

it('requires subject argument', function () {
    $this->expectException(\RuntimeException::class);
    $this->expectExceptionMessage('Not enough arguments (missing: "subject").');

    $this->artisan('generate');
});
