<?php

$finder = PhpCsFixer\Finder::create()
    ->notPath('src/Symfony/Component/Translation/Tests/fixtures/resources.php')
    ->in([
        __DIR__ . '/src',
    ])
;

$config = new PhpCsFixer\Config();

return $config
    ->setRules(['@Symfony' => true])
    ->setFinder($finder);
