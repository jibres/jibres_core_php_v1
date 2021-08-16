<?php
namespace content_site\body\blog\html;


class b4
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

			$html .= '<div class="container px-5 py-24 mx-auto">';
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

				$html .= '<div class="flex flex-wrap -m-12">';
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

							// for

						$html .= '<div class="p-12 sm:w-1/2 flex flex-col items-start">';
						{

							$html .= '<span class="inline-block py-1 px-2 rounded bg-indigo-50 text-indigo-500 text-xs font-medium tracking-widest">';
							{
								$html .= \content_site\assemble\tools::post_reading_time(a($value, 'readingtime'), a($_args, 'post_show_readingtime'));
							}
							$html .= '</span>';

							$html .= '<h2 class="sm:text-3xl text-2xl title-font font-medium text-gray-900 mt-4 mb-4">'.$myTitle.'</h2>';

							$html .= '<p class="leading-relaxed mb-8">';
							{
								if($myExcerpt && a($_args, 'post_show_excerpt'))
								{
									$html .= $myExcerpt;
								}
							}
							$html .= '</p>';

							$html .= '<div class="flex items-center flex-wrap pb-4 mb-4 border-b-2 border-gray-100 mt-auto w-full">';
							{

								$html .= '<a href="'.$myLink.'" class="text-indigo-500 inline-flex items-center">'.T_("Read more").'</a>';

								$html .= '<span class="text-gray-400 mr-3 inline-flex items-center ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">';
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

							if(a($_args, 'post_show_author'))
							{
								$html .= '<a class="inline-flex items-center">';
								{

									$writerName = a($value, 'user_detail', 'displayname');
									$marginClass = 'mr-2';
									if(\dash\language::dir() === 'rtl')
									{
										$marginClass = 'ml-2';
									}
									$html .= "<img loading='lazy' src='#' data-src='". \dash\fit::img(a($value, 'user_detail', 'avatar')). "' alt='$writerName' class='w-12 h-12 rounded-full flex-shrink-0 object-cover object-center'>";
									$html .= '<span class="flex-grow flex flex-col pl-4">';
									{
										$html .= '<span class="title-font font-medium text-gray-900">'.$writerName.'</span>';
										$html .= '<span class="text-gray-400 text-xs tracking-widest mt-0.5">DESIGNER</span>';
									}
									$html .= '</span>';

								}
								$html .= '</a>';
							}
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