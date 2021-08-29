<?php
namespace content_site\assemble\element;


class magicbox
{
	public static function html($_args, $_datalist, $_magicModel = null)
	{
		$html = '';

		foreach ($_datalist as $key => $item)
		{
			$html .= self::eachItem($_args, $_datalist, $_magicModel, $key, $item);
		}

		return $html;
	}


	public static function eachItem($_args, $_datalist, $_magicModel, $_key, $_item)
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
		if($_magicModel === 'blog' || $_magicModel === 'product')
		{
			// get grid class name by analyze
			$gridCol = \content_site\assemble\grid::className(a($_args, 'count'), count($_datalist), $_key);
			$magicBoxExtraAttr = "class='$gridCol flex flex-col max-w-md'";
		}
		elseif($_magicModel === 'slider')
		{
			$magicBoxExtraAttr = "class='swiper-slide'";
		}
		elseif(is_array($_magicModel))
		{
			if(isset($_magicModel['type']) && $_magicModel['type'] === 'slider')
			{
				// enable lazy load
				$sliderLazyLoad = true;
				if(isset($_magicModel['attr']))
				{
					// add attr to element
					$magicBoxExtraAttr = $_magicModel['attr'];
				}
			}
			if(isset($_magicModel[$_key]))
			{
				$magicBoxExtraAttr = "class='". $_magicModel[$_key]. "'";
			}
		}
		elseif($_magicModel)
		{
			$magicBoxExtraAttr = $_magicModel;
		}

		$card .= "<$myMagicBoxEl data-magicbox='$effect' $myLinkHref $magicBoxExtraAttr>";
		{
			// thumb
			// if($myThumb && a($_args, 'post_show_image'))
			{
				$pictureClass = 'transition shadow-sm hover:shadow-md';
				if(a($_args, 'coverratio:class'))
				{
					$pictureClass .= ' '. a($_args, 'coverratio:class');
				}
				if($maskImg)
				{
					$pictureClass .= ' '. $maskImg;
				}
				if($borderRadius)
				{
					$pictureClass .= ' '. $borderRadius;
				}
				if($effect !== 'zoom')
				{
					$pictureClass .= ' overflow-hidden';
				}

				$card .= "<picture class='$pictureClass'>";
				{
					$imgClass = 'object-cover';
					if(a($_args, 'coverratio') === 'free')
					{
						$imgClass = 'h-auto';
					}
					if($borderRadius)
					{
						$imgClass .= ' '. $borderRadius;
					}
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
				$card .= "</picture>";
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

			if(a($_args, 'magicbox_title_position') === 'inside')
			{
				$card .= "<div class='absolute inset-x-0 bottom-0 block px-4 py-2 z-10 transition $linkColorClass $linkAlign'>";
				{
					if(a($_args, 'product_show_title') !== false)
					{
						// title
						$card .= "<h3 class='leading-7 line-clamp-3'>";
						{
							$card .= $myTitle;
						}
						$card .= '</h3>';
					}

					if(a($_args, 'product_show_price'))
					{
						$card .= \content_site\assemble\wrench\price::simple1($_item);
					}
				}
				$card .= '</div>';
			}
			elseif(a($_args, 'magicbox_title_position') === 'outside')
			{
				$card .= "<h3 class='block $linkColorClass transition text-white px-4 py-2 z-10 $linkAlign'>";
				{
					if(a($_args, 'product_show_title') !== false)
					{
						// title
						$card .= "<h3 class='leading-7 line-clamp-3'>";
						{
							$card .= $myTitle;
						}
						$card .= '</h3>';
					}

					if(a($_args, 'product_show_price'))
					{
						$card .= \content_site\assemble\wrench\price::simple1($_item);
					}
				}

			}

		}
		$card .= "</$myMagicBoxEl>";

		return $card;
	}

}
?>