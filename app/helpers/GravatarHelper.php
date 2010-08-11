<?php
/**
 * RoxPHP Gravatar helper
 *
 * Copyright (C) 2010 Ramon Torres
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) 2010 Ramon Torres
 * @package default
 * @license The MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Gravatar helper
 *
 * @package default
 */
class GravatarHelper {

	/**
	 * Renders a gravatar
	 *
	 * @param string $email email address
	 * @param array $options
	 *         - size: size of the avatar in pixels (default: 80)
	 *         - rating: gravatar rating level (default: g)
	 *         - default: default image to show when user doesn't have a gravatar
	 * @return string
	 * @link http://en.gravatar.com/site/implement/images/
	 */
	public function image($email, $options = array()) {
		$defaults = array(
			'size'    => 80,
			'rating'  => 'g',
			'default' => 'mm'
		);

		$options += $defaults;

		$hash = md5(strtolower(trim($email)));
		$params = http_build_query($options);
		$url = sprintf('http://www.gravatar.com/avatar/%s?%s', $hash, $params);

		return sprintf('<img src="%s" alt="" width="%d" height="%d" />',
			$url, $options['size'], $options['size']);
	}

	/**
	 * Alias of GravatarHelper::image()
	 *
	 * @param string $email 
	 * @param array $options 
	 * @return string
	 */
	public function img($email, $options = array()) {
		return $this->image($email, $options);
	}
}
