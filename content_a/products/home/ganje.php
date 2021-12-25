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
							$add_url = \dash\url::this(). '/quick?gid='. a($value, 'id');

							$html .= '<a href="'.$add_url.'" class="btn-primary">'. T_("Add"). '</a>';
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