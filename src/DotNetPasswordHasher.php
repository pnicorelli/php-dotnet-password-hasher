<?php
namespace DotNetPasswordHasher;

class DotNetPasswordHasher{

    public static function verify($password, $hash, $algo="sha256") :bool
    {
      $hashedPasswordBytes = unpack("C*", base64_decode($hash));
      $hexChar = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F");

      $saltString = "";
      $storedSubKeyString = "";
      for ($i=1; $i < count($hashedPasswordBytes); $i++) {
        $a = (int) ($hashedPasswordBytes[$i+1] >> 4) & 0x0f;
        $b = (int) $hashedPasswordBytes[$i+1] & 0x0f;
        if( $i<=16 ){
          $saltString .= hex2bin($hexChar[ $a ] . $hexChar[ $b ]);
        } else {
          $storedSubKeyString .= $hexChar[ $a ] . $hexChar[ $b ];
        }
      }

      $pbkdf2 = hash_pbkdf2($algo, $password, $saltString, 1000, 256);
      $derivedKeyOctets = strtoupper( $pbkdf2 );
      $pos = strrpos($derivedKeyOctets, $storedSubKeyString);
      return ($pos===0)?true:false;
    }

    public static function hash($password, $algo="sha256") :string
    {
      $random = bin2hex(random_bytes(16));
      $salt = hex2bin($random);
      $pbkdf2 = hash_pbkdf2($algo, $password, $salt, 1000, 64);
      $h = '00'.substr($random, 0, 32).substr($pbkdf2, 0, 64);
      $h = base64_encode( hex2bin($h));
      return $h;
    }
}
