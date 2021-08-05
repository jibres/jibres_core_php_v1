<?php
namespace content_site\body\blog;


class b1
{
	public static function html($_args, $_blogList)
	{
		$html             = '';

		// define variables
		// $previewMode = a($_args, 'preview_mode');
		$id          = a($_args, 'id');
		$type        = a($_args, 'type');
		$coverRatio  = \content_site\options\coverratio::get_class(a($_args, 'coverratio'));
		$font_class  = \content_site\assemble\font::class($_args);
		// $type        = 'b1';

		$height           = \content_site\options\height::class_name(a($_args, 'height'));
		$background_style = \content_site\assemble\background::full_style($_args);

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

		$html .= "<$cnElement data-type='$type' class='$classNames'$background_style>";
		{
			$html .= '<div class="max-w-screen-lg mx-auto px-2">';
			{
				if(a($_args, 'heading') !== null)
				{
					$html .= '<header class="overflow-hidden">';
					{
						$heading_class = \content_site\options\heading::class_name($_args);
						$text_color    = \content_site\assemble\text_color::full_style($_args);
						$font_class    = \content_site\assemble\font::class($_args);

						$html .= "<h2 class='text-4xl leading-10 $heading_class' $text_color>";
						{
							$html .= a($_args, 'heading');
						}
						$html .= '</h2>';
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
								$card .= "<a class='block $coverRatio' href='$myLink'>";
								{
									$card .= "<img class='block h-full w-full object-center object-cover' src='$myThumb' alt='$myTitle'>";
								}
								$card .= "</a>";
								$card .= '</header>';
							}

							$card .= "<div class='flex-grow px-6 pt-4'>";
							{
								// title
								$card .= '<h3 class="mb-5">';
								{
									$card .= "<a class='block font-bold' href='$myLink'>";
									{
										$card .= $myTitle;
									}
									$card .= "</a>";

									if(a($_args, 'post_show_readingtime') && a($value, 'readingtime'))
									{
										$val = ['val' => \dash\fit::number(a($value, 'readingtime'))];
										$card .= '<small class="text-gray-700" title="'. T_("We are estimate you can read this post within :val.", $val). '">';
										$card .= T_(":val read", $val);
										$card .= '</small>';

									}
								}
								$card .= '</h3>';


								if($myExcerpt && a($_args, 'post_show_excerpt'))
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
								if(a($_args, 'post_show_author'))
								{

									$writerName = a($value, 'user_detail', 'displayname');
									$card .= "<img src='". \dash\fit::img(a($value, 'user_detail', 'avatar')). "' alt='$writerName' class='w-12 h-12 rounded-full me-2 bg-gray-100 overflow-hidden'>";
									$card .= "<span class='text-2xs me-2'>". $writerName. "</span>";
								}

								if(a($_args, 'post_show_date'))
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

			}
		}
		$html .= "</$cnElement>";

		return $html;
	}
}
?>