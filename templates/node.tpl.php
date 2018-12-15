<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php /* if ($user_picture || $display_submitted || !$page): */ ?>
    <?php if (!$page): ?>
      <header>
	<?php endif; ?>

      <?php print $user_picture; ?>
  
      <?php print render($title_prefix); ?>
      <?php if (!$page): ?>
        <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
  
      <?php if ($display_submitted): ?>
        <p class="submitted"><?php print $submitted; ?></p>
      <?php endif; ?>

    <?php if (!$page): ?>
      </header>
	<?php endif; ?>
  <?php /* endif; */ ?>

  <div class="content"<?php print $content_attributes; ?>>
    <?php
      // Hide comments, tags, and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      hide($content['field_tags']);
      print render($content);
    ?>
  </div>

  <?php if ($page): ?>
	  <div class="share-links">
		<h3><?php print(t('Share this page').':'); ?></h3>
        <ul class="btn-share btn-social">
          <li class="btn-facebook first"><a href="<?php print $facebook_share_url; ?>">Facebook</a></li>
          <li class="btn-twitter"><a href="<?php print $twitter_share_url; ?>">Twitter</a></li>
          <li class="btn-email last"><a href="<?php print $email_share_url; ?>">Email</a></li>
        </ul>
	  </div>
  <?php endif; ?>

  <?php if (!empty($content['links'])): ?>
    <footer>
      <?php print render($content['field_tags']); ?>
      <?php print render($content['links']); ?>
    </footer>
  <?php endif; ?>

  <?php print render($content['comments']); ?>

</article> <!-- /.node -->
