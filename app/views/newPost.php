<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Post</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,700" rel="stylesheet"
          type="text/css">
    <link rel="stylesheet" href="/css/main.css">

</head>
<body>
<div class="main-page">
    <div class="login-box">

        <div class="panel-heading"><strong class="">New Post</strong></div>

        <div class="error-list">
            <?php if (isset($data['errors'])) foreach ($data['errors'] as $error) echo $error . '<br>'; ?>
        </div>

        <div class="login-form">
            <form method="post" action="<?= $data['action'] ?>">

                <input class="form-control" name="title" placeholder="title" required="">

                <label>
                    <textarea class="form-control" name="text" placeholder="Your post" required=""></textarea>
                </label>

                <button type="submit" class="button">Post it!</button>

            </form>

        </div>
    </div>
</div>


</body>
</html>