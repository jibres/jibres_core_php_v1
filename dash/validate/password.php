<?php
namespace dash\validate;

class password
{
	private static $crazy_password =
	[
		'123456','password','12345678','qwerty','123456789','12345','1234','111111','1234567','dragon','123123','baseball','abc123','football','monkey','letmein','696969','666666',
		'qwertyuiop','123321','1234567890','michael','654321','pussy','superman','1qaz2wsx','7777777',		'0','qazwsx','123qwe','trustno1','jordan','jennifer','zxcvbnm','asdfgh',
		'hunter','buster','soccer','harley','sunshine','iloveyou','fuckme','2000','charlie','robert','hockey','ranger','daniel','starwars','klaster','112233','asshole','computer',
		'michelle','jessica','pepper','1111','zxcvbn','555555','11111111','131313','freedom','777777','pass','fuck','maggie','159753','aaaaaa','ginger','princess','cheese','amanda',
		'summer','ashley','6969','nicole','chelsea','biteme','matthew','access','yankees','987654321','austin','thunder','taylor','matrix','corvette','hello','secret','fucker','diamond',
		'1234qwer','gfhjkm','hammer','silver','222222','88888888','justin','test','bailey','q1w2e3r4t5','patrick','internet','scooter','orange','11111','golfer','cookie','richard',
		'bigdog','guitar','jackson','whatever','mickey','chicken','sparky','snoopy','maverick','phoenix','camaro','sexy','peanut','morgan','welcome','falcon','cowboy','ferrari','samsung',
		'andrea','smokey','steelers','joseph','dakota','arsenal','eagles','melissa','boomer','booboo','spider','nascar','monster','tigers','yellow','xxxxxx','123123123','gateway',
		'marina','diablo','bulldog','qwer1234','compaq','purple','hardcore','banana','junior','hannah','123654','porsche','lakers','iceman','money','cowboys','987654','london','tennis',
		'999999','ncc1701','coffee','scooby','miller','boston','q1w2e3r4','fuckoff','brandon','yamaha','chester','mother','forever','johnny','edward','333333','oliver','redsox','player',
		'nikita','knight','fender','barney','midnight','please','brandy','chicago','badboy','iwantu','slayer','rangers','angel','flower','bigdaddy','rabbit','wizard','bigdick','jasper',
		'enter','rachel','chris','steven','winner','adidas','natasha','1q2w3e4r','jasmine','winter','prince','panties','marine','ghbdtn','fishing','cocacola','casper','james','232323',
		'raiders','888888','gandalf','asdfasdf','crystal','87654321','12344321','sexsex','golden','blowme','bigtits','8675309','panther','lauren','angela','bitch','spanky','thx1138',
		'angels','madison','winston','shannon','mike','toyota','blowjob','canada','sophie','apples','dick','tiger','razz','123abc','pokemon','qazxsw','55555','qwaszx','muffin','johnson',
		'murphy','cooper','jonathan','liverpoo','danielle','159357','jackie','1990','123456a','789456','turtle','horny','abcd1234','scorpion','qazwsxedc','101010','butter','carlos',
		'password1','dennis','slipknot','qwerty123','booger','asdf','1991','black','startrek','12341234','cameron','newyork','rainbow','nathan','john','1992','rocket','viking','redskins',
		'butthead','asdfghjkl','1212','sierra','peaches','gemini','doctor','wilson','helpme','qwertyui','victor','florida','dolphin','pookie','captain','tucker','blue','liverpool',
		'theman','bandit','dolphins','maddog','packers','jaguar','lovers','nicholas','united','tiffany','maxwell','zzzzzz','nirvana','jeremy','suckit','stupid','porn','monica','elephant',
		'giants','jackass','hotdog','rosebud','success','debbie','mountain','444444','xxxxxxxx','warrior','1q2w3e4r5t','q1w2e3','123456q','albert','metallic','lucky','azerty','7777',
		'shithead','alex','bond007','alexis','1111111','samson','5150','willie','scorpio','bonnie','gators','benjamin','voodoo','driver','dexter','2112','jason','calvin','freddy','212121',
		'creative','12345a','sydney','rush2112','1989','asdfghjk','red123','bubba','4815162342','passw0rd','trouble','gunner','happy','fucking','gordon','legend','jessie','stella','qwert',
		'eminem','arthur','apple','nissan','bullshit','bear','america','1qazxsw2','nothing','parker','4444','rebecca','qweqwe','garfield','1012011','beavis','69696969','jack','asdasd',
		'december','2222','102030','252525','11223344','magic','apollo','skippy','315475','girls','kitten','copper','braves','shelby','godzilla','beaver','fred','tomcat','august','buddy',
		'airborne','1993','1988','lifehack','qqqqqq','brooklyn','animal','platinum','phantom','online','xavier','darkness','blink182','power','fish','green','789456123','voyager','police',
		'travis','12qwaszx','heaven','snowball','lover','abcdef','pakistan','7007','walter','playboy','blazer','cricket','sniper','hooters','donkey','willow','loveme','saturn','therock',
		'redwings','bigboy','pumpkin','trinity','williams','tits','nintendo','digital','destiny','topgun','runner','marvin','guinness','chance','bubbles','testing','fire','november',
		'minecraft','asdf1234','lasvegas','sergey','broncos','cartman','private','celtic','birdie','little','cassie','babygirl','donald','beatles','1313','dickhead','family','12121212',
		'school','louise','gabriel','eclipse','fluffy','147258369','lol123','explorer','beer','nelson','flyers','spencer','scott','lovely','gibson','doggie','cherry','andrey','snickers',
		'buffalo','pantera','metallica','member','carter','qwertyu','peter','alexande','steve','bronco','paradise','goober','5555','samuel','montana','mexico','dreams','michigan','cock',
		'carolina','yankee','friends','magnum','surfer','poopoo','maximus','genius','cool','vampire','lacrosse','asd123','aaaa','christin','kimberly','speedy','sharon','carmen','111222',
		'kristina','sammy','racing','ou812','sabrina','horses','qwerty1','pimpin','baby','stalker','enigma','147147','star','poohbear','boobies','147258','simple','bollocks','12345q',
		'marcus','brian','1987','qweasdzxc','drowssap','hahaha','caroline','barbara','dave','viper','drummer','action','einstein','bitches','genesis','hello1','scotty','friend','forest',
		'10203','hotrod','google','vanessa','spitfire','badger','maryjane','friday','alaska','1232323q','tester','jester','jake','champion','billy','147852','rock','hawaii','badass',
		'chevy','420420','walker','stephen','eagle1','bill','1986','october','gregory','svetlana','pamela','1984','music','shorty','westside','stanley','diesel','courtney','242424',
		'kevin','porno','hitman','boobs','mark','12345qwert','reddog','frank','qwe123','popcorn','patricia','aaaaaaaa','1969','teresa','mozart','buddha','anderson','paul','melanie',
		'abcdefg','security','lucky1','lizard','denise','3333','a12345','123789','ruslan','stargate','simpsons','scarface','eagle','123456789a','thumper','olivia','naruto','1234554321',
		'general','cherokee','a123456','vincent','Usuckballz1','spooky','qweasd','cumshot','free','frankie','douglas','death','1980','loveyou','kitty','kelly','veronica','suzuki',
		'semperfi','penguin','mercury','liberty','spirit','scotland','natalie','marley','vikings','system','sucker','king','allison','marshall','1979','98765','qwerty12','hummer',
		'adrian','1985','vfhbyf','sandman','rocky','leslie','antonio','98765432','4321','softball','passion','mnbvcxz','bastard','passport','horney','rascal','howard','franklin',
		'bigred','assman','alexander','homer','redrum','jupiter','claudia','55555555','141414','zaq12wsx','shit','patches','nigger','cunt','raider','infinity','andre','54321','galore',
		'college','russia','kawasaki','bishop','77777777','vladimir','money1','freeuser','wildcats','francis','disney','budlight','brittany','1994','sweet','oksana','honda','domino',
		'bulldogs','brutus','swordfis','norman','monday','jimmy','ironman','ford','fantasy','9999','7654321','hentai','duncan','cougar','1977','jeffrey','house','dancer','brooke','timothy',
		'super','marines','justice','digger','connor','patriots','karina','202020','molly','everton','tinker','alicia','rasdzv3','poop','pearljam','stinky','naughty','colorado','123123a',
		'water','test123','ncc1701d','motorola','ireland','asdfg','slut','matt','houston','boogie','zombie','accord','vision','bradley','reggie','kermit','froggy','ducati','avalon',
		'6666','9379992','sarah','saints','logitech','chopper','852456','simpson','madonna','juventus','claire','159951','zachary','yfnfif','wolverin','warcraft','hello123','extreme',
		'penis','peekaboo','fireman','eugene','brenda','123654789','russell','panthers','georgia','smith','skyline','jesus','elizabet','spiderma','smooth','pirate','empire','bullet',
		'8888','virginia','valentin','psycho','predator','arizona','134679','mitchell','alyssa','vegeta','titanic','christ','goblue','fylhtq','wolf','mmmmmm','kirill','indian','hiphop',
		'baxter','awesome','people','danger','roland','mookie','741852963','1111111111','dreamer','bambam','arnold','1981','skipper','serega','rolltide','elvis','changeme','simon',
		'1q2w3e','lovelove','denver','tommy','mine','loverboy','hobbes','happy1','alison','nemesis','chevelle','cardinal','burton','wanker','picard','151515','tweety','michael1','147852369',
		'12312','xxxx','windows','turkey','456789','1974','vfrcbv','sublime','1975','galina','bobby','newport','manutd','daddy','american','alexandr','1966','victory','rooster','qqq111',
		'madmax','electric','bigcock','a1b2c3','wolfpack','spring','phpbb','lalala','suckme','spiderman','eric','darkside','classic','raptor','123456789q','hendrix','1982','wombat',
		'avatar','alpha','zxc123','crazy','hard','england','brazil','1978','1011980','wildcat','polina',
	];



	public static function password($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = $_data;

		if($data === null || $data === '')
		{
			return null;
		}

		$meta        = $_meta;
		$meta['min'] = 6;
		$meta['max'] = 50;

		$data = \dash\validate\text::string($data, $_notif, $_element, $_field_title, $meta);

		if($data === false || $data === null)
		{
			return $data;
		}


		if(strpos($_data, ' ') !== false)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Do not use space in your password"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}

			return false;
		}

		if(in_array($data, self::$crazy_password))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Crazy password, Try another"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		// every password have 123456 is crazy
		if(strpos($data, '123456') !== false)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Can not use 123456 in your password, Try another"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}

			return false;
		}

		if(mb_strlen(count_chars($data, 3)) < 3)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Please use more than 3 unique character in your password"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}

			return false;
		}

		if(isset($_meta['displayname']) && $_meta['displayname'])
		{
			if(strpos($data, $_meta['displayname']) !== false)
			{
				if($_notif)
				{
					\dash\notif::error(T_("Can not use display name in the password"), ['element' => $_element]);
					\dash\cleanse::$status = false;
				}
				return false;
			}
		}

		if(isset($_meta['passwd_mobile']) && $_meta['passwd_mobile'])
		{
			if(strpos($data, $_meta['passwd_mobile']) !== false)
			{
				if($_notif)
				{
					\dash\notif::error(T_("Can not use your mobile in the password"), ['element' => $_element]);
					\dash\cleanse::$status = false;
				}
				return false;
			}
		}

		return $data;
	}
}
?>
