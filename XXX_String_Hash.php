<?php

/*

Character length:
md5: 32
sha1: 40
sha256: 64
sha512: 128

*/

abstract class XXX_String_Hash
{
	public static function hash ($string = '', $algorithm = 'md5')
	{
		$result = false;
		
		if (function_exists('hash') && XXX_Array::hasValue(hash_algos(), $algorithm))
        {
            $result = hash($algorithm, $string);
        }
        else
        {
            $result = md5($string);
        }
                
        return $result;
	}
}

?>