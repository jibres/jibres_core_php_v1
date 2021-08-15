<?php
namespace content_site\body\gallery\html;


class g1
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


		$image_list = a($_args, 'image_list');
		if(!is_array($image_list))
		{
			$image_list = [];
		}

		$image_list = array_values($image_list);


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

		    $html .= '<div class="flex w-full mb-20 flex-wrap">';
		    {
		      $html .= "<h1 class='sm:text-3xl text-2xl font-medium title-font text-gray-900 lg:w-1/3 lg:mb-0 mb-4' $text_color>". $heading. '</h1>';
		      $html .= '<p class="lg:pl-6 lg:w-2/3 mx-auto leading-relaxed text-base">'. $desc. '</p>';
		    }
		    $html .= '</div>';

		    $html .= '<div class="flex flex-wrap lg:-m-2 -m-1">';
		    {

		      $html .= '<div class="flex flex-wrap w-1/2">';
		      {

		        $html .= '<div class="lg:p-2 p-1 w-1/2">';
		        {
		        	$html .= self::el_image(a($image_list, 0) , 'w-full object-cover h-full object-center block');
		        }

		        $html .= '</div>';

		        $html .= '<div class="lg:p-2 p-1 w-1/2">';
		        {
		        	$html .= self::el_image(a($image_list, 1) , 'w-full object-cover h-full object-center block');
		        }

		        $html .= '</div>';

		        $html .= '<div class="lg:p-2 p-1 w-full">';
		        {
		        	$html .= self::el_image(a($image_list, 2) , 'w-full h-full object-cover object-center block');
		        }

		        $html .= '</div>';
		      }
		      $html .= '</div>';


		      $html .= '<div class="flex flex-wrap w-1/2">';
		      {
		        $html .= '<div class="lg:p-2 p-1 w-full">';
		        {
		        	$html .= self::el_image(a($image_list, 3) , 'w-full h-full object-cover object-center block');
		        }

		        $html .= '</div>';

		        $html .= '<div class="lg:p-2 p-1 w-1/2">';
		        {
		        	$html .= self::el_image(a($image_list, 4) , 'w-full object-cover h-full object-center block');
		        }

		        $html .= '</div>';

		        $html .= '<div class="lg:p-2 p-1 w-1/2">';
		        {
		        	$html .= self::el_image(a($image_list, 5) , 'w-full object-cover h-full object-center block');
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