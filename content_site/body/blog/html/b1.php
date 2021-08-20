<?php
namespace content_site\body\blog\html;


class b1
{
	public static function html($_args, $_blogList)
	{
		$html             = '';

		// define variables
		// $previewMode = a($_args, 'preview_mode');
		$id           = a($_args, 'id');
		$type         = a($_args, 'type');
		$coverRatio   = \content_site\options\coverratio::get_class(a($_args, 'coverratio'));
		$borderRadius = \content_site\options\radius::class_name(a($_args, 'radius'));
		$font_class   = \content_site\assemble\font::class($_args);
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

						$html .= "<h2 class='text-4xl leading-6 mb-5 $heading_class' $text_color>";
						{
							$html .= a($_args, 'heading');
						}
						$html .= '</h2>';
					}
					$html .= '</header>';
				}


				$html .= "<div class='grid grid-cols-12 gap-4'>";
				{
					foreach ($_blogList as $key => $value)
					{
						// a img
						// h3 a
						$myLinkHref   = " href='". a($value, 'link'). "'";
						$myTitle      = a($value, 'title');
						$myThumb      = \dash\fit::img(a($value, 'thumb'), 780);
						$myExcerpt    = a($value, 'excerpt');
						$myDate       = a($value, 'publishdate');
						$myAuthorPage = a($value, 'authorpage');

						// get grid class name by analyse
						$gridCol = \content_site\grid\analyze::className($totalCount, $totalExist, $key);

						$card = '';
						$card .= "<div data-card class='$gridCol flex w-full flex-col max-w-md mx-auto overflow-hidden transition shadow-md hover:shadow-lg bg-white $borderRadius'>";
						{
							// thumb
							if($myThumb && a($_args, 'post_show_image'))
							{
								$card .= '<header>';
								$card .= "<a class='block $coverRatio'$myLinkHref>";
								{
									$card .= "<img loading='lazy' class='block h-full w-full object-center object-cover' src='#' data-src='$myThumb' alt='$myTitle'>";
								}
								$card .= "</a>";
								$card .= '</header>';
							}

							$card .= "<div class='flex-grow px-6 py-4'>";
							{
								// title
								$card .= '<h3>';
								{
									$card .= "<a class='block text-lg leading-8 font-semibold focus:text-blue-800 transition'$myLinkHref>";
									{
										$card .= $myTitle;
									}
									$card .= "</a>";

								}
								$card .= '</h3>';

								$card .= \content_site\assemble\tools::post_reading_time(a($value, 'readingtime'), a($_args, 'post_show_readingtime'));


								if($myExcerpt && a($_args, 'post_show_excerpt'))
								{
									$card .= "<p class='mt-2 text-gray-500 text-sm leading-6'>";
									$card .= $myExcerpt;
									$card .= "</p>";
								}

							}
							$card .= '</div>';

							// add footer line
							if(a($_args, 'post_show_author') || a($_args, 'post_show_date') !== 'no')
							{
								$card .= '<footer class="flex items-center px-6 py-3 hover:bg-gray-50 transition">';
								{
									if(a($_args, 'post_show_author'))
									{
										$card .= "<a class='inline-block' href='$myAuthorPage'>";
										{
											$writerName = a($value, 'user_detail', 'displayname');
											$marginClass = 'mr-2';
											if(\dash\language::dir() === 'rtl')
											{
												$marginClass = 'ml-2';
											}
											$card .= "<img loading='lazy' src='#' data-src='". \dash\fit::img(a($value, 'user_detail', 'avatar')). "' alt='$writerName' class='inline-block w-12 h-12 rounded-full $marginClass bg-gray-100 overflow-hidden'>";
											$card .= "<span class='text-2xs mLa5 inline-block'>". $writerName. "</span>";
										}
										$card .= '</a>';
									}
									$card .= "<span class='flex-grow'></span>";

									if(a($_args, 'post_show_date'))
									{
										if($myDate)
										{
											$ltrDate = 'ltr';
											if(a($_args, 'post_show_date') === 'relative')
											{
												$ltrDate = '';
											}
											$card .= "<time class='text-gray-600 text-2xs $ltrDate' datetime='$myDate' title='". T_("Published"). " $myDate'>";

											$card .= \content_site\assemble\tools::date($myDate, a($_args, 'post_show_date'));

											$card .= "</time>";
										}
									}
								}

								$card .= '</footer>';

							}
						}
						$card .= '</div>';

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