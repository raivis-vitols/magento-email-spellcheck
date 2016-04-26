/**
 * @category    ArchApps
 * @package     ArchApps_EmailSpellCheck
 * @copyright   Copyright 2016 ArchApps (https://archapps.io)
 * @license     https://opensource.org/licenses/osl-3.0.php OSL 3.0
 */

/*global Class, Mailcheck, $$, Template*/

/**
 * ArchApps object in the global scope
 *
 * @type {ArchApps|*|{}}
 */
var ArchApps = window.ArchApps || {};

/**
 * Class to handle email spell check feature
 *
 * @type {*}
 */
ArchApps.EmailSpellCheck = Class.create();
ArchApps.EmailSpellCheck.prototype = {
    /**
     * Initialization function. Apply configs, events, observers
     *
     * @param {Object} config Object of options for the email spell check
     * @return {void}
     */
    initialize: function (config) {
        if (typeof Mailcheck !== 'object') {
            console.log('EmailSpellCheck :: No Mailcheck Plugin, Add Plugin');
            return;
        }

        this.elements = $$(config.selector);

        if (!this.elements.length) {
            console.log('EmailSpellCheck :: No Elements To Run Mailcheck On');
            return;
        }

        this.suggestionText = config.suggestionText;
        this.htmlWrapClass  = config.htmlWrapClass || 'esp-wrap';
        this.htmlEmailClass = config.htmlEmailClass || 'esp-email';
        this.htmlTextClass  = config.htmlTextClass || 'esp-text';

        this.suggestionEmailMarkup = new Template(
            '<a href="#" class="#{emailClass}">#{email}</a>'
        );

        this.suggestionMarkup = new Template(
            '<div class="#{wrapClass}">' +
                '<span class="#{textClass}">#{text}</span>' +
            '</div>'
        );

        /**
         * Extend Mailcheck plugin all default domains as specified in config
         */
        Mailcheck.defaultTopLevelDomains = config.topLevelDomains
            || Mailcheck.defaultTopLevelDomains;

        Mailcheck.defaultSecondLevelDomains = config.secondLevelDomains
            || Mailcheck.defaultSecondLevelDomains;

        Mailcheck.defaultDomains = config.domains || Mailcheck.defaultDomains;

        /**
         * Run email spell check for each selected field on element blur event
         */
        this.elements.each(function (element) {
            if (element.nodeName.toLocaleLowerCase() === 'input') {
                element.observe('blur', function () {
                    this.check(element);
                }.bind(this));
            }
        }.bind(this));
    },

    /**
     * Run mail-check for given element, show or remove the suggestion
     *
     * @param {Object} element DOM element of which email to be checked
     * @return {void}
     */
    check: function (element) {
        Mailcheck.run({
            email: element.value,

            empty: function () {
                this.removeSuggestion(element);
            }.bind(this),

            suggested: function (suggestion) {
                this.removeSuggestion(element);
                this.showSuggestion(element, suggestion);
            }.bind(this)
        });
    },

    /**
     * Display the suggestion after the specified DOM input element
     *
     * @param {Object} after DOM input element after which to add suggestion
     * @param {Object} suggestion Suggestion object containing correct email
     * @return {void}
     */
    showSuggestion: function (after, suggestion) {
        var emailMarkup = this.suggestionEmailMarkup.evaluate({
                emailClass: this.htmlEmailClass,
                email: suggestion.full
            }),

            suggestionMarkup = this.suggestionMarkup.evaluate({
                wrapClass: this.htmlWrapClass,
                textClass: this.htmlTextClass,
                text: this.suggestionText.replace(
                    '%suggestion%', emailMarkup
                )
            });

        after.insert({after: suggestionMarkup});

        var suggestionElement = after.next(),
            emailElement = suggestionElement
                .select('.' + this.htmlEmailClass)[0];

        emailElement.observe('click', function (event) {
            after.value = event.currentTarget.innerHTML;
            this.removeSuggestion(after);
            event.preventDefault();
        }.bind(this));
    },

    /**
     * Remove the suggestion after the specified DOM input element
     *
     * @param {Object} after DOM element of which to remove suggestion
     * @return {void}
     */
    removeSuggestion: function (after) {
        var suggestionElement = after.next('.' + this.htmlWrapClass);

        if (suggestionElement) {
            suggestionElement.remove();
        }
    }
};