<?php

$this->require_admin ();

if (! MenuBuilder::delete ($_POST['menu'])) {
	$this->add_notification (__ ('Error deleting menu. Check your permissions and try again.'));
} else {
	$cache->delete ('_c_menubuilder_menu_sitemap');
	$cache->delete ('_c_menubuilder_menu_dropmenu');
	$this->add_notification (__ ('Menu deleted.'));
}

$this->redirect ('/menubuilder/index');

?>