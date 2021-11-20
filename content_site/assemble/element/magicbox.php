<?php
namespace content_site\assemble\element;


class magicbox
{
	public static function html($_args, $_datalist, $_opt = null)
	{
		$html = '';

		foreach ($_datalist as $key => $item)
		{
			$html .= self::eachItem($_args, $_datalist, $_opt, $key, $item);
		}

		return $html;
	}


	public static function eachItem($_args, $_datalist, $_opt, $_key, $_item)
	{
		$myTitle      = a($_item, 'title');
		$borderRadius = a($_args, 'radius:class');
		$effect       = a($_args, 'effect');
		$maskImg      = a($_args, 'image_mask:class');

		$file_index = 'file';
		$link_index = 'url';

		if(a($_args, 'section') === 'blog')
		{
			$file_index = 'thumb';
			$link_index = 'link';
		}
		elseif(a($_args, 'section') === 'product')
		{
			$file_index = 'thumb';
			$link_index = 'url';
		}

		if(!a($_item, $file_index))
		{
			$_item[$file_index] = \dash\sample\img::image();
		}

		$myThumb      = \lib\filepath::fix(\dash\fit::img(a($_item, $file_index), 'raw'));

		$myMagicBoxEl = 'div';
		$myLinkHref   = '';
		if(a($_item, $link_index))
		{
			$myLinkHref   = "href='". a($_item, $link_index). "'";
			$myMagicBoxEl = 'a';
		}


		// new way to get parent element class, attr and some other details
		$elAttr       = '';
		$elClass      = '';
		$insideSlider = null;

		// enable lazyload inside slider
		if(a($_opt, 'slider') === true)
		{
			$insideSlider = true;
			// do nothing
		}
		else if(a($_opt, 'grid'))
		{
			// get grid class name by analyze
			$elClass = 'flex flex-col max-w-md';
			$elClass .= ' '. \content_site\assemble\grid::className(a($_args, 'count'), count($_datalist), $_key);
		}

		if(a($_opt, 'class'))
		{
			if($elClass)
			{
				$elClass .= ' ';
			}
			// if array passed, use for each key, else use one string for all
			if(is_array($_opt['class']))
			{
				if(a($_opt, 'class', $_key))
				{
					$elClass .= a($_opt, 'class', $_key);
				}
			}
			else
			{
				$elClass .= a($_opt, 'class');
			}
		}
		if($elClass)
		{
			$elClass = 'class="'. $elClass. '"';
		}

		if(a($_opt, 'attr'))
		{
			if($elAttr)
			{
				$elAttr .= ' ';
			}
			$elAttr = a($_opt, 'attr');
		}


		$elementTag = '<'. $myMagicBoxEl. ' data-magicbox="'. $effect. '"';
		if($myLinkHref)
		{
			$elementTag .= ' '. $myLinkHref;
		}
		if($elClass)
		{
			$elementTag .= ' '. $elClass;
		}
		// add playing mode for autoplay video
		// if(a($_item, 'video_autoplay'))
		if(a($_item, 'video_autoplay') && a($_item, 'video_muted'))
		{
			$elementTag .= ' data-playing="play"';
		}
		$elementTag .= '>';

		$card = $elementTag;
		{
			// thumb
			// if($myThumb && a($_args, 'post_show_image'))
			{
				$mediaBoxClass = 'transition relative shadow-sm hover:shadow-md';
				if(a($_args, 'coverratio:class'))
				{
					$mediaBoxClass .= ' '. a($_args, 'coverratio:class');
				}
				if($maskImg)
				{
					$mediaBoxClass .= ' '. $maskImg;
				}
				if($borderRadius)
				{
					$mediaBoxClass .= ' '. $borderRadius;
				}
				if($effect !== 'zoom')
				{
					$mediaBoxClass .= ' overflow-hidden';
				}
				if(a($_opt, 'mediaBoxClass'))
				{
					$mediaBoxClass .= ' '. a($_opt, 'mediaBoxClass');
				}

				$mediaElementType = 'picture';

				if(a($_item, 'file_detail', 'type') === 'video')
				{
					$mediaElementType = 'div';
				}

				$card .= "<$mediaElementType class='$mediaBoxClass'>";
				{

					$imgClass = 'object-cover w-full h-full overflow-hidden';
					if(a($_args, 'coverratio') === 'free')
					{
						$imgClass = 'h-auto w-full';
					}
					if($borderRadius)
					{
						$imgClass .= ' '. $borderRadius;
					}

					if(a($_item, 'file_detail', 'type') === 'video')
					{
						$video_args          = $_item;
						$video_args['src']   = \lib\filepath::fix(a($_item, $file_index), 'raw');
						$video_args['class'] = $imgClass;
						$video_args['videoFrameClass'] = $imgClass;

						$card .= video::html($video_args);
					}
					else
					{
						// use data-src for lazyload
						if($insideSlider)
						{
							$card .= "<img loading='lazy' class='swiper-lazy $imgClass' src='#' data-src='$myThumb' alt='$myTitle'>";
							$card .= '<div class="swiper-lazy-preloader"></div>';
						}
						else
						{
							$card .= "<img loading='lazy' class='$imgClass' src='#' data-src='$myThumb' alt='$myTitle'>";
						}
					}
				}
				$card .= "</$mediaElementType>";
			}
			$linkColorClass = 'link-'. a($_args, 'link_color');
			$linkAlign = '';
			if($borderRadius === 'rounded-full')
			{
				$linkAlign = 'text-center';
			}
			elseif($maskImg)
			{
				$linkAlign = 'text-center';
			}

			// decide to show title or not
			$showTitle = null;
			$showPrice = null;
			if(a($_args, 'product_show_title') !== false)
			{
				$showTitle = true;
			}
			if(a($_args, 'product_show_price') === true)
			{
				$showPrice = true;
			}
			// show
			$showCaptionBox = null;
			if($showTitle || $showPrice)
			{
				$showCaptionBox = true;
			}

			if($showCaptionBox)
			{
				$cardClass = '';
				if($linkColorClass)
				{
					$cardClass .= $linkColorClass;
				}

				if($linkAlign)
				{
					$cardClass .= ' '. $linkAlign;
				}

				switch (a($_args, 'slider_size'))
				{
					case 'sm':
					case 'md':
						$cardClass .= ' text-xs';
						break;

					case 'lg':
					case 'xl':
						$cardClass .= ' text-sm';
						break;

					default:
						break;
				}

				if(a($_args, 'magicbox_title_position') === 'inside')
				{
					if(a($_item, 'video_controls'))
					{
						$cardClass .= ' top-0';
					}
					else
					{
						$cardClass .= ' bottom-0';
					}
					$card .= "<div data-magic-caption class='absolute flex align-center inset-x-0 block px-4 py-2 z-10 transition $cardClass'>";
					{
						$card .= self::htmlCaptionBox($_item, $showTitle, $showPrice);
					}
					$card .= '</div>';
				}
				elseif(a($_args, 'magicbox_title_position') === 'outside')
				{
					$card .= "<div class='block transition text-white px-4 py-2 z-10 $cardClass'>";
					{
						$card .= self::htmlCaptionBox($_item, $showTitle, $showPrice);
					}
					$card .= '</div>';
				}
			}

		}
		$card .= "</$myMagicBoxEl>";

		return $card;
	}


	private static function htmlCaptionBox($_itemData, $_showTitle = null, $_showPrice = null)
	{
		$myTitle   = a($_itemData, 'title');
		$myDesc    = a($_itemData, 'desc');
		$myBtnText = a($_itemData, 'btn_title');

		$html = '';

		// title
		$html .= "<div class='flex-grow'>";
		{
			if($_showTitle)
			{
				if($myTitle)
				{
					$titleClass = 'leading-7 line-clamp-3 font-bold';
					if($myDesc)
					{
						$titleClass .= ' text-xl';
					}
					// show title
					$html .= "<h3 class='". $titleClass. "'>";
					{
						$html .= $myTitle;
					}
					$html .= '</h3>';
				}
				// show desc
				if($myDesc)
				{
					$html .= "<p class='leading-7 line-clamp-3 text-sm'>";
					{
						$html .= $myDesc;
					}
					$html .= '</p>';
				}
			}

			// show price line
			if($_showPrice)
			{
				$html .= \content_site\assemble\wrench\price::simple1($_itemData);
			}
		}
		$html .= '</div>';

		// show btn
		if($myBtnText)
		{
			$html .= "<div class='leading-7 line-clamp-1 text-sm'>";
			{
				$html .= $myBtnText;
			}
			$html .= '</div>';
		}

		if(a($_itemData, 'file_detail', 'type') === 'video')
		{
			$html .= '<div data-duration class="flex-none bg-gray-800 rounded px-1"></div>';
		}

		return $html;
	}
}
?>