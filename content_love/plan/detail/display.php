<?php
$data = \dash\data::dataRow();
$html = '';
$html .= '<div class="avand">';
{

	$html .= '<h3>' . T_("Store detail") . '</h3>';
	$html .= \content_love\plan\storeDetail::html(\dash\data::storeDetail());

	$html .= '<h3>' . T_("Current plan detail") . '</h3>';
	$html .= \content_love\plan\planDetail::html(\dash\data::dataRow());


	$html .= "<div class='box'>";
	{
		$html .= "<div class='pad'>";
		{
			$html .= '<h2 class="text-xl" data-kerkere=".showCancelFactor" data-kerkere-icon="close">';
			{
				$html .= T_("Cancel plan");
			}
			$html .= '</h2>';

			$html .= '<div class="showCancelFactor" data-kerkere-content="hide">';
			{
				$html .= '<nav class="items">';
				{
					$html .= '<ul>';
					{
						foreach (\dash\data::cancelFactor_factor() as $item)
						{
							$html .= '<li>';
							{
								$html .= '<a class="f item">';
								{
									$html .= '<div class="key">' . $item['title'] . '</div>';
									$html .= '<div class="value font-bold">' . \dash\fit::number($item['price']) . ' ' . T_("Toman") . '</div>';
								}
								$html .= '</a>';
							}
							$html .= '</li>';
						}

						$html .= '<li>';
						{
							$html .= '<a class="f item">';
							{
								$html .= '<div class="key">' . T_("Refund price to") . ' ' . a(\dash\data::cancelFactor(), 'meta', 'ownerDetail', 'displayname') . '</div>';
								$html .= '<div class="value font-bold">' . \dash\fit::mobile(a(\dash\data::cancelFactor(), 'meta', 'ownerDetail', 'mobile')) . '</div>';
							}
							$html .= '</a>';
						}
						$html .= '</li>';


					}
					$html .= '</ul>';
				}
				$html .= '</nav>';


				$html .= '<div class="txtRa mt-2">';
				{
					$html .= '<div data-confirm data-data=\'{"actiontype": "cancel"}\' class="btn-danger">' . T_("Cancel plan") . '</div>';
				}
				$html .= '</div>';
			}
			$html .= '</div>';

		}
		$html .= "</div>";
	}
	$html .= "</div>";

	$html .= "<div class='box'>";
	{
		$html .= "<div class='pad'>";
		{
			$html .= '<h2 class="text-xl">';
			{
				$html .= T_("Renew plan");
			}
			$html .= '</h2>';

			$html .= '<div class="txtRa mt-2">';
			{
				$renew =
					[
						'business_id' => \dash\data::dataRow_store_id(),
						'plan'        => \dash\data::dataRow_plan(),
						'periodtype'  => \dash\data::dataRow_periodtype(),
					];
				$html  .= '<a href="' . \dash\url::this() . '/add?' . \dash\request::build_query($renew) . '"  class="btn-primary">' . T_("Renew plan") . '</a>';
			}
			$html .= '</div>';

		}
		$html .= "</div>";
	}
	$html .= "</div>";

	$html .= "<div class='box'>";
	{
		$html .= "<div class='pad'>";
		{
			$html .= '<h2 class="text-xl">';
			{
				$html .= T_("Add new plan");
			}
			$html .= '</h2>';

			$html .= '<p class="">';
			{
				$html .= T_("Start new plan for this business");
			}
			$html .= '</p>';

			$html .= '<div class="txtRa mt-2">';
			{
				$html .= '<a href="' . \dash\url::this() . '/add?business_id=' . \dash\data::dataRow_store_id() . '"  class="btn-success">' . T_("Add new plan") . '</a>';
			}
			$html .= '</div>';

		}
		$html .= "</div>";
	}
	$html .= "</div>";


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

