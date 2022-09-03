<?php

include_once ROOT . '/models/Search.php';
class SearchController
{
    public function actionIndex()
    {
        if (isset($_POST['search']))
        {
            $searchInput = $_POST['searchInput'];
            $errors = false;
            if (strlen($searchInput) < 3)
                $errors[] = 'Поисковое слово должно содержать хотя бы 3 символа';

            if (!$errors)
            {
                $posts = Search::search($searchInput);
            }
        }
        require_once ROOT . '/views/search/index.php';
        return true;
    }
}