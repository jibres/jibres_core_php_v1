<?php
namespace dash\utility;

class icon
{
    // based on shopify polaris icon pack
    // https://polaris-icons.shopify.com/

    public static function svg($_name = null)
    {

        if(is_callable(['self', $_name]))
        {
            return self::$_name();
        }
    }

    public static function src($_name = null)
    {

        return 'data:image/svg+xml,'. rawurlencode(self::svg($_name));
    }


    private static function empty()
    {
        return '';
    }
    private static function Header()
    {
        return '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M1 2.5V9h18V2.5A1.5 1.5 0 0017.5 1h-15A1.5 1.5 0 001 2.5zM2 19a1 1 0 01-1-1v-2h2v1h1v2H2zM19 18a1 1 0 01-1 1h-2v-2h1v-1h2v2zM1 14v-3h2v3H1zM17 11v3h2v-3h-2zM6 17h3v2H6v-2zM14 17h-3v2h3v-2z" fill="#5C5F62"/></svg>';
    }
    private static function Footer()
    {
        return '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M1 2a1 1 0 011-1h2v2H3v1H1V2zM18 1a1 1 0 011 1v2h-2V3h-1V1h2zM19 17.5V11H1v6.5A1.5 1.5 0 002.5 19h15a1.5 1.5 0 001.5-1.5zM19 6v3h-2V6h2zM3 9V6H1v3h2zM14 1v2h-3V1h3zM9 3V1H6v2h3z" fill="#5C5F62"/></svg>';
    }
    private static function Setting()
    {
        return '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9.027 0a1 1 0 00-.99.859l-.37 2.598A6.993 6.993 0 005.742 4.57L3.305 3.59a1 1 0 00-1.239.428L.934 5.981a1 1 0 00.248 1.287l2.066 1.621a7.06 7.06 0 000 2.222l-2.066 1.621a1 1 0 00-.248 1.287l1.132 1.962a1 1 0 001.239.428l2.438-.979a6.995 6.995 0 001.923 1.113l.372 2.598a1 1 0 00.99.859h2.265a1 1 0 00.99-.859l.371-2.598a6.995 6.995 0 001.924-1.112l2.438.978a1 1 0 001.238-.428l1.133-1.962a1 1 0 00-.249-1.287l-2.065-1.621a7.063 7.063 0 000-2.222l2.065-1.621a1 1 0 00.249-1.287l-1.133-1.962a1 1 0 00-1.239-.428l-2.437.979a6.994 6.994 0 00-1.924-1.113L12.283.86a1 1 0 00-.99-.859H9.027zm1.133 13a3 3 0 100-6 3 3 0 000 6z" fill="#5C5F62"/></svg>';
    }
    private static function Image()
    {
        return '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 1A1.5 1.5 0 001 2.5v15A1.5 1.5 0 002.5 19h15a1.5 1.5 0 001.5-1.5v-15A1.5 1.5 0 0017.5 1h-15zm5 3.5c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zM16.499 17H3.497c-.41 0-.64-.46-.4-.79l3.553-4.051c.19-.21.52-.21.72-.01L9 14l3.06-4.781a.5.5 0 01.84.02l4.039 7.011c.18.34-.06.75-.44.75z" fill="#5C5F62"/></svg>';
    }
    private static function AddImage()
    {
        return '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M19 2.5A1.5 1.5 0 0017.5 1h-15A1.5 1.5 0 001 2.5v15A1.5 1.5 0 002.5 19H10v-2H3.497c-.41 0-.64-.46-.4-.79l3.553-4.051c.19-.21.52-.21.72-.01L9 14l3.06-4.781a.5.5 0 01.84.02l.72 1.251A5.98 5.98 0 0116 10h3V2.5zm-11.5 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm12.207 10.793A1 1 0 0019 15h-2v-2a1 1 0 00-2 0v2h-2a1 1 0 000 2h2v2a1 1 0 102 0v-2h2a1 1 0 00.707-1.707z" fill="#5C5F62"/></svg>';
    }
    private static function Images()
    {
        return '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M19 16a1 1 0 001-1V1a1 1 0 00-1-1H5a1 1 0 00-1 1v14a1 1 0 001 1h14zM6.426 14C6.173 14 6 13.809 6 13.604c0-.08.026-.162.083-.236l3.046-3.24a.448.448 0 01.617-.009l1.397 1.481 2.623-3.825a.446.446 0 01.72.016l3.462 5.609c.154.272-.052.6-.377.6H6.426zM11 5a2 2 0 11-4 0 2 2 0 014 0zM0 4.5A1.5 1.5 0 011.5 3H2v15h15v.5a1.5 1.5 0 01-1.5 1.5h-14A1.5 1.5 0 010 18.5v-14z" fill="#5C5F62"/></svg>';
    }
    private static function ImageWithTextOverlayMajor()
    {
        return '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M11 1a1 1 0 011-1h7a1 1 0 110 2h-7a1 1 0 01-1-1zm0 4a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1zM8.083 4A6.002 6.002 0 0014 9h2v9.5a1.5 1.5 0 01-1.5 1.5h-13A1.5 1.5 0 010 18.5v-13A1.5 1.5 0 011.5 4h6.583zM5 11a2 2 0 100-4 2 2 0 000 4zm-2.574 7h11.145c.325 0 .531-.328.377-.6l-3.462-5.609a.446.446 0 00-.72-.016L7.143 15.6l-1.397-1.48a.449.449 0 00-.617.007l-3.045 3.241c-.206.264-.01.632.342.632z" fill="#5C5F62"/></svg>';
    }
    private static function ImageWithTextMajor()
    {
        return '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M1.5 2A1.5 1.5 0 000 3.5v5A1.5 1.5 0 001.5 10h6A1.5 1.5 0 009 8.5v-5A1.5 1.5 0 007.5 2h-6zM18 6h-6a1 1 0 110-2h6a1 1 0 110 2zm-6 4h6a1 1 0 100-2h-6a1 1 0 100 2zm6 4H1a1 1 0 010-2h17a1 1 0 010 2zm-3.293 3.707A1 1 0 0114 18H1a1 1 0 010-2h13a1 1 0 01.707 1.707z" fill="#5C5F62"/></svg>';
    }
    private static function AbandonedCartMajor()
    {
        return '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.707 1.293a1 1 0 00-1.414 1.414L9.586 4 8.293 5.293a1 1 0 001.414 1.414L11 5.414l1.293 1.293a1 1 0 101.414-1.414L12.414 4l1.293-1.293a1 1 0 00-1.414-1.414L11 2.586 9.707 1.293z" fill="#5C5F62"/><path fill-rule="evenodd" d="M1 1a1 1 0 011-1h1.5A1.5 1.5 0 015 1.5V10h11.133l.877-6.141a1 1 0 111.98.282l-.939 6.571A1.5 1.5 0 0116.566 12H5v2h10a3 3 0 11-2.83 2H6.83A3 3 0 113 14.17V2H2a1 1 0 01-1-1zm13 16a1 1 0 112 0 1 1 0 01-2 0zM3 17a1 1 0 112 0 1 1 0 01-2 0z" fill="#5C5F62"/></svg>';
    }
    private static function add()
    {
        return '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M3 3h1V1H2.5A1.5 1.5 0 001 2.5V4h2V3zM6 3h3V1H6v2zM11 3h3V1h-3v2zM9 19H6v-2h3v2zM11 19h3v-2h-3v2zM17 4V3h-1V1h1.5A1.5 1.5 0 0119 2.5V4h-2zM3 17v-1H1v1.5A1.5 1.5 0 002.5 19H4v-2H3zM16 17h1v-1h2v1.5a1.5 1.5 0 01-1.5 1.5H16v-2zM10 6a1 1 0 011 1v2h2a1 1 0 110 2h-2v2a1 1 0 11-2 0v-2H7a1 1 0 110-2h2V7a1 1 0 011-1zM1 9V6h2v3H1zM1 11v3h2v-3H1zM17 9V6h2v3h-2zM17 11v3h2v-3h-2z" fill="#5C5F62"/></svg>';
    }
}
?>