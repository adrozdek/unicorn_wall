<form method="post" action="<?= $data['action'] ?>">
    <label>
        First Name:
        <input type="text" name="firstName" value="<?php if (isset($_POST['firstName'])) echo $_POST['firstName']; ?>">
    </label><br>
    <label>
        Last Name:
        <input type="text" name="lastName" value="<?php if (isset($_POST['lastName'])) echo $_POST['lastName']; ?>">
    </label><br>
    <label>
        Email:
        <input type="email" name="userEmail" value="<?php if (isset($_POST['userEmail'])) echo $_POST['userEmail']; ?>">
    </label><br>
    <label>
        Password:
        <input type="password" name="password1">
    </label><br>
    <label>
        Confirm Password:
        <input type="password" name="password2">
    </label><br>
    <input type="submit" value="Register">
</form>