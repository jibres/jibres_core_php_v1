<?php

$html = '';
if(!\dash\data::customer())
{
	$html .= '<div class="alert-info">'. T_("Thist order have not any address!"). '</div>';
	return;
}



$html .= '<div class="m-4 p-4 box">';
{
	$html .= '<div class="pad" style="border: 1px solid;">';
	{
		$html .= '<div class="text-xl font-bold">';
		{
			$html .= '<h2>';
			{
				$html .= T_("Order Number");
				$html .= ' '. \dash\fit::text(a(\dash\data::orderDetail(), 'factor', 'id'));
			}
			$html .= '</h2>';

			$html .= '<h2>';
			{
				$html .= \dash\data::customer_displayname();
			}
			$html .= '</h2>';
		}
		$html .= '</div>';

		$country = a(\dash\data::address(),'country_name');
		if($country)
		{
			$html .= '<span class="font-bold text-xl">';
			{
				$html .= $country;
			}
			$html .= '</span>';
		}

		$province = a(\dash\data::address(), 'province_name');
		if($province)
		{
			$html .= T_(', ');
			$html .= '<span class="font-bold text-xl">';
			{
				$html .= T_("Province"). ' ';
				$html .= $province;
			}
			$html .= '</span>';
		}

		$city = a(\dash\data::address(),'city_name');
		if($city)
		{
			$html .= T_(', ');
			$html .= '<span class="font-bold text-xl">';
			{
				$html .= T_("City"). ' ';
				$html .= $city;
			}
			$html .= '</span>';
		}

		$html .= '<p class="text-xl">';
		{
			$html .= \dash\data::address_address();
		}
		$html .= '</p>';


		$html .= '<div class="row">';

		$phone    = \dash\data::address_phone();
		$fax      = \dash\data::address_fax();
		$mobile   = \dash\data::address_mobile();
		$postcode = \dash\data::address_postcode();

		if($mobile)
		{
			$html .= '<span class="c-auto">'. T_('Mobile'). '</span>'. ' ';
			$html .= '<code class="font-bold tracking-widest">';
			{
				// $html .= $fax;
				$html .= $mobile;
			}
			$html .= '</code>';
			$html .= '<div class="c-12"></div>';
		}

		if($postcode)
		{
			$html .= '<span class="c-auto">'. T_('Postal code'). '</span>'. ' ';
			$html .= '<code class="font-bold tracking-widest">';
			{
				// $html .= $fax;
				$html .= $postcode;
			}
			$html .= '</code>';
			$html .= '<div class="c-12"></div>';
		}

		if($phone)
		{
			$html .= '<span class="c-auto">'. T_('Phone'). '</span>'. ' ';
			$html .= '<code class="font-bold tracking-widest">';
			{
				// $html .= $phone;
				$html .= $phone;
			}
			$html .= '</code>';
		}

		if($fax)
		{
			$html .= '<span class="c-auto">'. T_('Fax'). '</span>'. ' ';
			$html .= '<code class="font-bold tracking-widest">';
			{
				// $html .= $fax;
				$html .= $fax;
			}
			$html .= '</code>';
		}

		$html .= '</div>';
		$html .= '<div class="w-3/12 ">';
		{
			$html .= '<div dir="ltr" class="text-left truncate">';
			$html .= \dash\data::customer_url();
			$html .= '</div>';
		}
		$html .= '</div>';



	}
	$html .= '</div>';

}
$html .= '</div>';




echo $html;
?>
