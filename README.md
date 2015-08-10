# Dotenv diff

[![Author](http://img.shields.io/badge/by-@kielabokkie-lightgrey.svg?style=flat-square)](https://twitter.com/kielabokkie)
[![Packagist Version](https://img.shields.io/packagist/v/kielabokkie/dotenv-diff.svg?style=flat-square)](https://packagist.org/packages/kielabokkie/dotenv-diff)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Gitter](https://img.shields.io/badge/gitter-join%20chat-2DCD76.svg?style=flat-square)](https://gitter.im/kielabokkie/dotenv-diff)

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

**Note: this will overwrite your existing `post-merge` hook so if you already have one you'll need to figure out how to combine multiple post merge hooks**

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
