<?php

define ('HMAC_SHA256', 'sha256');
define ('SECRET_KEY', 'e971200a287e41b8b47e671910f3475c7bee0a50bb3c44e980be6ab4029952bbea7800327ec94e9d878ab2e7e41bfb641b2ea84e5def4780beafab3d7b5c5b3e6f00ed7e21354b0b883ae437515e9028eb94316c4caa4ee4949b50ce83eee193c3d9c1c98cd849ad99ebe3aa2d5503f47fb0c9f4e4f04d5e9f772c3be89aa092');

function sign ($params) {
  return signData(buildDataToSign($params), SECRET_KEY);
}

function signData($data, $secretKey) {
    return base64_encode(hash_hmac('sha256', $data, $secretKey, true));
}

function buildDataToSign($params) {
        $signedFieldNames = explode(",",$params["signed_field_names"]);
        foreach ($signedFieldNames as $field) {
           $dataToSign[] = $field . "=" . $params[$field];
        }
        return commaSeparate($dataToSign);
}

function commaSeparate ($dataToSign) {
    return implode(",",$dataToSign);
}

?>
