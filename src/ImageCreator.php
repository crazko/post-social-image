<?php declare(strict_types=1);

namespace Crazko\PostSocialImage;

class ImageCreator
{
    public function create(int $width, string $background, string $font): Image
    {
        return new Image($width, $background, $font);
    }
}
