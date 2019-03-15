<?php declare(strict_types=1);

namespace Crazko\PostSocialImage;

/**
 * @property-read string $text
 * @property-read int $size
 * @property-read string $color
 * @property-read int|null $position
 */
class Text
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var int
     */
    private $size;

    /**
     * @var string
     */
    private $color;

    /**
     * @var int|null
     */
    private $position;

    public function __construct(string $text, int $size, string $color, ?int $position = null)
    {
        $this->text = $text;
        $this->size = $size;
        $this->color = $color;
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function __get(string $param)
    {
        if (property_exists($this, $param)) {
            return $this->{$param};
        }

        throw new \Exception("Trying to access non-existing property: ${param}");
    }
}
