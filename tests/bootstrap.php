<?php

if (!$loader = @include __DIR__.'/../vendor/autoload.php') {
    die('You must set up the project autoloading, run the following commands:'.PHP_EOL.
        'curl -s http://getcomposer.org/installer | php'.PHP_EOL.
        'php composer.phar dumpautoload -o'.PHP_EOL);
}

$loader->add('Multisort\Test', __DIR__);
