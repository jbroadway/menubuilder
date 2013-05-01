<?php

$this->require_admin ();

if (! isset ($_GET['menu'])) {
	$this->redirect ('/menubuilder/index');
}

if (! MenuBuilder::verify_menu ($_GET['menu'])) {
	$this->redirect ('/menubuilder/index');
}

$page->layout = 'admin';
$page->title = __ ('Edit Menu') . ': ' . ucfirst ($_GET['menu']);

$form = new Form ('post', $this);

$form->data = array (
	'body' => MenuBuilder::get_raw_menu ($_GET['menu'])
);

echo $form->handle (function ($form) use ($cache) {
	if (! MenuBuilder::write ($_GET['menu'], $_POST['body'])) {
		return false;
	}
	$cache->delete ('menubuilder_sitemap_' . $_GET['menu']);
	$cache->delete ('menubuilder_dropmenu_' . $_GET['menu']);
	$form->controller->add_notification (__ ('Menu saved.'));
	$form->controller->redirect ('/menubuilder/index');
});

?>