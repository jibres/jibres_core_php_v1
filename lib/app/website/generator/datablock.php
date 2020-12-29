<?php
namespace lib\app\website\generator;

class datablock
{
	public static function html($_blockSetting, $_data)
	{
		if(!is_array($_blockSetting) || !is_array($_data))
		{
			return null;
		}
		$dataList = a($_data, 'list');
		if(!is_array($dataList))
		{
			return null;
		}
		$_blockSetting = a($_blockSetting, 'value');

		$html = '<section class="puzzle"';
		$html .= ' data-mode="'. a($_blockSetting, 'type'). '"';
		$html .= '>';
		{
			$html .= '<div class="'. a($_blockSetting, 'avand'). '">';
			{
				// get title line if need to show
				$html .= \lib\app\website\generator\title::html($_blockSetting, a($_data, 'line_link'));

				$spaceSize    = a($_blockSetting, 'padding');
				// $spaceSize = 'zero';
				// $spaceSize = 'normal'; default
				// $spaceSize = 'high';
				$spaceSize = 'extra';
				$radiusSize = a($_blockSetting, 'radius');
				// $radiusSize = '0';
				// $radiusSize = '1x'; default
				// $radiusSize = '2x';
				$radiusSize = '3x';
				// $radiusSize = '4x';
				// $radiusSize = 'circle';
				$effectMode = a($_blockSetting, 'effect');
				// $effectMode = 'none';
				$effectMode = 'zoom'; // default
				// $effectMode = 'darkShadow';
				// $effectMode = 'whiteShadow';

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
					$html .= self::everyItem($dataList, $_blockSetting);
				}
				$html .= '</div>';
			}
			$html .= '</div>';
		}
		$html .= '</section>';
		return $html;
	}


	private static function everyItem($_list, $_blockSetting)
	{
		$itemHtml = '';
		$infoPos  = a($_blockSetting, 'info_position');

		foreach ($_list as $key => $value)
		{
			$myItem = '';
			$myPuzzle = \lib\app\website\puzzle::layout($key, $_blockSetting);
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
						$myItem .= self::createInfoBox($linkTitle);
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
					if($infoPos === 'bottom' || $infoPos === 'inside')
					{
						$myItem .= self::createInfoBox($linkTitle);
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


	private static function createInfoBox($_title)
	{
		$myInfoBox = '<div class="info">';
		$myInfoBox .= media::heading($_title, 2);
		$myInfoBox .= '</div>';

		return $myInfoBox;
	}

}
?>