<?php
namespace dash\engine;
/**
 * dash main configure
 */
class power
{

	public static function on()
	{
		// set start engine power time
		\dash\runtime::start_engine();

		\dash\engine\prepare::requirements();

		// detect url and start work with them as first lib used by another one
		\dash\url::initialize();

		// block baby to not allow to harm yourself :/
		\dash\engine\baby::block();

		// detect language and if need set the new language
		\dash\language::detect_language();

		// find store detail and set to connect to true store
		\dash\engine\store::config();

		\dash\engine\prepare::basics();


		// check origin
		\dash\engine\guard::origin();

		// // check if isset remember me and login by this
		\dash\user::check_remeber_login();

		// LAUNCH !
		\dash\engine\mvc::fire();
	}
}
?>
