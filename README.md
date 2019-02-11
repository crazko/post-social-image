# Post Social Image

A simple command line tool to generate images suitable for social media sites.

![Example Image](./docs/post-social-image.png)

## Installation

```
composer install crazko/post-social-images
```

## Usage

```
vendor/bin/social-image create "My amazing post" ./assets/img -s example.com
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
