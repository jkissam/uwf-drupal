# Unwritten Future (Drupal theme)

Drupal base theme based on the [Unwritten Future HTML5 Framework](https://github.com/jkissam/unwritten_future)

Beta version 2

## Roadmap

* Provide blocks for "on this page" navigation containers
* Make sure it works with admin menu
* Write up documentation

## December 15, 2018 - Beta version 2

* Added javascript to template.php to assign `Drupal.settings.themeOptions` to `uwfOptions` and `Drupal.settings.themeTranslations` to `uwfText` so that `uwfUtil` can actually access them
* Removed `&& 0` from node.tpl.php that had been hiding social share links
* Added css to theme social share links
* Fixed bug in Unwritten Future core that triggered link shortening when the link is enclosed within an inline element (rewrote `uwfUtil.shortenLinks` to find the closest non-inline element to compare the width to, instead of just using the immediate parent)

## December 13, 2018 - Original beta version