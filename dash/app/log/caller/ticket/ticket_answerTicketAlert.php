<?php
namespace dash\app\log\caller\ticket;


class ticket_answerTicketAlert
{
	public static function site($_args = [])
	{
		$masterid =  \dash\app\log\support_tools::masterid($_args);

		$result              = [];
		$result['title']     = T_("Regards"). "\n". T_("Ticket :val answered", ['val' => \dash\fit::text($masterid)]);;
		$result['icon']      = 'life-ring';
		$result['cat']       = T_("Support");
		$result['iconClass'] = 'fc-green';


		$excerpt = '';
		$excerpt .=	'<a href="'.\dash\app\log\support_tools::ticket_short_link($masterid). '">';
		$excerpt .= T_("Show ticket");
		$excerpt .= ' ';
		$excerpt .= \dash\fit::text($masterid);
		$excerpt .= '</a>';

		$result['txt'] = $excerpt;

		return $result;
	}

	public static function expire()
	{
		return date("Y-m-d H:i:s", strtotime("+100 days"));
	}

	public static function is_notif()
	{
		return true;
	}

}
?>