<?php

/**
 * Class to access menus, stored as YAML files in the global
 * conf folder.
 */
class MenuBuilder {
	public static $path = 'conf/menubuilder/';

	public static $ext = '.yml';
	
	public static $comment = "# This file defines a menu structure in your website.\n# For formatting info, visit:\n# http://www.elefantcms.com/wiki/MenuBuilder\n\n";

	/**
	 * Verify a menu name for invalid characters and that
	 * the menu file exists.
	 */
	public static function verify_menu ($menu, $exists = true) {
		if (! preg_match ('/^[a-z0-9_-]+$/i', $menu)) {
			return false;
		}
		
		if ($exists && ! file_exists (self::$path . $menu . self::$ext)) {
			return false;
		}

		return true;
	}

	/**
	 * Fetch a list of all menus.
	 */
	public static function get_menus () {
		$menus = glob (self::$path . '*' . self::$ext);
		foreach ($menus as $key => $menu) {
			$menus[$key] = basename ($menu, self::$ext);
		}
		return $menus;
	}

	/**
	 * Fetch a menu structure.
	 */
	public static function get_menu ($menu) {
		return self::verify_menu ($menu)
			? sfYaml::load (self::$path . $menu . self::$ext)
			: false;
	}

	/**
	 * Fetch a menu file's raw contents.
	 */
	public static function get_raw_menu ($menu) {
		return self::verify_menu ($menu)
			? file_get_contents (self::$path . $menu . self::$ext)
			: false;
	}

	/**
	 * Write a menu to file.
	 */
	public static function write ($menu, $data) {
		if (! self::verify_menu ($menu, false)) {
			return false;
		}

		$data = is_string ($data)
			? $data
			: self::$comment . sfYaml::dump ($data);
		
		if (! file_put_contents (self::$path . $menu . self::$ext, $data)) {
			return false;
		}

		chmod (self::$path . $menu . self::$ext, 0666);
		return true;
	}

	/**
	 * Delete a menu file.
	 */
	public static function delete ($menu) {
		return self::verify_menu ($menu)
			? unlink (self::$path . $menu . self::$ext)
			: false;
	}
}

?>