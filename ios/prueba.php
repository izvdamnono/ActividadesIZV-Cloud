<?php
require_once('../clases/vendor/autoload.php');
use \Firebase\JWT\JWT;
$token = array(
    "usuario" => "http://example.org",
    "clave" => "http://example.com",
    "fechahora" => 1356999524,
    "datos" => 1357000000
);

/**
 * IMPORTANT:
 * You must specify supported algorithms for your application. See
 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
 * for a list of spec-compliant algorithms.
 */
$cadenaswift = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6OH0.nTgy1i1WGb_4LLNuMRwtfwwYBB8ilMDnV3OZzr9TBaw'; 
$key      = 'culo';

$jwt = JWT::encode($token, $key);
print($jwt);


$t = array(
    "c" => "http://example.org",
    "codificado" => $jwt
);

$decoded = JWT::decode($cadenaswift, $key, array('HS256'));
echo "Id: ".$decoded->id;
print_r($decoded);


/*
     * Carmelo-> [ username: "carvegex123", password: "carvegex123"]
     * Pilar->   [ username: "pilferher123", password: "pilferher123"]
     * Modesto-> [ username: "modmarpal123", password: "modmarpal123"]
*/
echo '<p>Carmelo:'.md5("carvegex123").'</p>';
echo '<p>Pilar:'.md5("pilferher123").'</p>';
echo '<p>Modesto:'.md5("modmarpal123").'</p>';
$key = "izvkey";
//echo JWT::encode(array("token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MSwidXNlcm5hbWUiOiJjYXJ2ZWdleDEyMyIsInBhc3N3b3JkIjoiZTA0ZGViZmQ2OGVmODBmMWUxMjUwMGI3ZTk4MGY0MzQiLCJkYXRlUmVxdWVzdCI6IjIwMTctMDItMjEgMTk6MTQ6MDEifQ.GTKhMone-Z2kd7R5oqL7AY5eoNMAyytso7FYGlhaQ-M"), $key);
//var_dump(JWT::decode('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyZXNwb25zZSI6Im9rIn0.06mAl6V2mCpLRRtNOFE3W_fFrICExlT-OuVUZYyyn0U', $key, array('HS256')));
var_dump( JWT::decode('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRlUmVxdWVzdCI6IjIwMTctMDItMjIiLCJpZCI6MSwidXNlcm5hbWUiOiJjYXJ2ZWdleDEyMyIsInBhc3N3b3JkIjoiZTA0ZGViZmQ2OGVmODBmMWUxMjUwMGI3ZTk4MGY0MzQifQ._oxbCG12GXfizshdqnevay4aIinSHdfOmYzPofbP0tw', $key, array('HS256')));
?>eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRlUmVxdWVzdCI6IjIwMTctMDItMjIiLCJpZCI6MSwidXNlcm5hbWUiOiJjYXJ2ZWdleDEyMyIsInBhc3N3b3JkIjoiZTA0ZGViZmQ2OGVmODBmMWUxMjUwMGI3ZTk4MGY0MzQifQ._oxbCG12GXfizshdqnevay4aIinSHdfOmYzPofbP0tw