JMB Donation Description
============

Using the JMB Donation content plugin you can enable bloggers and content writers on your website to raise funds via PayPal or Yandex.Money. The plugin allows you to specify an account to receive funds and set the default price for each author. JMB Donation can enrich personal blogs or portals who have multiple writers, enabling each content author to specify their own merchant ID to which they can receive the donations.

The module requires Mootools.

- Version: 1.0.3
- Compatibility: Joomla 3.9.*

**Русская версия:**
JMB Donation - плагин JMB Donation позволяет собирать пожертвования через различные платежные системы (Яндекс деньги, PayPal).


Documentation
=============

## 1. Getting Started

Using the JMB Donation content plugin you can enable bloggers and content writers on your website to raise funds via PayPal or Yandex.Money. It can enrich personal blogs or portals who have multiple writers, enabling each content author to specify their own merchant ID to which they can receive the donations.

## 2. Installation

JMB Donation can be installed as a typical extension for Joomla! CMS via standard process of installation. Download the latest version, proceed to your website _Control Panel > Extensions > Extension manager > Install extension_.

## 3. Configuration

After installation "**Content - JMB Donation**" plugin will appear in the Plugin Manager. The plugin has the following parameters:

### Plugin tab
![jmb-donation-settings1](https://user-images.githubusercontent.com/3432048/163677422-5c1354a2-5ca4-4399-ad4f-d50cce53f3e8.png)

JMB Donation - plugin tab

This tab contains the default paramters of the plugin. These can be overriden in the syntax.

* **Provider** - payment service provider. Currently supported: Paypal and Yandex.Money
* **Merchant** - the merchant data like email, merchant ID or wallet number
* **Default Amount** - the default amount that will be displayed in input field.
* **Minimal Amount** - the minimal amount allowed in slider.
* **Maximal Amount** - the maximal amount allowed in slider.
* **Step** - the amount that will be used for steps in slider. Total amount will be changed on this value when a user uses a slider.
* **Donation Currency** - the currency usage depends on the abilities of payment provider
* **Donation Text** - this text will be displayed befor the donation form

### Advanced tab

This tabs contains the parameters of the visual styling.

* **Image** - the image that will be displayed in the donation form. If you select a picture then the smile will not be displayed
* **Logo** - show or hide the logo of the payment service provider
* **Effects** - show or hide the effects: a slider and/or a smile
* **Smile** - show or hide the smile
* **Width of Smile** - the width of the smile
* **Height of Smile** - the height of the smile
* **Colour of Smile** - the colour of the smile
* **Backlink** - show or hide the backlink to extension website

## 4. Syntax

You can use two syntax options:

**{jmb_donation}**
All parameters will be used from the plugin settings.

**{jmb_donation provider|merchant|amount|currency}**

For example: <code>{jmb_donation paypal|support@norrnext.com|10|USD}</code>

You should always keep this order of parameters.

![jmb-donation-settings2](https://user-images.githubusercontent.com/3432048/163677428-750ee379-e632-440f-a6ca-0623717ad2c9.png)
Set custom parameters in a case if you need to override default settings

<p class="uk-alert">
    Please note that the '**currency**' parameter is optional and depends on the abilities of payment provider.
</p>

You can specify not only email, but also merchant ID or wallet number.

For example for 'Yandex.Money': <code>{jmb_donation yandex|41001599904355|15}</code>

