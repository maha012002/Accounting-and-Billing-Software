<?php

function encrypt($plainText,$key)
{
    $secretKey = hextobin(md5($key));
    $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
    $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
    $blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
    $plainPad = pkcs5_pad($plainText, $blockSize);
    if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1)
    {
        $encryptedText = mcrypt_generic($openMode, $plainPad);
        mcrypt_generic_deinit($openMode);

    }
    return bin2hex($encryptedText);
}

function decrypt($encryptedText,$key)
{
    $secretKey = hextobin(md5($key));
    $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
    $encryptedText=hextobin($encryptedText);
    $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
    mcrypt_generic_init($openMode, $secretKey, $initVector);
    $decryptedText = mdecrypt_generic($openMode, $encryptedText);
    $decryptedText = rtrim($decryptedText, "\0");
    mcrypt_generic_deinit($openMode);
    return $decryptedText;

}
//*********** Padding Function *********************

function pkcs5_pad ($plainText, $blockSize)
{
    $pad = $blockSize - (strlen($plainText) % $blockSize);
    return $plainText . str_repeat(chr($pad), $pad);
}

//********** Hexadecimal to Binary function for php 4.0 version ********

function hextobin($hexString)
{
    $length = strlen($hexString);
    $binString="";
    $count=0;
    while($count<$length)
    {
        $subString =substr($hexString,$count,2);
        $packedString = pack("H*",$subString);
        if ($count==0)
        {
            $binString=$packedString;
        }

        else
        {
            $binString.=$packedString;
        }

        $count+=2;
    }
    return $binString;
}





// Old, updated: January 10, 2016

/*
function get_CCAvanue_Order_Id(){
    $length = 8;
    $userid = "";
    $possible = "0123456789abcdefghifklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $i = 0;
    while($i < $length){
        $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
        if(!strstr($userid, $char )){
            $userid .= $char;
            $i++;
        }
    }
    return $userid;
}


function getchecksum($MerchantId,$Amount,$OrderId ,$URL,$WorkingKey)
{
    $str ="$MerchantId|$OrderId|$Amount|$URL|$WorkingKey";
    $adler = 1;
    $adler = adler32($adler,$str);
    return $adler;
}

function verifychecksum($MerchantId,$OrderId,$Amount,$AuthDesc,$CheckSum,$WorkingKey)
{
    $str = "$MerchantId|$OrderId|$Amount|$AuthDesc|$WorkingKey";
    $adler = 1;
    $adler = adler32($adler,$str);

    if($adler == $CheckSum)
        return "true" ;
    else
        return "false" ;
}

function adler32($adler , $str)
{
    $BASE =  65521 ;

    $s1 = $adler & 0xffff ;
    $s2 = ($adler -->> 16) & 0xffff;
    for($i = 0 ; $i < strlen($str) ; $i++)
    {
        $s1 = ($s1 + Ord($str[$i])) % $BASE ;
        $s2 = ($s2 + $s1) % $BASE ;
    }
    return leftshift($s2 , 16) + $s1;
}

function leftshift($str , $num)
{

    $str = DecBin($str);

    for( $i = 0 ; $i < (64 - strlen($str)) ; $i++)
        $str = "0".$str ;

    for($i = 0 ; $i < $num ; $i++)
    {
        $str = $str."0";
        $str = substr($str , 1 ) ;
    }
    return cdec($str) ;
}

function cdec($num)
{

    for ($n = 0 ; $n < strlen($num) ; $n++)
    {
        $temp = $num[$n] ;
        @$dec =  $dec + $temp*pow(2 , strlen($num) - $n - 1);
    }

    return $dec;
}

*/

