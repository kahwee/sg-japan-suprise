# sg-japan-suprise

Historical PHP script that exports Facebook posts and likes to CSV files.

## Setup and use

```sh
composer install
cp config.php.default.php config.php
```

Set the app configuration in the copied file, then run `php index.php`.
The script reads `/platform/posts` and writes `output/posts.csv` and
`output/likes.csv`; it overwrites those output files.

This checkout targets the old Facebook PHP SDK and Graph API. Current API
access is not verified, and there is no automated test suite. Inspect
[index.php](index.php) and [composer.json](composer.json) before running.
