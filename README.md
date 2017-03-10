# Privacy Cookie Bundle

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/3687a8b0-c268-49cf-b072-15a10d920709/big.png)](https://insight.sensiolabs.com/projects/3687a8b0-c268-49cf-b072-15a10d920709)

This bundle adds privacy cookie banner into Symfony 2 application.

![screenshot](https://cloud.githubusercontent.com/assets/3033038/14012485/5087f198-f1a6-11e5-881c-028bbe806cb3.png)

## Requirements

- Symfony v2.6 or later (including Symfony 3.x)

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
    new EzSystems\PrivacyCookieBundle\EzSystemsPrivacyCookieBundle(),

    // starting from Symfony 2.8 you have to enable AsseticBundle manually if you haven't done it before
    new Symfony\Bundle\AsseticBundle\AsseticBundle()
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

Add the following minimal configuration in `config.yml` file to enable `Assetic` support in your application (Symfony 2.8 and later):

```yaml
assetic:
    debug: '%kernel.debug%'
    use_controller: '%kernel.debug%'
    filters:
        cssrewrite: ~
```

If you are installing the bundle via `composer require` you must also copy assets to your project's `web` directory. You can do this by calling Symfony's built-in command from the project root directory:

For Symfony 2.x:

```bash
php app/console assets:install --symlink
```

For Symfony 3.x:

```bash
php bin/console assets:install --symlink
```

In production environment you have to dump assets using `Assetic` built-in command:

For Symfony 2.x:

```bash
php app/console assetic:dump -e=prod
```

For Symfony 3.x:

```bash
php bin/console assetic:dump -e=prod
```

## Usage

Insert the following `{{ show_privacy_cookie_banner(%privacy_policy_url%) }}` helper somewhere in your footer template before the body ending tag. Replace the `%privacy_policy_url%` parameter with your policy page address.

Note that the `%privacy_policy_url%` parameter is not required, in this case no policy link will be shown.

The following optional parameters can be set as a second argument in an array format:

Parameter        | Default value                                  | Description
---------------- | ---------------------------------------------- | -----------
cookieName       | privacyCookieAccepted                          | Sets your own status cookie name
cookieValidity   | 365                                            | Says how many days privacy banner should be hidden when user accepts policy?
cookiePath       | null                                           | Specifies the cookie path (by default cookie will be available only for the current domain)
caption          | Cookies help us create a good experience (...) | Sets your own banner message caption
learnMoreText    | Learn More                                     | Sets title and text of privacy link
extraParams      | Extra Params                                   | Send extra params in your override template

Example of usage in standard Symfony application:

```twig
{{ show_privacy_cookie_banner('http://ez.no/Privacy-policy') }}
```

or

```twig
{{ show_privacy_cookie_banner('http://ez.no/Privacy-policy', {
   cookieName: 'myCookie',
   cookieValidity: 7,
   cookiePath: '/',
   caption: 'Nice to see you here',
   learnMoreText: 'Find out more'
}) }}
```

If you are using eZ Publish / Platform you can use `ez_urlalias` to generate path for specified content object:

```twig
{{ show_privacy_cookie_banner(path('ez_urlalias', {contentId: 94}), {
   cookieName: 'myCookie',
   cookieValidity: 7,
   caption: 'Nice to see you here'
}) }}
```

Example of usage extraParams:

```twig
{{ show_privacy_cookie_banner('http://ez.no/Privacy-policy', {
   cookieName: 'myCookie',
   extraParams: {
       my_param1: value_my_param1 ,
       my_param2: value_my_param2
   }
}) }}
```
