<?php declare(strict_types=1);

namespace Crazko\PostSocialImage;

use Exception;
use Nette\Utils\FileSystem;
use Nette\Utils\Image as NetteImage;
use Nette\Utils\Strings;

class Image
{
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
    private $fontPath;

    /**
     * @var NetteImage
     */
    private $image;

    public function __construct(int $width, string $background, string $font)
    {
        $this->width = $width;
        $this->height = (int) floor($width / 16 * 9);
        $this->background = $background;
        $this->fontPath = sprintf('%s/%s', __DIR__, $font);
    }

    public function text(string $text, int $size, string $color, string $position): void
    {
        // $box = $this->getTextBox($text, $size, $this->fontPath);

        // var_dump($box);

        // // ako vlastny argument - center, right, left bottom ...
        // $x = ($this->width / 2) - ($box['width'] / 2);
        // $y = ($this->height / 2) - ($box['height'] / 2) + $size;

        // $this->image->ttfText(
        //     $size,
        //     0,
        //     $x,
        //     $y,
        //     NetteImage::rgb(...$this->hexToRGB($color)),
        //     $this->fontPath,
        //     $text
        // );
    }

    public function setSignature(string $text, int $size, string $color): void
    {
        // // Add signature
        // $image->ttfText(
        //     $this->configuration->originSize,
        //     0,
        //     $image->width - 320,
        //     $image->height - 50,
        //     NetteImage::rgb(...$this->configuration->signature),
        //     $this->configuration->font,
        //     $this->configuration->origin
        // );
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

    public function get()
    {
        if (! $this->image) {
            $this->image = $this->create;
        }

        return $this->image;
    }

    private function create(): NetteImage
    {

        // prejst vsetky texty a upravit

        $image = NetteImage::fromBlank(
            $this->width,
            $this->height,
            NetteImage::rgb(...$this->hexToRGB($background))
        );

        $image->resize($this->width, null);

        return $image;
    }

    /**
     * @return int[]
     */
    private function hexToRGB(string $hex): array
    {
        preg_match('/^#?([a-fA-F\d]{2})([a-fA-F\d]{2})([a-fA-F\d]{2})$/', $hex, $parts);

        if (! $parts) {
            throw new Exception('bad color provided' . $hex);
        }

        return [
            (int) hexdec($parts[1]),
            (int) hexdec($parts[2]),
            (int) hexdec($parts[3]),
        ];
    }

    /**
     * @return int[]
     */
    private function getTextBox(string $text, int $size, string $font): array
    {
        $wrappedText = wordwrap($text, 30);

        $box = imagettfbbox($size, 0, $font, $wrappedText);
        $minX = min($box[0], $box[2], $box[4], $box[6]);
        $maxX = max($box[0], $box[2], $box[4], $box[6]);
        $minY = min($box[1], $box[3], $box[5], $box[7]);
        $maxY = max($box[1], $box[3], $box[5], $box[7]);

        return [
            'width' => (int) ($maxX - $minX),
            'height' => (int) ($maxY - $minY),
        ];
    }
}
