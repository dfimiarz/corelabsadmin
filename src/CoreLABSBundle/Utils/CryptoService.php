<?php

/*
 * The MIT License
 *
 * Copyright 2015 Daniel Fimiarz <dfimiarz@ccny.cuny.edu>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace CoreLABSBundle\Utils;

/**
 * This class will be used to encrypt and decrypt database IDs before
 * they are sent to clients
 *
 * @author Daniel Fimiarz <dfimiarz@ccny.cuny.edu>
 */
class CryptoService {
    
   
    private $iv;
    private $key;
    
    public function __construct($secret_key) {
        $this->key = $secret_key;
        $iv_size = \mcrypt_get_iv_size(\MCRYPT_RIJNDAEL_128, \MCRYPT_MODE_ECB);
        $this->iv = \mcrypt_create_iv($iv_size, \MCRYPT_RAND);
    }
    
     /** Decrypts record id sent by the client
     * 
     * @param type $encrypted_value
     * @return type string
     */
    public function decrypt($encrypted_value)
    {
        $decrypted_value = \trim(\mcrypt_decrypt(\MCRYPT_RIJNDAEL_128, $this->key, \base64_decode($encrypted_value), \MCRYPT_MODE_ECB, $this->iv));
        
        return $decrypted_value;
        
    }
    
    /**
     * 
     * @param type $plain_text
     * @return type string
     */
    public function encrypt($plain_text)
    {
        $encrypted_value = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->key, $plain_text, MCRYPT_MODE_ECB, $this->iv));
        
        return $encrypted_value;
    }
}
