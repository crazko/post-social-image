<?php declare(strict_types=1);

namespace Crazko\PostSocialImage;

use Crazko\PostSocialImage\Configuration;
use Crazko\PostSocialImage\Creator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'create';

    protected function configure(): void
    {
        $this->setDescription('Creates a new social image.');
        $this->setHelp('Creates a new social image with a defined title and optional signature.');
        $this->setDefinition([
            new InputArgument('destination', InputArgument::REQUIRED, 'Where to save the image?'),
            new InputArgument('title', InputArgument::REQUIRED, 'Title of the post the image should be generated for.'),
            new InputOption('width', 'w', InputOption::VALUE_REQUIRED, 'The width of the image in px. Height is calculated proportionaly 16:9.', 1200),
            new InputOption('padding', 'p', InputOption::VALUE_REQUIRED, 'The padding of the image title in px.', 100),
            new InputOption('size', 's', InputOption::VALUE_REQUIRED, 'The size of the image title in px.', 100),

            new InputOption('colorBackground', 'b', InputOption::VALUE_REQUIRED, 'HEX color of the title.', '#ffffff'),
            new InputOption('colorForeground', 'f', InputOption::VALUE_REQUIRED, 'HEX color of the image background.', '#000000'),

            new InputOption('origin', 'o', InputOption::VALUE_REQUIRED, 'E.g. your name or the name of your blog.', ''),
            new InputOption('colorOrigin', 'c', InputOption::VALUE_REQUIRED, 'HEX color of the origin.', '#000000'),
        ]);
    }

    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $title = $input->getArgument('title');
        $destination = $input->getArgument('destination');

        $width = $input->getOption('width');

        $configuration = new Configuration([
            'width' => $width,
            'padding' => $input->getOption('padding'),
            'font' => '/ubuntu.ttf',
            'angle' => 0,
            'size' => $input->getOption('size'),
            'origin' => $input->getOption('origin'),
            'originSize' => 25,
            'background' => $input->getOption('colorBackground'),
            'foreground' => $input->getOption('colorForeground'),
            'signature' => $input->getOption('colorOrigin'),
        ]);

        $imageCreator = new Creator($configuration);
        $path = $imageCreator->create($title, $destination);

        $output->writeln(sprintf('<info>Image was created in %s</info>', $path));

        return 0;
    }
}
