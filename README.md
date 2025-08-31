# AI Ipsum - AI-Powered Content Generator



AI Ipsum is a powerful command-line tool built with [Laravel Zero](https://laravel-zero.com/) that generates intelligent dummy content using various AI providers. Perfect for developers, designers, and content creators who need realistic placeholder content for their projects.

## ✨ Features

- **AI-Powered Content Generation**: Uses cutting-edge AI models to create realistic, context-aware dummy content
- **Multiple AI Providers**: Support for OpenAI, Anthropic, Mistral, Groq, and many more
- **Customisable Output**: Control word count, sentence structure, paragraphs, and writing style
- **Multi-language Support**: Generate content in English, Spanish, French, German, and Italian
- **Writing Styles**: Choose from formal, informal, technical, creative, academic, or casual tones
- **Fast & Efficient**: Built on Laravel Zero for optimal performance and developer experience

## 🚀 Quick Start

### Installation

```bash
# Clone the repository
git clone <your-repo-url>
cd ai-ipsum

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Set your AI provider API keys in .env
# Example for OpenAI:
OPENAI_API_KEY=your_openai_api_key_here
```

### Basic Usage (built version)

If the released version is used then you need to make sure that a .env is placed in the same directory as the app.

```bash
# Set your AI provider API keys in .env
# Example for OpenAI:
OPENAI_API_KEY=your_openai_api_key_here
```

```bash
# Generate 100 words about "web development"
./ai-ipsum generate "web development"

# Generate content with specific word count
./ai-ipsum generate "artificial intelligence" --words=200

# Generate content in a specific style
./ai-ipsum generate "cooking recipes" --style=creative --words=150

# Generate content in Spanish
./ai-ipsum generate "travel destinations" --language=es --words=100

# Generate structured content (sentences and paragraphs)
./ai-ipsum generate "business strategy" --sentences=5 --paragraphs=3 --words=50
```

## 📖 Usage Guide

### Command Syntax

```bash
./ai-ipsum generate {subject} [options]
```

### Arguments

- `subject` - The topic or subject for content generation (required)

### Options

| Option | Description | Default | Values |
|--------|-------------|---------|---------|
| `--model` | AI model to use | `gpt-4o-mini` | Any supported model |
| `--words` | Target word count | `100` | Any positive integer |
| `--sentences` | Number of sentences | `false` | Any positive integer |
| `--paragraphs` | Number of paragraphs | `false` | Any positive integer |
| `--style` | Writing style | `formal` | `formal`, `informal`, `technical`, `creative`, `academic`, `casual` |
| `--language` | Output language | `en` | `en`, `es`, `fr`, `de`, `it` |
| `--debug` | Enable verbose output | `false` | Flag |

### Examples

```bash
# Generate technical documentation
./ai-ipsum generate "API documentation" --style=technical --words=300

# Generate creative story content
./ai-ipsum generate "space adventure" --style=creative --paragraphs=2 --sentences=4 --words=75

# Generate business content in French
./ai-ipsum generate "marketing strategy" --style=formal --language=fr --words=200

# Generate casual blog post
./ai-ipsum generate "weekend activities" --style=casual --words=150 --debug
```

## 🛠️ Development Guide

### Prerequisites

- PHP 8.2 or higher
- Composer
- Git

### Building from Source

#### 1. Set Up Development Environment

```bash
# Clone the repository
git clone <your-repo-url>
cd ai-ipsum

# Install dependencies
composer install

# Install development dependencies
composer install --dev
```

#### 2. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Configure your AI provider API keys
# Example .env configuration:
OPENAI_API_KEY=your_openai_api_key_here
ANTHROPIC_API_KEY=your_anthropic_api_key_here
MISTRAL_API_KEY=your_mistral_api_key_here
GROQ_API_KEY=your_groq_api_key_here
```

#### 3. Available AI Providers

The application supports multiple AI providers through the Prism library:

- **OpenAI** - GPT models (GPT-4, GPT-3.5, etc.)
- **Anthropic** - Claude models
- **Mistral** - Mistral AI models
- **Groq** - Fast inference models
- **Ollama** - Local models
- **Gemini** - Google's AI models
- **DeepSeek** - DeepSeek models
- **XAI** - xAI models
- **ElevenLabs** - Text-to-speech
- **VoyageAI** - Embedding models
- **OpenRouter** - Multiple provider access

#### 4. Running Tests

```bash
# Run all tests
./vendor/bin/pest

# Run tests with coverage
./vendor/bin/pest --coverage

# Run specific test file
./vendor/bin/pest tests/Feature/GenerateCommandTest.php
```

#### 5. Code Quality

```bash
# Format code with Laravel Pint
./vendor/bin/pint

# Check code style
./vendor/bin/pint --test
```

#### 6. Building the Application

```bash
# Build standalone application
php ai-ipsum app:build ai-ipsum

# Build with specific name
./vendor/bin/laravel-zero build --name=my-ai-ipsum

# Build for specific platform
./vendor/bin/laravel-zero build --target=linux
```

### Project Structure

```
ai-ipsum/
├── app/
│   ├── Commands/
│   │   ├── Generate.php          # Main content generation command
│   │   └── InspireCommand.php    # Example inspiration command
│   └── Providers/                # Service providers
├── config/
│   └── prism.php                 # AI provider configuration
├── tests/                        # Test files
├── composer.json                 # Dependencies and project config
└── .env.example                  # Environment template
```

### Adding New Commands

To add a new command, create a new file in `app/Commands/`:

```php
<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;

class MyNewCommand extends Command
{
    protected $signature = 'my-command {argument} {--option}';
    protected $description = 'Description of my command';

    public function handle(): void
    {
        // Your command logic here
        $this->info('Command executed successfully!');
    }
}
```

### Customising AI Providers

Modify `config/prism.php` to add new providers or adjust existing configurations:

```php
'providers' => [
    'my_provider' => [
        'api_key' => env('MY_PROVIDER_API_KEY', ''),
        'url' => env('MY_PROVIDER_URL', 'https://api.myprovider.com/v1'),
    ],
],
```

### Extending the Generate Command

The main `Generate` command can be extended to support:

- Additional AI models
- New writing styles
- More language options
- Custom output formats
- Content validation rules

## 🔧 Configuration

### Environment Variables

Key environment variables for configuration:

```bash
# OpenAI Configuration
OPENAI_API_KEY=your_key_here
OPENAI_URL=https://api.openai.com/v1

# Anthropic Configuration
ANTHROPIC_API_KEY=your_key_here
ANTHROPIC_API_VERSION=2023-06-01

# Mistral Configuration
MISTRAL_API_KEY=your_key_here
MISTRAL_URL=https://api.mistral.ai/v1

# Groq Configuration
GROQ_API_KEY=your_key_here
GROQ_URL=https://api.groq.com/openai/v1
```

### Customising Output Styles

The application supports six writing styles:

- **Formal**: Professional, business-like tone
- **Informal**: Casual, conversational tone
- **Technical**: Detailed, specialised language
- **Creative**: Imaginative, artistic expression
- **Academic**: Scholarly, research-oriented
- **Casual**: Relaxed, everyday language

## 🚀 Deployment

### Building for Distribution

```bash
# Build standalone executable
./vendor/bin/laravel-zero build

# The executable will be created in the builds/ directory
# Copy to your desired location or distribute directly
```

### Docker Support

```dockerfile
FROM php:8.2-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy application code
COPY . .

# Build the application
RUN ./vendor/bin/laravel-zero build

# Set executable permissions
RUN chmod +x builds/ai-ipsum

# Create entrypoint
ENTRYPOINT ["./builds/ai-ipsum"]
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Development Guidelines

- Follow PSR-12 coding standards
- Write comprehensive tests for new features
- Update documentation for any changes
- Use meaningful commit messages
- Ensure all tests pass before submitting PRs

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- Built with [Laravel Zero](https://laravel-zero.com/) - The Laravel way to build console applications
- Powered by [Prism](https://github.com/prism-php/prism) - PHP library for AI providers
- Inspired by the need for intelligent dummy content generation

## 📚 Resources

- [Laravel Zero Documentation](https://laravel-zero.com/)
- [Prism PHP Documentation](https://github.com/prism-php/prism)
- [Laravel Documentation](https://laravel.com/docs)
- [PHP Best Practices](https://phptherightway.com/)

---

**Happy coding! 🎉**

If you find this tool useful, please consider giving it a ⭐ on GitHub!
