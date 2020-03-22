<!-- Sidebar -->
<div class="bg-light border-right" id="sidebar-wrapper">

    <div class="sidebar-heading">MENUE: </div>
    <div class="list-group list-group-flush" >
        <a href="tickets-us.php" class="list-group-item list-group-item-action bg-light">View Tickets</a>

        <div class="flex-btn-side">
            <form action='logout.php' method='GET' >
                <input type='submit' class='button btn btn-danger' name='logout' value='Log out' />
            </form>

            <form action='newticket.php' method='POST' >
                <input type='submit' class='btn btn-success ' name='newTicket' value='New Ticket +' />
            </form>
        </div>
    </div>
</div>
<!-- /#sidebar-wrapper -->

