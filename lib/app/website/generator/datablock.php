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
		$itemHtml = '';
		foreach ($_list as $key => $value)
		{
			$myPuzzle = \lib\app\website\puzzle::layout($key, $_blockSetting);
			$itemHtml .= '<div class="'. a($myPuzzle, 'class'). '">';
			{
				$playMode     = a($myPuzzle, 'playMode');
				$galleryPath0 = a($value, 'gallery_array', 0, 'path');

				if($playMode === 'video' || $playMode === 'audio')
				{
					$itemHtml .= self::createVideoOrAudio($playMode, $value);
				}
				else
				{
					$imgSrc = a($value, 'thumb');
					if($imgSrc)
					{
						$imgAlt        = a($value, 'title');
						$imgLink       = a($value, 'link');
						$imgLinkTarget = a($value, 'target');

						$itemHtml .= self::createImgEl($imgSrc, $imgAlt);
					}
				}
			}
			$itemHtml .= '</div>';
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

			return self::createVideoEl($myMediaSrc, $myMediaMime, $myMediaPoster);
		}
		if($_type === 'audio')
		{
			return self::createAudioEl($myMediaSrc, $myMediaMime);
		}

		return null;
	}


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
		return self::createImgEl();
	}


	public static function createImgEl($_src, $_alt = null)
	{
		$imgEl = '<img';
		$imgEl .= ' loading="lazy"';
		$imgEl .= ' src="'. $_src. '"';
		if(!$_alt)
		{
			$_alt = 'image on Jibres';
		}
		// create srcset
		$imgEl .= ' alt="'. $_alt. '"';
		$imgEl .= '>';

		return $imgEl;
	}


}
?>