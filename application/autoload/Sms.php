<?php
Class Sms{


    public static function send($driver,$sms=array(),$config,$log=false,$userid='0'){

        Event::trigger('Sms_send');

        switch($driver){

            case 'nexmo':


                $url = 'https://rest.nexmo.com/sms/json?' . http_build_query(
                        [
                            'api_key' =>  $config['nexmo_api_key'],
                            'api_secret' => $config['nexmo_api_secret'],
                            'to' => $sms['to'],
                            'from' => $sms['from'],
                            'text' => $sms['text']
                        ]
                    );

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);


                if($log){
                    _log($response,'Admin',$userid);
                }


                break;


            case 'twilio':





                break;


            default:

                return false;


        }

    }


}