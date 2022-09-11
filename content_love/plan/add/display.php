<?php
$data    = \dash\data::dataRow();
$html    = '';
$storeId = \dash\data::dataRow_id();
$html    .= "<div class='avand'>";
{


	if(!$data)
	{
		$html .= "<div class='box'>";
		{
			$html .= "<div class='pad'>";
			{
				$html .= '<form method="get" autocomplete="off" action="' . \dash\url::that() . '">';
				{
					$html .= '<label>';
					{
						$html .= T_("Business");
					}
					$html .= '</label>';
					$html .= '<select name="business_id" class="select22"  data-model="html"  data-ajax--url="' . \dash\url::here() . '/store/api?json=true" data-shortkey-search data-placeholder="' . T_("Choose Business") . '">';
					if(\dash\data::dataRow_store_id())
					{
						$html .= '<option value="' . \dash\data::dataRow_store_id() . '" selected>' . \dash\data::selectedStoreTitle() . '</option>';
					}
					$html .= '</select>';

					$html .= '<div class="txtRa">';
					{
						$html .= '<button class="btn-success mt-4">' . T_("Go") . '</button>';
					}
					$html .= '</div>';
				}
				$html .= '</form>';


			}
			$html .= "</div>";
		}
		$html .= "</div>";

	}
	else
	{

		$html .= \content_love\plan\storeDetail::html($data);

		$html .= "<div class='box'>";
		{
			$html .= "<div class='pad'>";
			{
				$html .= '<form method="post" autocomplete="off">';
				{
					$html .= '<p>';
					{
						$html .= T_("If current plan is equal by new plan, plan was extended");
					}
					$html .= '</p>';

					$html .= '<label for="plan">' . T_("New Plan") . '</label>';

					$html .= '<select name="plan" class="select22" id="plan">';
					{
						foreach (\dash\data::planList() as $item)
						{
							$html .= '<option value="' . $item . '">' . T_(ucfirst($item)) . '</option>';
						}
					}
					$html .= '</select>';

					$html .= '<label for="periodtype">' . T_("Period") . '</label>';

					$html .= '<select name="periodtype" class="select22" id="periodtype">';
					{
						$html .= '<option value="yearly">' . T_("Yearly") . '</option>';
						$html .= '<option value="monthly">' . T_("Monthly") . '</option>';
						$html .= '<option value="custom">' . T_("Custom") . '</option>';
					}
					$html .= '</select>';

					$html .= '<div data-response="periodtype" data-response-where="custom" data-response-hide>';
					{
						$html .= '<label for="days">' . T_("Days") . '</label>';
						$html .= '<div class="input">';
						{
							$html .= '<input type="tel" name="days" placeholder="' . T_("Days") . '">';
						}
						$html .= '</div>';

					}
					$html .= '</div>';

					$html .= '<div class="txtRa mt-8">';
					{
						$html .= '<a class="btn-secondary outline mx-4" href="' . \dash\url::that() . '">' . T_("Cancel") . '</a>';
						$html .= '<button type="submit" class="btn-success">' . T_("Set plan") . '</button>';
					}
					$html .= '</div>';


				}
				$html .= '</form>';


			}
			$html .= "</div>";
		}
		$html .= "</div>";

	}

}
$html .= "</div>";
echo $html;
?>


