
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
</div>
