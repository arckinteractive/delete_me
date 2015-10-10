<?php
/**
 * Delete a user
 */

$user = elgg_get_logged_in_user_entity();
$username = $user->username;

// don't allow the only admin user to delete himself.
if ($user->isAdmin()) {
	$admins = elgg_get_admins(array('count' => true));
	if ($admins < 2) {
		register_error(elgg_echo('delete_me:cannot_delete_admin'));
		forward(REFERER);
	}
}

// sometimes this can take a loooong time.
set_time_limit(0);

if ($user->delete()) {
	setcookie("elggperm", "", (time() - (86400 * 30)), "/");
	$_SESSION = array();
	session_regenerate_id();
	
	system_message(elgg_echo('admin:user:delete:yes', array($username)));
	forward('/');
} else {
	register_error(elgg_echo('admin:user:delete:no'));
	forward(REFERRER);
}