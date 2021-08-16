<?php
namespace content_site\body\blog\html;


class b2
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

		$html .= "<$cnElement data-type='$type' class='body-font $classNames'$background_style $section_id>";
		{
			$html .= '<div class="container mx-auto">';
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

				$html .= '<div class="flex flex-wrap -mx-4 -my-8 pb-24">';
				{
					foreach ($_blogList as $key => $value)
					{
						// a img
						// h2 a
						$myLink      = a($value, 'link');
						$myTitle     = a($value, 'title');
						$myThumb     = \dash\fit::img(a($value, 'thumb'), 460);
						$myExcerpt   = a($value, 'excerpt');
						$myDate      = a($value, 'publishdate');
						$myAuthorPage = a($value, 'authorpage');
						$writerName = a($value, 'user_detail', 'displayname');

						$html .= '<div class="py-8 px-4 lg:w-1/3">';
						{
							$html .= '<div class="h-full flex items-start">';
							{
								$html .= '<div class="w-12 flex-shrink-0 flex flex-col text-center leading-none">';
								{
									$html .= '<span class="text-gray-500 pb-2 mb-2 border-b-2 border-gray-200">'.\dash\fit::date($myDate, 'F').'</span>';
									$html .= '<span class="font-medium text-lg text-gray-800 title-font leading-none">'.\dash\fit::date($myDate, 'd').'</span>';
								}

								$html .= '</div>';

								$html .= '<div class="flex-grow pl-6 pr-6">';
								{
									$html .= '<h3 class="tracking-widest text-xs title-font font-medium text-indigo-500 mb-1">';
									{
										$html .= \content_site\assemble\tools::post_reading_time(a($value, 'readingtime'), a($_args, 'post_show_readingtime'));
									}
									$html .= '</h3>';

									$html .= '<h2 class="title-font text-xl font-medium text-gray-900 mb-3">';
									{
										$html .= '<a href="'. $myLink. '">';
										{
											$html .= $myTitle;
										}
										$html .= '</a>';
									}

									$html .= '</h2>';

									$html .= '<p class="leading-relaxed mb-5">';
									{
										if($myExcerpt && a($_args, 'post_show_excerpt'))
										{
											$html .= $myExcerpt;
										}
									}
									$html .= '</p>';

									// add footer line
									if(a($_args, 'post_show_author'))
									{

										$html .= '<a class="inline-flex items-center" href="'.$myAuthorPage.'">';
										{
											$html .= "<img loading='lazy' src='#' data-src='". \dash\fit::img(a($value, 'user_detail', 'avatar')). "' alt='$writerName' class='w-8 h-8 rounded-full flex-shrink-0 object-cover object-center'>";


										  $html .= '<span class="flex-grow flex flex-col pl-3 pr-3">';
										  {
											$html .= '<span class="title-font font-medium text-gray-900">'.$writerName.'</span>';
										  }
										  $html .= '</span>';

										}
										$html .= '</a>';
									}
								}
								$html .= '</div>';
							}
							$html .= '</div>';
						}
						$html .= '</div>';

					} // endfor
				}
				$html .= '</div>';

				$html .= \content_site\assemble\blog::btn_viewall($_args);
			}
			$html .= '</div>';
		}
		$html .= "</$cnElement>";

		return $html;
	}
}
?>