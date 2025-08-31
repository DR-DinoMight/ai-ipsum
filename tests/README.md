# AI Ipsum Test Suite

This directory contains comprehensive tests for the AI Ipsum Laravel Zero application.

## Test Structure

### Feature Tests (`tests/Feature/`)
- **GenerateCommandTest.php** - Tests the complete `generate` command functionality
- Tests all command options and arguments
- Mocks external API calls to Prism
- Verifies command output and exit codes
- Tests validation of style and language options

### Unit Tests (`tests/Unit/`)
- **GenerateCommandTest.php** - Tests individual methods and logic
- Tests validation logic for options
- Tests edge cases and error handling
- Tests private methods using reflection
- Verifies business logic without external dependencies

## Running Tests

### Prerequisites
- PHP 8.2+
- Composer dependencies installed
- Pest testing framework

### Quick Start
```bash
# Run all tests
./vendor/bin/pest

# Run specific test suites
./vendor/bin/pest tests/Feature/
./vendor/bin/pest tests/Unit/

# Run with coverage (if available)
./vendor/bin/pest --coverage

# Run tests in parallel
./vendor/bin/pest --parallel
```

### Using the Test Runner Script
```bash
# Make script executable (first time only)
chmod +x tests/run-tests.sh

# Run all tests
./tests/run-tests.sh
```

## Test Coverage

### Command Options Tested
- `--model` - Different AI models (gpt-4o-mini, gpt-4o, etc.)
- `--sentences` - Number of sentences
- `--paragraphs` - Number of paragraphs
- `--words` - Word count per sentence
- `--style` - Writing style (formal, informal, technical, creative, academic, casual)
- `--language` - Language (en, es, fr, de, it)
- `--debug` - Debug mode

### Validation Tests
- Invalid style options are rejected
- Invalid language options are rejected
- Required arguments are enforced
- Edge cases are handled gracefully

### Mocking Strategy
- **Prism API** - Mocked to avoid actual API calls during testing
- **Command Input** - Mocked for unit testing individual methods
- **Laravel Container** - Properly configured for testing environment

## Test Data

### Valid Styles
- formal, informal, technical, creative, academic, casual

### Valid Languages
- en (English), es (Spanish), fr (French), de (German), it (Italian)

### Test Subjects
- Generic test subjects to avoid API rate limits
- Edge cases with zero and large values
- Various combinations of options

## Best Practices

### Test Isolation
- Each test is independent
- Mocks are properly cleaned up after each test
- No shared state between tests

### Assertions
- Clear, descriptive test names
- Comprehensive coverage of success and failure cases
- Proper exit code verification
- Output content validation where appropriate

### Mocking
- External dependencies are mocked
- Internal logic is tested without external calls
- Realistic mock responses that match actual API structure

## Troubleshooting

### Common Issues
1. **Mockery not found** - Ensure `mockery/mockery` is installed
2. **Collection class not found** - Laravel collections should be available
3. **Test database issues** - Tests don't use database, should not be an issue

### Debug Mode
- Use `--debug` flag when running tests to see detailed output
- Check test output for specific failure details
- Verify mock expectations match actual method calls

## Contributing

When adding new tests:
1. Follow the existing naming convention
2. Use descriptive test names
3. Mock external dependencies
4. Test both success and failure cases
5. Update this README if adding new test categories
