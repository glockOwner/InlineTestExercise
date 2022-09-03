<?php

require_once 'components/HttpClient.php';
include_once ROOT . '/models/Index.php';
class IndexController
{
    public function actionIndex()
    {


        require_once ROOT . '/views/index/index.php';
        return true;
    }

    public function actionDownload()
    {
        $requestPosts = new HttpClient('https://jsonplaceholder.typicode.com/posts');
        $responsePosts = $requestPosts->client->request('GET');
        $posts = json_decode($responsePosts->getBody()->getContents());
        unset($responsePosts, $requestPosts);

        $requestComments = new HttpClient('https://jsonplaceholder.typicode.com/comments');
        $responseComments = $requestComments->client->request('GET');
        $comments = json_decode($responseComments->getBody()->getContents());
        unset($responseComments, $requestComments);


        $postsWithComments = Index::getPostsWithComments($posts, $comments);
        Index::recordPostsIntoTxt($postsWithComments);
        $_SESSION['result'] = "Загружено " . count($posts) ." записей и " . count($comments) . " комментариев";
        Index::downloadPostsWithComments();
        header('Location: /');
        return true;
    }


}