<?php
declare (strict_types = 1);
namespace MyApp\Controller;
use MyApp\Service\DependencyContainer;
use Twig\Environment;
use MyApp\Entity\Type;
use MyApp\Entity\User;


class DefaultController
{
    private $twig;
    private $typeModel;
    private $productModel;
    private $userModel;
  
    public function __construct(Environment $twig, DependencyContainer $dependencyContainer)
    {
        $this->twig = $twig;
        $this->typeModel = $dependencyContainer->get('TypeModel');
        $this->productModel = $dependencyContainer->get('ProductModel');
        $this->userModel = $dependencyContainer->get('UserModel');
    }

    public function home()
    {
        echo $this->twig->render('defaultController/home.html.twig', []);
    }

    public function error404()
    {
        echo $this->twig->render('defaultController/error404.html.twig', []);
    }
    public function panier()
    {
        echo $this->twig->render('defaultController/panier.html.twig', []);
    }
    public function error500()
    {
        echo $this->twig->render('defaultController/error500.html.twig', []);
    }
    public function accueil()
    {
        echo $this->twig->render('defaultController/accueil.html.twig', []);
    }
    public function contact()
    {
        echo $this->twig->render('defaultController/contact.html.twig', []);
    }
    public function payement()
    {
        echo $this->twig->render('defaultController/payement.html.twig', []);
    }
    public function listepaniers()
    {
        echo $this->twig->render('defaultController/listepaniers.html.twig', []);
    }
    public function types()
    {
        $types = $this->typeModel->getAllTypes();
        echo $this->twig->render('defaultController/types.html.twig', ['types'=>$types]);
    }
    public function updateType(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $label = filter_input(INPUT_POST, 'label', FILTER_SANITIZE_STRING);
        if (!empty($_POST['label'])) {
        $type = new Type(intVal($id), $label);
        $success = $this->typeModel->updateType($type);
        if ($success) {
        header('Location: index.php?page=types');
        }
        }
        }
        else{
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        }
        $type = $this->typeModel->getOneType(intVal($id));
        echo $this->twig->render('defaultController/updateType.html.twig', ['type'=>$type]);
       }
    public function products()
    {
        $products = $this->productModel->getAllProducts();
        echo $this->twig->render('defaultController/products.html.twig', ['products'=>$products]);
    }
    public function users()
    {
        $users = $this->userModel->getAllUsers();
        echo $this->twig->render('defaultController/users.html.twig', ['users'=>$users]);
    }
    public function updateUser(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
            $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
            $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        if (!empty($_POST['email'])) {
            $user = new User(intVal($id), $email, $lastName, $firstName, $password);
            $success = $this->userModel->updateUser($user);
            if ($success) {
                header('Location: index.php?page=users');
                }
            }
        }
        else{
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        }
        $user = $this->userModel->getOneUser(intVal($id));
        echo $this->twig->render('defaultController/updateUser.html.twig', ['user'=>$user]);
       }

       public function addType(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $label = filter_input(INPUT_POST, 'label', FILTER_SANITIZE_STRING);
        if (!empty($_POST['label'])) {
        $type = new Type(null, $label);
        $success = $this->typeModel->createType($type);
        if ($success) {
        header('Location: index.php?page=types');
        }
        }
        }
        echo $this->twig->render('defaultController/addType.html.twig', []);
        }

        public function addUser(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
                $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
                $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
                $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            if (!empty($_POST['email'])) {
            $user = new User(null, $email, $lastName, $firstName, $password);
            $success = $this->userModel->createUser($user);
            if ($success) {
            header('Location: index.php?page=users');
            }
            }
            }
            echo $this->twig->render('defaultController/addUser.html.twig', []);
            }

            public function deleteType(){
                $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
                $this->typeModel->deleteType(intVal($id));
                header('Location: index.php?page=types');
            }

            public function deleteUser(){
                $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
                $this->userModel->deleteUser(intVal($id));
                header('Location: index.php?page=users');
                }
}