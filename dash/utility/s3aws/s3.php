<?php
namespace dash\utility\s3aws;

class s3
{

    private static $is_active      = null;
    private static $endpoint       = null;
    private static $AWS_KEY        = null;
    private static $AWS_SECRET_KEY = null;

    private static $client         = null;
    private static $connected      = false;
    private static $bucket         = null;
    private static $region         = null;
    private static $provider       = null;



    public static function set_provider($_provider)
    {
        self::$provider = $_provider;
    }

    /**
     * Check is active s3
     * load master variable
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public static function active()
    {
        if(is_null(self::$is_active))
        {
            if(\dash\setting\s3::status(self::$provider))
            {
                // define access key and secretkey
                self::$AWS_KEY        =  \dash\setting\s3::accesskey(self::$provider);
                self::$AWS_SECRET_KEY =  \dash\setting\s3::secretkey(self::$provider);

                self::$endpoint       = \dash\setting\s3::endpoint(self::$provider);
                self::$bucket         = \dash\setting\s3::bucket(self::$provider);

                self::$region         = \dash\setting\s3::region(self::$provider);
                self::$provider       = \dash\setting\s3::provider(self::$provider);

                self::$is_active      = true;
            }
            else
            {
                self::$is_active = false;
            }
        }

        return self::$is_active;
    }


    private static function debug()
    {
        if(\dash\url::isLocal())
        {
            return true;
        }

        return false;
    }

    /**
     * Gets the bucket name.
     *
     * @return     <type>  The bucket name.
     */
    public static function get_bucket_name()
    {
        return self::$bucket;
    }


    /**
     * Connect to s3
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    private static function connect()
    {
        if(!self::$connected)
        {
            self::$connected = true;

            require_once __DIR__.'/vendor/autoload.php';

            $fire =
            [

                'region'      => self::$region,
                // 'version'     => '2006-03-01',
                'version'     => 'latest',
                'endpoint'    => self::$endpoint,
                'credentials' =>
                [
                    'key'    => self::$AWS_KEY,
                    'secret' => self::$AWS_SECRET_KEY,
                ],
                // Set the S3 class to use objects.dreamhost.com/bucket
                // instead of bucket.objects.dreamhost.com
                'use_path_style_endpoint' => false,
            ];

            try
            {
                self::$client = new \Aws\S3\S3Client($fire);
            }
            catch (\Exception $e)
            {
                if(self::debug()) {\dash\notif::error($e->getMessage());}
                return false;
            }
        }

        return self::$client;
    }


    /**
     * Upload file
     *
     * @param      <type>   $_real_path  The real path
     * @param      <type>   $_addr       The address
     *
     * @return     boolean  ( description_of_the_return_value )
     */
    public static function upload($_real_path, $_addr)
    {
        // s3 is not active
        if(!self::active())
        {
            return false;
        }

        $client = self::connect();

        if(!$client)
        {
            return false;
        }

        try
        {
            $upload =
            [
                'Bucket' => self::$bucket,
                'Key'    => $_addr,
                'ACL'    => 'public-read',
                'Body'   => fopen($_real_path, 'r'),
            ];

            $result = $client->putObject($upload);

            if(isset($result['ObjectURL']) && is_string($result['ObjectURL']))
            {
                $url = $result['ObjectURL'];
                return $url;
            }
            return false;
        }
        catch (\Exception $e)
        {
            if(self::debug()) {\dash\notif::error($e->getMessage());}
            return false;
        }
    }


    public static function test_connection()
    {
        // s3 is not active
        if(!self::active())
        {
            return false;
        }

        $client = self::connect();

        if(!$client)
        {
            return false;
        }

        try
        {

            $get =
            [
                'Bucket' => self::$bucket,
                'Prefix' => md5(rand()),
            ];

            $ListObjects = $client->ListObjects($get);

            if($ListObjects)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch (\Exception $e)
        {
            if(self::debug()) {\dash\notif::error($e->getMessage());}
            return false;
        }

    }


    private static function get_file_key($_path)
    {
        $endpoint = self::$endpoint;
        $bucket   = self::$bucket;
        $temp     = preg_replace("/^(https|http)\:\/\//", '', $endpoint);

        if(substr($_path, 0, 7) === 'http://')
        {
            $temp = 'http://'. $bucket. '.' . $temp;
        }
        if(substr($_path, 0, 8) === 'https://')
        {
            $temp = 'https://'. $bucket. '.' . $temp;
        }

        $temp .= '/';

        $key = str_replace($temp, '', $_path);


        return $key;
    }


    public static function delete_file($_path)
    {
        // s3 is not active
        if(!self::active())
        {
            return false;
        }

        $client = self::connect();

        if(!$client)
        {
            return false;
        }

        $path = self::get_file_key($_path);


        try
        {
            $delete =
            [
                'Bucket' => self::$bucket,
                'Key'    => $path,
            ];

            $deleteObject = $client->deleteObject($delete);


            if(isset($deleteObject['DeleteMarker']) && $deleteObject['DeleteMarker'])
            {
                return true;
            }
            else
            {
                if(self::$provider === 'arvancloud')
                {
                    return true; // :)) arvancloud say not deleted but deleted!
                }

                return false;
            }

        }
        catch (\Exception $e)
        {
            if(self::debug()) {\dash\notif::error($e->getMessage());}
            return false;
        }

    }


    public static function delete_backet()
    {
        // s3 is not active
        if(!self::active())
        {
            return false;
        }

        $client = self::connect();

        if(!$client)
        {
            return false;
        }

        $objects = $client->getIterator('ListObjects', (['Bucket' => self::$bucket]));

        foreach ($objects as $object)
        {
            $result = $client->deleteObject([
                'Bucket' => self::$bucket,
                'Key' => $object['Key'],
            ]);
        }

        $result = $client->deleteBucket([
            'Bucket' => self::$bucket,
        ]);

    }


    public static function get_sample_folder_name()
    {
        return 's3/'. self::$provider. '/'. self::get_bucket_name();
    }
}
?>