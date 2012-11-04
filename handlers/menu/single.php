<?php

/**
 * Generates a single-level menu.
 */

if (! isset ($data['menu'])) {
	return;
}

$menu = MenuBuilder::get_menu ($data['menu']);

if (! $menu) {
	return;
}

info ($menu);

?>