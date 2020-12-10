<?php

namespace App\Controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Firebase\JWT\JWT;
use Doctrine\ORM\EntityManager;
use Utilisateur;

class UserController
{

    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function login(Request $request, Response $response, array $args): Response
    {
        $utilisateurRepository = $this->entityManager->getRepository('Utilisateur');

        $data = $request->getParsedBody();
        $login = $data['login'] ?? "";
        $password = $data['password'] ?? "";

        $utilisateur = $utilisateurRepository->findOneBy(array('login' => $login));

        if($utilisateur == null || $password != $utilisateur->getMotDePasse() ) {
            $response->getBody()->write(json_encode([
                "success" => false
            ]));
            return $response->withStatus(401);
        }

        $issuedAt = time();

        $payload = [
            "user" => [
                "login" => $utilisateur->getLogin() ,
                "email" => $utilisateur->getEmail()
            ],
            "iat" => $issuedAt,
            "exp" => $issuedAt + 60
        ];

        $token_jwt = JWT::encode($payload, $_ENV["JWT_SECRET"], "HS256");

        $response->getBody()->write(json_encode([
            "success" => true,
            "login" => $utilisateur->getLogin()
        ]));
        return $response
        ->withHeader("Authorization", $token_jwt)
        ->withStatus(200);
    }
    
    public function register(Request $request, Response $response, array $args): Response
    {
        $json = $request->getParsedBody()['user'];
        $user = json_decode($json, true);
        $utilisateurRepository = $this->entityManager->getRepository('Utilisateur');

        if($this->checkValues($user) == false) {
            $response->getBody()->write(json_encode([
                "success" => false
            ]));
            return $response->withStatus(401);
        }

        if($utilisateurRepository->findOneBy(array('login' => $user['login'] ))
        || $utilisateurRepository->findOneBy(array('email' => $user['email'] ))){
            $response->getBody()->write(json_encode([
                "success" => false
            ]));
            return $response->withStatus(401);
        }

        $civilite = $user['civilite'] ?? "";
        $nom = $user['nom'] ?? "";
        $prenom = $user['prenom'] ?? "";
        $login = $user['login'] ?? "";
        $email = $user['email'] ?? "";
        $motDePasse = $user['motDePasse'] ?? "";
        $adresse = $user['adresse'] ?? "";
        $ville = $user['ville'] ?? "";
        $codePostal = $user['codePostal'] ?? "";
        $pays = $user['pays']['name'] ?? "";
        $telephone = $user['pays']['dial_code'] . $user['telephone'] ?? "";

        $utilisateur = new Utilisateur();

        $utilisateur->setCivilite($civilite);
        $utilisateur->setNom($nom);
        $utilisateur->setPrenom($prenom);
        $utilisateur->setLogin($login);
        $utilisateur->setEmail($email);
        $utilisateur->setMotDePasse($motDePasse);
        $utilisateur->setAdresse($adresse);
        $utilisateur->setVille($ville);
        $utilisateur->setCodePostal($codePostal);
        $utilisateur->setPays($pays);
        $utilisateur->setTelephone($telephone);
        $this->entityManager->persist($utilisateur);
        $this->entityManager->flush();

        $result = [
            "success" => true,
             "user" => $user
        ];
        $response->getBody()->write(json_encode($result));
        return $response->withStatus(200);
    }

    public function checkValues(array $user) {
        return strpos($user['email'], ".") != false && strpos($user['email'], "@") != false &&
        $user['nom'] != '' && $user['prenom'] != '' && $user['login'] != '' && $user['motDePasse'] != '' &&
        $user['adresse'] != '' && $user['ville'] != '' && $user['codePostal'] != '' && 
        $user['telephone'] != '' && strlen($user['telephone']) == 9;
    }
}
