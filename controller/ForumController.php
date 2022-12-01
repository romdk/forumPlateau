<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\CategorieManager;
    use Model\Managers\SujetManager;
    use Model\Managers\MessageManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        
        public function index(){}
        
        public function listCategories(){
            
            $categorieManager = new CategorieManager();
            
            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                    "categories" => $categorieManager->findAll(["nomCategorie","ASC"])
                    ]
                ];
            }

        public function listSujets(){     
            
            $sujetManager = new SujetManager();
            $id=(isset($_GET["id"])) ? $_GET["id"] : null;

            return [
                "view" => VIEW_DIR."forum/listSujets.php",
                "data" => [
                    "sujets" => $sujetManager->findSujetsByCategorie($id)
                ]
            ];

        }
        
        
        
        
        
        public function listMessages(){
            
            $messageManager = new MessageManager();
            $id=(isset($_GET["id"])) ? $_GET["id"] : null;
            $messages = $messageManager->findMessagesBySujet($id);

            return [
                "view" => VIEW_DIR."forum/listMessages.php",
                "data" => [
                    "messages" => $messages
                    ]
                ];
                
            }

        public function ajoutSujet(){
            $ajoutSujet = new SujetManager();
            $categorieId=(isset($_GET["id"])) ? $_GET["id"] : null;
            $titre = filter_input(INPUT_POST,'titre',FILTER_SANITIZE_SPECIAL_CHARS);
            $message = filter_input(INPUT_POST,'1erMessage',FILTER_SANITIZE_SPECIAL_CHARS);

            return [
                "view" => VIEW_DIR."forum/listSujets.php",
                "data" => [
                    "sujets" => $ajoutSujet->InsertSujet($categorieId,$titre,$message)
                ]
            ];
            header("Location:index.php?ctrl=forum&action=listSujets&id=$id");            
        }

        public function ajoutMesage(){
            $ajoutMessage = new MessageManager();
            $sujetId=(isset($_GET["id"])) ? $_GET["id"] : null;
            $message = filter_input(INPUT_POST,'message',FILTER_SANITIZE_SPECIAL_CHARS);

        }
            
            

        

    }
