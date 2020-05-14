<?php

// include composer autoload
require __DIR__.'/../../vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;


if ( ! function_exists('is_external_url'))
{
	function is_external_url($url)
	{
		if ( ! is_string($url))
		{
			return FALSE;
		}

		$external_url = parse_url($url);
		$internal_url = parse_url(url("/"));

		return isset($external_url['host']) && $external_url['host'] !== $internal_url['host'];
	}
}


if ( ! function_exists('ckeckPermission'))
{
	function ckeckPermission($expression)
	{
        $lOk = 0;

        foreach ($expression as $key => $value) {

            if(app('defender')->canDo($value) || in_array($value, Auth::user()->permissions->pluck('name')->toArray())) {
               $lOk = true;
            }
        }

        return $lOk;
	}
}

if ( ! function_exists('img_src'))
{
	function img_src()
	{
		$args  = func_get_args();
		$types = array_map(function($arg) {
			return gettype($arg);
		}, $args);

		// Defaults options
		$options = array(
			'dynamic'   => FALSE,
			'thumbnail' => FALSE,
			'width'     => 'auto',
			'height'    => 'auto'
		);

		switch (implode('|', $types))
		{
			// ARGS: src
			case 'string':
				$url = $args[0];
			break;

			// ARGS: width
			case 'integer':
				$options['width'] = $args[0];
			break;

			// ARGS: src, attributes
			case 'string|array':
				$url     = $args[0];
				$options = $args[1] + $options;
			break;

			// ARGS: src, dynamic
			case 'string|boolean':
				$url                = $args[0];
				$options['dynamic'] = $args[1];
			break;

			// ARGS: src, width
			case 'string|integer':
				$url              = $args[0];
				$options['width'] = $args[1];
			break;

			// ARGS: width, height
			case 'integer|integer':
				$options['width']  = $args[0];
				$options['height'] = $args[1];
			break;

			// ARGS: src, width, dynamic
			case 'string|integer|boolean':
				$url                = $args[0];
				$options['width']   = $args[1];
				$options['dynamic'] = $args[2];
			break;

			// ARGS: src, width, height
			case 'string|integer|integer':
				$url               = $args[0];
				$options['width']  = $args[1];
				$options['height'] = $args[2];
			break;

			// ARGS: src, width, height, dynamic
			case 'string|integer|integer|boolean':
				$url                = $args[0];
				$options['width']   = $args[1];
				$options['height']  = $args[2];
				$options['dynamic'] = $args[3];
			break;

			// ARGS: src, width, dynamic, thumbnail
			case 'string|integer|boolean|boolean':
				$url                  = $args[0];
				$options['width']     = $args[1];
				$options['dynamic']   = $args[2];
				$options['thumbnail'] = $args[3];
			break;

			// ARGS: src, width, height, dynamic, thumbnail
			case 'string|integer|integer|boolean|boolean':
				$url                  = $args[0];
				$options['width']     = $args[1];
				$options['height']    = $args[2];
				$options['dynamic']   = $args[3];
				$options['thumbnail'] = $args[4];
			break;

			default:
				return;
		}

		if ($url == "")
		{
			$placeholder = "//placehold.it/";

			if (isset($options['width']))
			{
				$placeholder .= "{$options['width']}";
			}else {
				$placeholder .= "400";
			}

			if (isset($options['height']))
			{
				$placeholder .= "x{$options['height']}";
			}else {
				$placeholder .= "x400";
			}

			return $placeholder;
		}

		// If is an external URL, so we've done
		if (is_external_url($url))
		{
			return $url;
		}

		$path = ($options['dynamic'] ? '/storage/' : '/img/');

		$size  = array('auto', 'auto');

		if ($options['thumbnail'])
		{
			$path .= 'cache/';
			$size  = array('auto', 'auto'); // width, height

			if ($options['width'] !== NULL)
			{
				$size[0] = $options['width'];
			}

			if ($options['height'] !== NULL)
			{
				$size[1] = $options['height'];
			}

			$path .= implode('x', $size) . '/';
		}

		$path      .= ($options['dynamic']) ? $url : "{$url}";

		$path_uris = explode("/", $path);
		$file      = end($path_uris);
		unset($path_uris[key($path_uris)]);
		unset($path_uris[0]);
		$path_temp =  implode("/", $path_uris);

		if(!file_exists($path_temp."/".$file) && file_exists(str_replace("cache/".implode('x', $size)."/", "", $path_temp."/".$file))) {

			list($widthImage, $heightImage, $typeImage, $attrImage) = getimagesize(str_replace("cache/".implode('x', $size)."/", "", $path_temp."/".$file));

			if ($widthImage > 1900)
			{
				$image = Image::make((isset($size)) ? str_replace("cache/".implode('x', $size)."/", "", $path_temp."/".$file) : $path_temp."/".$file);

				$image->resize(1900, null, function ($constraint) {
				    $constraint->aspectRatio();
				    $constraint->upsize();
				})->save((isset($size)) ? str_replace("cache/".implode('x', $size)."/", "", $path_temp."/".$file) : $path_temp."/".$file, 75);
			}

			if (!file_exists($path_temp))
			{
				mkdir($path_temp, 0777, true);
			}

			$image = Image::make((isset($size)) ? str_replace("cache/".implode('x', $size)."/", "", $path_temp."/".$file) : $path_temp."/".$file)->fit(($size[0] == "auto") ? null : $size[0], ($size[1] == "auto") ? null : $size[1]);
			$image->save($path_temp."/".$file);
		}

		return url("/").$path;
	}


	if ( ! function_exists('html_tag'))
	{
		function html_tag()
		{
			$args  = func_get_args();
			$types = array_map(function($arg) {
				return gettype($arg);
			}, $args);

			// Default options
			$name    = reset($args);
			$content = NULL;
			$close   = FALSE;
			$options = array();

			switch (implode('|', $types))
			{
				// ARGS: name
				case 'string':
				break;

				// ARGS: name, content
				case 'string|string':
					$content = $args[1];
					$close   = TRUE;
				break;

				// ARGS: name, close
				case 'string|boolean':
					$close = $args[1];
				break;

				// ARGS: name, options
				case 'string|array':
					$options = $args[1];
				break;

				// ARGS: name, content, options
				case 'string|string|array':
					$content = $args[1];
					$options = $args[2];
					$close   = TRUE;
				break;

				// ARGS: name, close, options
				case 'string|boolean|array':
					$close   = $args[1];
					$options = $args[2];
				break;

				default:
					return NULL;
			}

			$tag = "<{$name}";


			foreach ($options as $option => $value)
			{
				$tag .= " {$option}";

				if ( ! is_null($value))
				{
					$tag .= "=\"{$value}\"";
				}
			}

			if (isset($options['src']) && !is_external_url($options['src'])) {

				$file = str_replace("/public/", "public/", str_replace(array(url("/"), ""), "", $options['src']));

				if (file_exists($file)) {

					list($widthImage, $heightImage, $typeImage, $attrImage) = getimagesize($file);

					$tag .= " width={$widthImage} height={$heightImage}";
				}
			}

			$tag .= ">";

			if ($close || ! is_null($content))
			{
				$tag .= $content;
				$tag .= "</{$name}>";
			}
			return $tag;
		}
	}

	if ( ! function_exists('img'))
	{
		function img()
		{
			$args  = func_get_args();
			$types = array_map(function($arg) {
				return gettype($arg);
			}, $args);

			// Defaults options
			$width   = $height    = NULL;
			$dynamic = $thumbnail = FALSE;
			$options = array();

			switch (implode('|', $types))
			{
				// ARGS: src
				case 'string':
					$src = $args[0];
				break;

				// ARGS: width
				case 'integer':
					$width = $args[0];
				break;

				// ARGS: src, attributes
				case 'string|array':
					$src     = $args[0];
					$options = $args[1];
				break;

				// ARGS: src, dynamic
				case 'string|boolean':
					$src     = $args[0];
					$dynamic = $args[1];
				break;

				// ARGS: src, width
				case 'string|integer':
					$src   = $args[0];
					$width = $args[1];
				break;

				// ARGS: width, height
				case 'integer|integer':
					$width  = $args[0];
					$height = $args[1];
				break;

				// ARGS: src, width, dynamic
				case 'string|integer|boolean':
					$src     = $args[0];
					$width   = $args[1];
					$dynamic = $args[2];
				break;

				// ARGS: src, dynamic, attributes
				case 'string|boolean|array':
					$src     = $args[0];
					$dynamic = $args[1];
					$options = $args[2];
				break;

				// ARGS: src, width, attributes
				case 'string|integer|array':
					$src     = $args[0];
					$width   = $args[1];
					$options = $args[2];
				break;

				// ARGS: src, width, height
				case 'string|integer|integer':
				case 'string|integer|string':
				case 'string|string|integer':
					$src    = $args[0];
					$width  = $args[1];
					$height = $args[2];
				break;

				// ARGS: src, width, dynamic, attributes
				case 'string|integer|boolean|array':
					$src     = $args[0];
					$width   = $args[1];
					$dynamic = $args[2];
					$options = $args[3];
				break;

				// ARGS: src, width, height, attributes
				case 'string|integer|integer|array':
				case 'string|integer|string|array':
				case 'string|string|integer|array':
					$src     = $args[0];
					$width   = $args[1];
					$height  = $args[2];
					$options = $args[3];
				break;

				// ARGS: src, width, height, dynamic
				case 'string|integer|integer|boolean':
				case 'string|integer|string|boolean':
				case 'string|string|integer|boolean':
					$src     = $args[0];
					$width   = $args[1];
					$height  = $args[2];
					$dynamic = $args[3];
				break;

				// ARGS: src, width, dynamic, thumbnail
				case 'string|integer|boolean|boolean':
					$src       = $args[0];
					$width     = $args[1];
					$dynamic   = $args[2];
					$thumbnail = $args[3];
				break;

				// ARGS: src, width, height, dynamic, thumbnail
				case 'string|integer|integer|boolean|boolean':
				case 'string|integer|string|boolean|boolean':
				case 'string|string|integer|boolean|boolean':
					$src       = $args[0];
					$width     = $args[1];
					$height    = $args[2];
					$dynamic   = $args[3];
					$thumbnail = $args[4];
				break;

				// ARGS: src, width, height, dynamic, thumbnail, attributes
				case 'string|integer|integer|boolean|boolean|array':
				case 'string|integer|string|boolean|boolean|array':
				case 'string|string|integer|boolean|boolean|array':
					$src       = $args[0];
					$width     = $args[1];
					$height    = $args[2];
					$dynamic   = $args[3];
					$thumbnail = $args[4];
					$options   = $args[5];
				break;
			}

			$options = array('src' => '') + $options; // Unshift src to the array

			if (!$thumbnail && $width !== NULL && strtolower($width) !== 'auto')
			{
				$options['width'] = $width;
			}

			if (!isset($src) || $args[0] == "")
			{
				$src = "";
			}

			$options['src'] = img_src($src, array(
				'width'     => $width,
				'height'    => $height,
				'dynamic'   => $dynamic,
				'thumbnail' => $thumbnail
			));

			return html_tag('img', $options);
		}
	}
}

if ( ! function_exists('prep_url'))
{
	function prep_url($str)
	{
		if ($str == 'http://' OR $str == '')
	    {
	        return '';
	    }

	    $url = parse_url($str);

	    if ( ! $url OR ! isset($url['scheme']))
	    {
	        $str = 'http://'.$str;
	    }

	    return $str;
	}
}


if ( ! function_exists('is_vimeo_url'))
{
	function is_vimeo_url($url)
	{
		$parsed_url = parse_url(prep_url($url));

		return isset($parsed_url['host']) && strpos($parsed_url['host'], 'vimeo') !== FALSE;
	}
}


if ( ! function_exists('is_youtube_url'))
{
	function is_youtube_url($url)
	{
		$parsed_url = parse_url(prep_url($url));

		return isset($parsed_url['host']) &&
			(strpos($parsed_url['host'], 'youtube') !== FALSE || strpos($parsed_url['host'], 'youtu.be') !== FALSE);
	}
}


if ( ! function_exists('get_video'))
{
	function get_video($url, $width = 420, $height = 315)
	{
		if (is_youtube_url($url))
		{
			return get_youtube_video($url, $width, $height);
		}
		elseif (is_vimeo_url($url))
		{
			return get_vimeo_video($url, $width, $height);
		}
	}
}


if ( ! function_exists('get_youtube_video_id'))
{
	function get_youtube_video_id($url)
	{
		preg_match("#((\?|\&)v\=|/embed/|/v/|/youtu.be/|\#././.+?/)(.{11})#i", prep_url($url), $matches);

		return isset($matches[3]) ? $matches[3] : FALSE;
	}
}


if ( ! function_exists('get_vimeo_video_id'))
{
	function get_vimeo_video_id($url)
	{
		preg_match('/(\d+)/', prep_url($url), $matches);

		return reset($matches);
	}
}


if ( ! function_exists('get_youtube_video'))
{
	function get_youtube_video($url, $width = 420, $height = 315)
	{
		if ($id = get_youtube_video_id($url))
		{
			return html_tag('iframe', TRUE, array(
				'width'                 => $width,
				'height'                => $height,
				'src'                   => "//www.youtube.com/embed/{$id}",
				'frameborder'           => '0',
				'webkitAllowFullScreen' => NULL,
				'mozallowfullscreen'    => NULL,
				'allowfullscreen'       => NULL
			));
		}
	}
}


if ( ! function_exists('get_vimeo_video'))
{
	function get_vimeo_video($url, $width = 420, $height = 315)
	{
		if ($id = get_vimeo_video_id($url))
		{
			return html_tag('iframe', TRUE, array(
				'width'                 => $width,
				'height'                => $height,
				'src'                   => "//player.vimeo.com/video/{$id}",
				'frameborder'           => '0',
				'webkitAllowFullScreen' => NULL,
				'mozallowfullscreen'    => NULL,
				'allowfullscreen'       => NULL
			));
		}
	}
}

if ( ! function_exists('get_video_cover'))
{
	function get_video_cover($url)
	{
		if (is_youtube_url($url))
		{
			return get_youtube_video_cover($url);
		}
		elseif (is_vimeo_url($url))
		{
			return get_vimeo_video_cover($url);
		}
	}
}

if ( ! function_exists('get_youtube_video_cover'))
{
	function get_youtube_video_cover($url)
	{
		if ($id = get_youtube_video_id($url))
		{
			return "http://img.youtube.com/vi/{$id}/0.jpg";
		}
	}
}

if ( ! function_exists('get_vimeo_video_cover'))
{
	function get_vimeo_video_cover($url)
	{
		if ($id = get_vimeo_video_id($url))
		{
			$parsed_url = parse_url(prep_url($url));
			$api_url    = 'http://vimeo.com/api/v2/video/' . substr($parsed_url['path'], 1) . '.php';
			$data       = unserialize(file_get_contents($api_url));
			$video      = reset($data);

			return ($video !== FALSE) ? $video['thumbnail_large'] : NULL;
		}
	}
}


if ( ! function_exists('get_date_month'))
{
	function get_date_month($month)
	{

		switch ($month) {
			case '01':
				return "Janeiro";
				break;
			case '02':
				return "Fevereiro";
				break;
			case '03':
				return "Março";
				break;
			case '04':
				return "Abril";
				break;
			case '05':
				return "Maio";
				break;
			case '06':
				return "Junho";
				break;
			case '07':
				return "Julho";
				break;
			case '08':
				return "Agosto";
				break;
			case '09':
				return "Setembro";
				break;
			case '10':
				return "Outubro";
				break;
			case '11':
				return "Novembro";
				break;
			case '12':
				return "Dezembro";
				break;
		}
	}
}

if ( ! function_exists('get_date_day'))
{
	function get_date_day($day)
	{
		$days =array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
		return $days[$day];

	}
}

if ( ! function_exists('combinePivot'))
{
	function combinePivot($entities, $pivots = [])
	{
		// Set array
        $pivotArray = [];
        // Loop through all pivot attributes
        foreach ($pivots as $pivot => $value) {
            // Combine them to pivot array
            $pivotArray += [$pivot => $value];
        }
        // Get the total of arrays we need to fill
        $total = count($entities);
        // Make filler array
        $filler = array_fill(0, $total, $pivotArray);
        // Combine and return filler pivot array with data
        return array_combine($entities, $filler);

	}
}
