<?php
/**
 * RoxPHP YouTube Helper
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
 * YouTube Helper
 *
 * @package default
 */
class YoutubeHelper {

	/**
	 * Embeds a youtube video
	 *
	 * @param string $vid   video id or video URL
	 * @param array $options 
	 * @return string
	 */
	public function embed($vid, $options = array()) {
		$defaults = array('width' => 640, 'height' => 385, 'hd' => false, 'related' => false, 'autoplay' => false);
		$options += $defaults;

		$flashParams = array();
		$flashParams[] = (strpos($vid, 'http://') === 0) ? self::extractVideoId($vid) : $vid;
		if ($options['hd']) {
			$flashParams[] = 'hd=1';
		}

		if (!$options['related']) {
			$flashParams[] = 'rel=0';
		}

		if ($options['autoplay']) {
			$flashParams[] = 'autoplay=1';
		}

		$playerUrl = 'http://www.youtube.com/v/' . htmlentities(implode('&', $flashParams));

		$embedCode = <<<EOD
<object width="{$options['width']}" height="{$options['height']}">
	<param name="movie" value="{$playerUrl}"></param>
	<param name="allowFullScreen" value="true"></param>
	<param name="allowscriptaccess" value="always"></param>
	<param name="wmode" value="opaque"></param>
	<embed src="{$playerUrl}" type="application/x-shockwave-flash" allowscriptaccess="always"
		allowfullscreen="true" width="{$options['width']}" height="{$options['height']}">
	</embed>
</object>
EOD;

		return $embedCode;
	}

	/**
	 * undocumented function
	 *
	 * @param string $url 
	 * @return string
	 */
	public static function extractVideoId($url) {
		$query = parse_url($url, PHP_URL_QUERY);
		parse_str($query, $parts);
		return isset($parts['v']) ? $parts['v'] : false;
	}
}
