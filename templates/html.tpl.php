<!DOCTYPE html>
<html class="no-js" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" xmlns:og="http://opengraphprotocol.org/schema/">

<head>
  <!-- add google webfonts here -->
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>

<body id="<?php print $page_id; ?>" class="<?php print $classes; ?>" <?php print $attributes;?>>
        <!--[if lt IE 10]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
        <![endif]-->
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
</body>

</html>
