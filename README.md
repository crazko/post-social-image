# Post Social Image

A simple command line tool to generate images suitable for social media sites.

![Example Image](./docs/post-social-image.png)

## Installation

```
composer require crazko/post-social-images
```

## Usage

TBD

### Through CLI:

```
vendor/bin/create-image -o example.com ./assets/img "My amazing post"
```

Resulting success message:

> Image was created in ./assets/img/my-amazing-post.png

You can also [define a new command](https://getcomposer.org/doc/articles/scripts.md#writing-custom-commands) to your `composer.json` to avoid constantly typing every option:

```json
{
    "scripts": {
        "image": "vendor/bin/create-image --ansi -b E6FAFF -f 1E9682 -c E1738A -o example.com ./assets/img"
    },
}
```

and use it to create new images more easily:

```
composer image "My amazing post"
```

### Available options

TBD

## How to add image to the site

Add following meta tags to the `<head>` element of your page:

```html
<meta name="twitter:image" content="/assets/img/my-amazing-post.png">
<meta property="og:image" content="/assets/img/my-amazing-post.png">
```

All recommended tags:

```html
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:creator" content="@twitter_handle">
<meta name="twitter:title" content="My amazing post">
<meta name="twitter:description" content="My amazing post introduction for visitors and crawlers.">
<meta name="twitter:image" content="/assets/img/my-amazing-post.png">

<meta property="og:type" content="article">
<meta property="og:title" content="My amazing post">
<meta property="og:description" content="My amazing post introduction for visitors and crawlers.">
<meta property="og:url" content="https://example.com/my-amazing-post">
<meta property="og:image" content="/assets/img/my-amazing-post.png">
```

See [The Open Graph protocol](http://ogp.me/) and [Twitter Cards](https://developer.twitter.com/en/docs/tweets/optimize-with-cards/overview/abouts-cards) for more info about other meta tags.

### Preview

Try to add your page to the https://metatags.io/ to see how would it look like with your amazing new social image when shared on Facebook, Twitter, Linkedin and others.
