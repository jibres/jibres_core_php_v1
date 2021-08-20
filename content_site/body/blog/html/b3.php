<?php
namespace content_site\body\blog\html;


class b3
{
	public static function html($_args, $_blogList)
	{
		$html             = '';

		$id               = a($_args, 'id');
		$type             = a($_args, 'type');

		$link_color       = a($_args, 'link_color');
		$borderRadius     = a($_args, 'radius:class');
		$font_class       = a($_args, 'font:class');
		$height           = a($_args, 'height:class');
		$heading_class    = a($_args, 'heading:class');
		$background_style = a($_args, 'background:full_style');
		$color_heading    = a($_args, 'color_heading:full_style');
		$color_text       = a($_args, 'color_text:full_style');
		$section_id       = a($_args, 'secition:id');

		$totalExist = count($_blogList);

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


		$html .= "<$cnElement data-type='$type' class='body-font overflow-hidden $classNames'$background_style $section_id>";
		{
			$html .= '<div class="container pb-24 mx-auto">';
			{
				if(a($_args, 'heading') !== null)
				{
					$html .= '<header>';
					{
						$html .= "<h3 class='font-bold text-4xl mb-10 $heading_class $font_class' $color_heading>";
						{
							$html .= a($_args, 'heading');
						}
						$html .= '</h3>';
					}
					$html .= '</header>';
				}

				$html .= '<div class="-my-8 divide-y-2 divide-gray-100">';
				{

					foreach ($_blogList as $key => $value)
					{
						$myLink       = a($value, 'link');
						$myTitle      = a($value, 'title');
						$myThumb      = \dash\fit::img(a($value, 'thumb'), 460);
						$myExcerpt    = a($value, 'excerpt');
						$myDate       = a($value, 'publishdate');
						$myAuthorPage = a($value, 'authorpage');
						$writerName   = a($value, 'user_detail', 'displayname');

						$html .= '<div class="py-8 flex flex-wrap sm:flex-nowrap">';
						{

							$html .= '<div class="sm:w-64 sm:mb-0 mb-6 flex-shrink-0 flex flex-col">';
							{

								$html .= "<span class='font-semibold title-font' $color_text>";
								{
									$html .= \content_site\body\blog\share::post_reading_time(a($value, 'readingtime'), a($_args, 'post_show_readingtime'));
								}
								$html .= '</span>';

								if(a($_args, 'post_show_date'))
								{
									$html .= '<span class="text-sm ">';
									{
										if($myDate)
										{
											$ltrDate = 'ltr';
											if(a($_args, 'post_show_date') === 'relative')
											{
												$ltrDate = '';
											}
											$html .= "<time class=' text-2xs $ltrDate' datetime='$myDate' title='". T_("Published"). " $myDate' $color_text>";

											$html .= \content_site\body\blog\share::date($myDate, a($_args, 'post_show_date'));

											$html .= "</time>";
										}
									}
									$html .= '</span>';

								} // endif

							}
							$html .= '</div>';

							$html .= '<div class="sm:flex-grow">';
							{

								$html .= '<h2 class="text-2xl font-medium title-font mb-2" '.$color_text.'>'.$myTitle.'</h2>';

								if($myExcerpt && a($_args, 'post_show_excerpt'))
								{
									$html .= "<p class='leading-relaxed' $color_text>";
									$html .= $myExcerpt;
									$html .= "</p>";
								}

								if(a($_args, 'post_show_read_more'))
								{
									$html .= '<a href="'.$myLink.'" class="inline-flex items-center mt-4 link-'.$link_color.'">'.T_("Read more").'</a>';
								}

							}
							$html .= '</div>';
						}
						$html .= '</div>';

					} // endfor

				}
				$html .= '</div>';
			}
			$html .= '</div>';

			$html .= \content_site\body\blog\share::btn_viewall($_args);

		}
		$html .= "</$cnElement>";



		return $html;
	}
}
?>