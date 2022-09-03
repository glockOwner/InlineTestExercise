<?php

class Index
{

    public static function getPostsWithComments($posts, $comments)
    {
        $postsWithComments = array();
        foreach ($posts as $post)
        {
            $postsWithComments[] = ['id' => $post->id, 'title' => $post->title, 'body' => $post->body,];
            foreach ($comments as $comment)
            {
                if ($comment->postId == $post->id)
                {
                    $postsWithComments[$post->id-1]['comments'][] = ['id' => $comment->id, 'name' => $comment->name, 'email' => $comment->email, 'body' => $comment->body];
                }
            }
        }
        return $postsWithComments;
    }

    public static function recordPostsIntoTxt($postsWithComments)
    {
        if (!file_exists('upload/postsWithComments.txt'))
        {
            foreach ($postsWithComments as $postWithComments)
            {
                file_put_contents('upload/postsWithComments.txt', "$postWithComments[id].$postWithComments[title]\r\n" . "Body: $postWithComments[body]\r\n" . "Comments: \r\n", FILE_APPEND);
                foreach ($postWithComments['comments'] as $comment)
                {
                    file_put_contents('upload/postsWithComments.txt', "Created by $comment[email]\r\n \"$comment[body]\"\r\n", FILE_APPEND);
                }
                file_put_contents('upload/postsWithComments.txt', "\r\n", FILE_APPEND);
            }
            self::createPosts($postsWithComments);
        }
    }

    public static function downloadPostsWithComments()
    {
        if (file_exists('upload/postsWithComments.txt'))
        {
            if (ob_get_level())
            {
                ob_end_clean();
            }
            header("Content-Description: File Transfer\r\n");
            header("Pragma: public\r\n");
            header("Expires: 0\r\n");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0\r\n");
            header("Cache-Control: public\r\n");
            header("Content-Type: text/plain; charset=UTF-8\r\n");
            header("Content-Disposition: attachment; filename=\"postsWithComments.txt\"\r\n");
            readfile('upload/postsWithComments.txt');
        }
    }

    public static function createPosts($postsWithComments)
    {
        $db = Db::getConnection();
        foreach ($postsWithComments as $postWithComments)
        {
            $sql = "INSERT INTO `posts` (`title`, `body`, `userId`) VALUES (:title, :body, NULL);";
            $result = $db->prepare($sql);
            $result->bindParam(':title', $postWithComments['title'], PDO::PARAM_STR);
            $result->bindParam(':body', $postWithComments['body'], PDO::PARAM_STR);
            $result->execute();
            foreach ($postWithComments['comments'] as $comment)
            {
                $sql = "INSERT INTO `comments` (`name`, `email`, `body`, `postId`) VALUES (:comment_name, :email, :body, :postId);";
                $result = $db->prepare($sql);
                $result->bindParam(':comment_name', $comment['name'], PDO::PARAM_STR);
                $result->bindParam(':email', $comment['email'], PDO::PARAM_STR);
                $result->bindParam(':body', $comment['body'], PDO::PARAM_STR);
                $result->bindParam(':postId', $postWithComments['id'], PDO::PARAM_STR);
                $result->execute();
            }
        }

    }


}