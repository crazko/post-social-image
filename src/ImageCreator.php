<?php declare(strict_types=1);

namespace Crazko\PostSocialImage;

use Nette\Utils\Strings;

class ImageCreator
{
    /**
     * @var TextFactory
     */
    private $textFactory;

    /**
     * @var ImageFactory
     */
    private $imageFactory;

    public function __construct(TextFactory $textFactory, ImageFactory $imageFactory)
    {
        $this->textFactory = $textFactory;
        $this->imageFactory = $imageFactory;
    }

    public function create(string $title, string $destination): void
    {
        $filename = Strings::webalize($title);

        $text = $this->textFactory->create($title);
        $image = $this->imageFactory->create($text);

        $image->save(sprintf('%s/%s.png', $destination, $filename), 7);
    }
}
