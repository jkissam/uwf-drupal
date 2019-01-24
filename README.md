# Unwritten Future (Drupal theme)

Drupal base theme based on the [Unwritten Future HTML5 Framework](https://github.com/jkissam/unwritten_future)

Beta version 5

## Roadmap

* Provide blocks for "on this page" navigation containers
* Make sure it works with admin menu
* Write up documentation

## January 24, 2019 - Beta version 5

* Updated with latest version of Unwritten Future Theme (1.2.2), which changes mobile menu behavior and fixes a small bug in implementation of `uwfOptions.fixSecondary`

## January 3, 2019 - Beta version 4

* Fixed email share variable reference in `uwf_preprocess_node` and undefined variable notices in `uwf_preprocess_block`

## December 28, 2018 - Beta version 3

* Incorporates [Unwritten Future version 1.2](https://github.com/jkissam/unwritten_future#version-12)
* Theme options to "fix" the first sidebar so that it will not scroll off the page entirely (but will scroll if its height is greater than the window height). This behavior can be applied to any arbitrary element on the page (other than the first sidebar) using the `uwfUtil.fixOnMaxScroll` javascript function
* Implements theme option to control what element is indexed for "on this page" navigation (defaults to `#block-system-main .field-name-body`)
* Provides `uwfUtil.registerGAevent` javascript function that is a wrapper for Google Analytics' `ga.send` but tests for existence of `ga` object (useful in situations where you are only implementing Google Analytics for anonymous users)
* Updates css for fieldsets and legends to a more flat look
* Also Drupal theme makes entire legend of collapsible fieldsets clickable, and fires `uwfUtil.fixFooter` upon opening or collapsing them to check whether footer should be fixed or un-fixed

## December 15, 2018 - Beta version 2

* Added javascript to template.php to assign `Drupal.settings.themeOptions` to `uwfOptions` and `Drupal.settings.themeTranslations` to `uwfText` so that `uwfUtil` can actually access them
* Removed `&& 0` from node.tpl.php that had been hiding social share links
* Added css to theme social share links
* Fixed bug in Unwritten Future core that triggered link shortening when the link is enclosed within an inline element (rewrote `uwfUtil.shortenLinks` to find the closest non-inline element to compare the width to, instead of just using the immediate parent)

## December 13, 2018 - Original beta version