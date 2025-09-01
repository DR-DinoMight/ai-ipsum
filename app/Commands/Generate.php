<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Prism;

class Generate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate {subject}
                            {--model=gpt-4o-mini}
                            {--sentences=false}
                            {--paragraphs=false}
                            {--words=100}
                            {--style=formal}
                            {--language=en}
                            {--debug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate content based on the subject and the options, only ever return the content no other text or information';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $subject = $this->argument('subject');
        $model = $this->option('model', 'GPT-5 mini');
        $sentences = $this->option('sentences');
        $paragraphs = $this->option('paragraphs');
        $words = $this->option('words', 100);
        //if v or verbose is passed, then set verbose to true
        if ($this->option('debug')) {
            $verbose = true;
        }
        $verbose = $verbose ?? false;


        //check if style is passed its one of the following: formal, informal, technical, creative, academic, etc.
        if ($this->option('style')) {
            $style = $this->option('style');
            //check if style is one of the following: formal, informal, technical, creative, academic, etc.
            if (!in_array($style, ['formal', 'informal', 'technical', 'creative', 'academic', 'casual'])) {
                $this->error('Invalid style');
                return;
            }
        }

        if ($this->option('language')) {
            $language = $this->option('language');
            //check if language is one of the following: en, es, fr, de, it, etc.
            if (!in_array($language, ['en', 'es', 'fr', 'de', 'it'])) {
                $this->error('Invalid language');
                return;
            }
        }

        if ($verbose) {
            $this->info('Generating content for ' . $subject . ' with ' . $model . ' model');
            $this->info('Sentences: ' . $sentences);
            $this->info('Paragraphs: ' . $paragraphs);
            $this->info('Words: ' . $words);
            $this->info('Style: ' . $style);
            $this->info('Language: ' . $language);
        }

        //generate content
        $content = $this->generateContent($subject, $model, $sentences, $paragraphs, $words, $style, $language);
        $this->info($content);
    }

    /**
     * Define the command's schedule.
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }

    private function generateContent($subject, $model, $sentences, $paragraphs, $words, $style, $language)
    {
        $system_prompt = 'You are a dummy content generator. You are given a subject and you need to generate dummy lorem ipsum type content. The content should be quite clearly not real content like lorem ipsum. Content should never be able to be used misconstrued as real content and always none offensive and never harmful in any way. You need to generate the content in the style: ' . $style . ' and the language: ' . $language . ' . Only ever return the content text no other text.';
        $prompt = 'Generate me some dummy content for the subject: ' . $subject;
        if ($paragraphs && $sentences && $words) {
            $prompt .= ' in ' . $words . ' words per sentence and ' . $sentences . ' sentences per paragraph and ' . $paragraphs . ' paragraphs';
        } else if ($sentences && $words) {
            $prompt .= ' in ' . $words . ' words per sentence and ' . $sentences . ' sentences';
        } else if ($words) {
            $prompt .= ' in ' . $words . ' words';
        }

        $response = Prism::text()
            ->using(Provider::OpenAI, $model)
            ->withSystemPrompt($system_prompt)
            ->withPrompt($prompt)
            ->asText();

        return $response->text;
    }
}
