<?php declare(strict_types=1);

use Crazko\PostSocialImage\Box;
use Tester\Assert;

require __DIR__ . '/../vendor/autoload.php';

$box = new Box('My amazing post', 50, __DIR__ . '/../src/ubuntu.ttf');

Assert::same(500, $box->width);
Assert::same(62, $box->height);

Assert::exception(function () use ($box): void {
    $box->foo;
}, \Throwable::class, 'Trying to access non-existing property: foo');
