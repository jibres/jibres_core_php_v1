<?php
namespace dash\utility;

class icon
{
    // based on shopify polaris icon pack
    // https://polaris-icons.shopify.com/

    public static function empty()
    {
        return "";
    }
    public static function header()
    {
        return "data:image/svg+xml;utf8,%3Csvg%20viewBox%3D%220%200%2020%2020%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20d%3D%22M1%202.5V9h18V2.5A1.5%201.5%200%200017.5%201h-15A1.5%201.5%200%20001%202.5zM2%2019a1%201%200%2001-1-1v-2h2v1h1v2H2zM19%2018a1%201%200%2001-1%201h-2v-2h1v-1h2v2zM1%2014v-3h2v3H1zM17%2011v3h2v-3h-2zM6%2017h3v2H6v-2zM14%2017h-3v2h3v-2z%22%20fill%3D%22%235C5F62%22%2F%3E%3C%2Fsvg%3E";
    }
    public static function footer()
    {
        return "data:image/svg+xml;utf8,%3Csvg%20viewBox%3D%220%200%2020%2020%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20d%3D%22M1%202a1%201%200%20011-1h2v2H3v1H1V2zM18%201a1%201%200%20011%201v2h-2V3h-1V1h2zM19%2017.5V11H1v6.5A1.5%201.5%200%20002.5%2019h15a1.5%201.5%200%20001.5-1.5zM19%206v3h-2V6h2zM3%209V6H1v3h2zM14%201v2h-3V1h3zM9%203V1H6v2h3z%22%20fill%3D%22%235C5F62%22%2F%3E%3C%2Fsvg%3E";
    }
}
?>