<?php

/**
 * @file
 * uwf theme-settings.php
 */
function uwf_form_system_theme_settings_alter(&$form, $form_state) {

  $form['uwf_navigation'] = array(
	'#type' => 'fieldset',
	'#title' => t('Navigation'),
	'#collapsible' => TRUE,
  );
  $form['uwf_navigation']['uwf_navigation_title'] = array
  (
	'#type' => 'textfield',
	'#title' => t('Navigation Title'),
	'#description' => t('Title to display for navigation (generally only shown on mobile)'),
	'#default_value' => theme_get_setting('uwf_navigation_title'),
  );
  $form['uwf_navigation']['uwf_navigation_icon'] = array
  (
	'#type' => 'textfield',
	'#title' => t('Navigation Icon'),
	'#description' => t('HTML for an icon to add to navigation title (generally only shown on mobile). If left blank, will display a default hamburger icon. Use <none> to remove icon.'),
	'#default_value' => theme_get_setting('uwf_navigation_icon'),
  );
  $form['uwf_navigation']['uwf_navigation_mobile_break_point'] = array
  (
	'#type' => 'textfield',
	'#title' => t('Mobile Navigation Break Point'),
	'#description' => t('Window width below which navigation menu will be displayed mobile-style'),
	'#default_value' => theme_get_setting('uwf_navigation_mobile_break_point'),
  );
  $form['uwf_navigation']['uwf_navigation_mobile_menu_direction'] = array
  (
	'#type' => 'radios',
	'#options' => array(
		'left' => 'Left',
		'right' => 'Right',
	),
	'#title' => t('Mobile Navigation Menu Direction'),
	'#description' => t('Side the mobile menu will slide in from'),
	'#default_value' => theme_get_setting('uwf_navigation_mobile_menu_direction'),
  );

  $form['uwf_section_navigation'] = array
  (
	'#type' => 'fieldset',
	'#title' => t('In-page section navigation'),
	'#collapsible' => true,
	'#collapsed' => (theme_get_setting('uwf_section_navigation_selector') != '.section-navigation') || (theme_get_setting('uwf_section_navigation_padding') != 20),
  );
  $form['uwf_section_navigation']['uwf_section_navigation_selector'] = array
  (
	'#type' => 'textfield',
	'#title' => t('Section Navigation Selector'),
	'#description' => t('jQuery selector to trigger in-page section navigation'),
	'#default_value' => theme_get_setting('uwf_section_navigation_selector'),
  );
  $form['uwf_section_navigation']['uwf_section_navigation_padding'] = array
  (
	'#type' => 'textfield',
	'#title' => t('Section Navigation Padding'),
	'#description' => t('Number of pixels to leave at the top of the page when scrolling to another section of the page (increase if you are using a fixed header)'),
	'#default_value' => theme_get_setting('uwf_section_navigation_padding'),
  );

  $form['uwf_external'] = array
  (
	'#type' => 'fieldset',
	'#title' => t('External link handling'),
	'#collapsible' => true,
	'#collapsed' => !theme_get_setting('uwf_external_links_exceptions'),
  );
  $form['uwf_external']['uwf_external_links'] = array(
	'#type' => 'radios',
	'#title' => t('Open any links that go offsite in a new window'),
	'#default_value' => theme_get_setting('uwf_external_links'),
	'#options' => array(
		1 => 'Yes',
		0 => 'No',
	),
  );
  $form['uwf_external']['uwf_external_links_exceptions'] = array(
	'#type' => 'textfield',
	'#title' => t('Exceptions'),
    '#description' => t('jQuery selector for external links that should <strong>not</strong> be opened in a new window'),
	'#default_value' => theme_get_setting('uwf_external_links_exceptions'),
  );

  $form['uwf_style'] = array
  (
	'#type' => 'fieldset',
	'#title' => t('Style settings (css and fonts)'),
	'#collapsible' => true,
	'#collapsed' => !(theme_get_setting('uwf_google_webfonts') || theme_get_setting('uwf_custom_css')),
  );
  $form['uwf_style']['uwf_google_webfonts'] = array
  (
	'#type' => 'textfield',
	'#title' => t('Google webfonts'),
	'#description' => t('Will be appended to //fonts.googleapis.com/css?family='),
	'#default_value' => theme_get_setting('uwf_google_webfonts'),
  );
  $form['uwf_style']['uwf_custom_css'] = array
  (
    '#type' => 'textarea',
    '#title' => t('Custom CSS'),
    '#description' => t('CSS to be added inside &lt;style&gt; tags in &lt;head&gt; element, after all other styles'),
    '#default_value' => theme_get_setting('uwf_custom_css'),
    '#cols' => 60,
    '#rows' => 7,
  );
    
  $form['uwf_positioning'] = array
  (
	'#type' => 'fieldset',
	'#title' => 'Positioning',
	'#collapsible' => true,
	'#collapsed' => true,
  );
  $form['uwf_positioning']['uwf_fix_footer'] = array(
	'#type' => 'radios',
	'#title' => t('Fix footer to bottom of the window if page content is shorter than window height?'),
	'#default_value' => theme_get_setting('uwf_fix_footer'),
	'#options' => array(
		1 => 'Yes',
		0 => 'No',
	),
  );
  $form['uwf_positioning']['uwf_fix_secondary'] = array(
	'#type' => 'radios',
	'#title' => t('Fix first sidebar?'),
    '#description' => t('Sidebar will be "fixed" so that it will not scroll off the page entirely (but will scroll if its height is greater than the window height).'),
	'#default_value' => theme_get_setting('uwf_fix_secondary'),
	'#options' => array(
		1 => 'Yes',
		0 => 'No',
	),
  );
  $form['uwf_positioning']['uwf_fix_secondary_top'] = array(
	'#type' => 'textfield',
	'#title' => t('Maximum amount at the top'),
    '#description' => t('Increase this to leave space for a fixed header/navigation.'),
	'#default_value' => theme_get_setting('uwf_fix_secondary_top'),
  );
  $form['uwf_positioning']['uwf_fix_secondary_max'] = array(
	'#type' => 'textfield',
	'#title' => t('Maximum amount at the bottom'),
    '#description' => t('Increase this to leave space for a footer.'),
	'#default_value' => theme_get_setting('uwf_fix_secondary_max'),
  );
  $form['uwf_positioning']['uwf_fix_secondary_break_point'] = array(
	'#type' => 'textfield',
	'#title' => t('Break point for implementation'),
    '#description' => t('Only implemented when window width is greater than this number.'),
	'#default_value' => theme_get_setting('uwf_fix_secondary_break_point'),
  );

  $form['uwf_js'] = array
  (
	'#type' => 'fieldset',
	'#title' => 'Javascript',
	'#collapsible' => true,
	'#collapsed' => !theme_get_setting('uwf_custom_js'),
  );
  $form['uwf_js']['uwf_validate_forms'] = array(
	'#type' => 'radios',
	'#title' => t('Validate all forms using jquery validate?'),
	'#default_value' => theme_get_setting('uwf_validate_forms'),
	'#options' => array(
		1 => 'Yes',
		0 => 'No',
	),
  );
  $form['uwf_js']['uwf_shorten_links'] = array(
	'#type' => 'radios',
	'#title' => t('Shorten any links that don\'t fit in their parent container?'),
	'#default_value' => theme_get_setting('uwf_shorten_links'),
	'#options' => array(
		1 => 'Yes',
		0 => 'No',
	),
  );
  $form['uwf_js']['uwf_shorten_links_selector'] = array(
	'#type' => 'textfield',
	'#title' => t('jQuery selector used to find links'),
	'#default_value' => theme_get_setting('uwf_shorten_links_selector'),
  );
  $form['uwf_js']['uwf_custom_js'] = array
  (
    '#type' => 'textarea',
    '#title' => t('Custom Javascript'),
    '#description' => t('Javascript to be added inside &lt;script&gt; tags in &lt;head&gt; element, after all other scripts'),
    '#default_value' => theme_get_setting('uwf_custom_js'),
    '#cols' => 60,
    '#rows' => 7,
  );
    
    $form['uwf_otp'] = array(
        '#type' => 'fieldset',
        '#title' => t('On This Page navigation'),
        '#collapsible' => true,
        '#collapsed' => !theme_get_setting('uwf_on_this_page'),
    );
    $form['uwf_otp']['uwf_on_this_page'] = array(
        '#type' => 'radios',
        '#title' => t('Enable On This Page navigation?'),
        '#options' => array(
            1 => 'Yes',
            0 => 'No',
        ),
        '#description' => t('If enabled, a javascript function will search the main page content for headers and create a menu that allows the user to jump to the various sections.'),
        '#default_value' => theme_get_setting('uwf_on_this_page'),
    );
    $form['uwf_otp']['uwf_on_this_page_heading'] = array(
        '#type' => 'textfield',
        '#title' => t('jQuery selector for headers'),
        '#default_value' => theme_get_setting('uwf_on_this_page_heading'),
    );
    $form['uwf_otp']['uwf_on_this_page_nav'] = array(
        '#type' => 'textfield',
        '#title' => t('jQuery selector for element(s) in which to place the menu'),
        '#default_value' => theme_get_setting('uwf_on_this_page_nav'),
    );
    $form['uwf_otp']['uwf_on_this_page_minimum_sections'] = array(
        '#type' => 'textfield',
        '#title' => t('Minimum number of sections that must be on the page to generate a menu'),
        '#default_value' => theme_get_setting('uwf_on_this_page_minimum_sections'),
    );
    $form['uwf_otp']['uwf_on_this_page_content'] = array(
        '#type' => 'textfield',
        '#title' => t('jQuery selector for element containing the main page content to index'),
        '#default_value' => theme_get_setting('uwf_on_this_page_content'),
    );


  $form['uwf_twitter'] = array
  (
	'#type' => 'fieldset',
	'#title' => 'Twitter',
	'#collapsible' => true,
	'#collapsed' => !(theme_get_setting('uwf_twitter_handle') || theme_get_setting('uwf_twitter_hashtag') || theme_get_setting('uwf_twitter_field')),
  );
  $form['uwf_twitter']['uwf_twitter_handle'] = array
  (
    '#type' => 'textfield',
    '#title' => t('Twitter handle for sharing links'),
    '#description' => t('If you enter a Twitter handle here, it will be appended to "share this on Twitter" tweets'),
	'#default_value' => theme_get_setting('uwf_twitter_handle'),
  );
  $form['uwf_twitter']['uwf_twitter_hashtag'] = array
  (
    '#type' => 'textfield',
    '#title' => t('Twitter hashtag for sharing links'),
    '#description' => t('If you enter a Twitter hashtag here, it will be appended to "share this on Twitter" tweets'),
	'#default_value' => theme_get_setting('uwf_twitter_hashtag'),
  );
  $form['uwf_twitter']['uwf_twitter_field'] = array
  (
    '#type' => 'textfield',
    '#title' => t('Field to use for tweet'),
    '#description' => t('By default, the title of the node will be used for the suggested tweet. Enter the machine name of a custom field to allow that field to override the title (title will still be used if this field is blank, or if the node type doesn\'t have the field).  This <strong>will</strong> hide the field in the node display, unless you override that behavior in node.tpl.php.'),
	'#default_value' => theme_get_setting('uwf_twitter_field'),
  );


  $form['uwf_blocks'] = array
  (
	'#type' => 'fieldset',
	'#title' => 'Advanced block and region settings',
	'#collapsible' => true,
	'#collapsed' => !(theme_get_setting('uwf_block_classes') || theme_get_setting('uwf_block_icons')),
  );
  $form['uwf_blocks']['uwf_block_icons'] = array
  (
    '#type' => 'textarea',
    '#title' => t('Block Title Icons'),
    '#description' => t('To add an icon to the title of a block, use this format: block_id|icon. One block per line.  icon can be either a class declaration, in which case an &lt;i&gt; element with the class will be prepended to the title, or any arbitrary html (such as an &lt;img&gt; tag).'),
    '#default_value' => theme_get_setting('uwf_block_icons'),
    '#cols' => 60,
    '#rows' => 7,
  );
  $form['uwf_blocks']['uwf_footer_block_classes'] = array
  (
    '#type' => 'textfield',
    '#title' => t('Class(es) added to blocks in the footer region'),
    '#description' => t('Will default to col-xs-12; must include at least one bootstrap column class in order to ensure proper padding.'),
    '#default_value' => theme_get_setting('uwf_footer_block_classes'),
  );
  $form['uwf_blocks']['uwf_region_classes_content'] = array
  (
    '#type' => 'textfield',
    '#title' => t('Classes for the content region'),
    '#description' => t('Use pipes to separate four cases: both sidebars present|only first sidebar present|only second sidebar present|no sidebars present'),
    '#default_value' => theme_get_setting('uwf_region_classes_content'),
  );
  $form['uwf_blocks']['uwf_region_classes_sidebar_first'] = array
  (
    '#type' => 'textfield',
    '#title' => t('Classes for the first sidebar region'),
    '#description' => t('Use pipes to separate two cases: both sidebars present|only this sidebar present'),
    '#default_value' => theme_get_setting('uwf_region_classes_sidebar_first'),
  );
  $form['uwf_blocks']['uwf_region_classes_sidebar_second'] = array
  (
    '#type' => 'textfield',
    '#title' => t('Classes for the second sidebar region'),
    '#description' => t('Use pipes to separate two cases: both sidebars present|only this sidebar present'),
    '#default_value' => theme_get_setting('uwf_region_classes_sidebar_second'),
  );
    
    $form['uwf_submitted_text'] = array(
        '#type' => 'textfield',
        '#title' => t('Text to format $submitted variable'),
        '#default_value' => theme_get_setting('uwf_submitted_text'),
    );

  $form['uwf_google_site_verification'] = array
  (
    '#type' => 'textfield',
    '#title' => t('Google site verification code'),
	'#default_value' => theme_get_setting('uwf_google_site_verification'),
  );

  return $form;
}
