<?php
namespace content_site\options\checklist;


class checklist_list
{

	public static function admin_html()
	{
		$currentSectionDetail = \dash\data::currentSectionDetail();

		if($currentSectionDetail && isset($currentSectionDetail['preview']['checklist_list']) && is_array($currentSectionDetail['preview']['checklist_list']))
		{
			// ok
		}
		else
		{
			return null;
		}


		$html = '';


		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::opt_hidden('child_key', 'checklist_list');


			$html .= '<nav class="items">';
			{
		  		$html .= '<ul data-sortable>';
		  		{
		    		foreach ($currentSectionDetail['preview']['checklist_list'] as $key => $value)
		    		{
			      		$html .= '<li>';
			      		{
				      		$html .= '<a class="item f" href="'. \dash\url::that(). '/checklist_list'. \dash\request::full_get(['index' => a($value, 'index')]). '">';
				      		{
					            $html .= '<input type="hidden" name="sort_child[]" value="'.  a($value, 'index'). '">';



								$status = '';
								switch (a($value, 'link_color'))
								{
									case 'success':
										// $status = 'data-okay';
				        				$html .= \dash\utility\icon::svg('CircleTick', 'major', 'green');
										break;

									case 'danger':
										// $status = 'data-fail';
				        				$html .= \dash\utility\icon::svg('CircleCancel', 'major', 'red');
										break;

									case 'warning':
										// $status = 'data-warn';
										$html .= \dash\utility\icon::svg('lightbulb', 'bootstrap', 'orange');
										break;


									case 'primary':
									default:
										// $status = 'data-info';
										$html .= \dash\utility\icon::svg('CircleInformation', 'major', '#009ae7');
										break;
								}




				        		// $html .= '<img src="'. $file_url. '" alt="'. a($value, 'title'). '">';
				        		$html .= '<div class="key">'. a($value, 'title').' </div>';

            					if (count($currentSectionDetail['preview']['checklist_list']) > 1)
            					{
              						$html .= '<img class="p-3 opacity-70 hover:bg-gray-200 sortHandle" data-handle src="'. \dash\utility\icon::url('DragHandle', 'minor'). '">';
              					}
              					else
              					{
				        			$html .= '<div class="go"></div>';
              					}

				      		}
				      		$html .= '</a>';
			      		}
				    	$html .= '</li>';
		    		}
		  		}
		  		$html .= '</ul>';
			}
			$html .= '</nav>';
		}
		$html .= \content_site\options\generate::_form();


		return $html;
	}

}
?>