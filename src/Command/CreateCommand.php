<?php declare(strict_types=1);

namespace Crazko\PostSocialImage\Command;

use Crazko\PostSocialImage\Image;
use Crazko\PostSocialImage\Position;
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
            new InputOption('padding', 'p', InputOption::VALUE_REQUIRED, 'The padding of the image in px.', 50),
            new InputOption('size', 's', InputOption::VALUE_REQUIRED, 'The size of the image title in px.', 100),

            new InputOption('colorBackground', 'b', InputOption::VALUE_REQUIRED, 'HEX color of the title.', 'ffffff'),
            new InputOption('colorForeground', 'f', InputOption::VALUE_REQUIRED, 'HEX color of the image background.', '000000'),

            new InputOption('origin', 'o', InputOption::VALUE_REQUIRED, 'E.g. your name or the name of your blog.', null),
            new InputOption('colorOrigin', 'c', InputOption::VALUE_REQUIRED, 'HEX color of the origin.', '000000'),
        ]);
    }

    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $title = $input->getArgument('title');
        $destination = $input->getArgument('destination');

        if (! is_string($title) || ! is_string($destination)) {
            $output->writeln('<error>Bad arguments provided</error>');

            return 1;
        }

        $width = $input->getOption('width');
        $padding = $input->getOption('padding');
        $font = __DIR__ . '/../ubuntu.ttf';
        $titleSize = $input->getOption('size');
        $origin = $input->getOption('origin');
        $originSize = 25;
        $colorBackground = $input->getOption('colorBackground');
        $colorTitle = $input->getOption('colorForeground');
        $colorOrigin = $input->getOption('colorOrigin');

        $image = new Image($width, $colorBackground, $font, $padding);
        $image->text($title, $titleSize, $colorTitle);

        if ($origin) {
            $image->text($origin, $originSize, $colorOrigin, Position::BOTTOM | Position::RIGHT);
        }

        $path = $image->save($title, $destination);

        $output->writeln(sprintf('<info>Image was created in %s</info>', $path));

        return 0;
    }
}
