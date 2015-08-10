# Dotenv diff

[![Join the chat at https://gitter.im/kielabokkie/dotenv-diff](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/kielabokkie/dotenv-diff?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

This package automatically compares your `.env` an `.env.example` files and notifies you when there are differences.

## Installation

The preferred way of installing this package is through composer:

```
composer require kielabokkie/dotenv-diff
```

## Usage

Once the package is installed there are two ways of running the Dotenv diff automatically, either by using git hooks or composer scripts.

### Git hooks

First of all you can have the Dotenv diff run automatically when you do a `git pull`. To set this up you'll need to copy over the supplied `post-merge` git hook to your `.git/hooks` folder.

From the root of your project execute the following command:

```
cp vendor/kielabokkie/dotenv-diff/git/hooks/post-merge .git/hooks/
```

### Composer

You can also set it up so it runs whenever you run composer commands like `composer install` or `composer update`.

All you need to do is call the `run` method from the scripts section of your `composer.json` file:

```json
{
    "scripts": {
        "post-install-cmd": [
            "Kielabokkie\\DotenvDiff::run"
        ],
        "post-update-cmd": [
            "Kielabokkie\\DotenvDiff::run"
        ]
    }
}
```