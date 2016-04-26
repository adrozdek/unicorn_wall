<?php if (isset($data['error'])) echo $data['error']; ?>
<form method="post" action="<?= $data['action'] ?>">
    <label>
        Email:
        <input type="email" name="userEmail">
    </label><br>
    <label>
        Password:
        <input type="password" name="password">
    </label><br>
    <input type="submit" value="Login">
</form>