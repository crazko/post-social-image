<?php declare(strict_types=1);

namespace Crazko\PostSocialImage;

class TextFactory
{
    /**
     * @var ImageConfiguration
     */
    private $imageConfiguration;

    public function __construct(ImageConfiguration $imageConfiguration)
    {
        $this->imageConfiguration = $imageConfiguration;
    }

    public function create(string $text): Text
    {
        return new Text(
            $text,
            $this->imageConfiguration->size,
            $this->imageConfiguration->angle,
            $this->imageConfiguration->font
        );
    }
}
