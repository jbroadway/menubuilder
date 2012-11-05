<?php

/**
 * Displays a breadcrumb menu using a bulleted list that you can
 * apply CSS to with the `breadcrumb` class, for example:
 *
 *     .breadcrumb {
 *         list-style-type: none;
 *         margin: 0;
 *         padding: 0;
 *     }
 *
 *     .breadcrumb li {
 *         list-style-type: none;
 *         margin: 0;
 *         padding: 0;
 *         display: inline;
 *     }
 *
 *     .breadcrumb li:before {
 *         content: " / ";
 *     }
 *
 *     .breadcrumb li:first-child:before {
 *         content: "";
 *     }
 */

$home = array (
	'label' => __ ('Home'),
	'page' => 'index'
);

$path = MenuBuilder::find_path ($data['menu'], $page->id);

if (! isset ($path[0]['page']) || $path[0]['page'] === 'index') {
	array_unshift ($path, $home);
}

echo $tpl->render (
	'menubuilder/menu/breadcrumb',
	array (
		'path' => $path
	)
);

?>