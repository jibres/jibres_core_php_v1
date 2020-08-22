<?php
namespace dash\utility;

// create select for locations
class location
{

	public static function pack($_country = null, $_province = null, $_city = null)
	{
		self::countrySelector($_country, $_province);
		self::provinceSelector($_country, $_province, $_city);
		self::citySelector($_country, $_province, $_city);
	}


	public static function packIran($_province = null, $_city = null)
	{
		self::provinceSelector($_country, $_province, $_city);
		self::citySelector($_country, $_province, $_city);
	}


	public static function countrySelector($_country = null, $_province = null)
	{
		$placeholder = T_("Choose your country");
		echo '<div class="countrySelector mB5">';
		echo '<label for="country">';
		echo T_("Country");
		echo '</label>';

		echo '<select class="select22" name="country" id="country" data-model="country"';
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
					echo ucfirst($value["name"]);
					if(\dash\language::current() != 'en')
					{
						if(isset($value['name']))
						{
							echo ' - '. T_(ucfirst($value['name']));
						}
					}
					echo '</option>';
				}
			}
		}
		echo '</select>';

    echo '</div>';
	}


	public static function provinceSelector($_country = null, $_province = null, $_city = null)
	{
		$placeholder = ("Please choose province");
		echo '<div class="provinceSelector mB5"';
		if($_country !== 'IR')
		{
			// echo ' data-status="hide"';
		}
		echo ' data-status="hide"';
		echo '>';
		echo '<label for="province">';
		echo T_("Province");
		echo '</label>';

		echo '<select class="select22" name="province" id="province"';
		echo ' data-next="#city"';
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

    echo '</div>';
	}


	public static function citySelector($_country = null, $_province = null, $_city = null)
	{
		$placeholder = ("Please choose city");
		echo '<div class="citySelector mB5"';
		if(!$_province)
		{
			echo ' data-status="hide"';
		}
		echo '>';
		echo '<label for="city">';
		echo T_("City");
		echo '</label>';

		echo '<select class="select22" name="city" id="city"';
		echo ' data-placeholder="'. $placeholder. '"';
		echo '>';

		{
			echo '<option value="">'. $placeholder. '</option>';

			// get city list
			$myCityList = \dash\utility\location\cites::$data;
			$myCityList = [];
			if($myCityList)
			{
				$newCityList = [];
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