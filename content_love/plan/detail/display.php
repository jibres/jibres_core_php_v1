<?php
$data = \dash\data::dataRow();
$html = '';
$html .= '<div class="avand">';
{
	$html .= '<form method="post" autocomplete="off">';
	{
		$html .= '<h3 for="status">' . T_("Store detail") . '</h3>';
		$html .= \content_love\plan\storeDetail::html(\dash\data::storeDetail());

		$html .= "<div class='box'>";
		{
			$html .= "<div class='pad'>";
			{
                $html .= '<p>';
                {
                    $html .= T_("You try to change business plan");
                }
                $html .= '</p>';

				$html .= '<label for="status">' . T_("Status") . '</label>';

				$html .= '<select name="status" class="select22" id="status">';
				{
					$html .= '<option value="active" ';
					if(\dash\data::dataRow_status() === 'active')
					{
						$html .= 'selected';
					}
					$html .= '>' . T_("Active") . '</option>';
					$html .= '<option value="deactive" ';
					if(\dash\data::dataRow_status() === 'deactive')
					{
						$html .= 'selected';
					}
					$html .= '>' . T_("Deactive") . '</option>';
				}
				$html .= '</select>';

				$html .= '<label for="reason">' . T_("Reason") . '</label>';
				$html .= '<div class="input">';
				{
					$html .= '<input type="text" name="reason" placeholder="' . T_("Reason") . '" value="' . a($data, 'reason') . '">';
				}
				$html .= '</div>';

				$html .= '<div class="txtRa mt-2">';
				{
					$html .= '<button type="submit" class="btn-success">' . T_("Save") . '</button>';
				}
				$html .= '</div>';

			}
			$html .= "</div>";
		}
		$html .= "</div>";

	}
	$html .= '</form>';


	$html .= '<nav class="items">';
	{
		$html .= '<ul>';
		{
			$html .= '<li data-kerkere=".showAllPlanDetai">';
			{
				$html .= '<a class="f item">';
				{
					$html .= '<div class="key">';
					{
						$html .= T_("Show all detail");
					}
					$html .= '</div>';
					$html .= '<div class="value font-bold">';
					{
						$html .= T_("Click here");
					}
					$html .= '</div>';
				}
				$html .= '</a>';
			}
			$html .= '</li>';
		}
		$html .= '</ul>';
	}
	$html .= '</nav>';

	$html .= '<nav class="items ltr showAllPlanDetai" data-kerkere-content="hide">';
	{
		$html .= '<ul>';
		{
			foreach ($data as $field => $value)
			{
				$html .= '<li>';
				{
					$html .= '<a class="f item">';
					{
						$html .= '<div class="key">';
						{
							$html .= $field;
						}
						$html .= '</div>';
						$html .= '<div class="value font-bold">';
						{
							$html .= $value;
						}
						$html .= '</div>';
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
echo $html;
?>

