<?php
namespace dash\utility;

// create select for locations
class location
{
	public static function countrySelector($_country = null, $_province = null)
	{
		$placeholder = T_("Choose your country");
		echo '<div class="countrySelector">';
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
						echo 'selected';
					}
					echo ">";
					echo ucfirst($value["name"]);
					if(\dash\language::current() != 'en')
					{
						echo ' - '. T_(ucfirst($value['name']));
					}
					echo '</option>';
				}
			}
		}
		echo '</select>';

    echo '</div>';
	}


	public static function provinceSelector($_province = null, $_city = null)
	{
		$placeholder = ("Please choose province");
		echo '<div class="provinceSelector">';
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
			$myProvinceList = \dash\utility\location\countres::$data;
			echo '<option value="">'. $placeholder. '</option>';

			if(is_array($myProvinceList) && $myProvinceList)
			{
				foreach ($myProvinceList as $key => $value)
				{
					echo '<option value="';
					echo $key;
					echo '"';
					if($_province == $key)
					{
						echo 'selected';
					}
					echo ">";
					echo ucfirst($value["name"]);
					if(\dash\language::current() != 'en')
					{
						echo ' - '. T_(ucfirst($value['name']));
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