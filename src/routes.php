<?php
// Routes

//$app->get('/[{name}]', function ($request, $response, $args) {
//    // Sample log message
//    $this->logger->info("Slim-Skeleton '/' route");
//
//    // Render index view
//    return $this->renderer->render($response, 'index.phtml', $args);
//});

session_start();

$app->get('/test', function ($request, $response, $args) {
    //return $this->renderer->render($response, 'test.phtml');
    echo "test";
});

$app->get('/join', function ($request, $response, $args) {
    if ($_COOKIE['username'] != null) {
        return $response->withStatus(200)->withHeader('Location', '/diary/public/index');
    } else {
        return $this->renderer->render($response, 'join.phtml');
    }
});

$app->get('/login', function ($request, $response, $args) {
    if ($_COOKIE['username'] != null) {
        return $response->withStatus(200)->withHeader('Location', '/diary/public/index');
    } else {
        return $this->renderer->render($response, 'login.phtml');
    }
});

require __DIR__ . '/../src/models/User.models.php';

$app->post('/login', function ($request, $response, $args) {
    $user = User::where('name', '=', $_POST['username'])->first();
    if ($user->name != null && $user->password === substr(crypt($_POST['password'], '$6$what ever salt it is'), 20)) {
        echo "success";
    } else {
        echo "error";
    }
});

$app->post('/join', function ($request, $response, $args) {
    $user = User::where('name', '=', $_POST['username'])->first();
    if ($user->name != null) {
        echo "error";
    } else {
//        $new_user = new User;
//        $new_user->name = $_POST['username'];
//        $new_user->password = substr(crypt($_POST['password'], '$6$what ever salt it is'), 20);
//        $new_user->save();
//        $_COOKIE['username']=$_POST['username'];
        setcookie("username", $_POST['username'], -1);
        echo "success";
    }
});

$app->get('/index', function ($request, $response, $args) {
    return $this->renderer->render($response, 'index.phtml');
});

$app->get('/logout', function ($request, $response, $args) {
    setcookie('username', "", 0);
    return $this->renderer->render($response, 'index.phtml');
});