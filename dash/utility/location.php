<?php
namespace dash\utility;

// create select for locations
class location
{

	public static function pack($_country = null, $_province = null, $_city = null)
	{
		$html = '';
		$html .= self::countrySelector($_country, $_province);
		$html .= self::provinceSelector($_country, $_province, $_city);
		$html .= self::citySelectorHtml($_city);
		return $html;
	}


	public static function packIran($_province = null, $_city = null)
	{
		$html = '';
		$html .= self::provinceSelector('IR', $_province, true);
		$html .= self::citySelectorHtml($_city);
		return $html;
	}


	public static function countrySelector($_country = null, $_province = null)
	{
		$html = '';
		$html .= '<div class="countrySelector mB5">';
		$html .= '<label for="country">';
		$html .= T_("Country");
		$html .= '</label>';
		$html .= self::countrySelectorHtml(...func_get_args());
    	$html .= '</div>';
    	return $html;
	}


	public static function countrySelectorHtml($_country = null, $_province = null, $_name = 'country', $_id = 'country')
	{
		$html = '';

		$placeholder = T_("Choose your country");
		$html .= '<select class="select22" name="'. $_name. '" id="'. $_id. '" data-model="country"';
		$html .= ' data-next="#province"';
		$html .= ' data-placeholder="'. $placeholder. '"';
		if($_province)
		{
			$html .= ' data-next-default="'. $_province. '"';
		}
		$html .= '>';

		{
			$html .= '<option value="">'. $placeholder. '</option>';

			$myCountryList = \dash\utility\location\countres::$data;
			if(is_array($myCountryList) && $myCountryList)
			{
				foreach ($myCountryList as $key => $value)
				{
					$html .= '<option value="';
					$html .= $key;
					$html .= '"';
					if($_country == $key)
					{
						$html .= ' selected';
					}
					$html .= ">";
					$countryName = ucfirst($value["name"]);
					$html .= $countryName;
					if(\dash\language::current() === 'en')
					{
						if(isset($value['localname']) && $value['localname'])
						{
							$html .= ' - '. $value['localname'];
						}
					}
					else
					{
						if(isset($value['name']))
						{
							$countryTransName = T_(ucfirst($value['name']));
							if($countryName !== $countryTransName)
							{
								$html .= ' - '. $countryTransName;

							}
						}
					}
					$html .= '</option>';
				}
			}
		}
		$html .= '</select>';
		return $html;
	}


	public static function provinceSelector($_country = null, $_province = null, $_pack_iran = false)
	{
		$html = '';

		$html .= '<div class="provinceSelector mB5"';
		if(!$_pack_iran)
		{
			$html .= ' data-status="hide"';
		}
		$html .= '>';
		$html .= '<label for="province">';
		$html .= T_("Province");
		$html .= '</label>';
		$html .= self::provinceSelectorHtml(...func_get_args());
	    $html .= '</div>';
	    return $html;
	}


	public static function provinceSelectorHtml($_country = null, $_province = null, $_city = null, $_name = 'province', $_id = 'province', $_city_name = 'city', $_city_id = 'city')
	{
		$html = '';


		$placeholder = T_("Please choose province");

		$html .= '<select class="select22" name="'.$_name. '" id="'. $_id. '"';
		$html .= ' data-next="#'.$_city_id. '"';
		$html .= ' data-next-type="city"';
		$html .= ' data-placeholder="'. $placeholder. '"';
		if($_city)
		{
			$html .= ' data-next-default="'. $_city. '"';
		}
		$html .= '>';

		{
			$html .= '<option value="">'. $placeholder. '</option>';

			if($_country === 'IR')
			{
				$myProvinceList = \dash\utility\location\provinces::key_list('localname');
				// $myProvinceList = [];
				if(is_array($myProvinceList) && $myProvinceList)
				{
					foreach ($myProvinceList as $key => $value)
					{
						$html .= '<option value="';
						$html .= $key;
						$html .= '"';
						if($_province == $key)
						{
							$html .= ' selected';
						}
						$html .= ">";
						if(isset($value))
						{
							$html .= ucfirst($value);
						}
						$html .= '</option>';
					}
				}
			}
		}
		$html .= '</select>';
		return $html;
	}





	public static function citySelectorHtml($_city = null, $_name = 'city', $_id = 'city')
	{
		$html = '';

		$placeholder = T_("Please choose city");
		$html .= '<div class="citySelector mB5"';
		$html .= ' data-status="hide"';
		$html .= '>';
		$html .= '<label for="city">';
		$html .= T_("City");
		$html .= '</label>';

		$html .= '<select class="select22" name="'. $_name. '" id="'. $_id. '"';
		$html .= ' data-placeholder="'. $placeholder. '"';
		$html .= '>';

		{
			$html .= '<option value="">'. $placeholder. '</option>';

			// get city list
			$myCityList = \dash\utility\location\cites::$data;
			$myCityList = [];
			$newCityList = [];
			if($myCityList)
			{
				foreach ($myCityList as $key => $value)
				{
					$temp = '';

					if(isset($value['province']) && isset($proviceList[$value['province']]))
					{
						$temp .= $proviceList[$value['province']]. ' - ';
					}
					if(isset($value['localname']))
					{
						$temp .= $value['localname'];
					}
					$newCityList[$key] = $temp;
				}
				asort($newCityList);
			}



			if(is_array($newCityList) && $newCityList)
			{
				foreach ($newCityList as $key => $value)
				{
					$html .= '<option value="';
					$html .= $key;
					$html .= '"';
					if($_city == $key)
					{
						$html .= ' selected';
					}
					$html .= ">";
					if(isset($value['name']))
					{
						$html .= ucfirst($value["name"]);
					}
					$html .= '</option>';
				}
			}
		}
		$html .= '</select>';

    	$html .= '</div>';
    	return $html;
	}
}
?>