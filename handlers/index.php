<?php

$this->require_admin ();

$page->title = __ ('Menu Builder');
$page->layout = 'admin';

$folder = trim (MenuBuilder::$path, '/');
if (! file_exists ($folder)) {
	mkdir ($folder);
	chmod ($folder, 0777);
	MenuBuilder::write ('sample', $tpl->render ('menubuilder/sample'));
}

echo $tpl->render (
	'menubuilder/index',
	array (
		'menus' => MenuBuilder::get_menus ()
	)
);

?>