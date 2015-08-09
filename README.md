# Dotenv diff

This package automatically compares your `.env` an `.env.example` files and notifies you when there are differences.

To automatically check the difference between your dotenv files when you run composer commands add the following to your `composer.json` file:

```json
{
    ...
    "require": {
        "kielabokkie/dotenv-diff": "dev-master"
    },
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
