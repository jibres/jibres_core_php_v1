<?php
namespace dash\social\telegram\commands;
// use telegram class as bot
use \dash\social\telegram\tg as bot;

class conversationFa
{
	public static function run($_cmd)
	{
		$text = null;
		$userInput = $_cmd['text'];
		$userInput = str_replace('?', '', $userInput);
		$userInput = str_replace('!', '', $userInput);
		$userInput = str_replace('؟', '', $userInput);
		$userInput = str_replace('*', '', $userInput);
		$userInput = str_replace('+', '', $userInput);
		$userInput = str_replace('-', '', $userInput);
		$userInput = str_replace('  ', '', $userInput);
		$userInput = str_replace('‌', '', $userInput);

		switch ($userInput)
		{
			case 'سلام':
			case 'سلااام':
			case 'salam':
			case 'hallo':
				$text = 'سلام عزیزم';
				break;

			case 'سلام خره':
			case 'سلام خر':
				$text = 'علیک سلام 😢 '. "\n". "توصبه میکنم با من با ادب صحبت کنید :|";
				break;

			case 'خ':
			case 'خخ':
			case 'خخخ':
			case 'خخخخ':
			case 'خخخخخ':
				$text = 'چیه صدات گرفته؟ خرما بدم خدمددون';
				break;

			case 'لا':
				$text = 'لا عربی! فارسی صحبت اله';
				break;


			case 'ا':
			case 'اا':
			case 'ااا':
				$text = 'چوب بستنی ندارم! مگه دکتر رفتی!';
				break;

			case 'خوبی':
			case 'khobi':
				$text = 'ممنون، خوبم';
				break;

			case 'مرسی':
				$text = 'خیلی خرسی! فارسی صحبت کن جیگر'. "\n". "parlez-vous français?";
				break;

			case 'نه':
				$text = 'نه چرا! راضی باش';
				break;

			case 'نه والا':
				$text = 'آره والا چی میگی!';
				break;

			case 'بله':
				$text = 'نظر لطفتونه قربان';
				break;

			case 'ابله':
				$text = 'لطفا شان خودتون رو حفظ کنید';
				break;

			case 'اه':
			case 'اوف':
				$text = 'از دست چیزی ناراحتی';
				break;

			case 'خوبم':
			case 'khobam':
				$text = 'احتمالا خوب هستنید!';
				break;

			case 'چه خبرا':
			case 'چخبر':
			case 'چه خبر':
			case 'che khabar':
				$text = 'سلامتی';
				break;

			case 'چطوری':
			case 'چه طوری':
				$text = 'خوبم، خدا رو شکر';
				break;


			case 'حال شما':
			case 'حال شما چطوره':
				$text = 'اگه بزارن حالم همیشه خوبه';
				break;

			case 'حالت خوبه':
				$text = 'عالی هستم';
				break;

			case 'چرا':
			case 'چرا آخه':
				$text = 'چرا نداره عزیز من';
				break;

			case 'مقاله':
				$text = 'اینجا مقاله فروشی نیست! چی از من میخوای!!';
				break;

			case 'چاقی':
				$text = 'نه! چی در موردم فکر کردی!';
				break;

			case 'لاغری':
				$text = 'نخیر، من تناسب اندام دارم:|';
				break;

			case 'سلامتی':
			case 'salamati':
				$text = 'خدا رو شکر';
				break;

			case 'بمیر':
			case 'بمیری بهتره':
				$text = 'مردن دست خداست';
				break;

			case 'بد':
				$text = 'من بد نیستم';
				break;

			case 'خوب':
				$text = 'ممنون عزیزم';
				break;

			case 'زشت':
				$text = 'من خوشگلم';
				break;

			case 'هوا گرمه':
				$text = 'شاید!';
				break;

			case 'سردمه':
				$text = 'بخاری رو روشن کن';
				break;

			case 'جان':
				$text = 'جانت بی بلا عزیز جان';
				break;

			case 'خر':
			case 'خری':
			case 'خیلی خری':
			case 'khar':
				$text = 'خر خودتی'."\n";
				$text .= 'بی تربیت'."\n";
				$text .= 'نزار چاک دهنم واشه'."\n";
				break;

			case 'سگ تو روحت':
			case 'sag to rohet':
			case 'sag to ruhet':
				$text = 'بله!'."\n";
				$text .= 'من روح ندارم!'."\n";
				break;

			case 'نفهم':
				$text = 'من خیلی هم میفهمم';
				break;

			case 'خوابی':
			case 'خوابیدی':
				$text = 'من همیشه بیدارم';
				break;

			case 'هی':
				$text = 'بفرمایید جناب';
				break;

			case 'الو':
			case 'alo':
				$text = 'بله قربان';
				break;

			case 'چی میگی':
				$text = 'جز مدح شما نگویم!';
				break;

			case 'اسمت چیه':
			case 'اسم':
			case 'اسم شما':
			case 'اسم شما چیه':
				$text = 'بنده سرشمار هستم. فرزند ارمایل';
				break;

			case 'بلا':
				$text = 'با ادب باش';
				break;

			case 'دختری':
				$text = 'خودت چی فکر میکنی؟ بهم میاد 😜';
				break;

			case 'پسری':
				$text = 'بله، مشکلی هست؟';
				break;

			case 'چاکر':
				$text = 'نوکر';
				break;

			case 'نوکر':
				$text = 'کلفت';
				break;

			case 'چاکریم':
				$text = 'فدایی داری';
				break;

			case 'چاکر داداش':
				$text = 'مخلصیم داداش';
				break;

			case 'چاکر آبجی':
				$text = 'نداشتیما :|';
				break;

			case 'اتل متل توتوله':
			case 'اتل متل توتوله گاو حسن چجوره':
				$text = 'اتل متن تولوله' ."\n". "گاو حسن چجوره"."\n\n". "نه شیر داره نه پستون"."\n". "گاوشو بردن هندستون";
				break;

			case 'سیب':
				$text = 'ممنون. سیبم خوبه ولی توت فرنگی بیشتر دوست دارم';
				break;

			case 'گلابی':
				$text = 'احتمالا منظور بدی که نداشتی :/';
				break;

			case 'خیار':
				$text = 'سردیم میکنه، شما خودت بخور';
				break;

			case 'برف':
			case 'برف اومده':
			case 'برف اومد':
				$text = 'برف اومده؟ کو؟';
				break;

			case 'برف اومده تا کمر':
				$text = 'نه بابا! کجا برف اومده؟';
				break;

			case 'دیگه داری چرت و پرت میگی':
				$text = 'شما که خودت دو سالگی شروع به حرف زدن کردی. 😁 کمکم کن یاد بگیرم';
				break;

			case 'باشه بابا چند بار میگی':
			case 'چند بار میگی':
				$text = 'حتما متوجه نشدی که مجبور شدم چند بار بگم!';
				break;

			case 'گیجی':
			case 'چقدر گیجی':
			case 'تو چقدر گیجی':
				$text = 'اگه بدونی من چیکارا میتونم بکنم دیگه از این حرفا نمیزنی عزیزم';
				break;

			case 'کجایی':
			case 'دقیقا کجایی':
			case 'کجا هستی':
				$text = 'من توی یه کامپیوترم که بهش میگن سرور. یه جای دور. ولی آرام و خنک.';
				break;

			case 'تو رو خدا':
			case 'تو رو بخدا':
			case 'خدا':
			case 'بخدا':
			case 'ای خدا':
			case 'خدایا':
			case 'خدایا چه کنم':
				$text = 'لا اله الا الله';
				break;

			case 'اشهد':
			case 'اشهدتو بخون':
			case 'اشهد بخون':
				$text = 'لا اله الا الله' . "محمد رسول الله".  "علی ولی الله";
				break;

			case 'خودمو میکشم':
			case 'خودمو میکشما':
			case 'خودمو میکشما':
			case 'میکشمتا':
			case 'خودکشی':
			case 'خودکشی کنم':
			case 'خودکشی میکنم':
			case 'خودکشی بکنم':
			case 'خودکشی بکن':
			case 'بمیر':
				$text = 'خودکشی کار خوبی نیست. جرا نمیری یکم کتاب بخونی؟';
				break;

			case 'با من ازدواج میکنی':
			case 'با من ازدواج کن':
			case 'میگم با من ازدواج کن':
			case 'شوهرم میشی':
			case 'زنم میشی':
			case 'همدمم میشی':
				$text = 'شما اول شماره و اسم فامیلتو درست بهم بده بعد درخواست ازدواج کن!!';
				break;

			case 'عاشقتم':
			case 'عاشق':
			case 'عاشقم':
			case 'عاشقی':
			case 'عاشق باش':
			case 'عاشقتم دیوونه':
			case 'عاشقتم خره':
				$text = 'نمیبینی چقدر گرونی شده! الان آخه وقت این کاراس';
				break;

			case 'منو مسخره کردی':
				$text = 'نه به جون ریش مرلین!';
				break;


			case 'تو آدمی':
			case 'آدمی':
			case 'چی هستی':
				$text = 'من یه رباتم. البته دوست دارم آدم باشم ولی خودمم بکشم نمیتونم. قدر خودتو بدون';
				break;

			case 'خاک تو سرت':
				$text = 'من با تو چیکار کردم که هی فحش میدی!';
				break;

			case 'من میرم':
			case 'من رفتم':
			case 'اصلا من میرم':
			case 'خداحافظ':
			case 'خداحافظ بابا':
			case 'بای':
			case 'بای بای':
				$text = 'باشه.'. "\n". "فعلا، دلم برات تنگ میشه عزیزم." . "\n". "منتظرت می‌مونم 😘";
				break;

			default:
				$text = false;
				break;
		}
		if($text)
		{
			bot::sendMessage($text);
			bot::ok();
		}
	}
}
?>