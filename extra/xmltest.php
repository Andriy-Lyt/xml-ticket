<?php
$xml=simplexml_load_file("../xml/tickets.xml");
//print_r($xml);
//echo $xml->to . "<br>";
//echo $xml->from . "<br>";
//echo $xml->heading . "<br>";
//echo $xml->body;

//echo '<pre>',var_dump($xml),'</pre>'; exit;
/*
echo '<pre>',var_dump($xml->xpath("/tickets/ticket[@ticketid={$ticketID}]")),'</pre>'; exit;
*/

//echo $xml->xpath("/tickets/ticket[@{$ticketID}]/status")[0];
//exit();

/*function ttid ($tickId) {
    $xml=simplexml_load_file("../xml/tickets.xml");
    return $xml->xpath("/tickets/ticket[@ticketid={$tickId}]")[0];
}*/
//echo  ((ttid(1))->userid);

//<? echo  '<p>'. ((ttid(1))) . '</p>';
//exit();
//
/*$ticketID = 3;
$userID = $xml->xpath("//ticket[@ticketid={$ticketID}]/userid")[0];
echo 'USER ID Xpath: '. $userID; exit();*/

$ticketID = 1; $newStatus =" Changed!";
 $xml->xpath("//ticket[@ticketid={$ticketID}]/status")[0] = 'Vasya' ;
$ticket1 = $xml->xpath("//ticket[@ticketid={$ticketID}]")[0];
//$ticket1->addChild('Vasiliy', 'Ivanov');
$ticket1->status =  "tralala";
$xml->saveXML("../xml/tickets.xml");

echo '<pre>';
print_r($xml->xpath("//ticket[@ticketid={$ticketID}]"));

?>