<?php
// $Id: template.php,v 1.4.2.6 2011/02/18 05:26:30 andregriffin Exp $

/**
 * Implements hook_preprocess_html().
 * Adding extra meta tags to the head for iPhone, Google domain verification
 */
function uwf_preprocess_html(&$variables) {
  $meta_xuacompatible = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'http-equiv' => 'X-UA-Compatible',
      'content' => 'IE=edge,chrome=1'
    )
  );
  drupal_add_html_head($meta_xuacompatible, 'meta_xuacompatible');
  $meta_viewport = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'viewport',
      'content' => 'width=device-width, maximum-scale=1.0'
    )
  );
  drupal_add_html_head($meta_viewport, 'meta_viewport');

  $settings = array(
    'pathToTheme' => drupal_get_path('theme', variable_get('theme_default', NULL)),
    'themeOptions' => array(
      'validateForms' => theme_get_setting('uwf_validate_forms') ? true : false,
      'fixFooter' => theme_get_setting('uwf_fix_footer') ? true : false,
      'fixSecondary' => theme_get_setting('uwf_fix_secondary') ? true : false,
      'fixSecondaryTop' => intval(theme_get_setting('uwf_fix_secondary_top')),
      'fixSecondaryMax' => intval(theme_get_setting('uwf_fix_secondary_max')),
      'fixSecondaryBreakPoint' => intval(theme_get_setting('uwf_fix_secondary_break_point')),
      'shortenLinks' => theme_get_setting('uwf_shorten_links') ? true : false,
      'shortenLinksSelector' => theme_get_setting('uwf_shorten_links_selector'),
      'externalLinks' => theme_get_setting('uwf_external_links') ? true : false,
      'externalLinksExceptions' => theme_get_setting('uwf_external_links_exceptions'),
      'sectionNavigationSelector' => theme_get_setting('uwf_section_navigation_selector'),
      'sectionNavigationPadding' => theme_get_setting('uwf_section_navigation_padding'),
      'mobileBreakPoint' => theme_get_setting('uwf_navigation_mobile_break_point'),
      'mobileMenuDirection' => theme_get_setting('uwf_navigation_mobile_menu_direction'),
      'onThisPageHeading' => theme_get_setting('uwf_on_this_page') ? theme_get_setting('uwf_on_this_page_heading') : '',
      'onThisPageNav' => theme_get_setting('uwf_on_this_page') ? theme_get_setting('uwf_on_this_page_nav') : '',
      'onThisPageMinimumSections' => theme_get_setting('uwf_on_this_page') ? intval(theme_get_setting('uwf_on_this_page_minimum_sections')) : 2,
      'onThisPageContent' => theme_get_setting('uwf_on_this_page') ? theme_get_setting('uwf_on_this_page_content') : '',
    ),
    'themeTranslations' => array(
      'dismissMenu' => t('Dismiss menu'),
      'openSubmenu' => t('Open submenu'),
      'closeSubmenu' => t('Close submenu'),
      'dismissMessage' => t('Dismiss message'),
	  'dismissModal' => t('Dismiss modal'),
      'opensNewWindow' => t('Opens in a new window'),
      'backToTop' => t('Back to top'),
      'link' => '('.t('link').')',
    ),
  );
  drupal_add_js('jQuery.extend(Drupal.settings,'.json_encode((object) $settings).'); uwfOptions=Drupal.settings.themeOptions; uwfText=Drupal.settings.themeTranslations', 'inline');

  $q = isset($_GET['q']) ? $_GET['q'] : 'front';
  $page_id = str_replace('/','-',$q);
  $page_id = strtolower($page_id);
  $page_id = preg_replace('/[^-_a-z0-9]/','',$page_id);
  $variables['page_id'] = 'page-'.$page_id;

  $googlefonts = theme_get_setting('uwf_google_webfonts');
  if ($googlefonts) {
    drupal_add_css('https://fonts.googleapis.com/css?family='.$googlefonts,array(
		'type' => 'external',
		'group' => CSS_SYSTEM,
		'every_page' => TRUE,
		'weight' => -100,
	));
  }

  // load fontawesome
  if (theme_get_setting('uwf_load_fontawesome')) {
    drupal_add_js('https://use.fontawesome.com/1a216137ba.js',array(
	  'type' => 'external',
	  'group' => JS_LIBRARY,
	  'every_page' => TRUE,
	  'weight' => -999,
	  'requires_jquery' => FALSE,
	));
  }

  if ($google_site_verification = theme_get_setting('uwf_google_site_verification')) {
    $meta_google_site_verification = array(
      '#type' => 'html_tag',
      '#tag' => 'meta',
      '#attributes' => array(
        'name' => 'google-site-verification',
        'content' => $google_site_verification,
      )
    );
    drupal_add_html_head($meta_google_site_verification, 'meta_google_site_verification');
  }

}

/**
 * Implements hook_html_head_alter().
 * We are overwriting the default meta character type tag with HTML5 version.
 */
function uwf_html_head_alter(&$head_elements) {
  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8'
  );
}

/**
 * Implements hook_process_html()
 */
function uwf_process_html(&$variables) {
 
  if (theme_get_setting('uwf_custom_css')) {
    $variables['styles'] .= '<script type="text/javascript"></script>'; /* Needed to avoid Flash of Unstyle Content in IE */
    $variables['styles'] .= '<style type="text/css">
      ' . theme_get_setting('uwf_custom_css') . '
    </style>';
  }
  if (theme_get_setting('uwf_custom_js')) {
    $variables['scripts'] .= '<script type="text/javascript">
      ' . theme_get_setting('uwf_custom_js') . '
    </script>';
  }
}

/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
function uwf_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];

  if (!empty($breadcrumb)) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
    // Uncomment to add current page to breadcrumb
	// $breadcrumb[] = drupal_get_title();
    $output .= '<nav class="breadcrumb">' . implode(' » ', $breadcrumb) . '</nav>';
    return $output;
  }
}

/**
 * Override or insert variables into the page template.
 */
function uwf_preprocess_page(&$variables) {

	$variables['ajax'] = isset($_GET['ajax']) ? $_GET['ajax'] : 0;
	$variables['navigation_class'] = 'nav-'.theme_get_setting('uwf_navigation_style');

	// page.tpl.php suggestions by node type
	if (!empty($variables['node']) && !empty($variables['node']->type)) {
		$variables['theme_hook_suggestions'][] = 'page__node__' . $variables['node']->type;
	}

	// columns
    $urcc = theme_get_setting('uwf_region_classes_content');
    $urcsf = theme_get_setting('uwf_region_classes_sidebar_first');
    $urcss = theme_get_setting('uwf_region_classes_sidebar_second');
	$content_classes = explode('|', $urcc ? $urcc : 'col-xs-12');
	$sidebar_first_classes = explode('|', $urcsf ? $urcsf : 'col-xs-12');
	$sidebar_second_classes = explode('|', $urcss ? $urcss : 'col-xs-12');
	while (count($content_classes) < 4) {
		$content_classes[] = $content_classes[count($content_classes) - 1];
	}
	while (count($sidebar_first_classes) < 2) {
		$sidebar_first_classes[] = $sidebar_first_classes[count($sidebar_first_classes) - 1];
	}
	while (count($sidebar_second_classes) < 2) {
		$sidebar_second_classes[] = $sidebar_second_classes[count($sidebar_second_classes) - 1];
	}
	
	$page = $variables['page'];
	
	if ($page['sidebar_first'] && $page['sidebar_second']) {
		$variables['content_classes'] = $content_classes[0];
		$variables['sidebar_first_classes'] = $sidebar_first_classes[0];
		$variables['sidebar_second_classes'] = $sidebar_second_classes[0];
	} elseif ($page['sidebar_first']) {
		$variables['content_classes'] = $content_classes[1];
		$variables['sidebar_first_classes'] = $sidebar_first_classes[1];
	} elseif ($page['sidebar_second']) {
		$variables['content_classes'] = $content_classes[2];
		$variables['sidebar_second_classes'] = $sidebar_second_classes[1];
	} else {
		$variables['content_classes'] = $content_classes[3];
	}

	// menu

/*
	// for multi-lingual menus, replace the two lines in the first else statement with these 3 lines:
	
    $variables['main_menu'] = drupal_render($tree);
*/

  if (isset($variables['main_menu']) && $variables['main_menu']) {
	$src = variable_get('menu_main_links_source', 'main-menu');
	$menu_tree = function_exists('i18n_menu_translated_tree') ? i18n_menu_translated_tree($src) : menu_tree($src);
    $main_menu = drupal_render($menu_tree);
	$menutitle = theme_get_setting('uwf_navigation_title');
    $menutitle = $menutitle ? t($menutitle) : t('Navigation');
    $menutitle = '<span>' . $menutitle . '</span>';
	$menuicon = theme_get_setting('uwf_navigation_icon');
    $menuicon = $menuicon ? $menuicon : '<svg class="icon navigation-icon" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><rect x="0" y="5" width="100" height="20"/><rect x="0" y="40" width="100" height="20"/><rect x="0" y="75" width="100" height="20"/></svg>';
	if ($menuicon == '<none>') { $menuicon = ''; }
	if ($menuicon) { $menuicon .= ' '; }
    $main_menu = str_replace('expanded','has-children',$main_menu);
    $variables['main_menu'] = "<h2 class=\"navigation-header\">".$menuicon.$menutitle."</h2><div class=\"main-menu\">".$main_menu."</div>";
  } else {
    $variables['main_menu'] = FALSE;
  }

  if (isset($variables['secondary_menu'])) {
    $variables['secondary_menu'] = theme('links__system_secondary_menu', array(
          'links' => $variables['secondary_menu'],
          'attributes' => array(
            'id' => 'utility-menu-links',
            'class' => array('links', 'inline', 'clearfix'),
          ),
          'heading' => array(
            'text' => t('Utility menu'),
            'level' => 'h2',
            'class' => array('element-invisible'),
          ),
        ));
  } else {
	$variables['secondary_menu'] = FALSE;
  }

/*
	if (isset($variables['tabs']['#primary'])) {
		foreach($variables['tabs']['#primary'] as $index => $link) {
			if (isset($link['#link']['title']) && ($link['#link']['title'] == 'HybridAuth')) {
				$variables['tabs']['#primary'][$index]['#link']['title'] = 'Social Identities';
			}
		}
		$variables['tabs_debug'] = '<pre style="font-size: 10px; margin: 2em 0;">'.print_r($variables['tabs']['#primary'],1).'</pre>';
	}
*/

}

/**
 * Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
 */
function uwf_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="tabs primary clearfix">';
    $variables['primary']['#suffix'] = '</ul>';
		foreach($variables['primary'] as $index => $link) {
			if (isset($link['#link']['title']) && ($link['#link']['title'] == 'HybridAuth')) {
				$variables['primary'][$index]['#link']['title'] = 'Social Identities';
			}
		}
    $output .= drupal_render($variables['primary']);
  }
  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="tabs secondary clearfix">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }
  return $output;
}

function uwf_preprocess_region(&$variables) {

}

/**
 * Override or insert variables into the node template.
 */
function uwf_preprocess_node(&$variables) {
  $variables['submitted'] = t(theme_get_setting('uwf_submitted_text'), array('!username' => $variables['name'], '!datetime' => $variables['date']));
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }
  if (!$variables['status']) {  }

  // twitter settings for social media sharing
  $variables['twitter_hashtag'] = theme_get_setting('uwf_twitter_hashtag');
  $variables['twitter_handle'] = theme_get_setting('uwf_twitter_handle');
  $tweetField = theme_get_setting('uwf_twitter_field');
  if ($tweetField) {
    $field_tweet = field_get_items('node', $variables['node'], $tweetField);
    $value_tweet = $field_tweet ? field_view_value('node', $variables['node'], $tweetField, $field_tweet[0]) : array();
    $tweet = isset($value_tweet['#markup']) ? $value_tweet['#markup'] : '';
  } else {
    $tweet = '';
  }
  $variables['twitter_tweet'] = $tweet ? $tweet : $variables['title'];

  $variables['facebook_share_url'] = uwf_share_url(
      $variables['node_url'],
      $variables['title']
  );
  $variables['twitter_share_url'] = uwf_share_url(
      $variables['node_url'],
      $variables['twitter_tweet'],
      'twitter',
      array(
          'twitter_hashtag' => $variables['twitter_hashtag'],
          'twitter_handle' => $variables['twitter_handle']
      )
  );
  $variables['email_share_url'] = uwf_share_url(
      $node_url,
      $title,
      'email',
      array(
          'email_subject' => t('I think you\'ll enjoy this: ').$title,
          'email_body' => t('I found it here:')
      )
  );
}

/**
 * Override or insert variables into the block template
 */
function uwf_preprocess_block(&$variables) {
	
	// add icon if necessary
	$variables['icon'] = '';
	$block_icons = explode("\n",theme_get_setting('uwf_block_icons'));
	foreach ($block_icons as $icon_line) {
		$icon_line_items = explode('|',$icon_line);
		if ( ($variables['block_html_id'] == $icon_line_items[0]) && isset($icon_line_items[1]) ) {
			$variables['icon'] = check_plain($icon_line_items[1]) == $icon_line_items[1] ? '<i class="'.$icon_line_items[1].'"></i> ' : $icon_line_items[1].' ';
		}
	}
	
	$block_region = $variables['block']->region;
	
	// add wrappers for blocks in highlighted, scrolling regions
	if ( ($block_region == 'highlighted') || ($block_region == 'scrolling') ) {
		$variables['block_wrapper'] = '<div id="'.$variables['block_html_id'].'-wrapper" class="section-wrapper">';
		$variables['block_inner'] = '<div id="'.$variables['block_html_id'].'-inner" class="section-inner">';
		$variables['classes_array'][] = 'section clearfix container';
	}

	// add footer classes from theme settings
	if ($block_region == 'footer') {
        $footer_block_classes = theme_get_setting('uwf_footer_block_classes');
		$variables['classes_array'][] = $footer_block_classes ? $footer_block_classes : 'col-xs-12';
	}
    
    // add modal class
    if ($block_region == 'modals') {
        $variables['classes_array'][] = 'modal';
    }
}


/**
 * The following functions are helper functions available to the theme,
 * but do not do anything on their own
 */


/**
 * Provides urls for Facebook sharing, tweeting and emails
 */
function uwf_share_url($url, $title='', $service='facebook', $options=array()) {
  $site_url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') .$_SERVER['HTTP_HOST'];
  if (strpos($url, $site_url) === false) { $url = $site_url.$url; }
  switch ($service) {

  case 'facebook':
    $fb_share_url = 'http://www.facebook.com/sharer.php?u='.urlencode($url);
    if ($title) { $fb_share_url .= '&amp;t='.urlencode(html_entity_decode($title, ENT_QUOTES)); }
    return $fb_share_url;
	break;

  case 'twitter':
	$twitter_hashtag = isset($options['twitter_hashtag']) ? $options['twitter_hashtag'] : '';
	$twitter_handle = isset($options['twitter_handle']) ? $options['twitter_handle'] : '';
    $tweet_url = 'https://twitter.com/intent/tweet?';
    $tweet_url .= 'url='.urlencode($url);
    $tweet_url .= $title ? '&amp;text='.urlencode(html_entity_decode($title, ENT_QUOTES)) : '';
    $tweet_url .= $twitter_hashtag ? '&amp;hashtags='.urlencode(html_entity_decode($twitter_hashtag, ENT_QUOTES)) : '';
    $tweet_url .= $twitter_handle ? '&amp;via='.urlencode(html_entity_decode($twitter_handle, ENT_QUOTES)) : '';
    return $tweet_url;
	break;

  case 'email':
	$email_subject = isset($options['email_subject']) ? $options['email_subject'] : '';
	$email_body = (isset($options['email_body']) && $options['email_body']) ? $options['email_body']."\n\n" : '';
	$email_url = "mailto:?";
	$email_url .= $email_subject ? 'subject='.str_replace('+','%20',urlencode(html_entity_decode($email_subject, ENT_QUOTES))).'&amp;' : '';
	$email_url .= 'body='.str_replace('+','%20',urlencode(html_entity_decode($email_body.$url, ENT_QUOTES)));
	return $email_url;
	break;

  default:
    return '';
	break;

  }
}



