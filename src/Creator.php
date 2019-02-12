<?php declare(strict_types=1);

namespace Crazko\PostSocialImage;

use Nette\Utils\FileSystem;
use Nette\Utils\Strings;

class Creator
{
    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @var Image
     */
    private $image;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
        $this->image = new Image($configuration);
    }

    public function create(string $title, string $destination): void
    {
        $filename = Strings::webalize($title);
        $image = $this->image->getFor(new Text(
            $title,
            $this->configuration->size,
            $this->configuration->angle,
            $this->configuration->font
        ));

        FileSystem::createDir($destination);
        $image->save(sprintf('%s/%s.png', $destination, $filename), 7);
    }
}
