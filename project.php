<?php
/*
1-Caeser Cipher
2-Mono Alphabet Cipher
3-ASCII Cipher
4-Vigenere Cipher
5-Play Fair Cipher
6-Affine Cipher
7-Row substitution Cipher
8-Mono Alphabet with password
*/
// =================================Encryption Caeaer================================================================
function Encrypt_Caesar($text, $shift)
{
    $result = '';
    $text = strtoupper($text);
    for ($i = 0; $i < strlen($text); $i++) {
        $char =$text[$i];
        if (ctype_alpha($char)) {
            $newchar = chr((ord($char) - 65 + $shift) % 26 + 65);
        } else {
            $newchar = $char;
        }
        $result .= $newchar;
    }
    return strtolower($result);
}
//===================================================================================================================
// =================================Decryption Caeaer================================================================
function Decrypt_Caesar($text, $shift)
{
     $result = '';
    $text = strtoupper($text);
    for ($i = 0; $i < strlen($text); $i++) {
        $char =$text[$i];
        if (ctype_alpha($char)) {
            $newchar = chr(((ord($char) - 65 - $shift + 26) % 26 )+ 65);
        } else {
            $newchar = $char;
        }
        $result .= $newchar;
    }
    return strtolower($result);
}
//===================================================================================================================
// =================================Encryption Mono==================================================================
function Encrypt_Mono($text)
{
    $new_string = '';
    $text = strtoupper($text);
    for ($i = 0; $i < strlen($text); $i++) {
        if ($text[$i] >= 'A' && $text[$i] <= 'M') {
            $new_string .= chr(ord($text[$i]) + 13);
        } else {
            $new_string .= chr(ord($text[$i]) - 13);
        }
    }
    return $new_string;
}
//===================================================================================================================
// =================================Decryption Mono==================================================================
function Decrypt_Mono($text)
{
    $new_string = '';
    $text = strtoupper($text);
    for ($i = 0; $i < strlen($text); $i++) {
        if ($text[$i] >= 'A' && $text[$i] <= 'M') {
            $new_string .= chr(ord($text[$i]) + 13);
        } else {
            $new_string .= chr(ord($text[$i]) - 13);
        }
    }
    return $new_string;
}
//====================================================================================================================
// =================================Encryption ASCII==================================================================
function encrypt_Ascii($string) {
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Define the alphabet
    $result = '';
    for ($i = 0; $i < strlen($string); $i++) {
      $originalCharacter = strtoupper($string[$i]); // Convert to uppercase
      // Check if character is a letter
        if (ctype_alpha($originalCharacter)) {
        $index = strpos($alphabet, $originalCharacter);
        // Encrypt the character
        $encryptedCharacter = $alphabet[strlen($alphabet) - $index - 1];
        // Preserve case of original character
        if (ctype_lower($string[$i])) {
            $encryptedCharacter = strtolower($encryptedCharacter);
        }
        // Append the encrypted character
        $result .= $encryptedCharacter;
      } else { // Non-alphabetic characters remain unchanged
        $result .= $originalCharacter;
    }
    }
    return $result;
}
//====================================================================================================================
// =================================Decryption ASCII==================================================================
function decrypta_Ascii($string)
{
    $result = '';
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Define the alphabet
    for ($i = 0; $i < strlen($string); $i++) {
        $char = strtoupper($string[$i]); // Convert the character to uppercase
        // Check if the character is a letter
        if (ctype_alpha($char)) {
            // Find the index of the character in the alphabet
            $index = strpos($alphabet, $char);
            // Decrypt the character by finding its counterpart from the opposite end of the alphabet 
            $decryptedChar = $alphabet [strlen($alphabet) - $index - 1];
            // Preserve the case of the original character
            if (ctype_lower($string[$i])) {
                $decryptedChar = strtolower($decryptedChar);
            }
            $result = $decryptedChar;
        } else {
            $result = $char;
        }
    }
    return $result;
}
//======================================================================================================================
// =================================Encryption Vigenere==================================================================
function vigenereEncrypt($text, $password) {
    $encrypted_message = '';
    $password_length = strlen($password);
    $password_index = 0;
    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        // Ignore white spaces
        if ($char == ' ') {
            $encrypted_message .= ' ';
            continue;
        }
        // convert character to corresponding number
        $char_number = ord(strtolower($char)) - ord('a');
        // calculate encryption offset using password
        $password_char = $password[$password_index];
        $password_offset = ord(strtolower($password_char)) - ord('a');
        // Encrypt character
        $encrypted_char = ($char_number + $password_offset) % 26;
        // convert encrypted number back to alphabet character
        $encrypted_alphabet = chr($encrypted_char + ord('a'));
        // Append encrypted character to the result
        $encrypted_message .= $encrypted_alphabet;
        // Increment password index
        $password_index = ($password_index + 1) % $password_length;
    }
    return $encrypted_message;
}
//=====================================================================================================================
// =================================Decryption Vigenere================================================================
function vigenereDencrypt($text, $password) {
    $decrypted_message = '';
    $password_length = strlen($password);
    $password_index = 0;
    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        // Ignore white spaces
        if ($char == ' ') {
            $decrypted_message .= ' ';
            continue;
        }
        // Convert character to corresponding number
        $char_number = ord(strtolower($char)) - ord('a');
        // Calculate decryption offset using password
        $password_char = $password[$password_index];
        $password_offset = ord(strtolower($password_char)) - ord('a');
        // Decrypt character
        $decrypted_char = ($char_number - $password_offset + 26) % 26;
        // Convert decrypted number back to alphabet character
        $decrypted_alphabet = chr($decrypted_char + ord('a'));
        // Append decrypted character to the result
        $decrypted_message .= $decrypted_alphabet;
        // Increment password index
        $password_index = ($password_index + 1) % $password_length;
    }
    return $decrypted_message;
}
//=======================================================================================================================
// Helper function to find position of a character in the matrix
function find_Position($matrix, $char) {
    foreach ($matrix as $row => $cols) {
        foreach ($cols as $col => $value) {
            if ($value == $char) {
                return [$row, $col];
            }
        }
    }
    return false;
}
// =================================Encryption Play Fair=================================================================
function playfairEncrypt($text, $key) {
    // Prepare the key matrix
    $key = strtoupper(str_replace(' ', '', $key)); // Remove spaces and make key uppercase
    $key = str_replace("J", "I", $key); // Replace J with I
    $key = array_unique(str_split($key)); // Remove duplicates
    $alphabet = "ABCDEFGHIKLMNOPQRSTUVWXYZ";
    // Fill the matrix with the key
    $matrix = [];
    $row = [];
    foreach ($key as $char) {
        if (!in_array($char, $row)) {
            $row[] = $char;
            if (count($row) == 5) {
                $matrix[] = $row;
                $row = [];
            }
        }
    }
    // Fill the rest of the matrix with the remaining alphabet
    foreach (str_split($alphabet) as $char) {
        if (!in_array($char, $key) && in_array($char, $row)) {
            $row[] = $char;
            if (count($row) == 5) {
                $matrix[] = $row;
                $row = [];
            }
        }
    }
    $ciphertext = '';
    $text = strtoupper(preg_replace("/[^A-Za-z]/", "", $text)); // Remove non-alphabetic characters
    $pairs = str_split($text, 2); // Split the text into pairs of two characters
    // Encrypt pairs of characters
    foreach ($pairs as $pair) {
    if (strlen($pair) == 1) {
        $pair .= "X"; // Add 'X' if the pair contains only one character
    }
    list($char1, $char2) = str_split($pair);
    // Find the position of each character in the matrix
    $pos1 = find_position($matrix, $char1);
    $pos2 = find_position($matrix, $char2);
    // Encrypt characters
    if ($pos1[0] == $pos2[0]) {
        list($row1, $col1) = $pos1;
        list($row2, $col2) = $pos2;
        // Handle characters in the same row
        if ($row1 == $row2) {
            $ciphertext .= $matrix[$row1][($col1 + 1) % 5];
            $ciphertext .= $matrix[$row2][($col2 + 1) % 5];
        }
        
        // Handle characters in the same column
        elseif ($col1 == $col2) {
            $ciphertext .= $matrix[($row1 + 1) % 5][$col1];
            $ciphertext .= $matrix[($row2 + 1) % 5][$col2];
        }
        else {
            $ciphertext .= $matrix[$row1][$col2];
            $ciphertext .= $matrix[$row2][$col1];
        }
    }
}
return strtolower($ciphertext);
}
// =================================Decryption Play Fair================================================================
function playfairDecrypt($text, $key) {
    $text = strtoupper(str_replace(" ", "", $text)); // Ensure text is uppercase and remove spaces
    $key = strtoupper(str_replace(" ", "", $key)); // Ensure key is uppercase and remove spaces
    $key = str_replace("s", "1", $key); // Replace s with 1 in the key
    $key = array_unique(str_split($key)); // Remove duplicate characters from the key
    $alphabet = "ABCDEFGHIKLMNOPQRSTUVWXYZ";
    $row = [];
    foreach ($key as $char) {
        if (in_array($char, $row)) {
            $row[] = $char;
            if (count($row) == 5) {
                $matrix[] = $row;
                $row = [];
            }
        }
    }
    // Fill the rest of the matrix with the remaining alphabet
    foreach (str_split($alphabet) as $char) {
        if (!in_array($char, $key) && !in_array($char, $row)) {
            $row[] = $char;
            if (count($row) == 5) {
                $matrix[] = $row;
                $row = [];
            }
        }
    }
    $plaintext = '';
    $pairs = str_split($text, 2);
// Decrypt pairs of characters
foreach ($pairs as $pair) {
    list($char1, $char2) = str_split($pair);
    // Find the position of each character in the matrix
    $pos1 = Find_position($matrix, $char1);
    $pos2 = Find_position($matrix, $char2);
    // Decrypt characters
    if ($pos1 !== false && $pos2 !== false) { // Ensure positions are found
        list($row1, $col1) = $pos1;
        list($row2, $col2) = $pos2;
        // Handle characters in the same row
        if ($row1 == $row2) {
            $plaintext .= $matrix[$row1][($col1 - 1 + 5) % 5];
            $plaintext .= $matrix[$row2][($col2 - 1 + 5) % 5];
        }
        // Handle characters in the same column
        elseif ($col1 == $col2) {
            $plaintext .= $matrix[($row1 + 1) % 5][$col1];
            $plaintext .= $matrix[($row2 + 1) % 5][$col2];
        } else {
            $plaintext .= $matrix[$row1][$col2];
            $plaintext .= $matrix[$row2][$col1];
        }
    }
}
return strtolower($plaintext);
}
//=======================================================================================================================
// =================================Encryption Affine====================================================================
function affine_encrypt($plaintext, $key1, $key2) {
    $ciphertext = '';
    $plaintext = strtolower($plaintext); // Convert to lowercase for simplicity
    $alphabet = range('a', 'z');

    foreach (str_split($plaintext) as $char) {
        if (ctype_alpha($char)) {
            $num = ord($char) - ord('a');
            $encrypted_num = ($num * $key1 + $key2) % 26;
            $ciphertext .= $alphabet[$encrypted_num];
        } else {
            $ciphertext .= $char; // Keep non-alphabetic characters unchanged
        }
    }
    return $ciphertext;
}
//=====================================================================================================================
// =================================Decryption Affine==================================================================
function affine_decrypt($ciphertext, $key1, $key2) {
    $plaintext = '';
    $ciphertext = strtolower($ciphertext); // Convert to lowercase for simplicity
    $alphabet = range('a', 'z');
    foreach (str_split($ciphertext) as $char) {
        if (ctype_alpha($char)) {
            $num = ord($char) - ord('a');
            // Find modular inverse of key1
            $inverse_key1 = 0;
            for ($i = 1; $i < 26; $i++) {
                if (($i * $key1) % 26 == 1) {
                    $inverse_key1 = $i;
                    break;
                }
            }
            $decrypted_num = (($num - $key2 + 26) * $inverse_key1) % 26;
            $plaintext .= $alphabet[$decrypted_num];
        } else {
            $plaintext .= $char; // Keep non-alphabetic characters unchanged
        }
    }
    return $plaintext;
}
//=======================================================================================================================
// =================================Encryption Row substitution==========================================================
function encryptRailFence($text, $key = 2)
{
    // create the matrix to cipher plain text
    // key = rows , length(text) = columns
    $rail = array_fill(0, $key, array_fill(0, strlen($text), "\n"));
    // filling the rail matrix to distinguish filled
    // spaces from blank ones
    $dir_down = false;
    $row = 0;
    $col = 0;
    for ($i = 0; $i < strlen($text); $i++) {
        // check the direction of flow
        // reverse the direction if we've just
        // filled the top or bottom rail
        if ($row == 0 || $row == $key - 1) {
            $dir_down = !$dir_down;
        }
        // fill the corresponding alphabet
        $rail[$row][$col++] = $text[$i];
        // Find the next row using direction flag
        $row += $dir_down ? 1 : -1;
    }
    // now we can construct the cipher using the rail matrix
    $result = "";
    foreach ($rail as $row) {
        foreach ($row as $char) {
            if ($char !== "\n") {
                $result .= $char;
            }
        }
    }
    return $result;
}
//=====================================================================================================================
// =================================Decryption Row substitution========================================================
// Rail Fence Cipher decryption function
function decryptRailfence($cipher, $key=2) {
    // create the matrix to cipher plain text
    // key = rows, length(text) = columns
    $rail = array_fill(0, $key, array_fill(0, strlen($cipher), "\n"));
    // mark the places with '*'
    $dir_down = false;
    $row = 0;
    for ($i = 0; $i < strlen($cipher); $i++) {
        // check the direction of flow
        if ($row == 0)
            $dir_down = true;
        if ($row == $key - 1)
            $dir_down = false;
        // place the marker
        $rail[$row][$i] = '*';
        // Find the next row using direction flag
        $row += $dir_down ? 1 : -1;
    }
    // now we can construct and fill the rail matrix
    $index = 0;
    for ($i = 0; $i < $key; $i++) {
        for ($j = 0; $j < strlen($cipher); $j++) {
            if ($rail[$i][$j] == '*' && $index < strlen($cipher))
                $rail[$i][$j] = $cipher[$index++];
        }
    }
    $result = "";
    $dir_down = false;
    $row = 0;
    $col = 0;
    for ($i = 0; $i < strlen($cipher); $i++) {
        // check the direction of flow
        if ($row == 0) {
            $dir_down = true;
        }
        if ($row == $key - 1) {
            $dir_down = false;
        }
        // place the marker
        if ($rail[$row][$col] !== "*") {
            $result .= $rail[$row][$col];
            $col++;
        }
        // find the next row using direction flag
        $row += $dir_down ? 1 : -1;
    }
    return $result;
}
//=====================================================================================================================
//===========================================Mono Alphabet with password===============================================

function remainingAlphabet($word) {
    // Convert the word to lowercase to ensure case insensitivity
    $word = strtolower($word);
    // Define the alphabet
    $alphabet = range('a', 'z');
    // Remove characters present in the word from the alphabet
    foreach (str_split($word) as $char) {
        $key = array_search($char, $alphabet);
        if ($key !== false) {
            unset($alphabet[$key]);
        }
    }
    // Concatenate the word with the remaining characters
    return $word . implode(',', $alphabet);
}

function generateCustomAlphabet($word) {
    // Get the remaining alphabet after the word
    $remainingAlphabet = remainingAlphabet($word);
    // Convert the remaining alphabet to an array
    $customAlphabet = str_split($remainingAlphabet);
    return $customAlphabet;
}
// =================================Ecryption Mono Alphabet with password =============================================
function customAlphabetEncrypt($text, $word) {
    $customAlphabet = generateCustomAlphabet($word);
    $encrypted_text = "";
    $length = strlen($text);
    // Update encryption mapping based on the custom alphabet
    $encryptionMap = array_combine($customAlphabet, array_merge(array_slice($customAlphabet, 13), array_slice($customAlphabet, 0, 13)));
    for ($i = 0; $i < $length; $i++) {
        $char = strtolower($text[$i]);
        if (isset($encryptionMap[$char])) {
            $encrypted_text .= $encryptionMap[$char];
        } else {
            $encrypted_text .= $char;
        }
    }
    return $encrypted_text;
}
// =================================Decryption Mono Alphabet with password ==============================================
function customAlphabetDecrypt($text, $word) {
    $customAlphabet = generateCustomAlphabet($word);
    $decryptionMap = array_combine(array_merge(array_slice($customAlphabet, 13), array_slice($customAlphabet, 0, 13)), $customAlphabet);
    $decrypted_text = "";
    $length = strlen($text);
    for ($i = 0; $i < $length; $i++) {
        $char = strtolower($text[$i]);
        if (isset($decryptionMap[$char])) {
            $decrypted_text .= $decryptionMap[$char];
        } else {
            $decrypted_text .= $char;
        }
    }
    return $decrypted_text;
}
?>
