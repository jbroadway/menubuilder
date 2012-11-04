<?php

$this->require_admin ();

$page->layout = 'admin';
$page->title = __ ('Add Menu');

$form = new Form ('post', $this);

$form->data = array (
	'body' => $tpl->render ('menubuilder/sample')
);

echo $form->handle (function ($form) {
	if (! MenuBuilder::write ($_POST['name'], $_POST['body'])) {
		return false;
	}
	$form->controller->add_notification (__ ('Menu saved.'));
	$form->controller->redirect ('/menubuilder/index');
});

?>