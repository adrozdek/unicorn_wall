<?php
if (!empty($data['errors'])) {
    foreach ($data['errors'] as $error) {
        echo $error . '<br>';
    }
}; ?>
<form method="post" action="<?= $data['action'] ?>">
    <label>
        First Name:
        <input type="text" name="firstName" value="<?= $data['firstName']; ?>">
    </label><br>
    <label>
        Last Name:
        <input type="text" name="lastName" value="<?= $data['lastName']; ?>">
    </label><br>
    <label>
        Email:
        <input type="email" name="userEmail" value="<?= $data['userEmail']; ?>">
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