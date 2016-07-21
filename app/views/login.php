<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Unicorn</title>
    <!--    <link rel="stylesheet" href="/css/bootstrap.min.css">-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,700" rel="stylesheet"
          type="text/css">
    <link rel="stylesheet" href="/css/main.css">

</head>
<body>
<div class="main-page">
    <div class="login-box">

        <div class="panel-heading"><strong class="">Login</strong></div>

        <div class="error-list">
            <?php if (isset($data['error'])) echo $data['error']; ?>
        </div>

        <div class="login-form">
            <form method="post" action="<?= $data['action'] ?>">

                <input class="form-control" name="userEmail" placeholder="email" required=""
                       type="email">

                <input class="form-control" name="password" placeholder="password" required=""
                       type="password">

                <button type="submit" class="button">Sign in</button>

            </form>

        </div>
        <div class="login-footer">Not Registered? <a href="/register" class="">Register here</a></div>
    </div>
    <div class="page-footer">&copy; 2016</div>
</div>



</body>
</html>