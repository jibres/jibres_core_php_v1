<?php
namespace content_site\body\blog;


class b2
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

		foreach ($_blogList as $key => $value)
		{
			$html .= "<div class='max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl mb-10'>";
			{
				// a img
				// h2 a
				$myLink      = a($value, 'link');
				$myTitle     = a($value, 'title');
				$myThumb     = \dash\fit::img(a($value, 'thumb'), 460);
				$myExcerpt   = a($value, 'excerpt');
				$myDate      = a($value, 'publishdate');

				$html .= '<div class="md:flex">';
				{
					// thumb
					if($myThumb)
					{
						$html .= "<div class='md:flex-shrink-0'>";
						{
							$html .= "<img class='h-full w-full object-cover md:w-48' src='$myThumb' alt='$myTitle'>";
						}
						$html .= "</div>";
					}


				    $html .= "<div class='p-8'>";
				    {
						// $html .= "<div class='uppercase tracking-wide text-sm text-indigo-500 font-semibold'>Case study</div>";
						$html .= "<a href='$myLink' class='block mt-1 text-lg leading-tight font-medium text-black hover:underline'>$myTitle</a>";

						if($myExcerpt && $_show_excerpt)
						{
							$html .= "<p class='mt-2 text-gray-500'>$myExcerpt</p>";
						}
				    }
				    $html .= "</div>";
				}
				$html .= '</div>';
			}
			$html .= '</div>';
		}

		return $html;
	}
}
?>