<?php declare(strict_types=1);

namespace Crazko\PostSocialImage;

use Nette\Utils\Image;

class ImageFactory
{
    /**
     * @var ColorConfiguration
     */
    private $colorConfiguration;

    /**
     * @var ImageConfiguration
     */
    private $imageConfiguration;

    public function __construct(ColorConfiguration $colorConfiguration, ImageConfiguration $imageConfiguration)
    {
        $this->colorConfiguration = $colorConfiguration;
        $this->imageConfiguration = $imageConfiguration;
    }

    public function create(Text $text): Image
    {
        $width = max($this->imageConfiguration->width, ($text->width + $this->imageConfiguration->padding));
        $height = floor($width / 16 * 9);

        // Calculate coordinates of the text
        $x = ($width / 2) - ($text->width / 2);
        $y = ($height / 2) - ($text->height / 2) + $this->imageConfiguration->size;

        $image = Image::fromBlank(
            $width,
            $height,
            Image::rgb(...$this->colorConfiguration->getBackground())
        );
        $image->ttfText(
            $this->imageConfiguration->size,
            $this->imageConfiguration->angle,
            $x,
            $y,
            Image::rgb(...$this->colorConfiguration->getForeground()),
            $this->imageConfiguration->font,
            (string) $text
        );

        $image->resize($this->imageConfiguration->width, null);

        // Add signature
        $image->ttfText(
            $this->imageConfiguration->signatureSize,
            $this->imageConfiguration->angle,
            $image->width - 320,
            $image->height - 50,
            Image::rgb(...$this->colorConfiguration->getSignature()),
            $this->imageConfiguration->font,
            $this->imageConfiguration->signature
        );

        return $image;
    }
}
