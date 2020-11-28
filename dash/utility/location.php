<?php
namespace dash\utility;

// create select for locations
class location
{

	public static function pack($_country = null, $_province = null, $_city = null)
	{
		self::countrySelector($_country, $_province);
		self::provinceSelector($_country, $_province, $_city);
		self::citySelectorHtml($_city);
	}


	public static function packIran($_province = null, $_city = null)
	{
		self::provinceSelector('IR', $_province, true);
		self::citySelectorHtml($_city);
	}


	public static function countrySelector($_country = null, $_province = null)
	{
		echo '<div class="countrySelector mB5">';
		echo '<label for="country">';
		echo T_("Country");
		echo '</label>';
		self::countrySelectorHtml(...func_get_args());
    	echo '</div>';
	}


	public static function countrySelectorHtml($_country = null, $_province = null, $_name = 'country', $_id = 'country')
	{
		$placeholder = T_("Choose your country");
		echo '<select class="select22" name="'. $_name. '" id="'. $_id. '" data-model="country"';
		echo ' data-next="#province"';
		echo ' data-placeholder="'. $placeholder. '"';
		if($_province)
		{
			echo ' data-next-default="'. $_province. '"';
		}
		echo '>';

		{
			echo '<option value="">'. $placeholder. '</option>';

			$myCountryList = \dash\utility\location\countres::$data;
			if(is_array($myCountryList) && $myCountryList)
			{
				foreach ($myCountryList as $key => $value)
				{
					echo '<option value="';
					echo $key;
					echo '"';
					if($_country == $key)
					{
						echo ' selected';
					}
					echo ">";
					$countryName = ucfirst($value["name"]);
					echo $countryName;
					if(\dash\language::current() === 'en')
					{
						if(isset($value['localname']) && $value['localname'])
						{
							echo ' - '. $value['localname'];
						}
					}
					else
					{
						if(isset($value['name']))
						{
							$countryTransName = T_(ucfirst($value['name']));
							if($countryName !== $countryTransName)
							{
								echo ' - '. $countryTransName;

							}
						}
					}
					echo '</option>';
				}
			}
		}
		echo '</select>';
	}


	public static function provinceSelector($_country = null, $_province = null, $_pack_iran = false)
	{
		echo '<div class="provinceSelector mB5"';
		if(!$_pack_iran)
		{
			echo ' data-status="hide"';
		}
		echo '>';
		echo '<label for="province">';
		echo T_("Province");
		echo '</label>';
		self::provinceSelectorHtml(...func_get_args());
	    echo '</div>';
	}


	public static function provinceSelectorHtml($_country = null, $_province = null, $_city = null, $_name = 'province', $_id = 'province', $_city_name = 'city', $_city_id = 'city')
	{

		$placeholder = T_("Please choose province");

		echo '<select class="select22" name="'.$_name. '" id="'. $_id. '"';
		echo ' data-next="#'.$_city_id. '"';
		echo ' data-next-type="city"';
		echo ' data-placeholder="'. $placeholder. '"';
		if($_city)
		{
			echo ' data-next-default="'. $_city. '"';
		}
		echo '>';

		{
			echo '<option value="">'. $placeholder. '</option>';

			if($_country === 'IR')
			{
				$myProvinceList = \dash\utility\location\provinces::key_list('localname');
				// $myProvinceList = [];
				if(is_array($myProvinceList) && $myProvinceList)
				{
					foreach ($myProvinceList as $key => $value)
					{
						echo '<option value="';
						echo $key;
						echo '"';
						if($_province == $key)
						{
							echo ' selected';
						}
						echo ">";
						if(isset($value))
						{
							echo ucfirst($value);
						}
						echo '</option>';
					}
				}
			}
		}
		echo '</select>';
	}





	public static function citySelectorHtml($_city = null, $_name = 'city', $_id = 'city')
	{
		$placeholder = T_("Please choose city");
		echo '<div class="citySelector mB5"';
		echo ' data-status="hide"';
		echo '>';
		echo '<label for="city">';
		echo T_("City");
		echo '</label>';

		echo '<select class="select22" name="'. $_name. '" id="'. $_id. '"';
		echo ' data-placeholder="'. $placeholder. '"';
		echo '>';

		{
			echo '<option value="">'. $placeholder. '</option>';

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
					echo '<option value="';
					echo $key;
					echo '"';
					if($_city == $key)
					{
						echo ' selected';
					}
					echo ">";
					if(isset($value['name']))
					{
						echo ucfirst($value["name"]);
					}
					echo '</option>';
				}
			}
		}
		echo '</select>';

    echo '</div>';
	}
}
?>