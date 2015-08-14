<?php

class Movie {

    private $title;
    private $poster;
    private $rating;
    private $description;
    private $genre;
    private $type;
    private $release_time;
    private $run_time;
    private $keyword;
    private $big_picture;
    private $parent_id;

    public function create($id) {
        $sql = mysql_query("SELECT * FROM Movies WHERE id LIKE '%".$id."%'") or die (mysql_error());
        $query = mysql_query($sql);
        $this->id=$id;
        if ($query){
            $data = mysql_fetch_array($query);
            $this->setMovie($data);
        }
    }

    public function setMovie (array $data = array()) {

        $this->title=$data['title'];
        $this->poster=$data['poster'];
        $this->rating=$data['rating'];
        $this->description=$data['description'];
        $this->genre=$data['genre'];
        $this->type=$data['type'];
        $this->release_time=$data['release_time'];
        $this->run_time=$data['run_time'];
        $this->keyword=$data['keyword'];
        $this->big_picture=$data['big_picture'];
        $this->parent_id=$data['parent_id'];
        
    }

    public function getMovie() {
        $data = array();

        $data['title']=$this->title;
        $data['poster']=$this->poster;
        $data['rating']=$this->rating;
        $data['description']=$this->description;
        $data['genre']=$this->genre;
        $data['type']=$this->type;
        $data['release_time']=$this->release_time;
        $data['run_time']=$this->run_time;
        $data['keyword']=$this->keyword;
        $data['big_picture']=$this->big_picture;
        $data['parent_id']=$this->parent_id;
        return $data;
    }

}

?>