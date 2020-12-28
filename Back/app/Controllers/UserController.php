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
            "exp" => $issuedAt + 600
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
        return (!preg_match("/[a-zA-Z]{1,256}/", $user['civilite']) ||
           !preg_match("/[A-Za-z]{1,256}/", $user['nom']) ||
           !preg_match("/[A-Za-z]{1,256}/", $user['prenom']) ||
           !preg_match("/[A-Za-z0-9 ]{1,256}/", $user['adresse']) ||
           !preg_match("/[0-9]{10,16}/", ltrim($user['telephone'], '+')) ||
           !preg_match("/[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}/", $user['email']) ||
           !preg_match("/[0-9]{5}/", $user['codePostal']) ||
           !preg_match("/[A-Za-z]{1,256}/", $user['ville']) ||
           !preg_match("/[A-Za-z0-9]{8,256}/", $user['login']) ||
           !preg_match("/(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,256}/", $user['motDePasse']));
    }
    
}
