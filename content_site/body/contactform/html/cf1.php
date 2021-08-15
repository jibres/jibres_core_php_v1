<?php
namespace content_site\body\contactform\html;


class cf1
{

	public static function html($_args)
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

		$html .= "<section class='text-gray-600 body-font relative $classNames' data-type='$type' $background_style $section_id>";
		{

			$html .= '<div class="absolute inset-0 bg-gray-300">';
			{
				$html .= '<iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" title="map" scrolling="no" src="https://maps.google.com/maps?width=100%&height=600&hl=en&q=%C4%B0zmir+(My%20Business%20Name)&ie=UTF8&t=&z=14&iwloc=B&output=embed" style="filter: grayscale(1) contrast(1.2) opacity(0.4);"></iframe>';
			}
			$html .= '</div>';

			$html .= '<div class="container px-5 py-24 mx-auto flex">';
			{

				$html .= '<div class="lg:w-1/3 md:w-1/2 bg-white rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md">';
				{

				  $html .= '<h2 class="text-gray-900 text-lg mb-1 font-medium title-font">'.a($_args, 'heading').'</h2>';

				  $html .= '<p class="leading-relaxed mb-5 text-gray-600">'.a($_args, 'description').'</p>';

				  $html .= '<div class="relative mb-4">';
				  {

				    $html .= '<label for="email" class="leading-7 text-sm text-gray-600">Email</label>';
				    $html .= '<input type="email" id="email" name="email" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">';
				  }
				  $html .= '</div>';

				  $html .= '<div class="relative mb-4">';
				  {

				    $html .= '<label for="message" class="leading-7 text-sm text-gray-600">Message</label>';
				    $html .= '<textarea id="message" name="message" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>';
				  }
				  $html .= '</div>';

				  $html .= '<button class="btn btn-outline border-0 py-2 px-6 focus:outline-none rounded text-lg">'.T_("Send").'</button>';
				  $html .= '<p class="text-xs text-gray-500 mt-3">Chicharrones blog helvetica normcore iceland tousled brook viral artisan.</p>';
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