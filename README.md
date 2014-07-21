[ ![Build status](https://travis-ci.org/sergeylukin/multisort-php.png?branch=master "Build status") ](https://travis-ci.org/sergeylukin/multisort-php)
[ ![Project status](http://stillmaintained.com/sergeylukin/multisort-php.png "Project status") ](http://stillmaintained.com/sergeylukin/multisort-php)

## About

[Multisort][] is a collection of PHP methods that allow sorting
insanely-dimensional arrays in multiple ways.

## Contributing

- [Contributing guide][contributing]
- [Current contributors][contributors]

*Thank you!*

## Setup

#### Composer

You'll need to install [Composer][] in order to use/develop this project.
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

## Unit Testing

This project uses [PHPUnit][] as it's unit testing framework.

To test the project, simply run `phpunit` if you've installed it globally
or run `./bin/phpunit` if you installed it with `composer install` inside
the project's directory.

## TODO:

[Multisort][] is a work in progress, so any ideas and patches are appreciated.

* ✓ add core functionality
* ✓ follow [PSR-2][] coding style standard + automatically validate files on every build
* come up with friendlier names for methods, arguments and variables
* add PhpDoc notations everywhere

## Changelog

See the [changelog][].

## License

Released under [MIT license][]

[multisort]: http://github.com/sergeylukin/multisort-php
[mit license]: http://sergey.mit-license.org/
[changelog]: http://github.com/sergeylukin/multisort-php/blob/master/CHANGELOG.md
[psr-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[contributing]: http://github.com/sergeylukin/multisort-php/blob/master/CONTRIBUTING.md
[contributors]: https://github.com/sergeylukin/multisort-php/graphs/contributors
[phpunit]: https://github.com/sebastianbergmann/phpunit/
[php code sniffer]: https://github.com/squizlabs/PHP_CodeSniffer
[composer]: https://getcomposer.org
