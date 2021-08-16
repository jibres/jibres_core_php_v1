<?php
namespace content_site\body\blog\html;


class b6
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


		$html .= "<$cnElement data-type='$type' class='$classNames'$background_style $section_id>";
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

			$html .= '<section class="text-gray-600 body-font">';
			{

				$html .= '<div class="container px-5 py-24 mx-auto">';
				{

					$html .= '<div class="flex flex-wrap -m-4">';
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

							$html .= '<div class="p-4 lg:w-1/3">';
							{
								$html .= '<div class="h-full bg-gray-100 bg-opacity-75 px-8 pt-16 pb-24 rounded-lg overflow-hidden text-center relative">';
								{
									$html .= '<h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">';
									{
										$html .= \content_site\assemble\tools::post_reading_time(a($value, 'readingtime'), a($_args, 'post_show_readingtime'));
									}
									$html .= '</h2>';

									$html .= '<h1 class="title-font sm:text-2xl text-xl font-medium text-gray-900 mb-3">'.$myTitle.'</h1>';


									$html .= '<p class="leading-relaxed mb-3">';
									{
										if($myExcerpt && a($_args, 'post_show_excerpt'))
										{
											$html .= $myExcerpt;
										}
									}
									$html .= '</p>';


									$html .= '<a class="text-indigo-500 inline-flex items-center">'.T_("Read more").'</a>';

									$html .= '<div class="text-center mt-2 leading-none flex justify-center absolute bottom-0 left-0 w-full py-4">';
									{

										$html .= '<span class="text-gray-400 mr-3 inline-flex items-center leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">';
										{

											$html .= '<svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
											$html .= '1.2K';
										}
										$html .= '</span>';

										$html .= '<span class="text-gray-400 inline-flex items-center leading-none text-sm">';
										{

											$html .= '<svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path></svg>';
											$html .= 6;
										}
										$html .= '</span>';
									}
									$html .= '</div>';

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
			$html .= '</section>';

		}
		$html .= "</$cnElement>";



		return $html;
	}
}
?>