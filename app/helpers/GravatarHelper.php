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
	 * undocumented function
	 *
	 * @param string $email 
	 * @param string $options 
	 * @return void
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

		return sprintf('<img src="%s" al="" width="%d" height="%d" />',
			$url, $options['size'], $options['size']);
	}

	/**
	 * undocumented function
	 *
	 * @param string $email 
	 * @param string $options 
	 * @return string
	 */
	public function img($email, $options = array()) {
		return $this->image($email, $options);
	}
}
