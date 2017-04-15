<?php
use Psr\Http\Message\ServerRequestInterface;


$app
    ->get(
        '/login', function () use ($app) {
            $view = $app->service('view.renderer');
            return $view->render('auth/login.html.twig');
        }, 'auth.show_login_form'
    )
    ->post(
        '/login', function (ServerRequestInterface $request) use ($app) {
            $view = $app->service('view.renderer');
            $auth = $app->service('auth');
            $data = $request->getParsedBody();
            $result = $auth->login($data);
            if(!$result) {
                return $view->render('auth/login.html.twig');
            }
            return $app->route('category-costs.list');
        }, 'auth.login'
    )
    ->get(
        '/logout', function () use ($app) {
            $app->service('auth')->logout();
            return $app->route('auth.show_login_form');
        }, 'auth.logout'
    );

$app->before(
    function () use ($app) {
        $route = $app->service('route');
        $auth = $app->service('auth');
        $routesWhiteList = [
        'auth.show_login_form',
        'auth.login',
        'category-costs.list'
        ];
        if(!in_array($route->name, $routesWhiteList) && !$auth->check()) {
            return $app->route('auth.show_login_form');
        }
    }
);
