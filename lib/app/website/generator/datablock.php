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

		$html = '<section class="puzzle imgLine"';
		$html .= ' data-mode="'. a($_blockSetting, 'value', 'type'). '"';
		$html .= ' data-design="'. a($_blockSetting, 'value', 'design'). '"';
		$html .= '>';
		{
			$html .= '<div class="'. a($_blockSetting, 'value', 'avand'). '">';
			{
				// get title line if need to show
				$html .= \lib\app\website\generator\title::html($_blockSetting, a($_data, 'line_link'));
				$html .= '<div class="row padMore2">';
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
		$html = '';
		foreach ($_list as $key => $value)
		{
			$myPuzzle = \lib\app\website\puzzle::layout($key, $_blockSetting);
			$html .= '<div class="'. a($myPuzzle, 'class'). '">';
			{
				$playMode     = a($myPuzzle, 'playMode');
				$galleryPath0 = a($value, 'gallery_array', 0, 'path');

				if( $galleryPath0 && $playMode === 'video')
				{
					$html .= self::createVideoOrAudio($playMode, $value);
				}
				elseif( $galleryPath0 && $playMode === 'audio')
				{
					$html .= self::createVideoOrAudio($playMode, $value);
				}
				elseif (a($value, 'thumb'))
				{
					$html .= self::createImgEl($value);
				}
			}
			$html .= '</div>';
		}
		return $html;
	}


	private static function createVideoOrAudio($_type, $_value)
	{
		$myMediaSrc  = \lib\filepath::fix(a($_value, 'gallery_array', 0, 'path'));
		$myMediaMime = a($_value, 'gallery_array', 0, 'mime');

		if($_type === 'video')
		{
			$myMediaPoster = \lib\filepath::fix(a($_value, 'poster'));

			return self::createVideoEl($myMediaSrc, $myMediaMime, $myMediaPoster);
		}
		if($_type === 'audio')
		{
			return self::createAudioEl($myMediaSrc, $myMediaMime);
		}

		return null;
	}


	private static function createVideoEl($_src, $_mime = 'video/mp4', $_poster = null)
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


	private static function createAudioEl($_src, $_mime = 'audio/mp3')
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


	private static function createImgEl($_prop)
	{
		if(!a($_prop, 'thumb'))
		{
			return null;
		}
		$imgEl = '<img';
		$imgEl .= ' src="'. \lib\filepath::fix(a($_prop, 'thumb')). '"';
		$imgEl .= ' alt="'. a($_prop, 'title'). '"';
		$imgEl .= '>';

		return $imgEl;
	}


}
?>