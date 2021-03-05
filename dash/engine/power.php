<?php
namespace dash\engine;
/**
 * dash main configure
 */
class power
{

	public static function on()
	{
		\dash\engine\prepare::requirements();

		// detect url and start work with them as first lib used by another one
		\dash\url::initialize();

		// detect language and if need set the new language
		\dash\language::detect_language();

		// check waf
		\dash\waf\protection::start();

		// find store detail and set to connect to true store
		\dash\engine\store::config();


		\dash\engine\prepare::basics();

		// check origin
		\dash\engine\guard::origin();

		// check login
		\dash\login::check();

		// LAUNCH !
		\dash\engine\mvc::fire();
	}
}
?>
