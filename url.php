<?php 
    function encrypt($s) {
        $cryptKey    ='d8578edf8458ce06fbc5bb76a58c5ca4';
        $qEncoded    =base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5( $cryptKey), $s, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
        return($qEncoded);
    }
    function decrypt($s) {
        $cryptKey    ='d8578edf8458ce06fbc5bb76a58c5ca4';
        $qDecoded    =rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($s), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
        return($qDecoded);
    }

    	//echo $id    ="qwerty";
        //echo $Encrypted    =encrypt($id);
        //echo $Decrypted    =decrypt($Encrypted);

?>
 