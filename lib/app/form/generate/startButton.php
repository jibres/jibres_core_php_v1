<?php
namespace lib\app\form\generate;


trait startButton
{
	private static function formCheckLoginButton()
	{
		if(isset(self::$formDetail['setting']['loginrequired']) && self::$formDetail['setting']['loginrequired'])
		{
			if(\dash\user::id())
			{
				return false;
			}
			else
			{
				$url = \dash\url::kingdom(). '/enter?referer='. \dash\url::location();

				$html = '';
				$html .= '<div class="text-center">';
				{
					$format = "<a class='btn-primary btn-xl ' href='%s' >";
					$html   .= sprintf($format, $url);
					{
						$html .= T_("Please login to continue");
					}
					$html .= '</a>';
				}
				$html .= '</div>';


				self::$html .= $html;

				self::$formStartButton = true;


				return true;
			}

		}
		return false;
	}


	private static function formStartButton()
	{
		if(isset(self::$formDetail['formStartButton']) && self::$formDetail['formStartButton'])
		{
			if(isset(self::$formDetail['formLoad']['starttime']) && self::$formDetail['formLoad']['starttime'])
			{
				return false;
			}

			$form_id = self::$formDetail['id'];
			$json    =
				[
					'token' => a(self::$formDetail, 'formLoad', 'token'),
					'tid'   => a(self::$formDetail, 'formLoad', 'id'),
					'fid'   => $form_id,
				];

			$json = json_encode($json);

			$url = \dash\url::kingdom() . '/f/' . $form_id . '/start';

			$html = '';
			$html .= '<div class="text-center">';
			{
				$format =
					"<div 
					class='btn-primary btn-xl ' 
					data-ajaxify 
					data-action='%s' 
					data-data='%s' 
					data-method='post'>";
				$html   .= sprintf($format, $url, $json);
				{
					$html .= T_("Start");
				}
				$html .= '</div>';
			}
			$html .= '</div>';


			self::$html .= $html;

			self::$formStartButton = true;

			return true;

		}

		return false;

	}

}


