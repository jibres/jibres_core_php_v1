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

$html .= '
<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-wrap -mx-4 -my-8">
      <div class="py-8 px-4 lg:w-1/3">
        <div class="h-full flex items-start">
          <div class="w-12 flex-shrink-0 flex flex-col text-center leading-none">
            <span class="text-gray-500 pb-2 mb-2 border-b-2 border-gray-200">Jul</span>
            <span class="font-medium text-lg text-gray-800 title-font leading-none">18</span>
          </div>
          <div class="flex-grow pl-6">
            <h2 class="tracking-widest text-xs title-font font-medium text-indigo-500 mb-1">CATEGORY</h2>
            <h1 class="title-font text-xl font-medium text-gray-900 mb-3">The 400 Blows</h1>
            <p class="leading-relaxed mb-5">Photo booth fam kinfolk cold-pressed sriracha leggings jianbing microdosing tousled waistcoat.</p>
            <a class="inline-flex items-center">
              <img alt="blog" src="https://dummyimage.com/103x103" class="w-8 h-8 rounded-full flex-shrink-0 object-cover object-center">
              <span class="flex-grow flex flex-col pl-3">
                <span class="title-font font-medium text-gray-900">Alper Kamu</span>
              </span>
            </a>
          </div>
        </div>
      </div>
      <div class="py-8 px-4 lg:w-1/3">
        <div class="h-full flex items-start">
          <div class="w-12 flex-shrink-0 flex flex-col text-center leading-none">
            <span class="text-gray-500 pb-2 mb-2 border-b-2 border-gray-200">Jul</span>
            <span class="font-medium text-lg text-gray-800 title-font leading-none">18</span>
          </div>
          <div class="flex-grow pl-6">
            <h2 class="tracking-widest text-xs title-font font-medium text-indigo-500 mb-1">CATEGORY</h2>
            <h1 class="title-font text-xl font-medium text-gray-900 mb-3">Shooting Stars</h1>
            <p class="leading-relaxed mb-5">Photo booth fam kinfolk cold-pressed sriracha leggings jianbing microdosing tousled waistcoat.</p>
            <a class="inline-flex items-center">
              <img alt="blog" src="https://dummyimage.com/102x102" class="w-8 h-8 rounded-full flex-shrink-0 object-cover object-center">
              <span class="flex-grow flex flex-col pl-3">
                <span class="title-font font-medium text-gray-900">Holden Caulfield</span>
              </span>
            </a>
          </div>
        </div>
      </div>
      <div class="py-8 px-4 lg:w-1/3">
        <div class="h-full flex items-start">
          <div class="w-12 flex-shrink-0 flex flex-col text-center leading-none">
            <span class="text-gray-500 pb-2 mb-2 border-b-2 border-gray-200">Jul</span>
            <span class="font-medium text-lg text-gray-800 title-font leading-none">18</span>
          </div>
          <div class="flex-grow pl-6">
            <h2 class="tracking-widest text-xs title-font font-medium text-indigo-500 mb-1">CATEGORY</h2>
            <h1 class="title-font text-xl font-medium text-gray-900 mb-3">Neptune</h1>
            <p class="leading-relaxed mb-5">Photo booth fam kinfolk cold-pressed sriracha leggings jianbing microdosing tousled waistcoat.</p>
            <a class="inline-flex items-center">
              <img alt="blog" src="https://dummyimage.com/101x101" class="w-8 h-8 rounded-full flex-shrink-0 object-cover object-center">
              <span class="flex-grow flex flex-col pl-3">
                <span class="title-font font-medium text-gray-900">Henry Letham</span>
              </span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
';

return $html;

		$html .= "<$cnElement data-type='$type' class='$classNames'$background_style $section_id>";
		{
			if(a($_args, 'heading') !== null)
			{
				$html .= '<header>';
				{
					$heading_class = \content_site\options\heading\heading_full::class_name($_args);

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
				$html .= "<div class='max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden sm:max-w-2xl mb-10'>";
				{
					// a img
					// h2 a
					$myLink      = a($value, 'link');
					$myTitle     = a($value, 'title');
					$myThumb     = \dash\fit::img(a($value, 'thumb'), 460);
					$myExcerpt   = a($value, 'excerpt');
					$myDate      = a($value, 'publishdate');

					$html .= '<div class="sm:flex">';
					{
						// thumb
						if($myThumb && a($_args, 'post_show_image'))
						{
							$html .= "<div class='sm:flex-shrink-0 $coverRatio'>";
							{
								$html .= "<img class='h-full w-full object-cover sm:w-48' src='$myThumb' alt='$myTitle'>";
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