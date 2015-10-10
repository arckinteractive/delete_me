<?php
/**
 * Allow a user to delete his or her own account.
 */

function delete_me_init() {
	$actions_dir = dirname(__FILE__) . '/actions/delete_me';
	elgg_register_action('delete_me/delete', "$actions_dir/delete.php");

	$link = elgg_view('output/url', array(
		'href' => 'action/delete_me/delete',
		'text' => elgg_echo('delete_me'),
		'confirm' => elgg_echo('delete_me:confirm')
	));
	
	$menu_item = ElggMenuItem::factory(array(
		'name' => 'delete_me',
		'text' => $link,
		'href' => false,
		'context' => 'settings'
	));
	elgg_register_menu_item('page', $menu_item);
}

// Default event handlers for plugin functionality
elgg_register_event_handler('init', 'system', 'delete_me_init');