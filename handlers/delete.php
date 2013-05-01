<?php

$this->require_admin ();

if (! MenuBuilder::delete ($_POST['menu'])) {
	$this->add_notification (__ ('Error deleting menu. Check your permissions and try again.'));
} else {
	$cache->delete ('menubuilder_sitemap_' . $_POST['menu']);
	$cache->delete ('menubuilder_dropmenu_' . $_POST['menu']);
	$this->add_notification (__ ('Menu deleted.'));
}

$this->redirect ('/menubuilder/index');

?>