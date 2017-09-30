<?php
/*
Plugin Name: Facebook Footer Link
Plugin URI: https://wordpress.com/
Description: This is facbook footer link
Version: 0.1
Author: Hasinur Rahman
Author URI: https://facebook.com/hasinurrahman44
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: fflink
Domain Path: /languages
 */
/**
 * Copyright (c) YEAR Your Name (email: Email). All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * **********************************************************************
 */

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Facebook Footer Link
 *
 * @class linking the facebook profile
 */
class Facebook_Footer_Link {

	function __construct() {

		$this->init_hooks();

		$ffl_options = get_option('ffl_field_settings');
	}

	/**
	 * Instantiate class
	 *
	 * @return object
	 */
	public static function init() {

		static $instance = false;

		if (!$instance) {

			$instance = new Facebook_Footer_Link();
		}

		return $instance;
	}

	/**
	 * Init All Hooks
	 *
	 * @return void
	 */
	public function init_hooks() {

		add_filter('the_content', array($this, 'ffl_add_content'));

		// Add to admin menu
		add_action('admin_menu', array($this, 'create_menu_link'));

		// Register setting
		add_action('admin_init', array($this, 'ffl_register_settins'));
	}

	/**
	 * Add to admin menu
	 *
	 * @return void
	 */
	public function create_menu_link() {
		add_options_page(
			'Facebook Footer Link Option',
			'Facebook Footer Link',
			'manage_options',
			'facebook_footer_link',
			array($this, 'ffl_admin_menu_page_content')
		);
	}

	public function ffl_admin_menu_page_content() {

		if (is_admin()) {

			$ffl_options = $this->ffl_get_option('ffl_field_settings');

			require_once plugin_dir_path(__FILE__) . 'templates/admin_setting_page.php';
		}
	}

	/**
	 * Add the content
	 *
	 * @param  string $content
	 *
	 * @return string
	 */
	public function ffl_add_content($content) {

		$ffl_options = $this->ffl_get_option('ffl_field_settings');

		$out_put_content = '<span class="dashicons dashicons-facebook"></span> Find Us On <a href="' . $ffl_options['profile-link'] . '" target="_blank">Facebook</a>';
		if ($ffl_options['enable']) {

			if (is_single() || is_home() && $ffl_options['show-feed']) {

				return $content . $out_put_content;
			}

		} else {

			if (is_single() && $ffl_options['enable']) {

				return $content . $out_put_content;

			}
		}

		return $content;
	}

	/**
	 * Register setting
	 *
	 * @return void
	 */
	public function ffl_register_settins() {

		register_setting('ffl_register_setting_group', 'ffl_field_settings');
	}

	/**
	 * Get ffl option
	 *
	 * @param  string $option
	 *
	 * @return void
	 */
	public function ffl_get_option($option) {

		return get_option($option);
	}
}

Facebook_Footer_Link::init();