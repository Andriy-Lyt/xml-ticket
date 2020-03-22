<?php
if(isset($_GET['ticketID'])){
    $ticketID = $_GET['ticketID'];
}
$xml=simplexml_load_file("../xml/tickets.xml");
$messages = $xml->xpath("//ticket[@ticketid={$ticketID}]/messages/message");//Array of messages
$messAttrs = $xml->xpath("//ticket[@ticketid={$ticketID}]/messages/message/@from");// Array of attrs: Client, Admin etc...

include_once '../layout/messages-div.php';
?>

