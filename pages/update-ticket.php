<?php
session_start();
if(isset($_SESSION['user-id'])) {
    include_once '../layout/top_side-adm.php';

$loginID = $_SESSION['user-id'];
    $xml=simplexml_load_file("../xml/tickets.xml");



//            <!--UPDATE TICKET in XML file, gets data from form below =========================================-->
            $mesgText = $error = $newStatus = "";


            if(isset($_GET['updTicket'])) {
                $mesgText = $_GET['message'];
                $newStatus = $_GET['newStatus'];
                $ticketID = $_GET['ticketID'];

            }

            if ($mesgText) {
                $xml->xpath("//ticket[@ticketid={$ticketID}]/messages")[0] ->addChild('message', $mesgText);

                $index = count($xml->xpath("//ticket[@ticketid={$ticketID}]/messages/message"));
                $xml->xpath("//ticket[@ticketid={$ticketID}]/messages/message")[$index-1]->addAttribute("from", "Admin");
                }

            elseif($newStatus) {
                $xml->xpath("//ticket[@ticketid={$ticketID}]/status")[0] = $newStatus;

                $xml->saveXML('../xml/tickets.xml');

                }else{
                $error =  "Please fill at least 1 field";
            }
        $xml->saveXML("../xml/tickets.xml");
         header('Location: viewticket-adm.php');
            ?>


<?php include_once '../layout/bottom.php'; ?>
<?php
}else{
    header("Location: login.php");
}?>

