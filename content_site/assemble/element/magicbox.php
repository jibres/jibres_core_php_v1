<?php
namespace content_site\assemble\element;


class magicbox
{
	public static function html($_args, $_image_list)
	{
		$html = '';

		foreach ($_image_list as $key => $value)
		{
			$myTitle      = a($value, 'title');
			$borderRadius = a($_args, 'radius:class');
			$effect       = a($_args, 'effect');
			$maskImg      = a($_args, 'image_mask:class');

			if(!a($value, 'file'))
			{
				$value['file'] = \dash\sample\img::image();
			}

			$myThumb      = \lib\filepath::fix(\dash\fit::img(a($value, 'file'), 'raw'));

			$myMagicBoxEl = 'div';
			$myLinkHref   = '';
			if(a($value, 'link'))
			{
				$myLinkHref   = "href='". a($value, 'link'). "'";
				$myMagicBoxEl = 'a';
			}

			$card = '';
			$card .= "<$myMagicBoxEl data-magicbox='$effect' $myLinkHref>";
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

			$html .= $card;
		}

		return $html;
	}
}
?>