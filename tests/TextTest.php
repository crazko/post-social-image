<?php declare(strict_types=1);

use Crazko\PostSocialImage\Text;
use Tester\Assert;

require __DIR__ . '/../vendor/autoload.php';

$text = new Text('My amazing post', 50, '#ffffff');

Assert::same('My amazing post', $text->text);
Assert::same(50, $text->size);
Assert::same('#ffffff', $text->color);

Assert::exception(function () use ($text): void {
    $text->foo;
}, \Throwable::class, 'Trying to access non-existing property: foo');
