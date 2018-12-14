<?php if (!$ajax): ?>
<div id="site-wrapper">

  <div id="skip-link">
    <a href="#content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
    <?php if ($main_menu): ?>
      <a href="#navigation" class="element-invisible element-focusable"><?php print t('Skip to navigation'); ?></a>
    <?php endif; ?>
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

  <?php if ($main_menu || $page['navigation']): ?>
	<div id="navigation-wrapper" class="section-wrapper">
		<nav id="navigation" class="site-navigation primary-navigation section clearfix container" role="navigation">
			<div id="navigation-inner" class="section-inner">
                
        <?php if ($main_menu) { print $main_menu; } ?>
	    <?php if ($page['navigation']) { print render($page['navigation']); } ?>
                
			</div>
		</nav>
	</div>
  <?php endif; ?>


<?php if ($page['highlighted']): ?>
	<div id="highlighted-wrapper" class="section-wrapper">
		<section id="highlighted" class="section clearfix container">
			<div id="highlighted-inner" class="section-inner row">
                <?php print render($page['highlighted']) ?>
			</div>
		</section>
	</div>
<?php endif; ?>

	<div id="main-wrapper" class="section-wrapper">
		<div id="main" class="section clearfix container">
			<div id="main-inner" class="section-inner row">


    <div id="primary" class="clearfix <?php echo $content_classes; ?>">
        <?php endif; /* !$ajax */ ?>
        <section id="content" class="site-content" role="main">
                
    <?php print $messages; ?>
    <a id="main-content"></a>
    <?php print render($title_prefix); ?>
    <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
    <?php print render($title_suffix); ?>
    <?php if (!empty($tabs['#primary'])): ?><div class="tabs-wrapper"><?php print render($tabs); ?></div><?php endif; ?>
    <?php print render($page['help']); ?>
    <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
    <?php print render($page['content']); ?>

        </section> <!-- /#main -->
        <?php if (!$ajax): ?>
    </div>

  
  <?php if ($page['sidebar_first']): ?>
    <aside id="secondary" role="complimentary" class="sidebar clearfix <?php echo $sidebar_first_classes; ?>">
      <?php print render($page['sidebar_first']); ?>
    </aside>  <!-- /#sidebar-first -->
  <?php endif; ?>
  
  <?php if ($page['sidebar_second']): ?>
    <aside id="tertiary" role="complimentary" class="sidebar clearfix <?php echo $sidebar_second_classes; ?>">
      <?php print render($page['sidebar_second']); ?>
    </aside>  <!-- /#sidebar-second -->
  <?php endif; ?>

			</div>
		</div>
	</div>

<?php if ($page['scrolling']): ?>
    <section id="scrolling">
      <?php print render($page['scrolling']) ?>
    </section>
<?php endif; ?>

  <?php if ($page['utility'] || $secondary_menu): ?>
	<div id="utility-wrapper" class="section-wrapper">
      <?php if ($secondary_menu): ?>
        <nav id="utility-nav" role="navigation" class="section clearfix container">
			<div id="utility-nav-inner" class="section-inner">
		      <?php echo $secondary_menu; ?>
            </div>
        </nav> <!-- /#utility-nav -->
      <?php endif; ?>
	  <?php if ($page['utility']) : ?>
		<aside id="utility" class="section clearfix container">
			<div id="utility-inner" class="section-inner">
	      <?php print render($page['utility']); ?>
            </div>
		</aside>
	  <?php endif; ?>
    </div> <!-- /#utility -->
  <?php endif; ?>

	<div id="footer-wrapper" class="section-wrapper">
		<footer id="footer" class="section clearfix container">
			<div id="footer-inner" class="section-inner row">
                <?php print render($page['footer']) ?>
			</div>
		</footer>
	</div>

</div>

<?php if ($page['modals']): ?>
  <div id="modals-wrapper">
    <div id="modals" class="modals" role="complementary">
      <?php print render($page['modals']) ?>
    </div> <!-- /#reveal-left -->
  </div>
<?php endif; ?>

<?php endif; /* !$ajax */ ?>
