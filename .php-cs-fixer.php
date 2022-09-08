<?php

require_once __DIR__ . '/vendor/marioblazek/coding-standard/src/PhpCsFixer/Config.php';

return (new Marek\CodingStandard\PhpCsFixer\Config())
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->exclude(['vendor', 'doc'])
            ->in(__DIR__)
        );
