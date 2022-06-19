<?php
$html = '';




$html .= '<form method="post" autocomplete="off">';
{

	$html .= '<div class="box">';
	{

		$html .= '<header><h2>'. T_("Edit note"). '</h2></header>';
		$html .= '<div class="body padLess">';
		{

			$html .= '<div class="mb-4">';
			{
				$html .= '<textarea id="comment" name="comment" class="txt" rows="5">'.\dash\data::dataRow_content_raw().'</textarea>';
			}
			$html .= '</div>';

			$html .= '<div class="row">';
			{
				$html .= '<div class="c-xs-6 c-sm-6">';
				{
					$html .= '<div class="radio3">';
					{
						$html .= '<input type="radio" name="privacy" value="private" ';
						if(\dash\data::dataRow_privacy() === 'private')
						{
							$html .= 'checked';
						}
						$html .= '  id="privacyprivate">';
						$html .= '<label for="privacyprivate">'. T_("Private") . ' <small>'. T_('Only your can view this note').'</small></label>';
					}
					$html .= '</div>';
				}
				$html .= '</div>';

				$html .= '<div class="c-xs-6 c-sm-6">';
				{
					$html .= '<div class="radio3">';
					{
						$html .= '<input type="radio" name="privacy" value="public" ';
						if(\dash\data::dataRow_privacy() === 'public')
						{
							$html .= 'checked';
						}
						$html .= '  id="privacypublic">';
						$html .= '<label for="privacypublic">'. T_("Public") . ' <small>'. T_('Your and customer can view this note').'</small></label>';
					}
					$html .= '</div>';
				}
				$html .= '</div>';
			}
			$html .= '</div>';

			$list   = [];
			$list[] = ['key' => 'primary', 		'title' => T_('Blue') 		];
			$list[] = ['key' => 'secondary', 	'title' => T_('Black') 		];
			$list[] = ['key' => 'success', 		'title' => T_('Green') 		];
			$list[] = ['key' => 'danger', 		'title' => T_('Red') 		];
			$list[] = ['key' => 'warning', 		'title' => T_('Yellow') 	];
			$list[] = ['key' => 'info', 		'title' => T_('Light blue') ];
			$list[] = ['key' => 'light', 		'title' => T_('Light') 		];
			$list[] = ['key' => 'dark', 		'title' => T_('Dark') 		];

			$html .= '<label for="color">'. T_("Color") . '</label>';
			$html .= '<select name="color" class="select22" id="color">';
			{
				$html .= '<option value="">'. T_("None"). '</option>';
				foreach ($list as $key => $value)
				{
					$html .= '<option value="'. $value['key']. '"';
					if(\dash\data::dataRow_color() == $value['key'])
					{
						$html .= ' selected';
					}
					$html .= '>'. $value['title']. '</option>';
				}
			}
			$html .= '</select>';

			$html .= '<div class="row">';
			{
				$html .= '<div class="c">';
				{
					$html .= '<label for="date">'. T_("Date").'</label>';
					$html .= '<div class="input">';
					{
						$html .= '<input type="tel" name="date" data-format="date" id="date" value="'.\dash\fit::date_en(date("Y-m-d", strtotime(\dash\data::dataRow_date()))).'">';
					}
					$html .= '</div>';
				}
				$html .= '</div>';

				$html .= '<div class="c">';
				{

					$html .= '<label for="time">'. T_("Time").'</label>';
					$html .= '<div class="input">';
					{
						$html .= '<input type="tel" name="time" data-format="time" id="time" value="'.date("H:i", strtotime(\dash\data::dataRow_date())).'">';
					}
					$html .= '</div>';
				}
				$html .= '</div>';
			}
			$html .= '</div>';

		}
		$html .= '</div>';

		$html .= '<footer class="f">';
		{
			$html .= '<div class="c"></div>';
			$html .= '<div class="cauto">';
				$html .= '<button class="btn-primary">'. T_("Edit note") . '</button>';
			$html .= '</div>';
		}
		$html .= '</footer>';
	}
	$html .= '</div>';
}
$html .= '</form>';



echo $html;
?>