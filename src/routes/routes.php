<?php 


require_once '../src/controllers/authController.php';
require_once '../src/controllers/usersController.php';
require_once '../src/controllers/postsController.php';
require_once '../src/controllers/friendReqController.php';
require_once '../src/controllers/imagesController.php';


$container = new \Slim\Container;
$app = new \Slim\App($container);



$app->add(new Tuupola\Middleware\JwtAuthentication([
    "secure" => false,
    "secret" => "supersecretkeyyoushouldnotcommittogithub",
    "path"=> "/",
    "ignore"=>["/api/users/login",
                "/api/users/register"]
]));



$app->post('/api/users/register', '\AuthController:register');
$app->post('/api/users/login', '\AuthController:login');
$app->get('/api/users', '\UsersController:getAllUsers');
$app->get('/api/users/{id}', '\UsersController:getUser' );
$app->post('/api/posts', '\PostsController:addPost');
$app->get('/api/posts', '\PostsController:getAllPosts');
$app->get('/api/posts/{id}', '\PostsController:getPostById'); 
$app->get('/api/usersandposts', '\UsersController:getUsersWithPosts');
$app->get('/api/users/posts/{id}', '\PostsController:getPostsByUserId');
$app->post('/api/users/friends/request', '\FriendReqController:sendFriendReq');
$app->post('/api/users/friends/fromreq', '\FriendReqController:getFromReq');
$app->post('/api/users/friends/toreq', '\FriendReqController:getToReq');
$app->post('/api/users/friends/acceptreq', '\FriendReqController:acceptReq');
$app->post('/api/users/friends', '\FriendReqController:getFriends');
$app->post('/api/users/{id}/pictures', '\ImagesController:uploadImage' );
$app->get('/api/users/{id}/images', '\ImagesController:getImagesByuserId');
$app->get('/api/users/{id}/friends/all-requests', '\FriendReqController:getAllRequests');
$app->post('/api/users/friends/requests', '\FriendReqController:deleteRequest');
$app->post('/api/users/friendsList', '\FriendReqController:getFriendsList');



$container['upload_directory'] = __DIR__ . '/uploads';

$container['AuthController'] = function() {
    return new AuthController();
};


$container['UsersController'] = function() {
    return new UsersController();
};


$container['postsController'] = function() {
    return new postsController();
};


$container['friendReqController'] = function() {
    return new friendReqController();
};


$container['imagesController'] = function() {
    return new ImagesController();
};



