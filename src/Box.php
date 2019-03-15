<?php declare(strict_types=1);

namespace Crazko\PostSocialImage;

/**
 * @property-read int $width
 * @property-read int $height
 */
class Box
{
    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    public function __construct(string $text, int $size, string $font)
    {
        $box = imagettfbbox($size, 0, $font, $text);

        $this->width = (int) $box[2] - $box[0];
        $this->height = (int) $box[1] - $box[7];
    }

    public function __get(string $param): int
    {
        if (property_exists($this, $param)) {
            return $this->{$param};
        }

        throw new \Exception("Trying to access non-existing property: ${param}");
    }
}
