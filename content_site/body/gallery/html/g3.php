<?php
namespace content_site\body\gallery\html;


class g3
{

	public static function html($_args, $_image_list)
	{

		$html = '';

		// define variables
		// $previewMode = a($_args, 'preview_mode');
		$id          = a($_args, 'id');
		$type        = a($_args, 'type');
		$coverRatio  = \content_site\options\coverratio::get_class(a($_args, 'coverratio'));
		$font_class  = \content_site\assemble\font::class($_args);
		// $type        = 'b1';

		$height           = \content_site\options\height::class_name(a($_args, 'height'));
		$background_style = \content_site\assemble\background::full_style($_args);
		$text_color       = \content_site\assemble\text_color::full_style($_args);
		$section_id       = \content_site\assemble\tools::section_id($type, $id);


		$classNames = $height;
		if($font_class)
		{
			$classNames .= ' '. $font_class;
		}

		$heading = a($_args, 'heading');
		$desc    = a($_args, 'description');

		$html .= "<section class='text-gray-600 body-font $classNames' data-type='$type' $background_style $section_id>";
		{

		  $html .= '<div class="container px-5 py-24 mx-auto flex flex-wrap">';
		  {

		    $html .= '<div class="flex flex-col text-center w-full mb-20">';
		    {
		      $html .= "<h1 class='sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900' $text_color>". $heading. '</h1>';
		      $html .= '<p class="lg:w-2/3 mx-auto leading-relaxed text-base">'. $desc. '</p>';
		    }
		    $html .= '</div>';

		    $html .= '<div class="lg:w-2/3 mx-auto">';
		    {


				$html .= '<div class="flex flex-wrap w-full bg-gray-100 py-32 px-10 relative mb-4">';
				{

				  $html .= el::img_nolink(a($_image_list, 0), 'w-full object-cover h-full object-center block opacity-25 absolute inset-0');

				  $html .= '<div class="text-center relative z-10 w-full">';
				  {

				    $html .= '<h2 class="text-2xl text-gray-900 font-medium title-font mb-2">'.a($_image_list, 0, 'caption').'</h2>';
				    $html .= '<p class="leading-relaxed">'.a($_image_list, 0, 'description').'</p>';
				    $html .= el::a(a($_image_list, 0), T_("Read More"), 'mt-3 text-indigo-500 inline-flex items-center');
				  }
				  $html .= '</div>';
				}
				$html .= '</div>';

				$html .= '<div class="flex flex-wrap -mx-2">';
				{

				  $html .= '<div class="px-2 w-1/2">';
				  {

				    $html .= '<div class="flex flex-wrap w-full bg-gray-100 sm:py-24 py-16 sm:px-10 px-6 relative">';
				    {
					  $html .= el::img_nolink(a($_image_list, 1), 'w-full object-cover h-full object-center block opacity-25 absolute inset-0');

				      $html .= '<div class="text-center relative z-10 w-full">';
				      {

				        $html .= '<h2 class="text-xl text-gray-900 font-medium title-font mb-2">'.a($_image_list, 1, 'caption').'</h2>';
				        $html .= '<p class="leading-relaxed">'. a($_image_list, 1, 'description').'</p>';
				        $html .= el::a(a($_image_list, 1), T_("Read More"), 'mt-3 text-indigo-500 inline-flex items-center');
				      }
				      $html .= '</div>';
				    }
				    $html .= '</div>';
				  }
				  $html .= '</div>';

				  $html .= '<div class="px-2 w-1/2">';
				  {

				    $html .= '<div class="flex flex-wrap w-full bg-gray-100 sm:py-24 py-16 sm:px-10 px-6 relative">';
				    {

					  $html .= el::img_nolink(a($_image_list, 2), 'w-full object-cover h-full object-center block opacity-25 absolute inset-0');

				      $html .= '<div class="text-center relative z-10 w-full">';
				      {

				        $html .= '<h2 class="text-xl text-gray-900 font-medium title-font mb-2">'.a($_image_list, 2, 'caption').'</h2>';
				        $html .= '<p class="leading-relaxed">'. a($_image_list, 2, 'description').'</p>';
				        $html .= el::a(a($_image_list, 2), T_("Read More"), 'mt-3 text-indigo-500 inline-flex items-center');
				      }
				      $html .= '</div>';
				    }
				    $html .= '</div>';
				  }
				  $html .= '</div>';

				}
				$html .= '</div>';

			}
			$html .= '</div>';
		  }
		  $html .= '</div>';
		}
		$html .= '</section>';

		return $html;
	}

}
?>