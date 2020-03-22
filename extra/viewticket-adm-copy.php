<?php
include_once '../layout/top_side-adm.php';
//Variables ========================
    $xml=simplexml_load_file("../xml/tickets.xml");
    //echo $ticketID;
    $loginID = 1;

if(isset($_GET['viewTicket'])){
    $ticketID = $_GET['ticketID'];
}
//    echo $ticketID.'AAA';
    $userID = $xml->xpath("//ticket[@ticketid={$ticketID}]/userid")[0];
    //echo($userID); exit;
    $userName = $xml->xpath("//user[@userid={$userID}]/name")[0];
    $date = $xml->xpath("//ticket[@ticketid={$ticketID}]/date")[0];
    $subject = $xml->xpath("//ticket[@ticketid={$ticketID}]/subject")[0];
    $messages = $xml->xpath("//ticket[@ticketid={$ticketID}]/messages/message");
    $messAttr = $xml->xpath("//ticket[@ticketid={$ticketID}]/messages/message/@from");
    $status = $xml->xpath("//ticket[@ticketid={$ticketID}]/status")[0];

//Update Ticket in XML file ===================
$updStatus = $addMessg = "";
    if(isset($_POST['updTicket'])) {
        $updStatus = $_POST['status'];
        $addMessg = $_POST['message'];
    }
    if ($updStatus) {
        $xml->xpath("//ticket[@ticketid={$ticketID}]/status")[0] = $updStatus;
        saveXML('../xml/tickets.xml');
//        echo $xml->asXML();
//        header("Refresh:0");
    }

    if ($addMessg) {
        $xml->xpath("//ticket[@ticketid={$ticketID}]/messages") ->addChild('message',$addMessg );
        saveXML('../xml/tickets.xml');
//        echo $xml->asXML();
//        header("Refresh:0");
    }

?>

<!--HTML Code: ============================-->
<h1>Ticket, Admin view</h1>
    <!--Printing all Messages for particular ticket-->
    <table>
    <thead>
    <tr>
        <th> Ticket ID </th>
        <th> User ID  </th>
        <th> User Name  </th>
        <th> Date  </th>
        <th> Subject  </th>
        <th> Status  </th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td> <?php echo $ticketID ?> </td>
            <td> <?php echo $userID ?>  </td>
            <td> <?php echo $userName ?>  </td>
            <td> <?php echo $date ?>     </td>
            <td> <?php echo $subject ?>  </td>
            <td> <?php echo $status ?>  </td>
        </tr>
    </tbody>
    </table>


<div id="messaggesDiv">
        <h3>Messages</h3>
    <?php
    foreach (array_combine($messages, $messAttr) as $mes => $atr) {
        echo 'sent by: '.$atr.'<br />'. $mes.'<br />'.'<br />';
}
    ?></div>

<div id="addMesgDiv">
        <h3>Add Message, update ticket status</h3>

<!--    Form to Update Ticket ===============-->
        <form action="" method="GET">
<!--            <input type="hidden" name="tkIdUpd" value="--><?//= $ticketID ?><!--" />-->

            <div class="form-group">
                <label for="name">Status:</label>
                <input type="text" class="form-control" name="status" id="status" value=""
                       placeholder="Enter new Status">
            </div>

            <div class="form-group">
                <label for="email">Message:</label>
                <textarea rows = "5" class="form-control" id="message" name="message"
                          value="" placeholder="Enter Message"></textarea> <br />

            <a href="../pages/tickets-adm.php" id="btn_back" class=" float-right">Back to List</a>
            <button type="submit" name="updTicket"
                    class="btn btn-success float-left" id="btn-submit">
                Update Ticket
            </button>
        </form>
</div>



<?php include_once '../layout/bottom.php'; ?>

