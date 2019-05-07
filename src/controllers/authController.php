<?php
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

require '../src/data/authData.php';
require '../src/TokenGenerator.php';

class AuthController
{

    public function register(Request $request, Response $response, array $args)
    {

        $name = $request->getParam('name');
        $password = password_hash($request->getParam('password'), PASSWORD_DEFAULT);
        $firstName = $request->getParam('firstName');
        $lastName = $request->getParam('lastName');
        $email = $request->getParam('email');
        $gender = $request->getParam('gender');

        $userToAdd = ['name' => $name,
            'password' => $password,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'gender' => $gender];

        $authData = new AuthData();

        try {
            $data = $authData->add($userToAdd);
            return $response->withjson($data);
        } catch (Exception $e) {
            $error = ["message" => $e->getMessage()];
            return $response->withJson($error)->withStatus(422);
        }

    }

    public function login(Request $request, Response $response, array $args)
    {

        $name = $request->getParam('name');
        $password = $request->getParam('password');

        $userToLogIn = ['name' => $name, 'password' => $password];

        $authData = new AuthData();
        $loggedUser = $authData->login($userToLogIn);

        if ($loggedUser) {
            $jwt = TokenGenerator::getToken($loggedUser);
            unset($loggedUser['password']);
            return $response->withJson([
                "user" => $loggedUser,
                "token" => $jwt,
                "message" => "You are logged in!",
            ]);
        } else {
            return $response->withStatus(500);
        }

    }

}
