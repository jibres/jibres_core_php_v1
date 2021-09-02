<?php
namespace content_site\body\visitcard;


class visitcard1_html
{
	public static function html($_args)
	{
		$html = \content_site\assemble\wrench\section::element_start($_args);
		{
			// $html .= "<div class='m-auto relative'>";
			{
				$borderRadius = a($_args, 'radius:class');
				$title        = a($_args, 'heading');
				$desc         = a($_args, 'description');

				$cardClass = 'relative m-auto overflow-hidden grid grid-cols-3 max-w-screen-sm lg:max-w-screen-md w-full bg-white shadow-xl hover:shadow-lg transition '. $borderRadius;

				$html .= '<div class="'. $cardClass. '">';
				{
					$html .= '<div class="logo">';
					{
						$logoSrc = \dash\url::icon();
						$html .= '<img class="w-full'. $borderRadius. '" src="'. $logoSrc .'" alt='. $title .'>';
					}
					$html .= '</div>';

					$html .= '<div class="col-span-2 flex flex-col m-auto p-4 text-center">';
					{
						// set title
						$html .='<h1 class="text-5xl font-normal leading-normal '. a($_args, 'color_heading:full_style').'">';
						{
							$html .= $title;
						}
						$html .= '</h1>';

						// set desc
						$html .= '<h2 class="text-lg text-gray-600 '. a($_args, 'color_text:full_style'). '">';
						{
							$html .= $desc;
						}
						$html .= '</h2>';

						// set social media links
						$socialNetworksList = \lib\store::social();
						$html .= \content_site\assemble\wrench\socialnetworks::type1($socialNetworksList);
					}
					$html .= '</div>';
				}
				$html .= '</div>';
			}
			// $html .= "</div>";
		}
		$html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}


	public static function html_old($_args)
	{
		$html             = '';


		$id               = a($_args, 'id');
		$type             = a($_args, 'model');
		$height           = a($_args, 'height:class');
		$background_style = a($_args, 'background:full_style');
		$section_id       = a($_args, 'secition:id');
		$color_text       = a($_args, 'color_text:full_style');


		$classNames = $height;


		$html .= "<div data-type='$type' class='flex $classNames'$background_style $section_id>";
		{
			$html .= "<div class='m-auto'>";
			{
				$html .= '<div class="bg-gray-200 p-10 text-center rounded-3xl">';
				{

					$html .='<h1 class="text-5xl font-normal leading-normal mt-0 mb-2" '. $color_text.'>';
					{
						$html .= a($_args, 'heading');
					}
					$html .= '</h1>';

					$html .= '<div '.$color_text.'>';
					{
						$html .= a($_args, 'description');
					}
					$html .= '</div>';
				}
				$html .= '</div>';
			}
			$html .= '</div>';
		}
		$html .= "</div>";

		return $html;
	}


}
?>