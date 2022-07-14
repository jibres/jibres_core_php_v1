<?php
namespace content_site\body\checklist;


class checklist1_html
{
	public static function html($_args)
	{
		$html = \content_site\assemble\wrench\section::element_start($_args);
		{

			$html .= \content_site\assemble\wrench\section::container($_args);
			{
				$html .= '<div class="">';
				{
					$checklist = [];

					if(isset($_args['checklist_list']) && is_array($_args['checklist_list']))
					{
						$checklist = $_args['checklist_list'];
					}


					foreach ($checklist as $key => $value)
					{
						$html .= '<a ';
						if(a($value, 'checklist_link', 'url'))
						{
							$html .= " href='". $value['checklist_link']['url']. "'";
						}
						$html .= ' class="checklist fc-black mb-5" ';

						$status = '';
						switch (a($value, 'link_color'))
						{
							case 'success':
								$status = 'data-okay';
								break;

							case 'danger':
								$status = 'data-fail';
								break;

							case 'warning':
								$status = 'data-warn';
								break;


							case 'primary':
							default:
								$status = 'data-info';
								break;
						}

						$html .= $status;
						$html .= '>';
						if(!a($value, 'title'))
						{
							$html .= '&nbsp;';

						}
						else
						{
							$html .= a($value, 'title');
						}
						$html .= '</a>';

					}
				}
				$html .= '</div>';


			}
			$html .= '</div>';
		}
		$html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}




}
?>