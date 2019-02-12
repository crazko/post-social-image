<?php declare(strict_types=1);

namespace Crazko\PostSocialImage;

use Exception;

/**
 * @property-read int $width
 * @property-read int $size
 * @property-read int $angle
 * @property-read string $font
 * @property-read int $padding
 * @property-read string $origin
 * @property-read int $originSize
 * @property-read int[] $background
 * @property-read int[] $foreground
 * @property-read int[] $signature
 */
final class Configuration
{
    /**
     * @var mixed[]
     */
    private $config;

    /**
     * @param mixed[] $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function __get(string $param)
    {
        if ($param === 'font') {
            return sprintf('%s/%s', __DIR__, $this->config[$param]);
        }

        if (in_array($param, ['background', 'foreground', 'signature'], true)) {
            return $this->hexToRGB($this->config[$param]);
        }

        return $this->config[$param];
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
