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
				$myGallery0 = a($value, 'gallery_array', 0, 'path');
				$playMode   = a($myPuzzle, 'playMode');

				if( $myGallery0 && $playMode === 'video')
				{
					$html .= self::createVideoEl($value);
				}
				elseif( $myGallery0 && $playMode === 'audio')
				{
					$html .= self::createAudioEl($value);
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


	private static function createVideoEl($_prop)
	{
		if(!a($_prop, 'gallery_array', 0, 'path'))
		{
			return null;
		}
		$videoEl = '<video';
		$videoEl .= ' controls';
		$videoEl .= '  preload="meta"';
		if(a($_prop, 'poster'))
		{
			$videoEl .= ' poster="'. \lib\filepath::fix(a($_prop, 'poster')). '"';
		}
		$videoEl .= '>';
		{
			$videoEl .= '<source';
			$videoEl .= ' type="'. a($_prop, 'gallery_array', 0, 'mime'). '"';
			$videoEl .= ' src="'. \lib\filepath::fix(a($_prop, 'gallery_array', 0, 'path')). '"';
			$videoEl .= '>';
		}

		$videoEl .= '</video>';

		return $videoEl;
	}


	private static function createAudioEl($_prop)
	{
		if(!a($_prop, 'gallery_array', 0, 'path'))
		{
			return null;
		}
		$audioEl = '<audio';
		$audioEl .= ' controls';
		$audioEl .= '  preload="meta"';
		$audioEl .= '>';
		{
			$audioEl .= '<source';
			$audioEl .= ' type="'. a($_prop, 'gallery_array', 0, 'mime'). '"';
			$audioEl .= ' src="'. \lib\filepath::fix(a($_prop, 'gallery_array', 0, 'path')). '"';
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