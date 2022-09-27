<?php
namespace lib\app\form\generate;


trait startButton
{


	private static function formStartButton()
	{
		if(isset(self::$formDetail['formStartButton']) && self::$formDetail['formStartButton'])
		{
			$form_id = self::$formDetail['id'];
			$json    =
				[
					'token' => a(self::$formDetail, 'formLoad', 'token'),
					'tid'   => a(self::$formDetail, 'formLoad', 'id'),
					'fid'   => $form_id,
				];

			$json = json_encode($json);

			$url = \dash\url::kingdom() . '/f/' . $form_id. '/start';

			$html   = '';
			$format =
				"<div 
					class='btn-primary btn-xl' 
					data-ajaxify 
					data-action='%s' 
					data-data='%s' 
					data-method='post'>";
			$html   .= sprintf($format, $url,  $json);
			{
				$html .= T_("Let's Go");
			}
			$html .= '</div>';

			self::$html .= $html;

			self::$formStartButton = true;

			return  true;

		}

		return false;

	}

}


