<?php

/**
 * Generates a multi-level dynamic drop-down menu.
 */

if (! isset ($data['menu'])) {
	return;
}

$out = $cache->get ('menubuilder_dropmenu_' . $data['menu']);
if (! $out) {
	$menu = MenuBuilder::get_menu ($data['menu']);

	if (! $menu) {
		return;
	}

	$data['id'] = isset ($data['id']) ? $data['id'] : 'dropmenu';

	$out = MenuPrinter::dropmenu ($menu['menu'], $data['id']);
	$cache->set ('menubuilder_dropmenu_' . $data['menu'], $out);
}

$page->add_style ('/apps/menubuilder/css/dropmenu.css');
$page->add_script ('/apps/menubuilder/js/dropmenu.js');

echo $out;

?>