<?php
namespace dash\utility;

// create select for locations
class location
{
	public static function countrySelector($_countryDefault = null, $_provinceDefault = null)
	{
		$placeholder = T_("Choose your country");
		echo '<div class="countrySelector">';
		echo '<label for="country">';
		echo T_("Country");
		echo '</label>';

		echo '<select class="select22" name="country" id="country" data-model="country"';
		echo ' data-next="#province"';
		echo ' data-placeholder="'. $placeholder. '"';
		if($_provinceDefault)
		{
			echo ' data-next-default="'. $_provinceDefault. '"';
		}
		echo '>';

		{
			$myCountryList = \dash\utility\location\countres::$data;
			echo '<option value="">'. $placeholder. '</option>';
			foreach ($myCountryList as $key => $value)
			{
				echo '<option value="';
				echo $key;
				echo '"';
				if($_countryDefault == $key)
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
		echo '</select>';

    echo '</div>';
	}
}
?>