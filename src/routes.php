<?php
// Routes

//$app->get('/[{name}]', function ($request, $response, $args) {
//    // Sample log message
//    $this->logger->info("Slim-Skeleton '/' route");
//
//    // Render index view
//    return $this->renderer->render($response, 'index.phtml', $args);
//});

$app->get('/test', function ($request, $response, $args) {
    return $this->renderer->render($response, 'test.phtml');
});

$app->get('/join', function ($request, $response, $args) {
    return $this->renderer->render($response, 'join.phtml');
});