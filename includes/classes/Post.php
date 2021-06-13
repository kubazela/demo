<?php
class Post {
    private $user_obj;
    private $con;

    public function __construct($con, $user){
        $this->con = $con;
        $this->user_obj = new User($con, $user);
    }

    public function submitPost($body, $user_to){
        $body = strip_tags($body);    //Odstraní HTML tagy
        $body = mysqli_real_escape_string($this->con, $body);     //Escapuje speciální znaky v řetězci pro použití v příkazu SQL

        $body = str_replace('\r\n', '\n',$body);     //Předělá \r\n na \n
        $body = nl2br($body);       //nl2br = new line to line break = všechny \n předělá na <br>

        $check_empty = preg_replace('/\s+/', "", $body);    //Smaže mezery

        if($check_empty !=""){      //Pokud není příspěvek prázdný, postni

            //Aktuální čas
            $date_added = date("Y-m-d H:i:s");

            //Get username
            $added_by = $this->user_obj->getUsername();

            //Pokud uživatel není na vlastním profilu, user_to je 'none'
            if($user_to == $added_by){
                $user_to = "none";
            }

            //Vlož příspěvek
            $query = mysqli_query($this->con, "INSERT INTO posts VALUES('', '$body', '$added_by', '$user_to', '$date_added', 'no', 'no', '0')");
            $returned_id = mysqli_insert_id($this->con);

            //Vlož notifikaci

            //Updatni post cound pro uživatele
            $num_posts = $this->user_obj->getNumPosts();
            $num_posts++;
            $update_query = mysqli_query($this->con, "UPDATE users SET num_posts='$num_posts' WHERE username='$added_by' ");
        }
    }
}
?>