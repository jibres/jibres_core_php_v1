<?php
namespace content_site\assemble\element;


class magicbox
{
	public static function html($_args, $_image_list)
	{
		$html = '';

		foreach ($_blogList as $key => $value)
		{
			// a img
			// h3 a
			$myLinkHref   = "href='". a($value, 'link'). "'";
			$myTitle      = a($value, 'title');
			$myThumb      = \dash\fit::img(a($value, 'thumb'), 780);

			// get grid class name by analyse
			$gridCol = \content_site\assemble\grid::className($totalCount, $totalExist, $key);

			$card = '';
			$card .= "<a data-magicbox='$effect' class='$gridCol flex flex-col max-w-md' $myLinkHref>";
			{
				// thumb
				if($myThumb && a($_args, 'post_show_image'))
				{
					$pictureClass = 'transition shadow-sm hover:shadow-md';
					if($coverRatio)
					{
						$pictureClass .= ' '. $coverRatio;
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
				$linkColorClass = 'link-'. $link_color;
				$linkAlign = '';
				if($borderRadius === 'rounded-full')
				{
					$linkAlign = 'text-center';
				}
				elseif($maskImg)
				{
					$linkAlign = 'text-center';
				}

				if($title_position === 'inside')
				{
					// title
					$card .= "<h3 class='absolute inset-x-0 bottom-0 block $linkColorClass leading-7 transition text-white px-4 py-2 line-clamp-3 z-10 $linkAlign'>";
					{
						$card .= $myTitle;
					}
					$card .= '</h3>';
				}
				elseif($title_position === 'outside')
				{
					// title
					$card .= "<h3 class='block $linkColorClass leading-7 transition text-white px-4 py-2 line-clamp-3 z-10 $linkAlign'>";
					{
						$card .= $myTitle;
					}
					$card .= '</h3>';
				}

			}
			$card .= '</a>';


			// save card
			$html .= $card;
		}

		return $html;
	}
}
?>