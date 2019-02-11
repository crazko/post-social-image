<?php declare(strict_types=1);

namespace Crazko\PostSocialImage;

use Exception;

final class ColorConfiguration
{
    /**
     * @var int[]
     */
    private $background;

    /**
     * @var int[]
     */
    private $foreground;

    /**
     * @var int[]
     */
    private $signature;

    /**
     * @param string[] $color
     */
    public function __construct(array $color)
    {
        $this->background = $this->hexToRGB($color['background']);
        $this->foreground = $this->hexToRGB($color['foreground']);
        $this->signature = $this->hexToRGB($color['signature']);
    }

    /**
     * @return int[]
     */
    public function getBackground(): array
    {
        return $this->background;
    }

    /**
     * @return int[]
     */
    public function getForeground(): array
    {
        return $this->foreground;
    }

    /**
     * @return int[]
     */
    public function getSignature(): array
    {
        return $this->signature;
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
}
