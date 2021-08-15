<?php
namespace content_site\body\gallery\html;


class g2
{

	private static function el_image($_data, $_class)
	{
		$html = '';

		if(a($_data, 'link'))
		{
			$html .= '<a href="'. $_data['link']. '"';
			if(a($_data, 'target'))
			{
				$html .= ' target="_blank"';
			}
			$html .= '>';
		}

		$url = a($_data, 'image');
		if(!$url)
		{
			$url = \dash\app::static_image_url();
		}
		else
		{
			$url = \lib\filepath::fix($url);
		}

		$html .= '<img src="'. $url. '" alt="'. a($_data, 'caption'). '" class="'. $_class. '">';

		if(a($_data, 'link'))
		{
			$html .= '</a>';
		}

		return $html;
	}


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

		  $html .= '<div class="container px-5 py-24 mx-auto">';
		  {

		    $html .= '<div class="flex flex-col text-center w-full mb-20">';
		    {
		      $html .= "<h1 class='sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900' $text_color>". $heading. '</h1>';
		      $html .= '<p class="lg:w-2/3 mx-auto leading-relaxed text-base">'. $desc. '</p>';
		    }
		    $html .= '</div>';

		    $html .= '<div class="flex flex-wrap -m-4">';
		    {

		      	foreach ($_image_list as $key => $value)
		      	{

			      $html .= '<div class="lg:w-1/3 sm:w-1/2 p-4">';
			      {

			        $html .= '<div class="flex relative">';
			        {

			          $html .= el::img_nolink($value, 'absolute inset-0 w-full h-full object-cover object-center');

			          $html .= '<div class="px-8 py-10 relative z-10 w-full border-4 border-gray-200 bg-white opacity-0 hover:opacity-100">';
			          {
			            // $html .= '<h2 class="tracking-widest text-sm title-font font-medium text-indigo-500 mb-1">'.a($value, 'caption').'</h2>';
			            $html .= '<h1 class="title-font text-lg font-medium text-gray-900 mb-3">'.a($value, 'caption').'</h1>';
			            $html .= '<p class="leading-relaxed">'.a($value, 'description').'</p>';
			          }
			          $html .= '</div>';
			        }
			        $html .= '</div>';
			      }
			      $html .= '</div>';
		      	}
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