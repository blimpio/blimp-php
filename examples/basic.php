<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once '../src/BlimpAPI.class.php';

$username = '';
$api_key = '';
$app_id = '';
$app_secret = '';

$client = new Client($username, $api_key, $app_id, $app_secret);
$companies = $client->get('company');
$rate_limit = $client->getRateLimitStatus();

echo "<pre>";
print_r($rate_limit);
echo "</pre>";

echo "<pre>";
print_r($companies);
echo "</pre>";

$params = array(
    "assigned_to" => null,
    "project" => "/api/v2/project/50/",
    "title" => "Testing",
);

echo "<pre>";
print_r($client->create('goal', $params));
echo "</pre>";

$params = array(
    'title' => 'Updated via the API'
);

echo "<pre>";
print_r($client->update('goal', 9, $params));
echo "</pre>";

echo "<pre>";
print_r($client->delete('goal', 9));
echo "</pre>";

echo "<pre>";
print_r($client->schema('goal'));
echo "</pre>";

?>