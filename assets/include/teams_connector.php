<?php
  // CURL Anfrage zu der Teams API
  function teamsWebhook( $text ) {
    $teamsurl = "https://tecsaar.webhook.office.com/webhookb2/7f07b976-8ff3-491e-9eb7-d011255c60ca@40a6b7e9-5ea6-44d8-b506-1f7c6d877de2/IncomingWebhook/70b43d4b678142dfafdab5ff8d951438/a09333a1-1d1a-4936-8bfd-525c37590301";

    $ch = curl_init();
    $jsonData = array('text' => $text);
    $jsonDataEncoded = json_encode($jsonData, true);

    $header = array();
    $header[] = 'Content-type: application/json';

    curl_setopt($ch, CURLOPT_URL, $teamsurl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    $result = curl_exec($ch);
    curl_close($ch);
  }
?>
