<?php
/**
 * RoxPHP Open Graph Helper
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
 * Open Graph Helper
 *
 * @package default
 * @link http://opengraphprotocol.org/
 */
class OpenGraphHelper {

	/**
	 * List of Open Graph properties
	 *
	 * @var array
	 */
	protected $_properties = array();

	/**
	 * Sets Open Graph properties
	 *
	 * @param string|array $property 
	 * @param string $content 
	 * @return void
	 */
	public function set($property, $content = null) {
		if (is_array($property)) {
			$this->_properties += $property;
			return;
		}

		$this->_properties[$property] = $content;
	}

	/**
	 * Renders Open Graph tags
	 *
	 * @return string
	 */
	public function tags() {
		$output = array();

		foreach ($this->_properties as $property => $content) {
			$output[] = sprintf('<meta property="og:%s" content="%s" />', $property, htmlspecialchars($content));
		}

		return implode('', $output);
	}
}
