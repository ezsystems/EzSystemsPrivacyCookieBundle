/*
 * Copyright (C) eZ Systems AS. All rights reserved.
 * For full copyright and license information view LICENSE file distributed with this source code.
 */

(function (global, doc) {
    var eZ = global.eZ = global.eZ || {};

    /**
     * Contains logic needed to display privacy banner.
     *
     * @class
     * @param {Object} config
     */
    eZ.PrivacyCookieBanner = function (config) {
        this.cookieName = config.cookieName || 'EzPrivacyCookieStatus';
        this.bannerElement = document.getElementById(config.bannerId || 'privacy-cookie-banner');
        this.acceptElement = document.getElementById(config.acceptId || 'privacy-cookie-banner__privacy-accept');
        this.closeElement = document.getElementById(config.closeId || 'privacy-cookie-banner__privacy-close');
        this.days = config.days || 365;
    };

    /**
     * Hide privacy banner.
     */
    eZ.PrivacyCookieBanner.prototype.hideBanner = function () {
        this.bannerElement.className = this.bannerElement.className.replace(/\b privacy-cookie-banner--slide-up\b/, '');
        this.bannerElement.className = this.bannerElement.className + ' privacy-cookie-banner--slide-down';
    };

    /**
     * Show privacy banner.
     */
    eZ.PrivacyCookieBanner.prototype.showBanner = function () {
        this.bannerElement.className = this.bannerElement.className.replace(/\b privacy-cookie-banner--slide-down\b/, '');
        this.bannerElement.className = this.bannerElement.className + ' privacy-cookie-banner--slide-up';
    };

    /**
     * Get cookie value by name.
     *
     * @param {string} name
     * @returns {string}
     */
    eZ.PrivacyCookieBanner.prototype.getCookie = function (name) {
        var cookieName = name + '=';
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) === ' ')
                c = c.substring(1);
            if (c.indexOf(cookieName) === 0)
                return c.substring(cookieName.length, c.length);
        }
        return '';
    };

    /**
     * Set cookie value.
     *
     * @param {string} name
     * @param {string} value
     * @param {int} days
     */
    eZ.PrivacyCookieBanner.prototype.setCookie = function (name, value, days) {
        var d = new Date();
        d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = 'expires=' + d.toUTCString();
        document.cookie = name + '=' + value + '; ' + expires;
    };

    /**
     * Accept privacy policy (set cookie status) and hide banner.
     */
    eZ.PrivacyCookieBanner.prototype.accept = function () {
        this.setCookie(this.cookieName, '1', this.days);
        this.hideBanner();
    };

    /**
     * Display privacy banner depending on cookie status.
     */
    eZ.PrivacyCookieBanner.prototype.show = function () {
        if (this.getCookie(this.cookieName) !== '1') {
            this.acceptElement.addEventListener('click', function () {
                this.accept();
            }.bind(this), false);
            this.closeElement.addEventListener('click', function () {
                this.hideBanner();
            }.bind(this), false);
            this.showBanner();
        }
    };

})(window, document);
