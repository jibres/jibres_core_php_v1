<?php
namespace dash\engine;

class viewThirdParty
{
	public static function append()
	{
		\dash\data::addons_gtag(self::googleAnalytics());
		\dash\data::addons_tawk(self::tawk());
		\dash\data::addons_imber(self::imber());
		\dash\data::addons_raychat(self::raychat());
	}


	public static function googleAnalytics()
	{
		// supersaeed guid
		// UA-130946685-3
		if(\dash\engine\store::inStore())
		{
			if(\lib\store::detail('google_analytics'))
			{
				return \lib\store::detail('google_analytics');
			}
			else
			{
				return null;
			}
		}

		// for jibres
		switch (\dash\url::tld())
		{
			case 'ir':
				return 'UA-130946685-2';

			case 'com':
				return 'UA-130946685-1';

			default:
				return null;
		}
	}


	public static function tawk()
	{
		if(\dash\engine\store::inBusinessWebsite())
		{
			if(\lib\store::detail('addon_tawk'))
			{
				return \lib\store::detail('addon_tawk');
			}
			else
			{
				return null;
			}
		}

		return null; // force disable

		// for jibres
		switch (\dash\url::tld())
		{
			case 'ir':
				return '5fc8dc17a1d54c18d8f00574';

			case 'com':
				return '5fdb8b03a8a254155ab44bbd';

			default:
				return null;
		}
	}


	public static function imber()
	{
		if(\dash\engine\store::inBusinessWebsite())
		{
			if(\lib\store::detail('addon_imber'))
			{
				return \lib\store::detail('addon_imber');
			}
			else
			{
				return null;
			}
		}

		switch (\dash\url::tld())
		{
			case 'ir':
				return null;
				// return 'z4ukjzykjxzslen';

			case 'com':
				return null;

			default:
				return null;
		}
	}


	public static function raychat()
	{
		return null; // force disable

		if(\dash\engine\store::inBusinessWebsite())
		{
			if(\lib\store::detail('addon_raychat'))
			{
				return \lib\store::detail('addon_raychat');
			}
			else
			{
				return null;
			}
		}

		switch (\dash\url::tld())
		{
			case 'ir':
				return '753a218c-a747-4aa1-a637-c3e8552bde75';

			case 'local':
				return '9e05444f-b316-4e42-b85d-40e18c4ff8d7';

			default:
				return null;
		}
	}


}
?>
