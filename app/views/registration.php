<?php
if (!empty($data['errors'])) {
    foreach ($data['errors'] as $error) {
        echo $error . '<br>';
    }
}; ?>
<form method="post" action="<?= $data['action'] ?>">
    <label>
        First Name:
        <input type="text" name="firstName" value="<?= $data['user']->getFirstName(); ?>">
    </label><br>
    <label>
        Last Name:
        <input type="text" name="lastName" value="<?= $data['user']->getLastName(); ?>">
    </label><br>
    <label>
        Birthday:
        <input placeholder="2015-11-30" name='birthDate' type='date' class="form-control" value="<?= $data['user']->getBirthDate(); ?>"/>
    </label><br>
    <label>
        Email:
        <input type="email" name="userEmail" value="<?= $data['user']->getEmail(); ?>">
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