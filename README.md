# Privacy Cookie Bundle

This bundle adds privacy cookie banner into Symfony 2 application.

![screenshot](https://cloud.githubusercontent.com/assets/3033038/14012485/5087f198-f1a6-11e5-881c-028bbe806cb3.png)

## Requirements

- Symfony v2.6 or later

## Installation
This package is available via Composer, so the instructions below are similar to how you install any other open source Symfony Bundle.

Run the following command in a terminal, from your Symfony installation root (pick most recent release):
```bash
php composer.phar require ezsystems/privacy-cookie-bundle
```

Enable the bundle in `app/AppKernel.php` file:

```php
$bundles = array(
    // existing bundles
    new EzSystems\PrivacyCookieBundle\EzSystemsPrivacyCookieBundle()
);
```

Add external assets to your bundle:

- CSS:
```
bundles/ezsystemsprivacycookie/css/privacycookie.css
```

- JS:
```
bundles/ezsystemsprivacycookie/js/privacycookie.js
```

If you are installing bundle via `composer require` you must also copy assets to your project `web` directory. You can do this by calling Symfony built-in command from the project root directory:

```bash
php app/console assets:install --symlink
```

## Usage

Insert the following `{{ show_privacy_cookie_banner(%privacy_policy_url%) }}` helper somewhere in your footer template before the body ending tag. Replace the `%privacy_policy_url%` parameter with your policy page address.

Note that the `%privacy_policy_url%` parameter is not required, in this case no policy link will be shown.

The following optional parameters can be set as a second argument in an array format:

Parameter     | Default value                                  | Description
------------- | ---------------------------------------------- | -----------
cookieName    | privacyCookieAccepted                          | Sets your own status cookie name
days          | 365                                            | Says how many days privacy banner should be hidden when user accepts policy?
bannerCaption | Cookies help us create a good experience (...) | Sets your own banner message caption

Example of usage in standard Symfony application:

```twig
{{ show_privacy_cookie_banner('http://ez.no/Privacy-policy') }}
```

or

```twig
{{ show_privacy_cookie_banner('http://ez.no/Privacy-policy', {
   cookieName: 'myCookie',
   days: 7,
   bannerCaption: 'Nice to see you here'
}) }}
```

If you are using eZ Publish / Platform you can use `ez_urlalias` to generate path for specified content object:

```twig
{{ show_privacy_cookie_banner(path('ez_urlalias', {contentId: 94}), {
   cookieName: 'myCookie',
   days: 7,
   bannerCaption: 'Nice to see you here'
}) }}
```
