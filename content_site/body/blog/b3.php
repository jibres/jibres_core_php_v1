<?php
namespace content_site\body\blog;


class b3
{
	public static function html($_args, $_blogList)
	{

		$html             = '';

		$html .= '<div class="avand-xl">';
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

						$html .= '<div class="pt-6 pb-8 space-y-2 md:space-y-5">';
						{
							$html .= '<h2 class="text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl md:text-[4rem] md:leading-[3.5rem]">'. a($_args, 'heading'). '</h2>';
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
							$html .= '<article class="space-y-2 xl:grid xl:grid-cols-4 xl:space-y-0 xl:items-baseline">';
							{
								$html .= '<dl>';
								{
									$html .= '<dt class="sr-only">'. T_("Published on").'</dt>';
									$html .= '<dd class="text-base font-medium text-gray-500">';
									{
										$html .= "<time datetime='$myDate'>".\dash\fit::date($myDate, 'readable')."</time>";
									}
									$html .= '</dd>';

								}
								$html .= '</dl>';

								$html .= '<div class="space-y-5 xl:col-span-3">';
								{

									$html .= '<div class="space-y-6">';
									{

										$html .= '<h3 class="text-2xl font-bold tracking-tight">';
										{
											$html .= "<a class='text-gray-900' href='$myLink'>$myTitle</a>";
										}
										$html .= '</h3>';

										$html .= '<div class="prose max-w-none text-gray-500">';
										{

											$html .= '<div class="prose max-w-none">';
											{
												if($myExcerpt && a($_args, 'post_show_excerpt'))
												{
													$html .= "<p>$myExcerpt</p>";
												}
											}
											$html .= '</div>';
										}
										$html .= '</div>';
									}
									$html .= '</div>';

									$html .= '<div class="text-base font-medium">';
									{
										$html .= "<a class='text-teal-600 hover:text-teal-700' href='$myLink'>Read more →</a>";
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
		$html .= '</div>';

		return $html;
	}
}
?>