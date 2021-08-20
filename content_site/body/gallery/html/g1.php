<?php
namespace content_site\body\gallery\html;


class g1
{
	public static function html($_args, $_image_list)
	{
		$html             = '';

		// define variables
		// $previewMode = a($_args, 'preview_mode');
		$id               = a($_args, 'id');
		$type             = a($_args, 'type');
		$title_position   = a($_args, 'post_title_position');
		$link_color       = a($_args, 'link_color');

		$coverRatio       = a($_args, 'coverratio:class');
		$borderRadius     = a($_args, 'radius:class');
		$font_class       = a($_args, 'font:class');

		$height           = a($_args, 'height:class');
		$background_style = a($_args, 'background:full_style');
		$color_heading    = a($_args, 'color_heading:full_style');
		$section_id       = a($_args, 'secition:id');
		$heading_class    = a($_args, 'heading:class');

		$maskImg          = a($_args, 'image_mask:class');


		$totalExist = count($_image_list);
		$totalCount = a($_args, 'count');

		$containerMaxWidth = 'max-w-screen-lg w-full px-2 sm:px-4 lg:px-4';
		if($totalCount > 3)
		{
			$containerMaxWidth = 'max-w-screen-xl w-full px-2 sm:px-4 lg:px-4';
		}

		// element type
		$cnElement = 'div';
		if(a($_args, 'heading') !== null)
		{
			$cnElement = 'section';
		}
		$classNames = $height;
		if($font_class)
		{
			$classNames .= ' '. $font_class;
		}


		$html .= "<$cnElement data-type='$type' class='flex $classNames'$background_style $section_id>";
		{
			$html .= "<div class='$containerMaxWidth m-auto'>";
			{
				$html .= "<div class='relative grid grid-cols-12 gap-4'>";
				{
					foreach ($_image_list as $key => $value)
					{
						// a img
						// h3 a
						$myLinkHref   = "href='". a($value, 'link'). "'";
						$myTitle      = a($value, 'caption');
						$myThumb      = \dash\fit::img(a($value, 'image'), 780);

						// get grid class name by analyse
						$gridCol = \content_site\assemble\grid::className($totalCount, $totalExist, $key);

						$card = '';
						$card .= "<a data-magicbox='dark' class='$gridCol relative flex w-full flex-col max-w-md mx-auto overflow-hidden' $myLinkHref>";
						{

							$card .= "<picture class='block overflow-hidden transition shadow-sm hover:shadow-md $coverRatio $borderRadius $maskImg'>";
							{
								$card .= "<img loading='lazy' class='block h-full w-full object-center object-cover' src='#' data-src='$myThumb' alt='$myTitle'>";
							}
							$card .= "</picture>";

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
				}
				$html .= '</div>';

			}
			$html .= "</div>";
		}
		$html .= "</$cnElement>";



		return $html;
	}
}
?>