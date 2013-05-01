<?php

/**
 * Generates a complete site map of a menu.
 */

if (! isset ($data['menu'])) {
	return;
}

$out = $cache->get ('menubuilder_sitemap_' . $data['menu']);
if (! $out) {
	$menu = MenuBuilder::get_menu ($data['menu']);

	if (! $menu) {
		return;
	}

	$out = MenuPrinter::sitemap ($menu['menu']);
	$cache->set ('menubuilder_sitemap_' . $data['menu'], $out);
}

echo $out;

?>