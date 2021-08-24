<?php
namespace content_site\assemble;


class img
{
	public static function createImgEl($_src, $_alt = null)
	{
		$imgEl = '<img itemprop="image"';
		$imgEl .= ' loading="lazy"';
		$imgEl .= self::createImgSrc($_src);

		if(!$_alt)
		{
			$_alt .= 'image on Jibres';
		}
		// create srcset
		$imgEl .= ' alt="'. $_alt. '"';
		$imgEl .= '>';
		return $imgEl;
	}


	public static function createPictureEl($_src, $_alt = null)
	{
		$picEl = '<picture>';
		{
			$picEl .= '<source type="image/webp"';
			$picEl .= ' srcset="'. self::createImgSrcset($_src). '"';
			$picEl .= '>';

			$picEl .= '<img';
			$picEl .= ' loading="lazy"';
			$picEl .= ' src="'. $_src. '"';

			if(!$_alt)
			{
				$_alt .= 'another image on Jibres';
			}
			// create srcset
			$picEl .= ' alt="'. $_alt. '"';
			$picEl .= '>';
		}
		$picEl .= '</picture>';
		return $picEl;
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
}
?>