<?php
namespace content_site\options\effect;


class effect_gradient_to extends \content_site\options\background\background_gradient_to
{


	public static function name()
	{
		return 'effect_gradient_to';
	}

	public static function title()
	{
		return T_("Effect Gradient to");
	}


	public static function extends_option()
	{
		return effect::extends_option();
	}

}
?>