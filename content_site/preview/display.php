<?php
$html = '';

if(!\dash\request::key_exists('lock', 'get'))
{
	$back_url = \dash\data::previewBackUrl();

	$html .= '<div class="fixed inset-x-0 py-2 px-10 bg-blue-50">';
	{
		$html .= '<div class="row">';
		{
			$html .= '<div class="c-auto">';
			{
				if($back_url)
				{
					$html .= '<a href="'. $back_url. '" >';
					{
						$html .= T_("Back");
					}
					$html .= '</a>';
				}
			}
			$html .= '</div>';

			$html .= '<div class="c"></div>';

			$html .= '<div class="c-auto">';
			{
				$html .= '<div class="w-3 bg-gray-300 rounded-full text-blue-500">';
				{
					$html .= '<a href="'. \dash\url::current(). \dash\request::full_get(['lock' => 1]). '" >';
					{
						$html .= '<img alt="Close" class="" src="'. \dash\utility\icon::url('MobileCancel'). '">';
					}
					$html .= '</a>';
				}
				$html .= '</div>';
			}
			$html .= '</div>';

		}
		$html .= '</div>';
	}
	$html .= '</div>';
}


if(\dash\data::myPreviewDisplayType() === 'preview_list')
{
	$previewSectionList = \dash\data::previewSectionList();
	if(!is_array($previewSectionList))
	{
		$previewSectionList = [];
	}

	$html .= '<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6 pb-10">';
	foreach ($previewSectionList as $value)
	{
		$url = \dash\url::that(). '/'. a($value, 'opt_model'). '/'. a($value, 'preview_key');

		$html .= '<a href="'.$url.'" class="group relative bg-white rounded-lg shadow-sm overflow-hidden transition hover:shadow-md focus:shadow-lg ring-1 ring-black ring-opacity-5">';
		{
			$html .= '<div class="relative bg-gray-100 border-b overflow-hidden">';
			{
				$html .= '<img src="'. a($value, 'preview_image'). '" alt="'.a($value, 'section').'">';
			}
			$html .= '</div>';

			$html .= '<div class="p-5">';
			{
				$html .= '<p class="text-sm font-medium text-gray-900 txtLa">';
				{
					$html .= a($value, 'preview_title');
				}
				$html .= '</p>';
			}
			$html .= '</div>';
		}
		$html .= '</a>';
	}
	$html .= '</div>';

}
elseif(\dash\data::myPreviewDisplayType() === 'model_list')
{

	$html .= '<section class="text-gray-600 body-font">';
	{

	  $html .= '<div class="container px-5 py-24 mx-auto">';
	  {

		foreach (\dash\data::myPreviewTypeList() as $group => $items)
		{

			$show_preview_link = \dash\url::current(). '/'. a($items, 'model');

		    $html .= '<div class="flex items-center lg:w-3/5 mx-auto border-b pb-10 mb-10 border-gray-200 sm:flex-row flex-col">';
		    {

		      $html .= '<div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">';
		      {

		        $html .= '<h2 class="text-gray-900 text-lg title-font font-medium mb-2">'.a($items, 'title').'</h2>';

		        // <p class="leading-relaxed text-base">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine.</p>
		        $html .= '<a href="'.$show_preview_link.'" class="mt-3 text-indigo-500 inline-flex items-center">'.T_("View").'</a>';
		      }
		      $html .= '</div>';
		    }
		    $html .= '</div>';
		}
	  }
	  $html .= '</div>';
	}
	$html .= '</section>';
}
elseif(\dash\data::myPreviewDisplayType() === 'group_list')
{
	foreach (\dash\data::groupSectionList() as $group => $items)
	{

		$html .= '<section class="text-gray-600 body-font">';
		{

		  $html .= '<div class="container px-5 py-24 mx-auto">';
		  {

			$html .= '<label>'. $group. '</label>';

			foreach ($items as $item)
			{
				if(a($item, 'section') === 'html')
				{
					continue;
				}

				$show_preview_link = \dash\url::that(). '/'. a($item, 'section');

			    $html .= '<div class="flex items-center lg:w-3/5 mx-auto border-b pb-10 mb-10 border-gray-200 sm:flex-row flex-col">';
			    {

			      $html .= '<div class="sm:w-32 sm:h-32 h-20 w-20 sm:mr-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 shrink-0">';
			      {
					$html .= '<img class="h-32 w-32 p-10" src="'. a($item, 'icon'). '">';

			      }
			      $html .= '</div>';

			      $html .= '<div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">';
			      {

			        $html .= '<h2 class="text-gray-900 text-lg title-font font-medium mb-2">'.a($item, 'title').'</h2>';

			        // <p class="leading-relaxed text-base">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine.</p>
			        $html .= '<a href="'.$show_preview_link.'" class="mt-3 text-indigo-500 inline-flex items-center">'.T_("View").'</a>';
			      }
			      $html .= '</div>';
			    }
			    $html .= '</div>';
			}

		  }
		  $html .= '</div>';
		}
		$html .= '</section>';
	}

}
else
{

	if(\dash\request::key_exists('lock', 'get'))
	{
		$preview  = \dash\data::myPreviewDetail();
		$html .= a($preview, 'preview_html');
	}
	else
	{
		$page_url = \dash\url::current(). \dash\request::full_get(['lock' => 1]);

		$html .= '<iframe id="liveIframe" class="w-full h-screen pt-10" src="'. $page_url. '"></iframe>';

	}

}

echo $html;

?>