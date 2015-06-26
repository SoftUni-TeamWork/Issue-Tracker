<?php

class CommentsController extends BaseController {
    private $db;

    public function onInit() {
        $this->db = new CommentModel();
    }

    public function add() {
        $this->authorize();

        if($this->isPost) {
            //$this->validateCsft($_POST['csrfName'], $_POST['csrfToken']);
            
            $issueId = $_POST['issueId'];
            $username = $_POST['username'];
            $comment = $_POST['comment'];

            $newComment = $this->db->addComment($issueId, $username, $comment);

            header('Content-Type: application/json');

            if ($newComment) {
                echo json_encode($newComment);
            } else {
                echo json_encode([
                    'message' => 'Cannot add comment'
                ]);
                http_response_code(400);
            }
        }
    }

//    protected function validateCsft($csfrName, $csfrToken){
//        $isValid = CsftGuard::validateToken($csfrName, $csfrToken);
//
//        if(!$isValid) {
//            echo json_encode([
//                'message' => 'Cannot add comment'
//            ]);
//            http_response_code(400);
//            die;
//        }
//    }
}