<?php
session_start();
if(isset($_SESSION['user-id'])) {

$loginID = $_SESSION['user-id'];
include_once '../layout/top_side-adm.php';

$xml=simplexml_load_file("../xml/tickets.xml");

// VIEW TICKET page gets ticketID from "tickets-us.php" ==================
if(isset($_GET['viewTicket'])){
$ticketID = $_GET['ticketID'];
//    echo '$ticketID from viewTicket form =' .$ticketID;     exit();


}
//Update Mesg code==========================================

    if(isset($_GET['updTicket'])) {

        $xml=simplexml_load_file("../xml/tickets.xml");
        $mesgText = $_GET['message'];
        $newStatus = $_GET['newStatus'];
        $ticketID = $_GET['ticketID'];

//        echo '$mesgText = '.$mesgText. '<br />';
//        echo '$newStatus = '.$newStatus.'<br />';
//        echo '$ticketID = from Update ticket form'.$ticketID.'<br />';

        if ($newStatus) {
            $result = $xml->xpath("//ticket[@ticketid={$ticketID}]");
            $result[0]->status = $newStatus;
        }
        if ($mesgText) {
            $xml->xpath("//ticket[@ticketid={$ticketID}]/messages")[0] ->addChild('message', $mesgText);

            $index = count($xml->xpath("//ticket[@ticketid={$ticketID}]/messages/message"));

            $xml->xpath("//ticket[@ticketid={$ticketID}]/messages/message")[$index-1]->addAttribute("from", "Admin");
        }

        $xml->saveXML('../xml/tickets.xml');
        header('Location: viewticket-adm.php?viewTicket=View+Ticket&ticketID='.$ticketID);
//    }else{
//        $error =  "Please fill Message field";
    }

//Variables ========================
$userID = $xml->xpath("//ticket[@ticketid={$ticketID}]/userid")[0];
$userName = $xml->xpath("//user[@userid={$userID}]/name")[0];
$date = $xml->xpath("//ticket[@ticketid={$ticketID}]/date")[0];
$subject = $xml->xpath("//ticket[@ticketid={$ticketID}]/subject")[0];
$status = $xml->xpath("//ticket[@ticketid={$ticketID}]/status")[0];
$messages = $xml->xpath("//ticket[@ticketid={$ticketID}]/messages/message");//Array of messages
//    echo 'messages var:'.var_dump($messages) ;
$messAttrs = $xml->xpath("//ticket[@ticketid={$ticketID}]/messages/message/@from");// Array of attrs: Client, Admin etc...
//    echo 'messAttrs var'; var_dump($messAttrs);

?>

<!--HTML  VIEW TICKET: ============================-->
<!--Printing all Messages for particular ticket-->
<h1>Ticket, Admin view</h1>
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
</table><br />

<!--BLOCK on the LEFT. DISPLAY MESSAGE DIV =====================================  -->
<div class="container">
    <div class="row justify-content-around">
        <div id="left-block" class="col-sm-12 col-md-6 div-border">
            <h2>Messages</h2>

            <!--       foreach (array_combine($messAttrs, $messages) as  $atr => $mes) {
                       echo 'sent by: ' . $atr . '<br />' . $mes . '<br />' . '<br />'; }
                foreach ($messages as $mes) {
                    echo $mes . '<br />';
                }
                ?>
                -->

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


        <!-- BLOCK on the RIGHT, UPDATES TICKET in XML file, gets data from the form below =======================-->
        <!--add Message Div ----------------------- -->
    <div id="" class="col-sm-12 col-md-5 ">
            <h2>Add Message, update Status</h2>




            <!-- FORM TO UPDATE TICKET on the right====================-->
            <form action="" method="GET">

                <div class="form-group">
                    <label for="newStatus">Update Status:</label>
                    <input type="text" class="form-control" name="newStatus" id="newStatus" value="" placeholder="Status" >
                </div>


                <div class="form-group">
                    <label for="email">Message:</label>
                    <textarea rows = "5" class="form-control" id="message" name="message"
                              value="" placeholder="Enter Message" ></textarea> <br />

                    <input type='hidden' name='ticketID' value= '<?php echo $ticketID ?>'>


                    <a href="tickets-adm.php" id="btn_back" class="btn float-right">Back to List</a>

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

    <script>
        $(function(){
           setInterval(function(){
               $.get('viewticket-ajax.php?ticketID=<?php echo $ticketID ?>', function(res){
                   $('#msg-tabls-div').replaceWith(res)
               })
           }, 10000)
        });
    </script>

<?php include_once '../layout/bottom.php'; ?>
<?php
}else{
    header("Location: login.php");
}?>

