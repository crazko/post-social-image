<?php declare(strict_types=1);

namespace Crazko\PostSocialImage;

use Nette\Utils\FileSystem;
use Nette\Utils\Image as NetteImage;
use Nette\Utils\Strings;

class Image
{
    const LETTERS_TO_WRAP = 20;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @var string
     */
    private $background;

    /**
     * @var string
     */
    private $fontPath;

    /**
     * @var Text[]
     */
    private $texts = [];

    /**
     * @var NetteImage
     */
    private $image;

    /**
     * @var int
     */
    private $padding;

    public function __construct(int $width, string $background, string $font, int $padding)
    {
        $this->width = $width;
        $this->height = $this->heightFromWidth($width);
        $this->background = $background;
        $this->fontPath = sprintf('%s/%s', __DIR__, $font);
        $this->padding = $padding;
    }

    public function text(string $text, int $size, string $color, ?int $position = null): void
    {
        $this->texts[] = new Text($text, $size, $color, $position);
    }

    /**
     * @return string The path of created image.
     */
    public function save(string $name, string $destination): string
    {
        $filename = Strings::webalize($name);
        $filepath = sprintf('%s/%s.png', $destination, $filename);

        FileSystem::createDir($destination);

        $image = $this->get();
        $image->save($filepath, 7);

        return $filepath;
    }

    public function get(): NetteImage
    {
        if ($this->image === null) {
            $this->image = $this->create();
        }

        return $this->image;
    }

    private function heightFromWidth(int $width): int
    {
        return (int) floor($width / 16 * 9);
    }

    private function widthFromHeight(int $height): int
    {
        return (int) floor($height / 9 * 16);
    }

    private function create(): NetteImage
    {
        // First text is a "title"
        /** @var Text $title */
        $title = array_shift($this->texts);
        $wrappedTitle = wordwrap($title->text, self::LETTERS_TO_WRAP);
        $boxTitle = new Box($wrappedTitle, $title->size, $this->fontPath);

        $possibleWidth = max($this->width, ($boxTitle->width + 2 * $this->padding));
        $possibleHeight = $this->heightFromWidth($possibleWidth);

        $initialHeight = max($possibleHeight, ($boxTitle->height + 2 * $this->padding));
        $initialWidth = $initialHeight > $possibleHeight ? $this->widthFromHeight($initialHeight) : $possibleWidth;

        $titleX = (int) ($initialWidth / 2) - ($boxTitle->width / 2);
        $titleY = (int) ($initialHeight / 2) - ($boxTitle->height / 2) + $title->size;

        $image = NetteImage::fromBlank(
            $initialWidth,
            $initialHeight,
            NetteImage::rgb(...$this->hexToRGB($this->background))
        );

        $image->ttfText(
            $title->size,
            0,
            $titleX,
            $titleY,
            NetteImage::rgb(...$this->hexToRGB($title->color)),
            $this->fontPath,
            $wrappedTitle
        );

        $image->resize($this->width, null);

        foreach ($this->texts as $text) {
            $boxText = new Box($text->text, $text->size, $this->fontPath);
            $x = 0;
            $y = 0;

            if ($text->position & Position::TOP) {
                $y = $this->padding + $text->size;
            }

            if ($text->position & Position::BOTTOM) {
                $y = $this->height - $boxText->height - $this->padding + $text->size;
            }

            if ($text->position & Position::LEFT) {
                $x = $this->padding;
            }

            if ($text->position & Position::RIGHT) {
                $x = $this->width - $boxText->width - $this->padding;
            }

            $image->ttfText(
                $text->size,
                0,
                $x,
                $y,
                NetteImage::rgb(...$this->hexToRGB($text->color)),
                $this->fontPath,
                $text->text
            );
        }

        return $image;
    }

    /**
     * @return int[]
     */
    private function hexToRGB(string $hex): array
    {
        preg_match('/^#?([a-fA-F\d]{2})([a-fA-F\d]{2})([a-fA-F\d]{2})$/', $hex, $parts);

        if (! $parts) {
            throw new \InvalidArgumentException('Provided color is not in HEX format: ' . $hex);
        }

        return [
            (int) hexdec($parts[1]),
            (int) hexdec($parts[2]),
            (int) hexdec($parts[3]),
        ];
    }
}
