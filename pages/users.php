<?php
session_start();
if(isset($_SESSION['user-id'])) {

$xml=simplexml_load_file("../xml/tickets.xml")or die("Error: Cannot create object");

include_once '../layout/top_side-adm.php';
?>

<h2>Users</h2>
<table>
    <thead>
    <tr>
        <th>User Id</th>
        <th>Privilege</th>
        <th>Name</th>
        <th>Username</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($xml->users->user as $user) {
        echo "
        <tr>
            <td>$user->userid</td>
			<td>$user->privilege</td>
			<td>$user->name</td>
			<td>$user->username</td>
		</tr>";
    }
    ?>
    </tbody>
</table>

<?php include_once '../layout/bottom.php';
?>
<?php
}else{
    header("Location: login.php");
}?>



