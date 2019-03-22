<!DOCTYPE html>
<html class="no-js" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" xmlns:og="http://opengraphprotocol.org/schema/">

<head>
  <!-- add google webfonts here -->
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>

<body class="<?php print $classes; ?>" <?php print $attributes;?>>
        <!--[if lt IE 10]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
        <![endif]-->

<div id="site-wrapper">

  <div id="skip-link">
    <a href="#content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>

	<div id="header-wrapper" class="section-wrapper">
		<header id="header" class="section clearfix container" role="banner">
			<div id="header-inner" class="section-inner">
                
	<?php if ($logo): ?>
      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
      </a>
    <?php endif; ?>
    <?php if ($site_name || $site_slogan): ?>
      <div id="site-name-slogan">
        <?php if ($site_name): ?>
          <?php if ($title): ?>
            <div id="site-name">
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
            </div>
          <?php else: /* Use h1 when the content title is empty */ ?>
            <h1 id="site-name">
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
            </h1>
          <?php endif; ?>
        <?php endif; ?>
        <?php if ($site_slogan): ?>
          <div id="site-slogan"><?php print $site_slogan; ?></div>
        <?php endif; ?>
      </div>
    <?php endif; ?>
    <?php print render($page['header']); ?>

			</div>
		</header>
	</div>

	<div id="main-wrapper" class="section-wrapper">
		<div id="main" class="section clearfix container">
			<div id="main-inner" class="section-inner row">


    <div id="primary" class="clearfix">

        <section id="content" class="site-content" role="main">
    <?php print $messages; ?>
    <a id="main-content"></a>
    <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
    <?php print $content; ?>
  </section> <!-- /#main -->
    </div>

			</div>
		</div>
	</div>
  
</div> <!-- /#site-wrapper -->

</body>
</html>
