<?php
namespace content_site\assemble;
/**
 *	Sample of loading imgage with full option for better loading time
 *  https://www.andreaverlicchi.eu/capping-image-fidelity-2x-minimize-loading-time/
 *
		<picture>
		  <!-- Landscape tablet / computers -->
		  <source media="(min-width: 1024px)"
		          sizes="(min-width: 1280px) 33vw, 50vw"
		          srcset="https://placehold.it/640 640w,
		                  https://placehold.it/1024 1024w,
		                  https://placehold.it/1280 1280w,
		                  https://placehold.it/1440 1440w">
		  <!-- Portrait tablets -->
		  <source media="(min-width: 415px)"
		          srcset="https://placehold.it/768 2x" />
		  <!-- iPhone X, XR... -->
		  <source media="(min-width: 414px)"
		          srcset="https://placehold.it/828 2x" />
		  <!-- iPhone 6/7/8 -->
		  <source media="(min-width: 375px)"
		          srcset="https://placehold.it/750 2x" />
		  <!-- IE (src) + iPhone 12 Mini (capped) -->
		  <img src="https://placehold.it/1280"
		       srcset="https://placehold.it/720 2x"
		       alt="Batman Super-man and Wonder" />
		</picture>
*/

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


	public static function picture($_src, $_alt = null, $_sizes = null, $_container = null)
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