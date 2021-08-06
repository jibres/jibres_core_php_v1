<?php
namespace content_site\body\blog;


class b6
{
	public static function html($_args, $_blogList)
	{

		$html             = '';


		$html .= "<div class='content leading-relaxed'>";
		{

			$html .= "<section>";
			{

				$text_color    = \content_site\assemble\text_color::full_style($_args);
				$font_class    = \content_site\assemble\font::class($_args);

				if(a($_args, 'heading') !== null)
				{
					$html .= '<h2 class="heading">'. a($_args, 'heading'). '</h2>';
				}

				// $html .= "<p>All of these entries are posts in a collection</p>";
				$html .= "<ul>";
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

						$html .= "<li class='mt-6'>";
						{

							$html .= "<time value='$myDate' class='text-gray-600'>$myDate</time>";
							$html .= "<h4 class='text-lg font-bold'>";
							{
								$html .= "<a href='$myLink'>$myTitle</a>";
							}
							$html .= "</h4>";

							$html .= "<div class=''>";
							{
								$html .= "<p>$myExcerpt</p>";
							}
							$html .= "</div>";
						}
						$html .= "</li>";

					} // endfor

				}
				$html .= "</ul>";
			}
			$html .= "</section>";
		}
		$html .= "</div>";


		return $html;
	}
}
?>