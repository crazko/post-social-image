# Post Social Image

A simple command line tool to generate images suitable for social media sites.

![Example Image](./docs/post-social-image.png)

## Installation

```
composer require crazko/post-social-images
```

## Usage

Through CLI:

```
vendor/bin/social-image create -o example.com ./assets/img "My amazing post"
```

You can also [define a new command](https://getcomposer.org/doc/articles/scripts.md#writing-custom-commands) to your `composer.json` to avoid constantly typing every option:

```json
{
    "scripts": {
        "image": "php ./vendor/bin/social-image create --ansi -b#E6FAFF -f#1E9682 -c#E1738A -o example.com ./assets/img"
    },
}
```

and use it to create new images repeatedly:

```
composer image "My amazing post"
```

### Available options




## How to add image to the site

Add following meta tags to the `<head>` element of your page:

```html
<meta name="twitter:image" content="path/to/image.png">
<meta property="og:image" content="path/to/image.png">
```

All recommended tags:

```html
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:creator" content="@rmnvsl">
<meta name="twitter:title" content="Easy frontend development">
<meta name="twitter:description" content="Create, store, present and distribute HTML templates painlessly with the current offer of the tools that are ready to help you. And completely for free!">
<meta name="twitter:image" content="https://romanvesely.com/assets/posts/easy-frontend-development.png">
<meta property="og:type" content="article">
<meta property="og:title" content="Easy frontend development">
<meta property="og:description" content="Create, store, present and distribute HTML templates painlessly with the current offer of the tools that are ready to help you. And completely for free!">
<meta property="og:url" content="https://romanvesely.com/easy-frontend-development">
<meta property="og:image" content="https://romanvesely.com/assets/posts/easy-frontend-development.png">
```

See [The Open Graph protocol](http://ogp.me/) and [Twitter Cards](https://developer.twitter.com/en/docs/tweets/optimize-with-cards/overview/abouts-cards) for more info about other meta tags.

### Preview

Try to add your page to the https://metatags.io/ to see how would it look like when shared on Facebook, Twitter, Linkedin and others.
