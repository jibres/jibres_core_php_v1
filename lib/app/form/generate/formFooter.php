<?php
namespace lib\app\form\generate;


trait formFooter
{


	private static function formFooter()
	{
		$html = '';

		if(self::$formStartButton)
		{
			// hidden footer
		}
		else
		{

			$html .= '<footer class="txtRa">';
			{
				$html .= '<button class="btn master">' . T_("Submit") . '</button>';
			}
			$html .= '</footer>';
		}

		return $html;

	}

}


