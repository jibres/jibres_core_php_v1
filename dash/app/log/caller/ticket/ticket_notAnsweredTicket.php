<?php
namespace dash\app\log\caller\ticket;



class ticket_notAnsweredTicket
{

	public static function site($_args = [])
	{

		$my_count         = isset($_args['data']['my_count']) ? $_args['data']['my_count'] : null;

		$result              = [];

		$result['title']     = T_("Please reply the ticket");

		$result['icon']      = 'life-ring';
		$result['cat']       = T_("Support");
		$result['iconClass'] = 'fc-red';
		$result['txt']       = self::get_msg($_args);
		return $result;

	}


	public static function get_msg($_args = [])
	{
		$msg          = '';
		$my_count      = isset($_args['data']['my_count']) ? $_args['data']['my_count'] : null;
		$msg .= T_("You have some unanswered message.") . ' ('. \dash\fit::number($my_count). ' '. T_("Ticket") .")";
		return $msg;
	}


	public static function send_to()
	{
		return ['supervisor'];
	}


	public static function expire()
	{
		// 7 days
		return date("Y-m-d H:i:s", time() + (60*60*24*7));
	}


	public static function is_notif()
	{
		return true;
	}


	public static function telegram()
	{
		return true;
	}


	public static function sms()
	{
		return false;
	}



	public static function telegram_text($_args, $_chat_id)
	{
		$tg_msg = '';
		$tg_msg .= "#Support #Ticket #Unanswered ";

		$tg_msg .= " 🔸 \n";

		$tg_msg .= T_("Please reply the ticket");

		$tg_msg .= "\n";

		$tg_msg .= self::get_msg($_args);
		$tg_msg .= "\n⏳ ". \dash\datetime::fit(date("Y-m-d H:i:s"), true);

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;

		return $tg;

	}
}
?>