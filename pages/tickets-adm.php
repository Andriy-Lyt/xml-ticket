<?php
session_start();

if(isset($_SESSION['user-id'])) {

$loginID = $_SESSION['user-id'];
//echo "login id: $loginID" ;

$xml=simplexml_load_file("../xml/tickets.xml");
 include_once '../layout/top_side-adm.php';
?>
<h1>Tickets, Admin view</h1>
<table>
    <thead>
        <tr>
            <th> Ticket ID </th>
            <th> User ID  </th>
            <th> Date  </th>
            <th> Status  </th>
            <th> Subject  </th>
            <th> View Ticket  </th>
        </tr>
    </thead>
    <tbody>
<?php
//     Printing All Tickets
        foreach ($xml->tickets->ticket as $ticket) { ?>
            <tr>
                <td> <?php echo $ticket->ticketid ?> </td>
                <td> <?php echo $ticket->userid ?>  </td>
                <td> <?php echo $ticket->date ?>     </td>
                <td> <?php echo $ticket->status ?>   </td>
                <td> <?php echo $ticket->subject ?>  </td>
                <td>
                    <form action='viewticket-adm.php' method='GET'>
                        <input type='hidden' name='ticketID' value= '<?php echo $ticket->ticketid ?>' />
                        <input type='submit' class='button btn btn-primary' name='viewTicket' value='View Ticket' />
                    </form>
                </td>
            </tr>
    <?php }  ?>
    </tbody>
</table>

<?php include_once '../layout/bottom.php'; ?>

<?php
}

else{
 header("Location: login.php");
}?>



