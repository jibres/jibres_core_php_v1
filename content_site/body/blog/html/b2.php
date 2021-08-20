<?php
namespace content_site\body\blog\html;


class b2
{
	public static function html($_args, $_blogList)
	{
		$html             = '';

		// define variables
		// $previewMode = a($_args, 'preview_mode');
		$id             = a($_args, 'id');
		$type           = a($_args, 'type');
		$title_position = a($_args, 'post_title_position');
		$link_color     = a($_args, 'link_color');
		$borderRadius     = \content_site\options\radius::class_name(a($_args, 'radius'));
		$coverRatio     = \content_site\options\coverratio::get_class(a($_args, 'coverratio'));
		$font_class     = \content_site\assemble\font::class($_args);
		// $type        = 'b1';

		$height           = \content_site\options\height::class_name(a($_args, 'height'));
		$background_style = \content_site\assemble\background::full_style($_args);
		$text_color       = \content_site\assemble\text_color::full_style($_args);
		$section_id       = \content_site\assemble\tools::section_id($type, $id);

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
						$heading_class = \content_site\options\heading\heading_full::class_name($_args);

						$html .= "<h2 class='text-3xl font-black leading-6 mb-5 $heading_class' $text_color>";
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
						$gridCol = \content_site\grid\analyze::className($totalCount, $totalExist, $key);

						$card = '';
						$card .= "<a data-magicbox='dark' class='$gridCol relative flex w-full flex-col max-w-md mx-auto overflow-hidden $borderRadius' $myLinkHref>";
						{
							// thumb
							if($myThumb && a($_args, 'post_show_image'))
							{
								$card .= "<picture class='block overflow-hidden transition shadow-sm hover:shadow-md $coverRatio $borderRadius'>";
								{
									$card .= "<img loading='lazy' class='block h-full w-full object-center object-cover' src='#' data-src='$myThumb' alt='$myTitle'>";
								}
								$card .= "</picture>";
							}

							if($title_position === 'inside')
							{
								// title
								$card .= "<h3 class='absolute inset-x-0 bottom-0 block leading-7 transition text-white px-4 py-2 line-clamp-3 z-10'>";
								{
									$card .= $myTitle;
								}
								$card .= '</h3>';
							}
							elseif($title_position === 'outside')
							{
								// title
								$card .= "<h3 class='block leading-7 transition text-white px-4 py-2 line-clamp-3 z-10 $link_color'>";
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

				$html .= \content_site\assemble\blog::btn_viewall($_args);

			}
			$html .= "</div>";
		}
		$html .= "</$cnElement>";



		return $html;
	}
}
?>