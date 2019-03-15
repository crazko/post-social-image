<?php declare(strict_types=1);

use Crazko\PostSocialImage\Image;
use Tester\Assert;

require __DIR__ . '/../vendor/autoload.php';

class ImageTest extends Tester\TestCase
{
    public function setUp(): void
    {
        $this->image = new Image(800, '#ffffff', __DIR__ . '/../src/ubuntu.ttf', 50);
    }

    public function testGetException(): void
    {
        Assert::exception(function () {
            $this->image->get();
        }, \InvalidArgumentException::class, 'Add at least one text with Image::text()');
    }

    public function testGetImage(): void
    {
        $this->image->text('My amazing post', 50, '#000000');
        $imageFile = $this->image->get();

        Assert::same(800, $imageFile->width);
        Assert::same(450, $imageFile->height);
    }

    public function testSaveImage(): void
    {
        $this->image->text('My amazing post', 50, '#000000');
        $path = $this->image->save('My amazing post', __DIR__ . '/img');

        Assert::same(__DIR__ . '/img/my-amazing-post.png', $path);
        Assert::true(file_exists($path));
        unlink($path);
    }

    public function testColorException(): void
    {
        $this->image->text('My amazing post', 50, 'Bad color');
        Assert::exception(function () {
            $this->image->get();
        }, \InvalidArgumentException::class, 'Provided color is not in HEX format: Bad color');
    }
}

(new ImageTest())->run();
