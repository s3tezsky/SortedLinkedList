<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Phpdoc\GeneralPhpdocAnnotationRemoveFixer;
use Symplify\CodingStandard\Fixer\LineLength\LineLengthFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
        __DIR__ . '/public',
    ])
    ->withPreparedSets(
        psr12: true,
        common: true,
        symplify: true,
        laravel: false,
        strict: true,
        cleanCode: true,
    )
    ->withPhpCsFixerSets(perCS30: true)
    ->withSkip([
        LineLengthFixer::class,
        GeneralPhpdocAnnotationRemoveFixer::class,
    ]);
