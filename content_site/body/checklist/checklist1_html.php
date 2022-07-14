<?php
namespace content_site\body\checklist;


class checklist1_html
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

				$cardClass = 'relative m-auto overflow-hidden flex flex-col md:flex-row max-w-screen-sm md:max-w-screen-md w-max md:w-full bg-white md:shadow-xl md:hover:shadow-lg transition rounded-lg md:'. $borderRadius;

				$html .= '<div class="'. $cardClass. '">';
				{
					$logoSrc = a($_args, 'logo');
					if($logoSrc)
					{
						$html .= '<div class="logo w-64 h-64 md:w-64 md:h-64 m-auto mt-5 md:mt-auto">';
						{
							$html .= '<img class="w-full '. $borderRadius. '" src="'. $logoSrc .'" alt="'. $title .'">';
						}
						$html .= '</div>';
					}

					$html .= '<div class="flex-1 flex flex-col m-auto p-5 px-10 text-center">';
					{
						// set title
						$titleClass = 'leading-normal';
						if(mb_strlen($title) > 20 )
						{
							$titleClass .= ' text-2xl md:text-3xl';
						}
						elseif(mb_strlen($title) > 15 )
						{
							$titleClass .= ' text-3xl md:text-4xl';
						}
						else
						{
							$titleClass .= ' text-4xl md:text-5xl';
						}
						if(\dash\language::dir() === 'rtl')
						{
							$titleClass .= ' font-bold';
						}

						$html .='<h1 class="'. $titleClass. '"'. a($_args, 'color_heading:full_style'). '>';
						{
							$html .= $title;
						}
						$html .= '</h1>';

						// set desc
						if($desc)
						{
							$descClass = 'leading-relax font-light text-gray-600 mt-2';
							if(\dash\language::dir() !== 'rtl')
							{
								$descClass .= ' text-lg';
							}
							$html .= '<h2 class="'. $descClass. '" '. a($_args, 'color_text:full_style'). '>';
							{
								$html .= nl2br($desc);
							}
							$html .= '</h2>';
						}

						// set social media links
						$html .= \content_site\assemble\wrench\socialnetworks::type1($_args);
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




}
?>