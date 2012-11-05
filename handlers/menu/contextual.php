<?php

/**
 * Generates a contextual menu, opening and closing
 * sections based on the currently active page. Shows
 * all parents and children of the current page..
 */

if (! isset ($data['menu'])) {
	return;
}

$menu = MenuBuilder::get_menu ($data['menu']);

if (! $menu) {
	return;
}

$path = MenuBuilder::find_path ($menu['menu'], $page->id);
$path = ($path) ? $path : array ();
echo MenuPrinter::contextual ($menu['menu'], $path);

?>