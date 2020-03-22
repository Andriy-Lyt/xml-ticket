<?php
session_start();
if(isset($_SESSION['user-id'])) {
//    echo $_SESSION['user-id'] ;exit();

    include_once '../layout/top_side-us.php';

    $xml=simplexml_load_file("../xml/tickets.xml");
    $error = "";
    $numbTickInXml = count($xml->tickets->ticket);
    //echo $numbTickInXml .'AAA';

    if(isset($_GET['addTicket'])) {
    $ticketID = $numbTickInXml+1;
    $userID = $_SESSION['user-id'];
    $subject = $_GET['subject'];
    $messageText = $_GET['message'];

        //Function to Add Ticket to XML
        function addTicket() {
            global $xml, $userID, $subject, $messageText, $ticketID ;
            $ticket = $xml->tickets->addChild('ticket');
            $ticket->addAttribute('userid', $userID);
            $ticket->addAttribute('ticketid', $ticketID);
            $ticket->addChild('ticketid', $ticketID);
            $ticket->addChild('userid', $userID);
            $ticket->addChild('date', date("F j, Y"));
            $ticket->addChild('status', 'Ongoing');
            $ticket->addChild('subject', $subject);
            $ticket->addChild('messages');
            $messageNode = $ticket->messages->addChild('message', $messageText);
            $messageNode->addAttribute('from', 'Client');
            $xml->saveXML("../xml/tickets.xml");
        }

    if($subject && $messageText){
    addTicket();
    header('Location:  sucs-adticket.php');
    } else {
    $error =  "Fill all the fields";
    }
    }
    ?>
    <!--    Form to Create a new ticket -->
    <div>
        <h1>Create a new Ticket</h1>
        <form action="newticket.php" method="get" id="newticket-form">

            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" class="form-control" name="subject" id="subject" value="" placeholder="Subject"
                       required>
            </div>

            <div class="form-group">
                <label for="message">Message:</label>
                <textarea rows="5" class="form-control" id="message" name="message" value="" placeholder="Message"
                          required></textarea>
            </div>

            <button type="submit" name="addTicket"
                    class="btn btn-success float-left" id="btn-submit">
                Submit ticket
            </button>
        </form>
        <p><?= $error ?></p>
    </div>

<?php include_once '../layout/bottom.php'; ?>

<?php
}else{
header("Location: login.php");
}?>