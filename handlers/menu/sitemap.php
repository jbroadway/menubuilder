<?php

/**
 * Generates a complete site map of a menu.
 */

if (! isset ($data['menu'])) {
	return;
}

$menu = MenuBuilder::get_menu ($data['menu']);

if (! $menu) {
	return;
}

echo MenuPrinter::sitemap ($menu['menu']);

$this->cache = true;

?>