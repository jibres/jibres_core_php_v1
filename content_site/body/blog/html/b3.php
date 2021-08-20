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

		$html .= "<$cnElement data-type='$type' class='overflow-hidden $classNames'$background_style $section_id>";
		{
			$containerClass = 'max-w-3xl mx-auto px-4 sm:px-6 xl:max-w-5xl xl:px-0';
			$html .= '<div class="'. $containerClass. '">';
			{
				if(a($_args, 'heading') !== null)
				{
					$html .= '<header class="pt-6 pb-8 space-y-2 md:space-y-5">';
					{
						$html .= "<h2 class='font-black text-4xl md:text-5xl lg:text-7xl $heading_class $font_class' $color_heading>";
						{
							$html .= a($_args, 'heading');
						}
						$html .= '</h2>';

						$html .= '<p class="text-lg text-gray-500">';
						{
							$html .= a($_args, 'description');
						}
						$html .= '</p>';

					}
					$html .= '</header>';
				}

				$html .= '<div class="divide-y divide-gray-200">';
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

						$eachItemClass = 'py-5 lg:py-12 space-y-2';

						if(a($_args, 'post_show_date'))
						{
							$eachItemClass = 'py-5 lg:py-12 space-y-2 lg:grid lg:grid-cols-4 lg:space-y-0 lg:items-baseline';
						}

						$html .= '<article class="'. $eachItemClass. '">';
						{
								if(a($_args, 'post_show_date'))
								{
									$html .= "<dl>";
									{
										$html .= '<dt class="sr-only">'. T_('Published on'). '</dt>';
										$html .= '<dt class="text-base font-medium"'. $color_text. '>';
										{
												$ltrDate = 'ltr';
												if(a($_args, 'post_show_date') === 'relative')
												{
													$ltrDate = '';
												}
												$html .= "<time class='$ltrDate' datetime='$myDate' title='". T_("Published"). " $myDate' $color_text>";
												$html .= \content_site\body\blog\share::date($myDate, a($_args, 'post_show_date'));
												$html .= "</time>";
										}
										$html .= '</dt>';
									}
									$html .= '</dl>';
								}

							$html .= '<div class="sm:mb-0 mb-6 flex-shrink-0 flex flex-col">';
							{
							}
							$html .= '</div>';

							$html .= '<div class="sm:flex-grow">';
							{

								$html .= '<h3 class="text-2xl font-medium title-font mb-2" '.$color_text.'>'.$myTitle.'</h3>';

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
						$html .= '</article>';

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