<?php

abstract class XXX_String_Encryption
{
	public static $cryptKey = '6061fff5cae215123faad60ed73cfc78';
		
	public static function encrypt ($string = '', $cryptKey = '')
	{
		$result = false;
		
		if ($cryptKey == '')
		{
			$cryptKey = self::$cryptKey;
		}
		
		$initializationVectorSize = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_CBC);
		
		$initializationVector = mcrypt_create_iv($initializationVectorSize, MCRYPT_DEV_URANDOM);
		
		$cipherString = mcrypt_encrypt(MCRYPT_BLOWFISH, $cryptKey, $string, MCRYPT_MODE_CBC, $initializationVector);
		
		$result = XXX_String_Base64::encode($initializationVector . $cipherString);
		
		return $result;
	}
	
	public static function decrypt ($string = '', $cryptKey = '')
	{
		$result = false;
		
		if ($cryptKey == '')
		{
			$cryptKey = self::$cryptKey;
		}
		
		$string = XXX_String_Base64::decode($string);
		
		$initializationVectorSize = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_CBC);
		
    	$initializationVector = XXX_String::getPart($string, 0, $initializationVectorSize);
		$cipherString = XXX_String::getPart($string, $initializationVectorSize);
		
		$result = mcrypt_decrypt(MCRYPT_BLOWFISH, $cryptKey, $string, MCRYPT_MODE_CBC, $initializationVector);
		
		return $result;
	}
}

?>