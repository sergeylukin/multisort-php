## Contributing

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

[unit-testing]: http://github.com/sergeylukin/multisort-php/blob/master/README.md#unit-testing
[psr-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[php code sniffer]: https://github.com/squizlabs/PHP_CodeSniffer
