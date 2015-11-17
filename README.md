# Privacy Cookie Bundle

This bundle adds privacy cookie banner into Symfony 2 application (eZ Publish / eZ Platform).

## Requirements

- Symfony v2.6 or later _(*)_
- BootstrapJS v3.x

_(*) if you are using Symfony v2.5 you should install v0.1 of this bundle_

## Installation
This package is available via Composer, so the instructions below are similar to how you install any other open source Symfony Bundle.

Run the following command in a terminal, from your Symfony installation root (pick most recent release):
```
php composer.phar require ezsystems/privacy-cookie-bundle
```

Enable the bundle in `app/AppKernel.php` file (for regular Symfony application) or `ezpublish\EzPublishKernel.php` file (for eZ Publish / eZ Platform):
```
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

You should also add BootstrapJS libraries into your project.

If you are installing bundle via `composer require` you must also copy assets to your project `web` directory. You can do this by calling Symfony built-in command from the project root directory:

```
php app/console assets:install --symlink
```

If you are using eZ Publish / eZ Platform:

```
php ezpublish/console assets:install --symlink
```

## Usage

Insert the following `{{ show_privacy_cookie_banner(%privacy_policy_url%) }}` helper somewhere in your footer template before the body ending tag. Replace the `%privacy_policy_url%` parameter with your policy page address.

Note that `%privacy_policy_url%` parameter is not required, in this case no policy link will be shown.

The following optional parameters can be set as a second argument in an array format:

Parameter     | Default value                                  | Description
------------- | ---------------------------------------------- | -----------
cookieName    | privacyCookieAccepted                          | Sets your own status cookie name
days          | 365                                            | Says how many days privacy banner should be hidden when user accepts policy?
bannerCaption | Cookies help us create a good experience (...) | Sets your own banner message caption

Example of usage:

```
{{ show_privacy_cookie_banner('http://ez.no/Privacy-policy') }}
```

or

```
{{ show_privacy_cookie_banner(path('ez_urlalias', {contentId: 94}), {
    cookieName: 'myCookie',
    days: 7,
    bannerCaption: 'Nice to see you here'}) }}
```

##Abstraction

Privacy Cookie Bundle v0.2 allows to increase abstraction level on the implementation side. Example of the usage can be see at [EzDemoBundle](https://github.com/ezsystems/DemoBundle). Banner options are retrieved from a specified content type structure.
