<?php
$data          = \dash\data::dataRow();
$html          = '';
$storeId       = \dash\data::dataRow_id();
$currnetCharge = \lib\app\sms_charge\charge::getBalance($storeId);
$html          .= "<div class='avand'>";
{


	if(!$data)
	{
		$html .= "<div class='box'>";
		{
			$html .= "<div class='pad'>";
			{
				$html .= '<form method="get" autocomplete="off" action="' . \dash\url::current() . '">';
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

		$html .= '<nav class="items">';
		{
			$html .= '<ul>';
			{
				$html .= '<li>';
				{
					$html .= '<a class="f item">';
					{
						$html .= '<div class="key">' . T_("ID") . '</div>';
						$html .= '<div class="value font-bold">' . a($data, 'id') . '</div>';
					}
					$html .= '</a>';
				}
				$html .= '</li>';

				$html .= '<li>';
				{
					$html .= '<a class="f item">';
					{
						$html .= '<div class="key">' . T_("Business title") . '</div>';
						$html .= '<div class="value font-bold">' . a($data, 'title') . '</div>';
					}
					$html .= '</a>';
				}
				$html .= '</li>';

				$html .= '<li>';
				{
					$html .= '<a class="f item">';
					{
						$html .= '<div class="key">' . T_("Current plan") . '</div>';
						$html .= '<div class="value font-bold">' . T_(ucfirst(strval(a($data, 'plan')))) . '</div>';
					}
					$html .= '</a>';
				}
				$html .= '</li>';
			}
			$html .= '</ul>';
		}
		$html .= '</nav>';

		$html .= "<div class='box'>";
		{
			$html .= "<div class='pad'>";
			{
				$html .= '<form method="post" autocomplete="off">';
				{
					$html .= '<div class="alert-info">';
					{
						$html .= T_("The current business sms charge is");
						$html .= '<span class="font-bold mx-2">' . \dash\fit::number($currnetCharge) . ' ' . \lib\currency::jibres_currency(true) . '</span>';
					}
					$html .= '</div>';

					$html .= '<div class="row mb-2">';
					{
						$html .= '<div class="c-xs-6 c-sm-6">';
						{
							$html .= '<div class="radio3">';
							{
								$html .= '<input type="radio" name="type" value="plus" id="plus" >';
								$html .= '<label for="plus">' . T_("Increasing the charge") . '</label>';
							}
							$html .= '</div>';
						}

						$html .= '</div>';

						$html .= '<div class="c-xs-6 c-sm-6">';
						{

							$html .= '<div class="radio3">';
							{

								$html .= '<input type="radio" name="type" value="minus" id="minus" >';
								$html .= '<label for="minus">' . T_("Reducing the chage") . '</label>';
							}
							$html .= '</div>';
						}
						$html .= '</div>';
					}

					$html .= '</div>';

					$html .= '<div data-response="type" data-response-where="minus" data-response-hide data-response-effect="slide">';
					{
						$html .= '<div class="alert-danger">';
						{
							$html .= T_("Be careful, you are reducing the charge amount of SMS Business account");
						}
						$html .= '</div>';
					}
					$html .= '</div>';

					$html .= '<div data-response="type" data-response-where="plus" data-response-hide data-response-effect="slide">';
					{
						$html .= '<div class="alert-success">';
						{
							$html .= T_("You are increasing the recharge amount of SMS Business account");
						}
						$html .= '</div>';
					}
					$html .= '</div>';
					$html .= '<br>';

					$html .= '<div data-response="type" data-response-where="plus|minus" data-response-hide data-response-effect="slide">';
					{

						$html .= '<label for="amount">' . T_("Amount") . '</label>';
						$html .= '<div class="input">';
						{
							$html .= '<input type="tel" name="amount" data-format="price" id="amount" placeholder="' . \lib\currency::jibres_currency(true) . '">';
						}
						$html .= '</div>';


					}
					$html .= '</div>';


					$html .= '<div class="txtRa mt-8">';
					{
						$html .= '<a class="btn-secondary outline mx-4" href="' . \dash\url::that() . '">' . T_("Cancel") . '</a>';
						$html .= '<button type="submit" class="btn-primary">' . T_("Update charge") . '</button>';
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


