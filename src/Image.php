<?php declare(strict_types=1);

namespace Crazko\PostSocialImage;

use Nette\Utils\Image as NetteImage;

class Image
{
    /**
     * @var Configuration
     */
    private $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getFor(Text $text): NetteImage
    {
        $width = max($this->configuration->width, ($text->width + $this->configuration->padding));
        $height = floor($width / 16 * 9);

        // Calculate coordinates of the text
        $x = ($width / 2) - ($text->width / 2);
        $y = ($height / 2) - ($text->height / 2) + $this->configuration->size;

        $image = NetteImage::fromBlank(
            $width,
            $height,
            NetteImage::rgb(...$this->configuration->background)
        );

        $image->ttfText(
            $this->configuration->size,
            0,
            $x,
            $y,
            NetteImage::rgb(...$this->configuration->foreground),
            $this->configuration->font,
            (string) $text
        );

        $image->resize($this->configuration->width, null);

        // Add signature
        $image->ttfText(
            $this->configuration->originSize,
            0,
            $image->width - 320,
            $image->height - 50,
            NetteImage::rgb(...$this->configuration->signature),
            $this->configuration->font,
            $this->configuration->origin
        );

        return $image;
    }
}
