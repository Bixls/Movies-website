<?php

class MovieAdapter
{

public function getData() {

  $title= urlencode($_POST['title']);
  $season=$_POST['season'];
  $episode=$_POST['episode'];
  $json = file_get_contents('http://www.omdbapi.com/?t='.$title.'&Season='.$season.'&Episode='.$episode);
  $data = json_decode($json,true);
  return data;
}

private function CreateMovie() {

  $movie = new Movie();
  $data = array();
  $data['title']=$_POST['title'];
  $data['poster']=$_POST['poster'];
  $data['rating']=$_POST['rating'];
  $data['description']=$_POST['description'];
  $data['genre']=$_POST['genre'];
  $data['type']=$_POST['type'];
  $data['release_time']=$_POST['release_time'];
  $data['run_time']=$_POST['run_time'];
  $data['keyword']=$_POST['keyword'];
  $data['big_picture']=$_POST['big_picture'];
  if (!empty($_POST['parent']))
  {
  $sql = mysql_query("SELECT * FROM Movies WHERE title LIKE '%".$_POST['parent']."%'");
  $result = mysql_fetch_assoc($sql);
  $data['parent_id']=$result['id'];
  }
  else {
  $data['parent_id']=0;
  }
  $movie->setMovie($data);
  return $movie; 
}

private function CreateActor($i) {

  $actor = new Actor();
  $data = array();
  $data['title']=$_POST['title'.$i];
  $data['name']=$_POST['name'.$i];
  $data['role']=$_POST['role'.$i];
  $data['picture']=$_POST['picture'.$i];
  $sql = mysql_query("SELECT * FROM Movies WHERE title LIKE '%".$_POST['title']."%'");
  $result = mysql_fetch_assoc($sql);
  $data['movie_id']=$result['id'];
  $actor->setActor($data);
  return $actor; 

}

private function updateMovie($movie) {

  $data=$movie->getMovie();
  $sql = "INSERT INTO Movies (title,poster,rating,description,genre,type,release_time,run_time,keyword,big_picture,parent_id) 
  VALUES ('".$data['title']."', '".$data['poster']."', '".$data['rating']."','".$data['description']."','".$data['genre']."','".$data['type']."','".$data['release_time']."','".$data['run_time']."','".$data['keyword']."','".$data['big_picture']."','".$data['parent_id']."')";
    $query = mysql_query($sql);
    if(!$query)
    {
      echo"fail";
    }

}

private function updateActor($actor) {

  $data=$actor->getActor();
  $sql = "INSERT INTO Actors (title,name,role,picture,movie_id)
  VALUES ('".$data['title']."', '".$data['name']."', '".$data['role']."','".$data['picture']."','".$data['movie_id']."')";
    $query = mysql_query($sql);
    if(!$query)
    {
      echo"fail";
    }

}

public function Create()
{
  $movie = new Movie();
  $actor = new Actor();
  $data = array();
  $movie=$this->CreateMovie();
  $this->updateMovie($movie);
  for($i=1;$i<=10;$i++)
  {
    $actor=$this->CreateActor($i);
    $data=$actor->getActor();
    if ($data['title']=="")
      {break;}
    $this->updateActor($actor);
  }

}

}

?>