<?php
namespace dash\engine;
/**
 * Create static files
 */
class static_files
{
	public static function human()
	{
		$contributors = "";
		// general detail
		$contributors .= '/** '. ("In The name of Allah"). ' **/' . "\n\n\n";

		// $contributors .= "\n\n\n";
		$contributors .= '     ██╗██╗██████╗ ██████╗ ███████╗███████╗'. "\n";
		$contributors .= '     ██║██║██╔══██╗██╔══██╗██╔════╝██╔════╝'. "\n";
		$contributors .= '     ██║██║██████╔╝██████╔╝█████╗  ███████╗'. "\n";
		$contributors .= '██   ██║██║██╔══██╗██╔══██╗██╔══╝  ╚════██║'. "\n";
		$contributors .= '╚█████╔╝██║██████╔╝██║  ██║███████╗███████║'. "\n";
		$contributors .= ' ╚════╝ ╚═╝╚═════╝ ╚═╝  ╚═╝╚══════╝╚══════╝'. "\n";
		$contributors .= ''. "\n";

		$contributors .= "https://Jibres.com". "\n";
		$contributors .= "https://github.com/Jibres". "\n\n";

		$contributors .= ("Jibres is built by a creative team of engineers, designers, researchers and others in many different sites across the globe. It is updated continuously, and built with more tools and technologies than we can shake a stick at. If you'd like to help us out, see jibres.com/careers."). "\n";


		// teams member
		$contributors .= "\n\n". "/* ". ('TEAM'). "*/";

		// Javad Adib
		$contributors .= "\n\t". ("Javad Adib");
		$contributors .= "\n\t". ('Website'). ": https://mradib.com";
		$contributors .= "\n\t". ('Website'). ": https://evazzadeh.com";
		$contributors .= "\n\t". ('Contact'). ": CEO [at] Jibres.com";
		$contributors .= "\n\t". ('Twitter'). ": @MrAdib";
		$contributors .= "\n\t". ('Github'). ": @MrJavadAdib";
		$contributors .= "\n\t". ('Telegram'). ": @MrJavadAdib";
		// $contributors .= "\n\t". ('Location'). ": Iran";
		$contributors .= "\n";

		// Reza Mohiti
		$contributors .= "\n\t". ("Reza Mohiti");
		$contributors .= "\n\t". ('Website'). ": https://rezamohiti.ir";
		$contributors .= "\n\t". ('Contact'). ": rm.biqarar [at] gmail.com";
		$contributors .= "\n\t". ('Twitter'). ": @rmBiqarar";
		$contributors .= "\n\t". ('Github'). ": @biqarar";
		$contributors .= "\n\t". ('Telegram'). ": @Biqarar";
		// $contributors .= "\n\t". ('Location'). ": Qom, Iran";


		// special thanks to
		$contributors .= "\n\n\n". "/* ". ('THANKS'). "*/";

		// Mohammad Hasan Salehi HajiAbadi
		$contributors .= "\n\t". ("Mohammad Hasan Salehi HajiAbadi");
		$contributors .= "\n\t". ('Website'). ": https://hasansalehi.ir";
		$contributors .= "\n\t". ('Contact'). ": itb.Baravak [at] gmail.com";
		$contributors .= "\n\t". ('Twitter'). ": @baravak";
		$contributors .= "\n\t". ('Github'). ": @baravak";
		$contributors .= "\n\t". ('Telegram'). ": @Hasan";
		// $contributors .= "\n\t". ('Location'). ": Qom, Iran";
		$contributors .= "\n";

		// Saman Soltani
		$contributors .= "\n\t". ("Saman Soltani");
		$contributors .= "\n\t". ('Website'). ": https://samansoltani.com";
		$contributors .= "\n\t". ('Contact'). ': '. "sam.soltani [at] gmail.com";
		$contributors .= "\n\t". ('Twitter'). ": @Saman_Soltani";
		$contributors .= "\n\t". ('Github'). ": @Saman";
		$contributors .= "\n\t". ('Telegram'). ": @Saman_Soltani";
		// $contributors .= "\n\t". ('Location'). ": Germany";
		$contributors .= "\n";

		// Sadegh Salehi
		$contributors .= "\n\t". ("Sadegh Salehi HajiAbadi");
		$contributors .= "\n\t". ('Website'). ": https://sahelekaj.ir";
		$contributors .= "\n\t". ('Contact'). ': '. "sahelekaj [at] gmail.com";
		$contributors .= "\n\t". ('Telegram'). ": @Sahelekaj";
		// $contributors .= "\n\t". ('Location'). ": Iran";
		$contributors .= "\n";

		// Ahmad Karimi
		$contributors .= "\n\t". ("Ahmad Karimi");
		$contributors .= "\n\t". ('Website'). ": http://ahmadkarimi.com";
		$contributors .= "\n\t". ('Contact'). ': '. "ahmadkarimi1991 [at] gmail.com";
		$contributors .= "\n\t". ('Twitter'). ": @AhmadKarimi1991";
		$contributors .= "\n\t". ('Github'). ": @AhmadKarimi1991";
		$contributors .= "\n\t". ('Telegram'). ": @eahmad";
		// $contributors .= "\n\t". ('Location'). ": Iran";
		$contributors .= "\n";


		// site
		$contributors .= "\n\n\n". "/* ". ('SITE'). "*/";
		$contributors .= "\n\t". "Last update: 26/12/2020";
		$contributors .= "\n\t". "Version: 3.0.0";
		$contributors .= "\n\t". "Language: Farsi / English";
		$contributors .= "\n\t". "Doctype: HTML5";
		$contributors .= "\n\t". "IDE: Sublime!";


		// Ermile
		// $contributors .= "\n\n\n";
		// $contributors .= '─██████████████─████████████████───██████──────────██████─██████████─██████─────────██████████████─'. "\n";
		// $contributors .= '─██░░░░░░░░░░██─██░░░░░░░░░░░░██───██░░██████████████░░██─██░░░░░░██─██░░██─────────██░░░░░░░░░░██─'. "\n";
		// $contributors .= '─██░░██████████─██░░████████░░██───██░░░░░░░░░░░░░░░░░░██─████░░████─██░░██─────────██░░██████████─'. "\n";
		// $contributors .= '─██░░██─────────██░░██────██░░██───██░░██████░░██████░░██───██░░██───██░░██─────────██░░██─────────'. "\n";
		// $contributors .= '─██░░██████████─██░░████████░░██───██░░██──██░░██──██░░██───██░░██───██░░██─────────██░░██████████─'. "\n";
		// $contributors .= '─██░░░░░░░░░░██─██░░░░░░░░░░░░██───██░░██──██░░██──██░░██───██░░██───██░░██─────────██░░░░░░░░░░██─'. "\n";
		// $contributors .= '─██░░██████████─██░░██████░░████───██░░██──██████──██░░██───██░░██───██░░██─────────██░░██████████─'. "\n";
		// $contributors .= '─██░░██─────────██░░██──██░░██─────██░░██──────────██░░██───██░░██───██░░██─────────██░░██─────────'. "\n";
		// $contributors .= '─██░░██████████─██░░██──██░░██████─██░░██──────────██░░██─████░░████─██░░██████████─██░░██████████─'. "\n";
		// $contributors .= '─██░░░░░░░░░░██─██░░██──██░░░░░░██─██░░██──────────██░░██─██░░░░░░██─██░░░░░░░░░░██─██░░░░░░░░░░██─'. "\n";

		// $contributors .= "\n\n\n";
		// $contributors .= '     /$$$$$ /$$ /$$'. "\n";
		// $contributors .= '    |__  $$|__/| $$'. "\n";
		// $contributors .= '       | $$ /$$| $$$$$$$   /$$$$$$   /$$$$$$   /$$$$$$$'. "\n";
		// $contributors .= '       | $$| $$| $$__  $$ /$$__  $$ /$$__  $$ /$$_____/'. "\n";
		// $contributors .= '  /$$  | $$| $$| $$  \ $$| $$  \__/| $$$$$$$$|  $$$$$$ '. "\n";
		// $contributors .= ' | $$  | $$| $$| $$  | $$| $$      | $$_____/ \____  $$'. "\n";
		// $contributors .= ' |  $$$$$$/| $$| $$$$$$$/| $$      |  $$$$$$$ /$$$$$$$/'. "\n";
		// $contributors .= ' \______/ |__/|_______/ |__/       \_______/|_______/ '. "\n";
		// $contributors .= ''. "\n";


		// cache 1 day
		\dash\header::cache(60*60*24);

		// try to show it
		\dash\code::jsonBoom($contributors, true, 'text');
	}


	public static function robots()
	{
		$robots = "";
		// allow all user agents
		$robots .= "User-Agent: *". "\n";

		// disallow
		$robots .= "Disallow: /cgi-bin/". "\n";
		$robots .= "Disallow: /static/". "\n";
		$robots .= "Disallow: /enter/". "\n";
		$robots .= "Disallow: /account/". "\n";
		$robots .= "Disallow: /a/". "\n";
		$robots .= "Disallow: /cp/". "\n";
		$robots .= "Disallow: /su/". "\n";
		$robots .= "Disallow: /crm/". "\n";
		$robots .= "Disallow: /cms/". "\n";
		$robots .= "Disallow: /tmp/". "\n";
		$robots .= "Disallow: /*.txt$". "\n\n";

		// allow
		$robots .= "Sitemap: /sitemap.xml". "\n";

		// cache 1 day
		\dash\header::cache(60*60*24);

		\dash\code::jsonBoom($robots, true, 'text');
	}

}
?>
