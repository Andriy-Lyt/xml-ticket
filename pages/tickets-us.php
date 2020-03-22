<?php
session_start();
/*echo '$_SESSION[\'user-id\'] = '. $_SESSION['user-id'].'<br />';
echo '$_POST[\'username\'] = '.$_POST['username'].'<br />';
echo '$_POST[\'password\'] = '.$_POST['password'].'<br />';
exit();*/

if(isset($_SESSION['user-id'])) {
    include_once '../layout/top_side-us.php';

$xml=simplexml_load_file("../xml/tickets.xml");
$loginID = $_SESSION['user-id'];
//    echo "login id: $loginID" ;

$ticketsByUserID = $xml->xpath("//ticket[@userid={$loginID}]");
//var_dump($ticketsByUserID);
?>
<h1>Tickets, User view</h1>
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

<!--Printing Tickets submitted by certain User-->
<!--$ticketsByUserID = $xml->xpath("//ticket[@userid={$loginID}]");
-->
<?php
    foreach ($ticketsByUserID as $ticket) { ?>
        <tr>
            <td><?php echo $ticket->ticketid ?></td>
            <td><?php echo $ticket->userid ?></td>
            <td><?php echo $ticket->date ?></td>
            <td><?php echo $ticket->status ?></td>
            <td><?php echo $ticket->subject ?></td>
            <td>
                    <form action='viewticket-us.php' method='GET'>
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
}else{
//    header("Location: login.php");
}?>


