<?php
namespace dash;
/**
 * Class for notif code.
 */
class notif_code
{
    /**
     * Notif code
     *
     * @var        array
     */
	private static $notif_code = [];


    private static function define_code()
    {
        $notif_code = [];

        /**
         * Your account credit is not sufficient. Please charge your account
         */
        $notif_code[] = ['code' => 3000, 'key' => 'account_balance', 'title' => 'Your account credit is not sufficient. Please charge your account'];
    }
}
?>
