<?php
namespace lib\app\website\generator;

class media
{
	public static function createVideoEl($_src, $_mime = 'video/mp4', $_poster = null)
	{
		$videoEl = '<video';
		{
			$videoEl .= ' controls';
		}
		{
			$videoEl .= '  preload="meta"';
		}
		if($_poster)
		{
			$videoEl .= ' poster="'. $_poster. '"';
		}
		$videoEl .= '>';
		{
			$videoEl .= '<source';
			$videoEl .= ' type="'. $_mime. '"';
			$videoEl .= ' src="'. $_src. '"';
			$videoEl .= '>';
		}

		$videoEl .= '</video>';

		return $videoEl;
	}


	public static function createAudioEl($_src, $_mime = 'audio/mp3')
	{
		$audioEl = '<audio';
		{
			$audioEl .= ' controls';
		}
		{
			$audioEl .= '  preload="meta"';
		}
		$audioEl .= '>';
		{
			$audioEl .= '<source';
			$audioEl .= ' type="'. $_mime. '"';
			$audioEl .= ' src="'. $_src. '"';
			$audioEl .= '>';
		}

		$audioEl .= '</audio>';

		return $audioEl;
	}


	public static function createLinkedImgEl($_src, $_alt = null, $_link = null, $_target = null)
	{
		return self::createLinkEl(self::createImgEl($_src, $_alt), $_link, $_target);
	}


	public static function createLinkEl($_inside, $_link, $_target = null)
	{
		$linkEl = '<a';
		if($_link)
		{
			$linkEl .= ' href="'.  $_link. '"';
		}
		if($_target)
		{
			$linkEl .= ' target="_blank"';
		}
		$linkEl .= '>';

		{
			$linkEl .= $_inside;
		}
		$linkEl .= '</a>';

		return $linkEl;
	}


	public static function heading($_text, $_level, $_class = null)
	{
		switch ($_level)
		{
			// case 1:
			case 2:
			case 3:
			case 4:
			case 5:
			// case 6:
				// do nothing
				break;

			default:
				$_level = 2;
				break;
		}

		$headingEl = '<h'. $_level;
		if($_class)
		{
			$headingEl .= ' class="'. $_class. '"';
		}
		else
		{
			$headingEl .= ' class="eTitle"';
		}
		$headingEl .= '>';
		$headingEl .= $_text;
		$headingEl .= '</h'. $_level.'>';

		return $headingEl;
	}


	public static function createImgEl($_src, $_alt = null)
	{
		$imgEl = '<img';
		$imgEl .= ' loading="lazy"';
		$imgEl .= self::createImgSrc($_src);

		if(!$_alt)
		{
			$_alt .= 'image on Jibres';
		}
		// create srcset
		$imgEl .= ' alt="'. $_alt. '"';
		$imgEl .= '>';
		self::createImgSrcset($_src);
		return $imgEl;
	}


	public static function createImgSrc($_src)
	{
		$srcAttr = '';
		$srcAttr .= ' srcset="'. self::createImgSrcset($_src). '"';
		$srcAttr .= ' src="'. $_src. '"';

		return $srcAttr;
	}


	public static function createImgSrcset($_src)
	{
		$dotPosition = strrpos($_src, '.');
		if(!$dotPosition)
		{
			return false;
		}
		$imgName = substr($_src, 0, $dotPosition);
		$imgExt  = '.webp';//substr($_src, $dotPosition);
		$srcset  = '';
		$srcsetArr = [];
		// my defined breakpoints
		$myBreakPoints =
		[
			220 => '220w',
			300 => '300w',
			460 => '460w',
			780 => '780w',
			1100 => '1100w',
		];

		foreach ($myBreakPoints as $width => $breakpoint)
		{
			$srcsetArr[] = $imgName. '-w'. $width. $imgExt. ' '. $breakpoint;
		}
		$srcset = implode(', ', $srcsetArr);

		return $srcset;
	}


	public static function getImgThumb($_src)
	{
		$dotPosition = strrpos($_src, '.');
		if(!$dotPosition)
		{
			return '';
		}
		$imgExt = substr($_src, $dotPosition);
		switch ($imgExt)
		{
			case '.jpg':
			case '.png':
			case '.gif':
				return substr($_src, 0, $dotPosition). '-w120.webp';
				break;

			default:
				return $_src;
		}
	}
}
?>