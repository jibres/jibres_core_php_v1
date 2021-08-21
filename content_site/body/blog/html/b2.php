<?php
namespace content_site\body\blog\html;


class b2
{
	public static function html($_args, $_blogList)
	{
		$html             = '';

		// define variables
		// $previewMode = a($_args, 'preview_mode');
		$id               = a($_args, 'id');
		$type             = a($_args, 'type');
		$title_position   = a($_args, 'magicbox_title_position');
		$link_color       = a($_args, 'link_color');

		$coverRatio       = a($_args, 'coverratio:class');
		$borderRadius     = a($_args, 'radius:class');
		$font_class       = a($_args, 'font:class');
		$effect           = a($_args, 'effect');

		$height           = a($_args, 'height:class');
		$background_style = a($_args, 'background:full_style');
		$color_heading    = a($_args, 'color_heading:full_style');
		$section_id       = a($_args, 'secition:id');
		$heading_class    = a($_args, 'heading:class');

		$maskImg          = a($_args, 'image_mask:class');


		$totalExist = count($_blogList);
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
				if(a($_args, 'heading') !== null)
				{
					$html .= '<header>';
					{
						$html .= "<h2 class='text-3xl font-black leading-6 mb-5 $heading_class' $color_heading>";
						{
							$html .= a($_args, 'heading');
						}
						$html .= '</h2>';
					}
					$html .= '</header>';
				}


				$html .= "<div class='relative grid grid-cols-12 gap-4'>";
				{
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
						$card .= "<a data-magicbox='$effect' class='$gridCol relative flex w-full flex-col max-w-md mx-auto overflow-hidden' $myLinkHref>";
						{
							// thumb
							if($myThumb && a($_args, 'post_show_image'))
							{
								$pictureClass = 'block relative transition shadow-sm hover:shadow-md';
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
									$imgClass = 'block h-full w-full object-center object-cover overflow-hidden';
									if(a($_args, 'coverratio') === 'free')
									{
										$imgClass = 'block h-auto w-full overflow-hidden';
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
				}
				$html .= '</div>';

				$html .= \content_site\body\blog\share::btn_viewall($_args);

			}
			$html .= "</div>";
		}
		$html .= "</$cnElement>";



		return $html;
	}
}
?>