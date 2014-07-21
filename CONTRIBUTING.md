## Guideline

Contributing is absolutely encouraged, but a few things should be taken into
account:

  - Always test any bug-fixes or changes with [unit testing][]

  - When adding or changing a feature, make sure to write a **new**
    [unit test][unit-testing]

  - This project adheres to the [PSR-2][] standards. Please make sure your
    contributions comply by running [PHP Code Sniffer][] in the project's root
    directory:

    ```
    ./bin/phpcs --standard=PSR2 --encoding=utf-8 -p src/ tests/
    ```

  - When creating pull requests

    - make sure to create useful/verbose PR messages

    - don't be afraid to squash your commits

    - rebase onto the parent's upstream branch before pushing your remote


## Setup

#### Composer

You'll need to install [Composer][] in order to work on this project.
The easiest way would be executing following command:

```
curl -s http://getcomposer.org/installer | php
```

This should install [Composer][] in the project's root directory.
Now you can use [Composer][] by simply running `php composer.phar`

#### Bootstrap

If you've already installed [PHPUnit][] and [PHP Code Sniffer][] on your machine
you only need to configure projects autoloading by running:

```
php composer.phar dumpautoload -o
```

If you prefer to install [PHPUnit][] and [PHP Code Sniffer][] specifically for
this project and setup autoloading in one command just execute:

```
php composer.phar install
```

After this command you'll have all the tools required to work with this
project:

Run `./bin/phpunit` to run unit tests

Run `./bin/phpcs --standard=PSR2 --encoding=utf-8 -p src/ tests/` to validate
code against [PSR-2][] standard

[unit testing]: http://github.com/sergeylukin/multisort-php/blob/master/README.md#unit-testing
[psr-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[php code sniffer]: https://github.com/squizlabs/PHP_CodeSniffer
[composer]: https://getcomposer.org
[phpunit]: https://github.com/sebastianbergmann/phpunit/
