<?php
namespace content_site\body\blog;


class b1
{
	public static function html($_args, $_blogList, $_id, $_show_author, $_show_date, $_show_excerpt)
	{
		$html             = '';

		if(a($_args, 'heading') !== null)
		{
			$html .= '<header>';
			{
				$heading_class = \content_site\options\heading::class_name($_args);
				$text_color    = \content_site\assemble\text_color::full_style($_args);
				$font_class    = \content_site\assemble\font::class($_args);

				$html .= "<h3 class='font-bold text-4xl mb-10 $heading_class $font_class' $text_color data-sync-apply='heading-$_id'>";
				{
					$html .= a($_args, 'heading');
				}
				$html .= '</h3>';
			}
			$html .= '</header>';
		}

		$grid_cols = \content_site\grid\analyze::get_class($_args);

		$html .= "<div class='grid $grid_cols justify-center'>";
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


				$card = '';
				$card .= '<div data-card class="flex flex-col max-w-lg rounded-lg overflow-hidden shadow-lg bg-white ">';
				{
					// thumb
					if($myThumb)
					{
						$card .= '<header>';
						$card .= "<a class='block' href='$myLink'>";
						{
							$card .= "<img class='block w-full' src='$myThumb' alt='$myTitle'>";
						}
						$card .= "</a>";
						$card .= '</header>';
					}

					$card .= "<div class='flex-grow px-6 pt-4'>";
					{
						// title
						$card .= '<h2>';
						{
							$card .= "<a class='block font-bold mb-5' href='$myLink'>";
							{
								$card .= $myTitle;
							}
							$card .= "</a>";
						}
						$card .= '</h2>';

						if($myExcerpt && $_show_excerpt)
						{
							$card .= "<p class='text-gray-700 text-xs'>";
							$card .= $myExcerpt;
							$card .= "</p>";
						}

					}
					$card .= '</div>';

						// add footer line
					$card .= '<footer class="flex items-center px-6 py-4 hover:bg-gray-50 transition">';
					{
						if($_show_author)
						{

							$writerName = a($value, 'user_detail', 'displayname');
							$card .= "<img src='". \dash\fit::img(a($value, 'user_detail', 'avatar')). "' alt='$writerName' class='w-12 h-12 rounded-full me-2 bg-gray-100 overflow-hidden'>";
							$card .= "<span class='text-2xs me-2'>". $writerName. "</span>";
						}

						if($_show_date)
						{
							if($myDate)
							{
								$card .= "<time class='text-gray-600 text-2xs' datetime='$myDate' title='". T_("Published"). " $myDate'>";
								$card .= \dash\fit::date($myDate, 'readable');

								$card .= "</time>";
							}
						}
					}

					$card .= '</footer>';
				}
				$card .= '</div>';

				// save card
				$html .= $card;
			}
		}
		$html .= '</div>';

		return $html;
	}
}
?>