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
		}
		else
		{
			$file_index = 'file';
		}

		if(!a($_item, $file_index))
		{
			$_item[$file_index] = \dash\sample\img::image();
		}

		$myThumb      = \lib\filepath::fix(\dash\fit::img(a($_item, $file_index), 'raw'));

		$myMagicBoxEl = 'div';
		$myLinkHref   = '';
		if(a($_item, 'link'))
		{
			$myLinkHref   = "href='". a($_item, 'link'). "'";
			$myMagicBoxEl = 'a';
		}

		$card = '';
		$magicBoxClass = '';
		if($_magicModel === 'blog')
		{
			// get grid class name by analyze
			$gridCol = \content_site\assemble\grid::className(a($_args, 'count'), count($_datalist), $_key);
			$magicBoxClass = "class='$gridCol flex flex-col max-w-md'";
		}
		elseif(is_array($_magicModel))
		{
			if(isset($_magicModel[$_key]))
			{
				$magicBoxClass = "class='". $_magicModel[$_key]. "'";
			}
		}

		$card .= "<$myMagicBoxEl data-magicbox='$effect' $myLinkHref $magicBoxClass>";
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
					$card .= "<img loading='lazy' class='$imgClass' src='#' data-src='$myThumb' alt='$myTitle'>";
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
				// title
				$card .= "<h3 class='absolute inset-x-0 bottom-0 block $linkColorClass leading-7 transition text-white px-4 py-2 line-clamp-3 z-10 $linkAlign'>";
				{
					$card .= $myTitle;
				}
				$card .= '</h3>';
			}
			elseif(a($_args, 'magicbox_title_position') === 'outside')
			{
				// title
				$card .= "<h3 class='block $linkColorClass leading-7 transition text-white px-4 py-2 line-clamp-3 z-10 $linkAlign'>";
				{
					$card .= $myTitle;
				}
				$card .= '</h3>';
			}

		}
		$card .= "</$myMagicBoxEl>";

		return $card;
	}

}
?>