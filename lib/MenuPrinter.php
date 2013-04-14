<?php

/**
 * Helper functions for printing menus.
 */
class MenuPrinter {
	/**
	 * Print a sitemap to an HTML list.
	 */
	public static function sitemap ($menu) {
		ob_start ();
		echo '<ul>';
		foreach ($menu as $item) {
			$item['link'] = isset ($item['link']) ? $item['link'] : '/' . $item['page'];
			printf (
				'<li><a href="%s">%s</a>',
				$item['link'],
				$item['label']
			);
			if (isset ($item['menu'])) {
				echo self::sitemap ($item['menu']);
			}
			echo '</li>';
		}
		echo '</ul>';
		return ob_get_clean ();
	}

	/**
	 * Print a site menu that opens based on the current page.
	 */
	public static function contextual ($menu, $path) {
		foreach ($path as $k => $p) {
			$path[$k]['link'] = isset ($p['link']) ? $p['link'] : '/' . $p['page'];
		}
		ob_start ();
		echo '<ul>';
		foreach ($menu as $item) {
			$item['link'] = isset ($item['link']) ? $item['link'] : '/' . $item['page'];
			if ($item === $path[count ($path) - 1]) {
				printf ('<li class="current"><a href="%s">%s</a>', $item['link'], $item['label']);
				if (isset ($item['menu'])) {
					echo self::contextual ($item['menu'], $path);
				}
				echo '</li>';
			} elseif (in_array ($item, $path)) {
				printf ('<li class="parent"><a href="%s">%s</a>', $item['link'], $item['label']);
				if (isset ($item['menu'])) {
					echo self::contextual ($item['menu'], $path);
				}
				echo '</li>';
			} else {
				printf ('<li><a href="%s">%s</a></li>', $item['link'], $item['label']);
			}
		}
		echo '</ul>';
		return ob_get_clean ();
	}
	
	/**
	 * Print a site menu structure for dropmenus.
	 */
	public static function dropmenu ($menu, $id) {
		ob_start ();
		if ($id) {
			echo '<ul id="' . $id . '" class="dropmenu">';
		} else {
			echo '<ul class="dropmenu">';
		}
	
		foreach ($menu as $item) {
			$item['link'] = isset ($item['link']) ? $item['link'] : '/' . $item['page'];
			printf ('<li><a href="%s">%s</a>', $item['link'], $item['label']);
			if (isset ($item['menu'])) {
				echo self::dropmenu ($item['menu'], $id);
			}
			echo '</li>';
		}
		echo '</ul>';
		return ob_get_clean ();
	}
}

?>