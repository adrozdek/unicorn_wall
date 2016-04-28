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
        <div class="col-sm-6 col-xs-10 col-sm-offset-3 col-xs-offset-1">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong class="">Register</strong>
                    </div>
                    <div class="error">
                        <?php
                        if (!empty($data['errors'])) {
                            foreach ($data['errors'] as $error) {
                                echo $error . '<br>';
                            }
                        }; ?>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="post" action="<?= $data['action'] ?>">
                            <div class="form-group">
                                <label for="firstName" class="col-md-3 col-xs-12 control-label">First name</label>
                                <div class="col-md-7 col-xs-12">
                                    <input class="form-control" name="firstName" id="firstName"
                                           value="<?= $htmlComponent->encode($data['user']->getFirstName()); ?>"
                                           required=""
                                           type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lastName" class="col-md-3 col-xs-12 control-label">Last name</label>
                                <div class="col-md-7 col-xs-12">
                                    <input class="form-control" name="lastName" id="lastName"
                                           value="<?= $htmlComponent->encode($data['user']->getLastName()); ?>"
                                           required=""
                                           type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="birthdate" class="col-md-3 col-xs-12 control-label">Birthdate</label>
                                <div class="col-md-7 col-xs-12">
                                    <input class="form-control" placeholder="2015-11-30" name='birthDate' type='date'
                                           value="<?= $htmlComponent->encode($data['user']->getBirthDate()); ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-md-3 col-xs-12 control-label">Email</label>
                                <div class="col-md-7 col-xs-12">
                                    <input class="form-control" name="userEmail" required=""
                                           type="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword1" class="col-md-3 col-xs-12 control-label">Password</label>
                                <div class="col-md-7 col-xs-12">
                                    <input class="form-control" name="password1" required=""
                                           type="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword2"
                                       class="col-md-3 col-xs-12 control-label">Confirm password</label for="inputPassword3">
                                <div class="col-md-7 col-xs-12">
                                    <input class="form-control" name="password2" required=""
                                           type="password">
                                </div>
                            </div>
                            <div class="form-group last">
                                <div class="col-md-offset-3 col-xs-9">
                                    <button type="submit" class="btn btn-success btn-sm">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">Already registered? <a href="/" class="">Sign in here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>