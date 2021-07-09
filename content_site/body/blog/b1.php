<?php
namespace content_site\body\blog;


class b1
{
	public static function html($_args, $_blogList, $_id)
	{
		$html             = '';

		if(a($_args, 'heading') !== null)
		{
			$html .= '<header>';
			{
				$html .= '<h3';
				$html .= ' class="font-bold text-4xl mb-10"';
				$html .= " data-sync-apply='heading-$_id'";
				$html .= '>';
				{
					$html .= a($_args, 'heading');
				}
				$html .= '</h3>';
			}
			$html .= '</header>';
		}

		$html .= '<div class="grid grid-cols-3 gap-6 justify-center">';
		{
			foreach ($_blogList as $key => $value)
			{
				// a img
				// h2 a
				$myLink      = a($value, 'link');
				$myTitle     = a($value, 'title');
				$myThumb     = a($value, 'thumb');
				$myExcerpt   = a($value, 'excerpt');
				$myDate      = a($value, 'publishdate');
				// show some data
				$showAuthor  = a($value, 'allowshowwriter');
				$showPubDate = a($value, 'allowshowpublishdate');

				$card = '';
				$card .= '<div data-card class="flex flex-col max-w-sm rounded-lg overflow-hidden shadow-lg bg-white ">';
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

						if($myExcerpt)
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
						$writerName = T_("Javad Adib");
						if($showAuthor)
						{
							$card .= "<img src='". \dash\fit::img(\dash\sample::avatar('semantic')). "' alt='$writerName' class='w-12 h-12 rounded-full me-2 bg-gray-100 overflow-hidden'>";
							$card .= "<span class='text-2xs me-2'>". $writerName. "</span>";
						}

						if($showPubDate)
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