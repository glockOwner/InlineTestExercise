<?php

class Search
{
    public static function search($searchInput)
    {
        $db = Db::getConnection();
        $sql = "SELECT * FROM `comments` WHERE `body` LIKE '%$searchInput%';";
        $result = $db->query($sql);
        $posts = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            $sql = "SELECT `title`, `id` FROM `posts` WHERE `id` = :postId;";
            $resultPost = $db->prepare($sql);
            $resultPost->bindParam(':postId', $row['postId']);
            $resultPost->execute();
            $post = $resultPost->fetch();
            $posts[$post['title']] = $row['body'];
        }
        return $posts;
    }
}