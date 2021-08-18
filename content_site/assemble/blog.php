<?php
namespace content_site\assemble;


class blog
{

	public static function btn_viewall($_args)
	{
		$html = '';
		if(a($_args, 'btn_viewall_check'))
		{
			$html .= '<footer class="text-center overflow-hidden">';
			{

				$mode = a($_args, 'btn_viewall_mode');
				if(!$mode)
				{
					$mode = 'outline';
				}

				// $classVal = 'hover:bg-gray-800 font-semibold py-2 px-10 shadow border rounded';

				$html .= "<a class='mx-auto mt-5 jbtn jbtn-wide jbtn-outline jbtn-$mode' href='". a($_args, 'btn_viewall_link'). "'>";
				$html .= a($_args, 'btn_viewall');
				$html .= '</a>';
			}
			$html .= '</footer>';

		} // endif

		return $html;

	}
}
?>