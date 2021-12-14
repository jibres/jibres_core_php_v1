<?php
$html = '';


$html .= '<div class="row">';
{
	$html .= '<div class="c-xs-12 c-sm-3">';
	{
		$html .= '<nav class="header items long">';
		{
			$html .= '<ul>';
			{

				foreach (\dash\data::settingCategory() as $key => $value)
				{
					$html .= '<li>';
					{

						$html .= '<a class="item f" href="'.a($value, 'link').'">';
						{
							$html .= a($value, 'icon');
							$html .= '<div class="key">'.a($value,'title').'</div>';
							if(\dash\url::child() === $key)
							{
								$html .= \dash\utility\icon::bootstrap('check-circle', 'text-green-500');
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
	$html .= '</div>';

	$html .= '<div class="c-xs-12 c-sm-8">';
	{
		if(\dash\data::settingDisplayAddr() && is_file(\dash\data::settingDisplayAddr()))
		{
			echo $html;
			$html = '';
			require_once(\dash\data::settingDisplayAddr());
		}
		else
		{
			$list = \dash\data::settingOptions();
			if(!is_array($list))
			{
				$list = [];
			}

			$html .= \dash\layout\elements\option_box::multiple_html($list);
		}
	}
	$html .= '</div>';

}
$html .= '</div>';


echo $html;

?>