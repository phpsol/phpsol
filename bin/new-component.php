<?php

declare(strict_types=1);

use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

require_once __DIR__ . '/../vendor/autoload.php';

$filesystem = new Filesystem();
$input = new ArgvInput();
$output = new ConsoleOutput();

$io = new SymfonyStyle($input, $output);

$name = (string)$io->ask('What is the name of the component? (in PascalCase)');
$description = (string)$io->ask('What is de description of the component?');

$configuration = [
    'name' => 'phpsol/' . convertCamelCaseToSnakeCase($name),
    'type' => 'library',
    'license' => 'MIT',
    'description' => $description,
    'homepage' => 'https://github.com/phpsol/' . convertCamelCaseToSnakeCase($name),
    'authors' => [
        [
            'name' => 'Daniël Brekelmans',
            'homepage' => 'https://github.com/dbrekelmans',
        ],
        [
            'name' => 'Maarten Nusteling',
            'homepage' => 'https://github.com/nusje2000',
        ],
    ],
    'require' => [
        'php' => '^7.4',
    ],
    'require-dev' => [
        'phpunit/phpunit' => '^9.4',
    ],
    'autoload' => [
        'psr-4' => [
            'Phpsol\\' . $name . '\\' => './',
        ],
    ],
    'autoload-dev' => [
        'psr-4' => [
            'Phpsol\\' . $name . '\\Tests\\' => './Tests',
        ],
    ],
];

$targetDir = dirname(__DIR__) . '/src/' . $name;
if (!$filesystem->exists($targetDir)) {
    $filesystem->mkdir($targetDir);
}

$composerLocation = $targetDir . '/composer.json';
if ($filesystem->exists($composerLocation)) {
    if (!$io->confirm(sprintf('Would you like to overwrite "%s".', $composerLocation))) {
        $io->error('Could not write composer file, aborting.');

        exit(1);
    }

    $filesystem->remove($composerLocation);
}

$composerContents = json_encode($configuration, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n";
$filesystem->dumpFile($composerLocation, $composerContents);

$filesystem->mkdir($targetDir . '/Tests');
$testGitKeepLocation = $targetDir . '/Tests/.gitkeep';
$filesystem->dumpFile($testGitKeepLocation, '');

$io->success(sprintf('Created new component in "%s".', $targetDir));

if ($io->confirm('Would you like to add the new files to git?')) {
    addToGit($composerLocation);
    addToGit($testGitKeepLocation);
}

function convertCamelCaseToSnakeCase(string $string, string $snakeCharacter = '-') : string
{
    $split = str_split($string);
    foreach ($split as $index => &$character) {
        if (preg_match('/[A-Z]/', $character) > 0) {
            $character = strtolower($character);

            if ($index > 0) {
                $character = $snakeCharacter . $character;
            }
        }
    }

    return implode($split);
}

function addToGit(string $file) : void
{
    $process = Process::fromShellCommandline(sprintf('git add %s', $file), dirname(__DIR__));
    $process->run();

    if (0 !== $process->getExitCode()) {
        throw new LogicException(sprintf('Could not add file to git due to: %s', $process->getErrorOutput()));
    }
}

