<?php


/**
* cofig of zarinpal payment
*/
self::$config['zarinpal']['status']      = true;
self::$config['zarinpal']['MerchantID']  = "325ffbdc-664a-11e8-acce-005056a205be";
self::$config['zarinpal']['Description'] = "Jibres";
// set the call back is null to redirecto to default dash callback payment
self::$config['zarinpal']['CallbackURL'] = null;
// all amount of this payment * exchange of this payment to change all units to default units of dash
self::$config['zarinpal']['exchange']    = 1;


/**
* cofig op pay.ir
*/
self::$config['payir']['status']   = false;
self::$config['payir']['api']      = "3c350829ff1161278c63640a798f2daf";
self::$config['payir']['redirect'] = null;


/**
* config of parsian payment
*/
self::$config['parsian']['status']       = true;
self::$config['parsian']['LoginAccount'] = 'n7RcBk5Wn5Qc033W00t3';
// set the call back is null to redirecto to default dash callback payment
self::$config['parsian']['CallBackUrl']  = null;
// all amount of this payment * exchange of this payment to change all units to default units of dash
self::$config['parsian']['exchange']     = 10;


/**
* config of irkish payment
*/
self::$config['irkish']['status']      = true;
self::$config['irkish']['merchantId']  = 'C3FC'; // jibres
// set the call back is null to redirecto to default dash callback payment
self::$config['irkish']['revertURL']   = null;
self::$config['irkish']['description'] = 'jibres.com';
self::$config['irkish']['paymentId']   = null;
self::$config['irkish']['sha1']        = '22338240992352910814917221751200141041845518824222260'; // main



self::$config['asanpardakht']['status']           = true;
self::$config['asanpardakht']['MerchantID']       = '3833817';
self::$config['asanpardakht']['MerchantConfigID'] = '4358';
self::$config['asanpardakht']['Username']         = 'jibrs3833817';
self::$config['asanpardakht']['Password']         = 'TFIHOc7';
self::$config['asanpardakht']['EncryptionKey']    = 'fkAD0Ebq8P2fvqpIkULhAuLJ12Av5GnXpJXxMRTTXIk=';
self::$config['asanpardakht']['EncryptionVector'] = 'G4TOobPmmVp/P6U5VuRs+tERgFoA9gm3MbcFxXMhDg8=';
self::$config['asanpardakht']['MerchantIP']       = '138.68.96.140';
self::$config['asanpardakht']['MerchantName']     = 'JIBRES';


?>