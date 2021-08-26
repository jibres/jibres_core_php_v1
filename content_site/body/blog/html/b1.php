<?php
namespace content_site\body\blog\html;


class b1
{
	public static function html($_args, $_blogList)
	{
		$coverRatio       = a($_args, 'coverratio:class');
		$borderRadius     = a($_args, 'radius:class');

		$totalExist = count($_blogList);
		$totalCount = a($_args, 'count');

		$html = \content_site\assemble\wrench\section::element_start($_args);
		{
			$html .= \content_site\assemble\wrench\section::container_auto($_args, a($_args, 'count'));
			{
				$html .= \content_site\assemble\wrench\heading::simple1($_args);

				$html .= \content_site\assemble\wrench\section::grid_12($_args);
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
						$gridCol = \content_site\assemble\grid::className($totalCount, $totalExist, $key);

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

								$card .= \content_site\body\blog\share::post_reading_time(a($value, 'readingtime'), a($_args, 'post_show_readingtime'));


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

											$card .= \content_site\body\blog\share::date($myDate, a($_args, 'post_show_date'));

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

				$html .= \content_site\body\blog\share::btn_viewall($_args);

			}
			$html .= "</div>";
		}
		$html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}
}
?>