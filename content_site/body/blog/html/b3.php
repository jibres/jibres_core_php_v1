<?php
namespace content_site\body\blog\html;


class b3
{
	public static function html($_args, $_blogList)
	{
		$color_heading    = a($_args, 'color_heading:full_style');
		$color_text       = a($_args, 'color_text:full_style');

		$html = \content_site\assemble\wrench\section::element_start($_args);
		{
			$containerClass = 'max-w-3xl w-full m-auto px-4 sm:px-6 xl:max-w-5xl xl:px-0 divide-y divide-gray-200';
			$html .= '<div class="'. $containerClass. '">';
			{
				if(a($_args, 'heading') !== null)
				{
					$html .= '<header class="pt-6 pb-8 space-y-2">';
					{
						$heading_class    = a($_args, 'heading:class');
						$html .= "<h2 class='font-bold text-4xl md:text-5xl lg:text-6xl $heading_class' $color_heading>";
						{
							$html .= a($_args, 'heading');
						}
						$html .= '</h2>';

						$html .= '<p class="text-xl opacity-60"'.$color_text.'>';
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
						$postTextClass = 'space-y-2';

						if(a($_args, 'post_show_date') !== 'no')
						{
							$eachItemClass = 'py-5 lg:py-12 space-y-2 lg:grid lg:grid-cols-4 lg:space-y-0 lg:items-baseline';
							$postTextClass = 'space-y-2 lg:col-span-3';
						}

						$html .= '<article class="'. $eachItemClass. '">';
						{
								if(a($_args, 'post_show_date') !== 'no')
								{
									$html .= "<dl>";
									{
										$html .= '<dt class="sr-only">'. T_('Published on'). '</dt>';
										$html .= '<dd class="text-base font-medium">';
										{
												$ltrDate = 'ltr';
												if(a($_args, 'post_show_date') === 'relative')
												{
													$ltrDate = '';
												}
												$html .= "<time class='$ltrDate opacity-80' datetime='$myDate' title='". T_("Published"). " $myDate' $color_text>";
												$html .= \content_site\body\blog\share::date($myDate, a($_args, 'post_show_date'));
												$html .= "</time>";
										}
										$html .= '</dd>';
									}
									$html .= '</dl>';
								}

							$html .= "<div class='$postTextClass'>";
							{
								$html .= '<h3 class="text-xl font-bold">';
								$html .= '<a href="'.$myLink.'" class="inline-flex items-center"'. $color_heading. '>'. $myTitle. '</a>';
								$html .= '</h3>';

								if($myExcerpt && a($_args, 'post_show_excerpt'))
								{
									$html .= "<p class='leading-7' $color_text>";
									$html .= $myExcerpt;
									$html .= "</p>";
								}

								if(a($_args, 'post_show_read_more'))
								{
									$html .= "<div class='text-base font-medium'>";
									$html .= '<a href="'.$myLink.'" class="inline-flex items-center opacity-70 link-'. a($_args, 'link_color').'">'.T_("Read more").'</a>';
									$html .= "</div>";
								}

							}
							$html .= '</div>';
						}
						$html .= '</article>';
					} // endfor
				}
				$html .= '</div>';

				$html .= \content_site\body\blog\share::btn_viewall($_args);
			}
			$html .= '</div>';
		}
		$html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}
}
?>