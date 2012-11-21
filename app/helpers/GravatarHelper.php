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
class GravatarHelper extends \rox\template\Helper {

	/**
	 * Renders a gravatar
	 *
	 * @param string $email email address
	 * @param array $options
	 *         - size: size of the avatar in pixels (default: 80)
	 *         - rating: gravatar rating level (default: g)
	 *         - default: default image to show when user doesn't have a gravatar
	 *         - retina: if set to true (default), it will use an image that is twice the size as the src
	 *         - alt: value of alt attribute
	 *         - class: CSS class for the img tag
	 *         - id: id for the img tag
	 *
	 * @return string
	 * @link http://en.gravatar.com/site/implement/images/
	 */
	public function image($email, $options = array()) {
		$defaults = array(
			'size'    => 80,
			'rating'  => 'g',
			'default' => 'mm',
			'retina'  => true,
			'alt'     => '',
			'class'   => false,
			'id'      => false
		);

		$options += $defaults;

		$params = array();
		foreach (array('size', 'rating', 'default') as $k) {
			$params[$k] = $options[$k];
		}
		
		if ($options['retina']) {
			$params['size'] = $params['size'] * 2;
		}

		$hash = md5(strtolower(trim($email)));
		$qs = http_build_query($params);
		$url = sprintf('http://www.gravatar.com/avatar/%s?%s', $hash, $qs);

		$attributes = array(
			'src'    => $url,
			'alt'    => $options['alt'],
			'width'  => $options['size'],
			'height' => $options['size'],
		);

		foreach (array('id', 'class') as $k) {
			if ($options[$k] !== false) {
				$attributes[$k] = $options[$k];
			}
		}

		return $this->_selfClosingTag('img', $attributes);
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
