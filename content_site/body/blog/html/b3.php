<?php
namespace content_site\body\blog\html;


class b3
{
	public static function html($_args, $_blogList)
	{
		$html             = '';

		$id          = a($_args, 'id');
		$type        = a($_args, 'type');

		$coverRatio  = \content_site\options\coverratio::get_class(a($_args, 'coverratio'));
		$font_class  = \content_site\assemble\font::class($_args);


		$height           = \content_site\options\height::class_name(a($_args, 'height'));
		$background_style = \content_site\assemble\background::full_style($_args);
		$text_color       = \content_site\assemble\text_color::full_style($_args);
		$section_id       = \content_site\assemble\tools::section_id($type, $id);


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
						$heading_class = \content_site\options\heading\heading_full::class_name($_args);

						$html .= "<h3 class='font-bold text-4xl mb-10 $heading_class $font_class' $text_color>";
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
						$myLink      = a($value, 'link');
						$myTitle     = a($value, 'title');
						$myThumb     = \dash\fit::img(a($value, 'thumb'), 460);
						$myExcerpt   = a($value, 'excerpt');
						$myDate      = a($value, 'publishdate');
						$myAuthorPage = a($value, 'authorpage');
						$writerName = a($value, 'user_detail', 'displayname');

						$html .= '<div class="py-8 flex flex-wrap sm:flex-nowrap">';
						{

							$html .= '<div class="sm:w-64 sm:mb-0 mb-6 flex-shrink-0 flex flex-col">';
							{

								$html .= '<span class="font-semibold title-font text-gray-700">';
								{
									$html .= \content_site\assemble\tools::post_reading_time(a($value, 'readingtime'), a($_args, 'post_show_readingtime'));
								}
								$html .= '</span>';

								if(a($_args, 'post_show_date'))
								{
									$html .= '<span class="text-sm text-gray-500">';
									{
										if($myDate)
										{
											$ltrDate = 'ltr';
											if(a($_args, 'post_show_date') === 'relative')
											{
												$ltrDate = '';
											}
											$html .= "<time class='text-gray-600 text-2xs $ltrDate' datetime='$myDate' title='". T_("Published"). " $myDate'>";

											$html .= \content_site\assemble\tools::date($myDate, a($_args, 'post_show_date'));

											$html .= "</time>";
										}
									}
									$html .= '</span>';

								} // endif

							}
							$html .= '</div>';

							$html .= '<div class="sm:flex-grow">';
							{

								$html .= '<h2 class="text-2xl font-medium text-gray-900 title-font mb-2">'.$myTitle.'</h2>';

								if($myExcerpt && a($_args, 'post_show_excerpt'))
								{
									$html .= "<p class='leading-relaxed'>";
									$html .= $myExcerpt;
									$html .= "</p>";
								}

								$html .= '<a href="'.$myLink.'" class="text-indigo-500 inline-flex items-center mt-4">'.T_("Read more").'</a>';
							}
							$html .= '</div>';
						}
						$html .= '</div>';

					} // endfor

				}
				$html .= '</div>';
			}
			$html .= '</div>';

			$html .= \content_site\assemble\blog::btn_viewall($_args);

		}
		$html .= "</$cnElement>";



		return $html;
	}
}
?>