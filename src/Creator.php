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

    /**
     * @return string The path of created image.
     */
    public function create(string $title, string $destination): string
    {
        $filename = Strings::webalize($title);
        $filepath = sprintf('%s/%s.png', $destination, $filename);
        $image = $this->image->getFor(new Text(
            $title,
            $this->configuration->size,
            $this->configuration->font
        ));

        FileSystem::createDir($destination);
        $image->save($filepath, 7);

        return $filepath;
    }
}
