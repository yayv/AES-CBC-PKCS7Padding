<?php

class AES_CBC_PKCS7Padding 
{
    /*
    
    */
    public function __construct()
    {
        $this->key = "ihlih*0039JOHT$)(PIJY*(()JI^)IO%";

        $this->salt="\x00\x01\x02\x03\x04\x05\x06\x07\x08\x09\x0A\x0B\x0C\x0D\x0E\x0F";
        $this->iv = "\x0A\x01\x0B\x05\x04\x0F\x07\x09\x17\x03\x01\x06\x08\x0C\x0D\x5b";
    }

    public function test()
    {
        echo $this->encode("今天是个好日子啊，老百姓们真高兴");

        echo '<br/><hr><br/>';

        echo $this->decode($this->body);
    }

    public function encode($text)
    {
        $cipher = "aes-256-cbc";
        
        $key = hash_pbkdf2("sha1",$this->key, $this->salt,10000,256, true);

        $encrypted = openssl_encrypt($text, 'AES-256-CBC', $key, 1, $this->iv);
        $encrypt_msg = base64_encode($encrypted);

        return $encrypt_msg;
    }

    public function decode($body)
    {
        $cipher = "aes-256-cbc";
        
        $key = hash_pbkdf2("sha1",$this->key,$this->salt,10000,256, true);
        
        $encrypted = openssl_decrypt(base64_decode($this->body), $cipher, $key, 1, $this->iv);

        if($encrypted)
            return base64_encode($encrypted);
        else
            return false;
    }
}


