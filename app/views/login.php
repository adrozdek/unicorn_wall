<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Unicorn</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/main.css">

</head>
<body>

<div class="container">
    <div class="row">
        <div class=" col-sm-4 col-xs-7 col-lg-offset-4 col-sm-offset-4 col-xs-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><strong class="">Login</strong>
                </div>
                <div class="error">
                    <?php if (isset($data['error'])) echo $data['error']; ?>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="post" action="<?= $data['action'] ?>">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-md-3 col-xs-12 control-label">Email</label>
                            <div class="col-md-9 col-xs-12">
                                <input class="form-control" name="userEmail" placeholder="email" required=""
                                       type="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-md-3 col-xs-12 control-label">Password</label>
                            <div class="col-md-9 col-xs-12">
                                <input class="form-control" name="password" placeholder="password" required=""
                                       type="password">
                            </div>
                        </div>
                        <div class="form-group last">
                            <div class="col-md-offset-3 col-xs-9">
                                <button type="submit" class="btn btn-success btn-sm">Sign in</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">Not Registered? <a href="/register" class="">Register here</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>