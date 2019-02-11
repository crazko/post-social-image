<?php declare(strict_types=1);

namespace Crazko\PostSocialImage;

/**
 * @property-read int $width
 * @property-read int $size
 * @property-read int $angle
 * @property-read string $font
 * @property-read int $padding
 * @property-read string $signature
 * @property-read int $signatureSize
 */
final class ImageConfiguration
{
    /**
     * @var mixed[]
     */
    private $image;

    /**
     * @param mixed[] $image
     */
    public function __construct(array $image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function __get(string $param)
    {
        if ($param === 'font') {
            return sprintf('%s/%s', __DIR__, $this->image[$param]);
        }

        return $this->image[$param];
    }
}
