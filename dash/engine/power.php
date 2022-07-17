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

		\dash\engine\runtime::set('power', 'url');
		// detect url and start work with them as first lib used by another one
		\dash\url::initialize();

		// detect language and if need set the new language
		\dash\language::detect_language();

		// redirect http to https, remove www
		\dash\engine\prepare::hsts();

		// check waf
		\dash\engine\runtime::set('waf', 'start');
		\dash\waf\protection::start();
		\dash\engine\runtime::set('waf', 'end');


		\dash\engine\prepare::check_domain();

		// find store detail and set to connect to true store
		\dash\engine\runtime::set('powerStoreConf', 'start');
		\dash\engine\store::config();
		\dash\engine\runtime::set('powerStoreConf', 'end');


		\dash\engine\prepare::basics();

		// check origin
		\dash\engine\guard::origin();

		// check login
		\dash\engine\runtime::set('powerLoginCheck', 'start');
		\dash\login::check();

		// LAUNCH !
		\dash\engine\runtime::set('powerMVC', 'start');
		\dash\engine\mvc::fire();
	}
}
?>