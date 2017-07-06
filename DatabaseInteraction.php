<?php
require_once ('config/config.php');

/**
 *  In this class are the functions to filter, to comment and to like the blogs. And the function to follow the site.
 */
class DatabaseInteraction
{
    private $db = null;

    function __construct() {
        $this->db = mysqli_connect (MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    }

    /**
    * Function to get all the blogs who are true for the filter
    * @param $filter_by the selected filter option
    * @return an associative array of the blogs from the selected filter with id, text, zeit, likes, pfad and beitraege_id
    */
    function getBeitraegeByFilter($filter_by) {
        if(!isset($_SESSION)){
            session_start();
            $_SESSION['filterby'] = $filter_by;
        }
        $blog_entry_query = $this->db->query("SELECT beitraege.id, beitraege.text, beitraege.zeit, beitraege.likes, bilder.pfad, bilder.beitraege_id, tags.id as tags_id, tags.name FROM beitraege LEFT OUTER JOIN bilder ON beitraege.id = bilder.beitraege_id LEFT OUTER JOIN beitraege_has_tags ON beitraege_has_tags.beitraege_id = beitraege.id LEFT OUTER JOIN tags ON beitraege_has_tags.tags_id = tags.id ORDER BY zeit DESC;");
        $tags_query = $this->db->query("SELECT * FROM tags");
        $tags = array();
        $beitraege = array();
        while ($result = $tags_query->fetch_assoc()) {
            $tags[] = $result;
        }
        if ($filter_by != null) {
            //check after what the blogs will be filtered
            if ($filter_by == "Lastmonth") {
                $lastMonthName = strftime('%B', strtotime("-1 month"));
                while ($beitrag = $blog_entry_query->fetch_assoc()) {
                    $date = strftime("%B", strtotime($beitrag['zeit']));
                    if ($date == $lastMonthName) {
                        $beitraege[] = $beitrag;
                    }
                }
            }
            else {
                $tag_beitraege = array();
                foreach ($tags as $tag) {
                    if ($filter_by == $tag['name']) {
                        while ($beitrag = $blog_entry_query->fetch_assoc()) {
                                if ($tag['id'] == $beitrag['tags_id']) {
                                    $beitraege[] = $beitrag;
                                }
                        }

                    }
                }
            }
        }
        else {
                while ($beitrag = $blog_entry_query->fetch_assoc()) {
                    $beitraege[] = $beitrag;
                }
            }
        return $beitraege;
    }

    /**
    * Function to save Comments in the Database table 'kommentare'
    * @param $comment the text from the comment input field
    * @param $beitrags_id is the id from the current blog
    * @return true or false
    */
    function createComment($comment, $beitrags_id) {
        if ($comment != null) {
            $comment = mysqli_real_escape_string($this->db, $comment);
            $comment_query = "INSERT INTO kommentare (`id`, `text`, `zeit`, `beitrag_id`)
                    VALUES(null, '$comment', NOW(), '$beitrags_id');";
            return mysqli_query($this->db, $comment_query)
                or die("Anfrage ~comment~ fehlgeschlagen: " . mysqli_error());
        }
        else {
            return false;
        }
    }

    /**
    * Function to follow the blog and save the email address
    * @param $email is the email from the input
    * @param $name is the name from the input
    * @return true or false
    */
    function createFollower($email, $name) {
        if ($email != null) {
            $name = mysqli_real_escape_string($this->db, $name);
            $email = mysqli_real_escape_string($this->db, $email);
            $follower_query = "INSERT INTO follower (`id`, `name`, `email`)
                    VALUES(null, '$name', '$email');";
            return mysqli_query($this->db, $follower_query)
                 or die("Anfrage ~email~ fehlgeschlagen: " . mysqli_error());
        }
        else {
            return false;
        }
    }

    /**
    * Function to like a blog and save the number in the table 'beitrage' in row 'likes'
    * @param $count_like number of likes
    * @param $beitragsid the id from the current blog
    * @return true or false
    */
    function updateBeitraegeLikes($count_likes, $beitrags_id) {
        if($count_likes != null) {
            $like_blog_query = "UPDATE beitraege SET `likes` = '$count_likes'
                    WHERE `id` = '$beitrags_id';";
            return mysqli_query($this->db, $like_blog_query)
                 or die("Anfrage ~like~ fehlgeschlagen: " . mysqli_error());
        }
        else {
            return false;
        }
    }

    /**
    * Function to save text into database table 'beitraege'
    * @param $blog_content is the text from tinymce
    * @return true or false
    */
    public function createBeitrag($blog_content) {
        $blog_content = mysqli_real_escape_string($this->db, $blog_content);
        $new_blog_query = "INSERT INTO beitraege (`id`, `text`, `zeit`, `likes`)
                VALUES(null, '$blog_content', NOW(), '0')";
        return array('mysqli_query' => mysqli_query($this->db, $new_blog_query)
           or die("Anfrage ~blog_conntent~ fehlgeschlagen: " . mysqli_error($this->db)), 'beitrag_id' => $this->db->insert_id);
    }

    /**
    * Function to save imagepath into database table 'bilder'
    * @param $image is the imagepath from the selected picture
    * @return true or false
    */
    public function createImage($image, $beitrag_id) {
        if ($image != null) {
            $image = mysqli_real_escape_string($this->db, $image);
            $image_path = "images/".$image;
            $image_query = "INSERT INTO bilder (`id`, `pfad`, `beitraege_id`)
                    VALUES(null, '$image_path', '$beitrag_id')";
            return mysqli_query($this->db, $image_query)
                 or die("Anfrage ~image~ fehlgeschlagen: " . mysqli_error($this->db));
         }
         else {
             return false;
         }
    }

    /**
    * Function to insert beitraege_id and tag_id into the table 'beitraege_has_tags'
    * @param $tag is the name of the selected tag from the checkbox
    * @return true or false
    */
    public function addIdsToBeitraegeHasTags($tag, $beitrag_id) {
        if ($tag != null) {
            $tag = mysqli_real_escape_string($this->db, $tag);
            $tags_ids_query = $this->db->query("SELECT id FROM tags WHERE name = '$tag'");
            $tag_id = array();
            $tag_id = $tags_ids_query->fetch_assoc();
            $result_tag_id = $tag_id['id'];
            $blog_tag_query = "INSERT INTO beitraege_has_tags (`beitraege_id`, `tags_id`)
                    VALUES('$beitrag_id', '$result_tag_id')";
            return mysqli_query($this->db, $blog_tag_query)
                or die("Anfrage ~tag~ fehlgeschlagen: " . mysqli_error($this->db));
        }
        else {
            return false;
        }
    }

    /**
    * Function to get all comments and their 'beitraege_id'
    * @return associative array of all comments
    */
    public function getComments() {
        $comments_query = $this->db->query("SELECT kommentare.beitrag_id, kommentare.text, kommentare.zeit FROM kommentare");
        $comments_by_beitrag_id = array();
        while ($comment_entry = $comments_query->fetch_assoc()) {
            $beitrag_id = $comment_entry['beitrag_id'];
            $comment = array('text' => $comment_entry['text'], 'zeit' => strftime('%H:%M %d %m %Y', strtotime($comment_entry['zeit'])));
            if (!isset($comments_by_beitrag_id[$beitrag_id])) {
                $comments_by_beitrag_id[$beitrag_id] = array();
            }
            $comments_by_beitrag_id[$beitrag_id][] = $comment;
        }
        return $comments_by_beitrag_id;
    }

    /**
    * Function to get all tag names
    * @return associative array with all tag names
    */
    public function getTagNames() {
        $tags_query = $this->db->query("SELECT name FROM tags");
        $tags = array();
        while ($tag = $tags_query->fetch_assoc()) {
            $tags[] = $tag;
        }
        return $tags;
    }

    /**
    * Function to count the follower
    * @return number of follower
    */
    public function getCountFollower() {
        $follower_count_query = $this->db->query('SELECT count(*) as follower FROM Blog.follower;');
        $follower_count = $follower_count_query->fetch_assoc();
        return $follower_count;
    }

    /**
    * Function to check the Login Data
    * @param $user is the name of the admin
    * @param $pw is the password from the user
    */
    public function checkLoginData($username, $password) {
        $pw = md5(mysqli_real_escape_string($this->db, $password));
        $user = mysqli_real_escape_string($this->db, $username);

        $admin_login_query = $this->db->query("SELECT user, passwort FROM admin_login WHERE user = '$user' AND passwort = '$pw'");
        $admin_login = $admin_login_query->fetch_assoc();
        if ($admin_login != NULL) {
            return true;
        }
        else {
            return false;
        }
    }
}

?>
