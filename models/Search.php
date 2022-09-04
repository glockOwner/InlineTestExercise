<?php

class Search
{
    public static function search($searchInput)
    {
        $db = Db::getConnection();
        $sql = "SELECT comments.body AS 'comment_body', posts.title AS 'post_title' FROM `comments` INNER JOIN `posts` ON comments.postId = posts.id WHERE comments.body LIKE '%$searchInput%'";
        $result = $db->query($sql);
        $posts = array();
        while ($row = $result->fetch()) {
            $posts[$row['post_title']] = $row['comment_body'];
        }
        return $posts;
    }
}