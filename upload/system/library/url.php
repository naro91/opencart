<?php
/**
 * @package        OpenCart
 * @author        Daniel Kerr
 * @copyright    Copyright (c) 2005 - 2017, OpenCart, Ltd. (https://www.opencart.com/)
 * @license        https://opensource.org/licenses/GPL-3.0
 * @link        https://www.opencart.com
 */

/**
 * URL class
 */
class Url {
	private $url;
	private $rewrite = array();

	/**
	 * Constructor
	 *
	 * @param    string $url
	 * @param    string $ssl
	 *
	 */
	public function __construct($url, $ssl = '') {
		$this->url = $url;
	}

	/**
	 *
	 *
	 * @param    object $rewrite
	 */
	public function addRewrite($rewrite) {
		$this->rewrite[] = $rewrite;
	}

	/**
	 *
	 *
	 * @param    string $route
	 * @param    mixed $args
	 *
	 * @return    string
	 */
	public function link($route, $args = '') {
		$url = $this->url . 'index.php?route=' . (string)$route;

		if ($args) {
			if (is_array($args)) {
				$url .= '&amp;' . http_build_query($args);
			} else {
				$url .= str_replace('&', '&amp;', '&' . ltrim($args, '&'));
			}
		}

		foreach ($this->rewrite as $rewrite) {
			$url = $rewrite->rewrite($url);
		}

		return $url;
	}
}
