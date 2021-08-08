<?php
namespace content_site\body\blog\html;


class b2
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
					$heading_class = \content_site\options\heading::class_name($_args);

					$html .= "<h3 class='font-bold text-4xl mb-10 $heading_class $font_class' $text_color>";
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
						if($myThumb && a($_args, 'post_show_image'))
						{
							$html .= "<div class='md:flex-shrink-0 $coverRatio'>";
							{
								$html .= "<img class='h-full w-full object-cover md:w-48' src='$myThumb' alt='$myTitle'>";
							}
							$html .= "</div>";
						}

					    $html .= "<div class='p-8'>";
					    {
							// $html .= "<div class='uppercase tracking-wide text-sm text-indigo-500 font-semibold'>Case study</div>";
							$html .= "<a href='$myLink' class='block mt-1 text-lg leading-tight font-medium text-black hover:underline'>$myTitle</a>";
					    	$html .= \content_site\assemble\tools::post_reading_time(a($value, 'readingtime'), a($_args, 'post_show_readingtime'));

							if($myExcerpt && a($_args, 'post_show_excerpt'))
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
		}
		$html .= "</$cnElement>";

		return $html;
	}
}
?>