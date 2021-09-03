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
			$puzzle_type = $_args['puzzle']['puzzle_type'];

			if($puzzle_type === 'slider')
			{
				if(isset($_args['puzzle']['slider_type']) && $_args['puzzle']['slider_type'] === 'special')
				{
					return self::draw_special_slider($_args, $_data);
				}
				else
				{
					// simple
					return self::draw_simple_slider($_args, $_data);
				}
			}
			elseif($puzzle_type === 'rail')
			{
				return rail::draw($_args, $_data);
			}
			else
			{
				// puzzle mode
				return self::draw_puzzle($_args, $_data);
			}
		}
		else
		{
			// ? return null
		}

	}

	private static function draw_puzzle($_args, $_data)
	{

		$dataList = $_data;


		$html = '<section class="puzzle"';
		$html .= ' data-mode="'. a($_args, 'type'). '"';
		$html .= '>';
		{
			$spaceSize  = a($_args, 'padding', 'code');

			$radiusSize = a($_args, 'radius', 'code');

			$effectMode = a($_args, 'effect', 'code');


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
				$html .= self::everyItem($_args, $dataList);
			}
			$html .= '</div>';

		}
		$html .= '</section>';
		return $html;
	}


	private static function everyItem($_args, $_list)
	{
		$itemHtml = '';

		$infoPos  = a($_args, 'infoposition', 'code');

		foreach ($_list as $key => $value)
		{
			$myItem = '';
			$myPuzzle = \lib\pagebuilder\body\puzzle\puzzle::layout($key, $_args);
			$myItem .= '<div class="'. a($myPuzzle, 'class'). '">';
			{
				$playMode      = a($myPuzzle, 'playMode');

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
						$imgSrc = a($value, 'imageurl');
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

		$ratio = null; // need get ratio

		$html .= '<div class="jSlider1 mB10" data-slider data-slider-ratio="'. $ratio. '">';

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


	private static function el_special_item($_data)
	{
		$html = '';
		$html .= '<a class="roundedBox"';

		if(a($_data, 'url'))
		{
			$html .= ' href="'.  a($_data, 'url'). '"';
			if(a($_data, 0, 'target'))
			{
				$html .= ' target="_blank"';
			}
		}

		$html .= '>';

        $html .= '<figure class="overlay">';
		$html .= '<img src="'. a($_data, 'imageurl').'" alt="' . a($_data, 0, 'alt'). '">';
	    $html .= '<figcaption><h2>'. a($_data, 'alt'). '</h2></figcaption>';
        $html .= '</figure>';
        $html .= '</a>';

        return $html;
	}


	private static function draw_special_slider($_args, $_data)
	{
		if(count($_data) < 5)
		{
			return '';
		}

		$ratio = null; // need get ratio
		$html = '';

		$html .= '<div class="row">';
		{

			$html .= '<div class="c-xs-12 c-sm-12 c-lg-6">';
			{
		    	if(count($_data) === 5)
		    	{
		    		$html .= self::el_special_item($_data[0]);

		    		unset($_data[0]);
		    	}
		    	else
		    	{
		    		// count > 5
			    	$html .= '<div class="jSlider1" data-slider data-slider-ratio="'.$ratio. '">';

		    		$count_foreach = count($_data) - 4;
		    		$count = 0;

					foreach ($_data as $key => $value)
					{
						$count++;
						$html .= self::el_special_item($value);

					    unset($_data[$key]);
					    if($count >= $count_foreach)
					    {
					    	break;
					    }
					}
			  		$html .= '</div>';
		    	}

			}

	    	$html .= '</div>';

			$html .= '<div class="c-xs-12 c-sm-12 c-lg-6 ">';
			{
				$html .= '<div class="row">';

		        foreach ($_data as $key => $value)
		        {
			        $html .= '<div class="c-6">';
					$html .= self::el_special_item($value);
			        $html .= '</div>';
		        }

				$html .= '</div>';
			}
			$html .= '</div>';
		}
		$html .= '</div>';

		return $html;
	}
}
?>