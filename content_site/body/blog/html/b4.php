<?php
namespace content_site\body\blog\html;


class b4
{
	public static function html($_args, $_blogList)
	{

		$html             = '';

		$html .= '<div class="avand-xl">';
		{

			$html .= '<section class="w-full md:w-2/3 flex flex-col items-center px-3">';
			{

				foreach ($_blogList as $key => $value)
				{

					$myLink      = a($value, 'link');
					$myTitle     = a($value, 'title');
					$myThumb     = \dash\fit::img(a($value, 'thumb'), 460);
					$myExcerpt   = a($value, 'excerpt');
					$myDate      = a($value, 'publishdate');

				    $html .= '<article class="flex flex-col shadow my-4">';
				    {
				        $html .= "<a href='$myLink' class='hover:opacity-75'>";
				        {
				            $html .= "<img src='$myThumb' alt='$myTitle'>";
				        }
				        $html .= '</a>';

				        $html .= '<div class="bg-white flex flex-col justify-start p-6">';
				        {

				            // <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">Technology</a>
				            $html .= '<h3>';
				            {
				            	$html .= "<a href='$myLink' class='text-3xl font-bold pb-4'>$myTitle</a>";
				            }
				            $html .= '</h3>';

				            $html .= '<p class="text-sm pb-3">';
				            {
				                $html .= 'By <a href="#" class="font-semibold">David Grzyb</a>, Published on April 25th, 2020';
				            }
				            $html .= '</p>';

				            $html .= "<a href='$myLink' class='pb-6'>";
				            {
				            	$html .= $myExcerpt;
				            }
				            $html .= '</a>';

				            $html .= "<a href='$myLink' class='uppercase text-gray-800'>". T_("Continue Reading");
				            {
					            // need icon
				            }
				            $html .= '</a>';
				        }
				        $html .= '</div>';

				    }
				    $html .= '</article>';

				} // endfor

			}
			$html .= '</section>';
		}
		$html .= '</div>';

		return $html;
	}
}
?>