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
		else
		{
			$file_index = 'file';
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

		$card = '';
		$magicBoxExtraAttr = '';
		$sliderLazyLoad = false;
		if($_opt === 'blog' || $_opt === 'product')
		{
			// get grid class name by analyze
			$gridCol = \content_site\assemble\grid::className(a($_args, 'count'), count($_datalist), $_key);
			$magicBoxExtraAttr = "class='$gridCol flex flex-col max-w-md'";
		}
		elseif(is_array($_opt))
		{
			if(isset($_opt['type']) && $_opt['type'] === 'slider')
			{
				// enable lazy load
				$sliderLazyLoad = true;
				if(isset($_opt['attr']))
				{
					// add attr to element
					$magicBoxExtraAttr = $_opt['attr'];
				}
			}
			if(isset($_opt[$_key]))
			{
				$magicBoxExtraAttr = "class='". $_opt[$_key]. "'";
			}
		}
		elseif($_opt)
		{
			$magicBoxExtraAttr = $_opt;
		}

		$card .= "<$myMagicBoxEl data-magicbox='$effect' $myLinkHref $magicBoxExtraAttr>";
		{
			// thumb
			// if($myThumb && a($_args, 'post_show_image'))
			{
				$mediaBoxClass = 'transition shadow-sm hover:shadow-md';
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

				$mediaElementType = 'picture';

				if(a($_item, 'file_detail', 'type') !== 'image')
				{
					$mediaElementType = 'div';
				}

				$card .= "<$mediaElementType class='$mediaBoxClass'>";
				{

					$imgClass = 'object-cover w-full';
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
						$card .= "<video controls class='$imgClass'>";

						$card .= "<source src='$myThumb' type='". a($_item, 'file_detail', 'mime'). "'>";
						$card .= "</video>";
					}
					else
					{
						// use data-src for lazyload
						if($sliderLazyLoad)
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
				if(a($_args, 'magicbox_title_position') === 'inside')
				{
					$card .= "<div class='absolute inset-x-0 bottom-0 block px-4 py-2 z-10 transition $linkColorClass $linkAlign'>";
					{
						if($showTitle)
						{
							// title
							$card .= "<h3 class='leading-7 line-clamp-3'>";
							{
								$card .= $myTitle;
							}
							$card .= '</h3>';
						}

						if($showPrice)
						{
							$card .= \content_site\assemble\wrench\price::simple1($_item);
						}
					}
					$card .= '</div>';
				}
				elseif(a($_args, 'magicbox_title_position') === 'outside')
				{
					$card .= "<div class='block $linkColorClass transition text-white px-4 py-2 z-10 $linkAlign'>";
					{
						if($showTitle)
						{
							// title
							$card .= "<h3 class='leading-7 line-clamp-3'>";
							{
								$card .= $myTitle;
							}
							$card .= '</h3>';
						}

						if($showPrice)
						{
							$card .= \content_site\assemble\wrench\price::simple1($_item);
						}
					}
					$card .= '</div>';
				}
			}

		}
		$card .= "</$myMagicBoxEl>";

		return $card;
	}

}
?>