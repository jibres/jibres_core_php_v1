<?php
namespace content_site\body\blog;


class b5
{
	public static function html($_args, $_blogList)
	{

		$html             = '';

		$html .= '<div class="avand-xl">';
		{

			$html .= '<div class="">';
			{
				$text_color    = \content_site\assemble\text_color::full_style($_args);
				$font_class    = \content_site\assemble\font::class($_args);

				if(a($_args, 'heading') !== null)
				{
					$html .= '<header>';
					{
						$heading_class = \content_site\options\heading::class_name($_args);

						$html .= '<h2 class="">'. a($_args, 'heading'). '</h2>';

					}
					$html .= '</header>';
				}


				$html .= '<div>';
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

						$html .= "<div>";
						{
							$html .= "<span class='text-red-700 text-4xl p-10'>";
							{
								$html .= \dash\fit::number($key + 1);
							}
							$html .= "</span>";

							$html .= "<a href='$myLink' class='text-4xl'>";
							{
								$html .= $myTitle;
							}
							$html .= "</a>";
						}
						$html .= "</div>";

					} // endfor
				}
				$html .= '</div>';
			}
			$html .= '</div>';
		}
		$html .= '</div>';

		return $html;
	}
}
?>