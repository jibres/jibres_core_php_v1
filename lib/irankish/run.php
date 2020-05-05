<?php
namespace lib\irankish;


class run
{


    public static function run($_args = [])
    {
        // if soap is not exist return false
        if(!class_exists("soapclient"))
        {
            \dash\log::set('payment:parsian:soapclient:not:install');
            \dash\notif::error(T_("Can not connect to parsian gateway. Install it!"));
            // return false;
        }

        // try
        {
            $soap_meta =
            [
                'soap_version' => 'SOAP_1_1',
                'cache_wsdl'   => WSDL_CACHE_NONE ,
                'encoding'     => 'UTF-8',
                'exceptions'   => true,
            ];

            $client = @new \SoapClient('http://185.79.62.20/Services/DefineMerchant?wsdl',$soap_meta);


            // $result = $client->Login("RoozAndishKavirPeyma", "Aa@123456");
            $result = $client->login(["username" => "RoozAndishKavirPeyma", "password" => "Aa@123456"]);


            var_dump($result);exit();
            self::$payment_response = $result;

            $status = $result->SalePaymentRequestResult->Status;
            $token  = $result->SalePaymentRequestResult->Token;
            $msg    = self::msg($status);

            if ($status === 0 && $token > 0)
            {
                $url = "https://pec.shaparak.ir/NewIPG/?Token=" . $token;
                return $url;
            }
            else
            {
                \dash\log::set('payment:parsian:error');
                \dash\notif::error($msg);
                return false;
            }
        }
        // catch (\Exception $e)
        // {
        //     \dash\log::set('payment:parsian:error:load:web:services');
        //     \dash\notif::error(T_("Error in load web services"));
        //     return false;
        // }
    }





}
?>