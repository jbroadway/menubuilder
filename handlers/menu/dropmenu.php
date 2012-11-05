<?php

/**
 * Generates a multi-level dynamic drop-down menu.
 */

if (! isset ($data['menu'])) {
	return;
}

$menu = MenuBuilder::get_menu ($data['menu']);

if (! $menu) {
	return;
}

$data['id'] = isset ($data['id']) ? $data['id'] : 'dropmenu';

$page->add_style ('/apps/menubuilder/css/dropmenu.css');
$page->add_script ('/apps/menubuilder/js/dropmenu.js');

echo MenuPrinter::dropmenu ($menu['menu'], $data['id']);

$this->cache = true;

?>