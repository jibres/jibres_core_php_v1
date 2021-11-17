<?php
namespace content_site\options\effect;


class effect_gradient_type
{
	use \content_site\options\background\background_gradient_type;

	public static function name()
	{
		return 'effect_gradient_type';
	}

	public static function title()
	{
		return T_("Effect Gradient type");
	}

	public static function extends_option()
	{
		return effect::extends_option();
	}
}
?>