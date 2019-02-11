#!/usr/bin/env php
<?php declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Crazko\PostSocialImage\ColorConfiguration;
use Crazko\PostSocialImage\ImageConfiguration;
use Crazko\PostSocialImage\TextFactory;
use Crazko\PostSocialImage\ImageFactory;
use Crazko\PostSocialImage\ImageCreator;

class CreateCommand extends Command
{
    protected static $defaultName = 'create';

    protected function configure()
    {
        $this
            ->setDescription('Creates a new social image.')
            ->setHelp('Creates a new social image with a defined title and optional signature.')
            ->addArgument('title', InputArgument::REQUIRED, 'Title of the post the image should be generated for.')
            ->addArgument('destination', InputArgument::REQUIRED, 'Where to save the image?')
            ->addOption('signature', 's', InputOption::VALUE_REQUIRED, 'E.g. your name or the name of your blog.', '');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        // TODO: Check destination availability

        $imageConfiguration = new ImageConfiguration([
            'width' => 1200,
            'padding' => 100,
            'font' => '/ubuntu.ttf',
            'angle' => 0,
            'size' => 100,
            'signature' => $input->getOption('signature'),
            'signatureSize' => 25,
        ]);
        $colorConfiguration = new ColorConfiguration([
            'background' => '#E6FAFF',
            'foreground' => '#1E9682',
            'signature' => '#E1738A',
        ]);

        $textFactory = new TextFactory($imageConfiguration);
        $imageFactory = new ImageFactory($colorConfiguration, $imageConfiguration);

        $imageCreator = new ImageCreator($textFactory, $imageFactory);
        $imageCreator->create($input->getArgument('title'), $input->getArgument('destination'));
    }
}

$application = new Application();
$application->add(new CreateCommand());
$application->run();
