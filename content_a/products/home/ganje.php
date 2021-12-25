<?php
$html = '';
$html .= '<div class="mt-10">';
{
	if(\dash\data::ganjeSearch())
	{
		foreach (\dash\data::ganjeSearch() as $key => $value)
		{
			$html .= '<div class="box">';
			{
				$html .= '<div class="pad">';
				{
					$html .= '<div class="row">';
					{
						$html .= '<div class="c">';
						{

							if(a($value, 'thumb'))
							{
								$html .= '<img class="w-10 h-10" src="'. a($value, 'thumb'). '" alt="'.a($value, 'title').'">';
							}
							$html .= a($value, 'title');
						}
						$html .= '</div>';

						$html .= '<div class="cauto">';
						{
							$html .= '<div class="btn-primary" data-ajaxify data-method="post" data-data=\'{"add_from": "ganje", "ganje_id": "'.a($value, 'id').'"}\'>'. T_("Add"). '</div>';
						}
						$html .= '</div>';
					}
					$html .= '</div>';

				}
				$html .= '</div>';
			}
			$html .= '</div>';
		}
	}

}
$html .= '</div>';

echo $html;
?>