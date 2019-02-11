<?php declare(strict_types=1);

namespace Crazko\PostSocialImage;

/**
 * @property-read int $width
 * @property-read int $height
 */
class Text
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var int[]
     */
    private $dimensions;

    public function __construct(string $text, int $size, int $angle, string $font)
    {
        $this->text = wordwrap($text, 30);

        $box = imagettfbbox($size, $angle, $font, $this->text);
        $minX = min($box[0], $box[2], $box[4], $box[6]);
        $maxX = max($box[0], $box[2], $box[4], $box[6]);
        $minY = min($box[1], $box[3], $box[5], $box[7]);
        $maxY = max($box[1], $box[3], $box[5], $box[7]);

        $this->dimensions = [
            'width' => (int) ($maxX - $minX),
            'height' => (int) ($maxY - $minY),
        ];
    }

    public function __get(string $dimension): int
    {
        return $this->dimensions[$dimension];
    }

    public function __toString(): string
    {
        return $this->text;
    }
}
