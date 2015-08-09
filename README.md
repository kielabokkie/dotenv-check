# Dotenv diff

This package automatically compares your `.env` an `.env.example` files and notifies you when there are differences.

## Installation

The preferred way of installing this package is through composer:

```shell
composer require kielabokkie/dotenv-diff
```

To automatically check the difference between your dotenv files when you run composer commands add the following to your `composer.json` file:

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
