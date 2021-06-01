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
    private static function ColumnWithTextMajor()
    {
        return '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 7V1H2.5A1.5 1.5 0 001 2.5V7h8zM19 2.5A1.5 1.5 0 0017.5 1H11v6h8V2.5zM1 9h8v2H1V9zM19 9h-8v2h8V9zM1 13h8v2H1v-2zM19 13h-8v2h8v-2zM1 17h4v2H1v-2zM15 17h-4v2h4v-2z" fill="#5C5F62"/></svg>';
    }
    private static function FeaturedCollectionMajor()
    {
        return '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 .439a1.48 1.48 0 00-2.103 0l-1.04 1.18-3.48 4a1.497 1.497 0 00-.377 1v9.88c0 .398.157.779.436 1.06.278.282.657.44 1.051.44h2.479v-9.43a3.568 3.568 0 01.872-2.33l3.638-4.12L8 .439zm10.618 7.13l-4.579-5.13a1.51 1.51 0 00-2.129 0l-1.004 1.18-3.524 4a1.486 1.486 0 00-.382 1v9.88c0 .389.152.763.423 1.043.272.28.642.444 1.033.457h9.038c.4 0 .782-.158 1.065-.44.282-.281.44-.663.44-1.06v-9.93a1.487 1.487 0 00-.38-1zM11.402 9c-1 0-1.9.9-1.9 2 0 2.2 1.3 3.9 3.5 5 2.2-1.1 3.5-2.8 3.5-4.9v-.2c0-1-.9-1.9-1.9-1.9-1 0-1.6 1.167-1.6 1.167S12.402 9 11.402 9z" fill="#5C5F62"/></svg>';
    }
        private static function CollectionsMajor()
    {
        return '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6.948.001C7.342.001 7.72.16 8 .44l1.477 1.68-3.638 4.12a3.568 3.568 0 00-.872 2.33V18H2.487a1.48 1.48 0 01-1.051-.44A1.507 1.507 0 011 16.5V6.62a1.497 1.497 0 01.377-1l3.48-4L5.897.44A1.48 1.48 0 016.949.001zM14.04 2.44l4.58 5.13c.247.275.383.631.381 1v9.93c0 .399-.159.78-.441 1.062a1.51 1.51 0 01-1.065.439H8.456a1.509 1.509 0 01-1.033-.457A1.497 1.497 0 017 18.5V8.62a1.487 1.487 0 01.382-1l3.524-4.001 1.005-1.18a1.51 1.51 0 012.128 0zm-1.9 5.807a1.51 1.51 0 001.901-.186 1.497 1.497 0 00-.489-2.447 1.512 1.512 0 00-1.641.325 1.498 1.498 0 00.228 2.308z" fill="#5C5F62"/></svg>';
    }
        private static function colors()
    {
        return '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18.867 12.48A4.53 4.53 0 0020 9.304v-.19a9.998 9.998 0 00-1.916-5.041A10.017 10.017 0 008.464.129a10.025 10.025 0 00-4.91 2.244A10.005 10.005 0 00.25 12.22a10.002 10.002 0 002.566 4.744 10.021 10.021 0 004.66 2.725 19.9 19.9 0 004.007.31h1.152c.376 0 .735-.195.986-.474A1.47 1.47 0 0014 18.507a1.5 1.5 0 00-1.5-1.5c-.399 0-.795-.167-1.076-.448a1.5 1.5 0 011.062-2.562h3.366a4.54 4.54 0 003.015-1.517zM12 3.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM5.5 7a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm-1 5a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm10-4a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" fill="#5C5F62"/></svg>';
    }
        private static function BlockquoteMajor()
    {
        return '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M3 3.5a1 1 0 00-1 1V5h.5A1.5 1.5 0 014 6.5v1A1.5 1.5 0 012.5 9h-1A1.5 1.5 0 010 7.5v-3a3 3 0 013-3v2zM8.5 5H8v-.5a1 1 0 011-1v-2a3 3 0 00-3 3v3A1.5 1.5 0 007.5 9h1A1.5 1.5 0 0010 7.5v-1A1.5 1.5 0 008.5 5zM12 8a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1zm-8 3a1 1 0 100 2h15a1 1 0 100-2H4zm-1 5a1 1 0 011-1h15a1 1 0 110 2H4a1 1 0 01-1-1zM13 3a1 1 0 100 2h6a1 1 0 100-2h-6z" fill="#5C5F62"/></svg>';
    }
        private static function BuyButtonMajor()
    {
        return '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M0 1.5A1.5 1.5 0 011.5 0h17A1.5 1.5 0 0120 1.5v6A1.5 1.5 0 0118.5 9h-5.889a1.5 1.5 0 01-1.5-1.5V5.111a1.111 1.111 0 10-2.222 0V7.5a1.5 1.5 0 01-1.5 1.5H1.5A1.5 1.5 0 010 7.5v-6z" fill="#5C5F62"/><path d="M7 5a3 3 0 016 0v4.384a.5.5 0 00.356.479l2.695.808a2.5 2.5 0 011.756 2.748l-.633 4.435A2.5 2.5 0 0114.699 20H6.96a2.5 2.5 0 01-2.27-1.452l-2.06-4.464a2.417 2.417 0 01-.106-1.777c.21-.607.719-1.16 1.516-1.273 1.035-.148 2.016.191 2.961.82V5zm3-1a1 1 0 00-1 1v7.793c0 1.39-1.609 1.921-2.527 1.16-.947-.784-1.59-.987-2.069-.948a.486.486 0 00.042.241l2.06 4.463A.5.5 0 006.96 18h7.74a.5.5 0 00.494-.43l.633-4.434a.5.5 0 00-.35-.55l-2.695-.808A2.5 2.5 0 0111 9.384V5a1 1 0 00-1-1z" fill="#5C5F62"/></svg>';
    }
    private static function ArchiveMajor()
    {
        return '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 1A1.5 1.5 0 001 2.5V4h18V2.5A1.5 1.5 0 0017.5 1h-15zM2 17.5A1.5 1.5 0 003.5 19h13a1.5 1.5 0 001.5-1.5V6H2v11.5zM7 9h6v2H7V9z" fill="#5C5F62"/></svg>';
    }
    private static function AddProductMajor()
    {
        return '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M11 1h7a1 1 0 011 1v7a.999.999 0 01-.29.71l-.29.29H16a6 6 0 00-6 6v2.42l-.29.29a1 1 0 01-1.42 0l-7-7a.999.999 0 010-1.42l9-9A1.001 1.001 0 0111 1zm3.667 4.747a1.5 1.5 0 101.666-2.494 1.5 1.5 0 00-1.666 2.494zm5.04 9.546A1 1 0 0019 15h-2v-2a1 1 0 00-2 0v2h-2a1 1 0 000 2h2v2a1 1 0 002 0v-2h2a1 1 0 00.707-1.707z" fill="#5C5F62"/></svg>';
    }
    private static function ProductsMajor()
    {
        return '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.293 1.293A1 1 0 0111 1h7a1 1 0 011 1v7a1 1 0 01-.293.707l-9 9a1 1 0 01-1.414 0l-7-7a1 1 0 010-1.414l9-9zM15.5 6a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" fill="#5C5F62"/></svg>';
    }
    private static function empty()
    {
        return '';
    }
    private static function empty()
    {
        return '';
    }
    private static function empty()
    {
        return '';
    }



    private static function empty()
    {
        return '';
    }
}
?>