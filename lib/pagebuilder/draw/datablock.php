<?php
namespace lib\pagebuilder\draw;

class datablock
{
	public static function draw($_args, $_data)
	{
		if(!is_array($_args) || !is_array($_data))
		{
			return null;
		}


		if(isset($_args['puzzle']['puzzle_type']) && $_args['puzzle']['puzzle_type'])
		{
			// puzzle type [simple, special]
			if(isset($_args['puzzle']['slider_type']) && $_args['puzzle']['slider_type'])
			{
				if($_args['puzzle']['slider_type'] === 'special')
				{

				}
				else
				{
					// simple
					return self::draw_simple_slider($_args, $_data);
				}
			}
			else
			{
				// ?
			}

		}
		else
		{

		}

		$dataList = $_data;

		var_dump($_args);exit();

		$_args = a($_args, 'value');

		$html = '<section class="puzzle"';
		$html .= ' data-mode="'. a($_args, 'type'). '"';
		$html .= '>';
		{
			$html .= '<div class="'. a($_args, 'avand'). '">';
			{
				// get title line if need to show
				$html .= \lib\app\website\generator\title::html($_args, a($_data, 'line_link'));

				$spaceSize  = a($_args, 'padding');

				$radiusSize = a($_args, 'radius');

				$effectMode = a($_args, 'effect');


				$html .= '<div class="row"';
				if($spaceSize)
				{
					$html .= ' data-space="'. $spaceSize. '"';
				}
				if($radiusSize)
				{
					$html .= ' data-radius="'. $radiusSize. '"';
				}
				if($effectMode)
				{
					$html .= ' data-effect="'. $effectMode. '"';
				}
				$html .= '>';
				{
					$html .= self::everyItem($dataList, $_args);
				}
				$html .= '</div>';
			}
			$html .= '</div>';
		}
		$html .= '</section>';
		return $html;
	}


	private static function everyItem($_list, $_args)
	{
		$itemHtml = '';
		$infoPos  = a($_args, 'info_position');

		foreach ($_list as $key => $value)
		{
			$myItem = '';
			$myPuzzle = \lib\app\website\puzzle::layout($key, $_args);
			$myItem .= '<div class="'. a($myPuzzle, 'class'). '">';
			{
				$playMode      = a($myPuzzle, 'playMode');
				$galleryPath0  = a($value, 'gallery_array', 0, 'path');
				// link data
				$linkTitle  = a($value, 'title');
				$link       = a($value, 'link');
				$linkTarget = a($value, 'target');

				// add every item element
				$myItem .= '<a class="everyItem"';
				if($infoPos)
				{
					$myItem .= ' data-info="'. $infoPos. '"';
				}
				if($link)
				{
					$myItem .= ' href="'. $link. '"';
				}
				if($linkTarget)
				{
					$myItem .= ' target="_blank"';
				}
				$myItem .= '>';
				{
					if($infoPos === 'top')
					{
						$myItem .= self::createInfoBox($linkTitle, 2);
					}

					if($playMode === 'video' || $playMode === 'audio')
					{
						$myItem .= self::createVideoOrAudio($playMode, $value);
					}
					else
					{
						$imgSrc = a($value, 'thumb');
						if($imgSrc)
						{
							$myItem .= media::createPictureEl($imgSrc, $linkTitle);
						}
					}
					switch ($infoPos)
					{
						case 'bottom':
							$myItem .= self::createInfoBox($linkTitle, 2);
							break;

						case 'inside':
							$myItem .= self::createInfoBox($linkTitle, 3);
							break;

						case 'beside':
							$myItem .= self::createInfoBox($linkTitle, 4);
							break;

						default:
							// do nothing
							break;
					}
				}
				$myItem .= '</a>';
			}
			$myItem .= '</div>';
			// append created item
			$itemHtml .= $myItem;
		}
		return $itemHtml;
	}


	private static function createVideoOrAudio($_type, $_value)
	{
		$myMediaSrc  = \lib\filepath::fix(a($_value, 'gallery_array', 0, 'path'));
		$myMediaMime = a($_value, 'gallery_array', 0, 'mime');

		if($_type === 'video')
		{
			$myMediaPoster = \lib\filepath::fix(a($_value, 'poster'));

			return media::createVideoEl($myMediaSrc, $myMediaMime, $myMediaPoster);
		}
		if($_type === 'audio')
		{
			return media::createAudioEl($myMediaSrc, $myMediaMime);
		}

		return null;
	}


	private static function createInfoBox($_title, $_heading = 2)
	{
		$myInfoBox = '<div class="info">';
		$myInfoBox .= media::heading($_title, $_heading);
		$myInfoBox .= '</div>';

		return $myInfoBox;
	}



	private static function draw_simple_slider($_args, $_data)
	{
		$html = '';
		$html .= '<div class="jSlider1 mB10" data-slider>';

		foreach ($_data as $key => $value)
		{
			$html .= '<a';
			if(a($value, 'url'))
			{
				$html .= ' href="'.  a($value, 'url'). '"';
				if(a($value, 'target'))
				{
					$html .= ' target="_blank"';
				}
			}
			$html .= '>';
    		$html .= '<img src="'. \lib\filepath::fix(a($value, 'imageurl')). '" alt="'. a($value, 'alt'). '">';
			$html .= '</a>';
    	}
		$html .= '</div>';

		return $html;
	}
}
?>