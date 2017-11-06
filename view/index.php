<?php
    require "func.php";
?>
<form method="post" class="panel">
    <p>Add your phone number</p>
    <br>
    <b>Option 1. Add your phone number</b>
    <br>
    <br>
    Enter your PHONE
    <br>
    <input name="phone">
    <br>
    <br>
    Enter your e-mail *:
    <br>
    <input name="mail">
    <br>
    <div>You will be able to retrieve your phone number later on using your e-mail.</div>
    <input type="submit" name="add">
</form>
<form method="post" class="panel">
    <p>Retrieve your phone number</p>
    <br>
    <b>Option 2. Retrieve your phone number</b>
    <br>
    <br>
    Enter your e-mail *:
    <br>
    <input name="mail">
    <br>
    <div>The phone number will be e-mailed to you.</div>
    <input type="submit" name="retrieve">
</form>
<br>
<?php echo $mes ?>