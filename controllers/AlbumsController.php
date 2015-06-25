<?php

class AlbumsController extends BaseController {
    private $db;

    public function onInit() {
        $this->title = 'My albums';
        $this->db = new IssueModel();
    }

    public function index() {
        
    }

    public function me($page = 1, $pageSize = 12) {
        $this->authorize();
        $from = ($page - 1) * $pageSize;
        $this->page = $page;
        $this->pageSize = $pageSize;

        $albumsData = $this->db->getUserAlbumsFiltered($_SESSION['username'], $from, $pageSize);
        $this->albums = $albumsData['fetched_albums'];
        $this->totalPages = ceil($albumsData['total_albums'] / $this->pageSize);

        $this->renderView(__FUNCTION__);
    }

    public function showAlbum($albumId) {
        $this->renderView('show-album');
    }

    public function create() {
        $this->authorize();

        if($this->isPost) {
            $albumName = $_POST['album-title'];
            $photosPaths = [];


            for($i = 0; $i < count($_FILES['photos']['name']); $i++) {
                $photoPath = ALBUMS_IMAGES_LOCATION . DIRECTORY_SEPARATOR . uniqid('image_', true) . '.' .
                    pathinfo($_FILES['photos']['name'][$i], PATHINFO_EXTENSION);
                move_uploaded_file($_FILES['photos']['tmp_name'][$i], $photoPath);
                $photosPaths[] = $photoPath;
            }

            $albumId = $this->db->createUserAlbum($_SESSION['username'], $albumName, $photosPaths);

            $this->redirectToUrl('/albums/show-album/' . $albumId);
        }

        $this->renderView(__FUNCTION__);
    }

    public function edit($albumId) {
        $this->authorize();

        $this->renderView(__FUNCTION__);
    }

    public function delete($albumId) {
        $this->authorize();

        $this->renderView(__FUNCTION__);
    }
}