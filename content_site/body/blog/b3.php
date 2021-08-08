<?php
namespace content_site\body\blog;


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
		$background_style = \content_site\assemble\background::style($_args);
		$text_color       = \content_site\assemble\text_color::style($_args);
		$section_id       = \content_site\assemble\tools::section_id($type, $id);

		$backgroundAttr = null;
		if($background_style || $text_color)
		{
			$backgroundAttr = "style='$background_style $text_color'";
		}

		$onlyTextColorStyle = null;
		if($text_color)
		{
			$onlyTextColorStyle = "style='$text_color'";
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

		$html .= "<$cnElement data-type='$type' class='$classNames $font_class' $backgroundAttr $section_id>";
		{

			$html .= '<div class="divide-y divide-gray-200">';
			{
				$text_color    = \content_site\assemble\text_color::full_style($_args);
				$font_class    = \content_site\assemble\font::class($_args);

				if(a($_args, 'heading') !== null)
				{
					$html .= '<header>';
					{
						$heading_class = \content_site\options\heading::class_name($_args);

						$html .= "<div class='pt-6 pb-8 space-y-2 md:space-y-5' $onlyTextColorStyle>";
						{
							$html .= "<h2 class='text-3xl font-extrabold tracking-tight sm:text-4xl md:text-[4rem] md:leading-[3.5rem] $heading_class' $onlyTextColorStyle>";
							{
							 $html .= a($_args, 'heading');
							}
							$html .= '</h2>';
							// <p class="text-lg text-gray-500">All the latest Tailwind CSS news, straight from the team.</p>
						}
						$html .= '</div>';
					}
					$html .= '</header>';
				}


				$html .= '<ul class="divide-y divide-gray-200">';
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

						$html .= '<li class="py-12">';
						{
							$html .= "<article class='space-y-2 xl:grid xl:grid-cols-4 xl:space-y-0 xl:items-baseline' $onlyTextColorStyle>";
							{
								$html .= '<dl>';
								{
									$html .= '<dt class="sr-only">'. T_("Published on").'</dt>';
									$html .= '<dd class="text-base font-medium text-gray-500">';
									{
										$html .= "<time $onlyTextColorStyle datetime='$myDate'>";
										{
											$html .= \content_site\assemble\tools::date($myDate, a($_args, 'post_show_date'));
										}
										$html .= "</time>";
									}
									$html .= '</dd>';

								}
								$html .= '</dl>';

								$html .= '<div class="space-y-5 xl:col-span-3">';
								{

									$html .= '<div class="space-y-5">';
									{

										$html .= '<h3 class="text-2xl font-bold tracking-tight">';
										{
											$html .= "<a class='' $onlyTextColorStyle href='$myLink'>$myTitle</a>";
										}
										$html .= '</h3>';

										$html .= '<div class="prose max-w-none text-gray-500">';
										{

											$html .= '<div class="prose max-w-none">';
											{
												if($myExcerpt && a($_args, 'post_show_excerpt'))
												{
													$html .= "<p $onlyTextColorStyle>$myExcerpt</p>";
												}
											}
											$html .= '</div>';
										}
										$html .= '</div>';
									}
									$html .= '</div>';

									$html .= '<div class="text-base font-medium">';
									{
										$html .= "<a class='text-teal-600' href='$myLink'>Read more →</a>";
									}
									$html .= '</div>';
								}
								$html .= '</div>';
							}
							$html .= '</article>';
						}
						$html .= '</li>';

					} // endfor
				}
				$html .= '</ul>';
			}
			$html .= '</div>';
		}
		$html .= "</$cnElement>";


		return $html;
	}
}
?>