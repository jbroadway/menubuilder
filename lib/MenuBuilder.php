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
	 * Find a path within a menu. Matches the provided
	 * page value or the link value against
	 * `$_SERVER['REQUEST_URI']`.
	 */
	public static function find_path ($menu, $page) {
		if (! is_array ($menu)) {
			$menu = self::get_menu ($menu);
			if (! $menu) {
				return false;
			}
			$menu = $menu['menu'];
		}

		foreach ($menu as $item) {
			if (
				(isset ($item['page']) && $item['page'] === $page)
			||
				(isset ($item['link']) && $item['link'] === $_SERVER['REQUEST_URI'])
			) {
				return array ($item);
			}
			
			if (isset ($item['menu'])) {
				$res = self::find_path ($item['menu'], $page);
				if ($res) {
					array_unshift ($res, $item);
					return $res;
				}
			}
		}

		return false;
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