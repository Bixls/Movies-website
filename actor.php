<?php

class Actor {

    private $title;
    private $name;
    private $role;
    private $picture;
    private $movie_id;

    public function create($id) {
        $sql = mysql_query("SELECT * FROM Actors WHERE id LIKE '%".$id."%'") or die (mysql_error());
        $query = mysql_query($sql);
        $this->id=$id;
        if ($query){
            $data = mysql_fetch_array($query);
            $this->setActor($data);
        }
    }

    public function setActor (array $data = array()) {

        $this->title=$data['title'];
        $this->name=$data['name'];
        $this->role=$data['role'];
        $this->picture=$data['picture'];
        $this->movie_id=$data['movie_id'];
              
    }

    public function getActor() {
        $data = array();
        $data['title']=$this->title;
        $data['name']=$this->name;
        $data['role']=$this->role;
        $data['picture']=$this->picture;
        $data['movie_id']=$this->movie_id;
        return $data;
    }

}

?>