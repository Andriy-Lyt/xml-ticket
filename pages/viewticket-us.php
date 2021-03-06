<?php
session_start();
if(isset($_SESSION['user-id'])) {

$loginID = $_SESSION['user-id'];
include_once '../layout/top_side-us.php';

$xml=simplexml_load_file("../xml/tickets.xml");

// VIEW TICKET gets ticketID from "tickets-us.php" ==================
if(isset($_GET['viewTicket'])){
    $ticketID = $_GET['ticketID'];
//    echo '$ticketID from viewTicket form =' .$ticketID;
}
//<!--UPDATE TICKET in XML file, gets data from form below =========================================-->

    if(isset($_GET['updTicket'])) {
        $xml=simplexml_load_file("../xml/tickets.xml");
        $mesgText = $_GET['message'];
        $ticketID = $_GET['ticketID'];

//        echo '$mesgText = '.$mesgText. '<br />';
//        echo '$newStatus = '.$newStatus.'<br />';
//        echo '$ticketID = from Update ticket form'.$ticketID.'<br />';

        if ($mesgText) {
           $xml->xpath("//ticket[@ticketid={$ticketID}]/messages")[0] ->addChild('message', $mesgText);

            $index = count($xml->xpath("//ticket[@ticketid={$ticketID}]/messages/message"));

            $xml->xpath("//ticket[@ticketid={$ticketID}]/messages/message")[$index-1]->addAttribute("from", "Client");

           $xml->saveXML('../xml/tickets.xml');
            header('Location: viewticket-us.php?viewTicket=View+Ticket&ticketID='. $ticketID);
        }
//        else{
//        $error =  "Please fill Message field";
//    }
//       echo '$ticketID =' .$ticketID;
    }
//    echo $ticketID.'AAA';

    //Variables ========================
    $userID = $xml->xpath("//ticket[@ticketid={$ticketID}]/userid")[0];
//    echo 'USER ID Xpath: '. $userID; exit();
    $userName = $xml->xpath("//user[@userid={$userID}]/name")[0];
    $date = $xml->xpath("//ticket[@ticketid={$ticketID}]/date")[0];
    $subject = $xml->xpath("//ticket[@ticketid={$ticketID}]/subject")[0];
    $messages = $xml->xpath("//ticket[@ticketid={$ticketID}]/messages/message");//Array of messages
//    echo 'messages var:'.var_dump($messages) ;
    $messAttrs = $xml->xpath("//ticket[@ticketid={$ticketID}]/messages/message/@from");// Array of attrs: Client, Admin etc...
//    echo 'messAttrs var'; var_dump($messAttrs);
    $status = $xml->xpath("//ticket[@ticketid={$ticketID}]/status")[0];
?>

<!--HTML  VIEW TICKET: ============================-->
<!--Printing all Messages for particular ticket-->
<h1>Ticket, User view</h1>
<table>
    <thead><tr>
        <th> Ticket ID </th><th> User ID </th><th> User Name  </th><th> Date  </th><th> Subject  </th><th> Status  </th>
    </tr></thead>
    <tbody><tr>
        <td> <?php echo $ticketID ?> </td>
        <td> <?php echo $userID ?>  </td>
        <td> <?php echo $userName ?>  </td>
        <td> <?php echo $date ?>     </td>
        <td> <?php echo $subject ?>  </td>
        <td> <?php echo $status ?>  </td>
    </tr></tbody>
</table>

<!--BLOCK on the LEFT. DISPLAY MESSAGE DIV =====================================  -->

<div class="container">
<div class="row justify-content-around">
<div id="left-block" class="col-sm-12 col-md-6 div-border">
    <h2>Messages</h2>

<!--    /*   foreach (array_combine($messAttrs, $messages) as  $atr => $mes) {
           echo 'sent by: ' . $atr . '<br />' . $mes . '<br />' . '<br />'; }
    foreach ($messages as $mes) {
        echo $mes . '<br />';
    }
    ?>
    */ -->

    <!--     Message 'Sent By' table------------------------->
    <div id="msg-tabls-div">
    <table class=" noborder inlblock" >
        <thead class=" noborder " >
        <tr class=" noborder " >
            <th class=" noborder " > Sent by: </th>
            </tr>
        </thead>
        <tbody>

    <?php foreach ($messAttrs as $atr){ ?>
        <tr >
            <td height = "50px" class=" noborder " > <?php echo $atr ?> </td>
        </tr>
<?php } ?>
    </tbody>
   </table>

    <!--    Text of Message table -------------------------->

    <table class=" noborder inlblock" >
        <thead class=" noborder " >
        <tr class=" noborder " >
            <th class=" noborder " > Message: </th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($messages as $mes){ ?>
            <tr >
                <td height = "50px" class=" noborder " > <?php echo $mes ?> </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    </div> <!-- Closing   msg-tabls-div  -->
</div><!-- Closing   div #left-block  -->

    <!-- BLOCK on the RIGHT, UPDATES TICKET in XML file, gets data from form below ======================================-->
    <!--addMesgDiv ================================== -->

<div id="" class="col-sm-12 col-md-5">
    <h2>Add Message</h2>


<!-- FORM TO UPDATE TICKET on the right====================-->
        <form action="viewticket-us.php" method="GET">

            <div class="form-group">
                <label for="email">Message:</label>
                <textarea rows = "5" class="form-control" id="message" name="message"
                          value="" placeholder="Enter Message" required></textarea> <br />

                <input type='hidden' name='ticketID' value= '<?php echo $ticketID ?>'>

                <a href="tickets-us.php" id="btn_back" class="btn float-right">Back to List</a>

            <button type="submit" name="updTicket"
                    class="btn btn-success float-left" id="btn-success">
                Submit Message
            </button>
            </div>
        </form>
    <?php if (!empty($error)) { echo "<p><{$error}></p>"; } ?>
</div>
</div>
</div>

<?php include_once '../layout/bottom.php'; ?>
<?php
}else{
    header("Location: login.php");
}?>
