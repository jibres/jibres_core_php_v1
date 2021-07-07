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
				$html .= ' class="font-bold text-6xl mb-10"';
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
				$myLink    = a($value, 'link');
				$myTitle   = a($value, 'title');
				$myThumb   = a($value, 'thumb');
				$myExcerpt = a($value, 'excerpt');

				$card = '';
				$card .= '<div data-card class="max-w-sm rounded-lg overflow-hidden shadow-lg bg-white ">';
				{
					// thumb
					if($myThumb)
					{
						$card .= "<a class='block' href='$myLink'>";
						{
							$card .= "<img class='block w-full' src='$myThumb' alt='$myTitle'>";
						}
						$card .= "</a>";
					}

					$card .= "<div class='px-6 py-4'>";
					{
						// title
						$card .= '<h2>';
						{
							$card .= "<a class='block font-bold text-xl mb-5' href='$myLink'>";
							{
								$card .= $myTitle;
							}
							$card .= "</a>";
						}
						$card .= '</h2>';

						if($myExcerpt)
						{
							$card .= "<p class='text-gray-700 text-base'>";
							$card .= $myExcerpt;
							$card .= "</p>";

						}
					}
					$card .= '</div>';
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