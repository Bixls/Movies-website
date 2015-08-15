<?php

class MovieAdapter
{

private function getAPI() {

  $title= urlencode($_POST['title']);
  $season=$_POST['season'];
  $episode=$_POST['episode'];
  $json = file_get_contents('http://www.omdbapi.com/?t='.$title.'&Season='.$season.'&Episode='.$episode);
  $data = json_decode($json,true);
  return data;
}

public function getData() {

  $api_data = array();

  $api_data = $this->getAPI();

  $data['title']=$api_data['Title'];
  $data['poster']=$api_data['Poster'];
  $data['rating']=$api_data['imdbRating'];
  $data['description']=$api_data['Plot'];
  $data['genre']=$api_data['Genre'];
  $data['type']=$api_data['Type'];
  $data['year']=$api_data['Year'];
  $data['release_time']=$api_data['Released'];
  $data['run_time']=$api_data['Runtime'];
  $actors=$api_data['Actors'];
  $x;
  $i=0;
  while(1) {

    $x=strpos($actors, ",");
    if ($pos === false) {
      $data['actors'][$i]=substr($actors,0);
    }
    else {
    $data['actors'][$i]=substr($actors,0,$x+1);
    $actors=substr($actors,$x+1);
    $i++;
    }

  }

return $data;

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
  $data['year']=$_POST['year'];
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
  $sql = "INSERT INTO Movies (title,poster,rating,description,genre,type,year,release_time,run_time,keyword,big_picture,parent_id) 
  VALUES ('".$data['title']."', '".$data['poster']."', '".$data['rating']."','".$data['description']."','".$data['genre']."','".$data['type']."','".$data['year']."','".$data['release_time']."','".$data['run_time']."','".$data['keyword']."','".$data['big_picture']."','".$data['parent_id']."')";
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

private function editMovie($movie) {

  $data=$movie->getMovie();
  $query = mysql_query("UPDATE Movies SET title='".$_POST['title']."', poster='".$_POST['poster']."' , rating='".$_POST['rating']."' , description='".$_POST['description']."' , genre='".$_POST['genre']."' , type='".$_POST['type']."' , year='".$_POST['year']."' , release_time='".$_POST['release_time']."', run_time='".$_POST['run_time']."' , keyword='".$_POST['keyword']."' , big_picture='".$_POST['big_picture']."' , parent_id='".$_POST['parent_id']."' WHERE id='".$_POST['id']."'") or die (mysql_error());
    if(!$query)
    {
      echo"fail";
    }

}

private function editActor($movie) {

  $data=$movie->getMovie();
  $query = mysql_query("UPDATE Actors SET title='".$_POST['title']."' , name='".$_POST['name']."' , role='".$_POST['role']."' , picture='".$_POST['picture']."' , movie_id='".$_POST['movie_id']."' WHERE id='".$_POST['id']."'") or die (mysql_error());
    if(!$query)
    {
      echo"fail";
    }

}

public function edit() {

  $movie = new Movie();
  $actor = new Actor();
  $data = array();
  $movie=$this->CreateMovie();
  $this->editMovie($movie);
  for($i=1;$i<=10;$i++)
  {
    $actor=$this->CreateActor($i);
    $data=$actor->getActor();
    if ($data['title']=="")
      {break;}
    $this->editActor($actor);
  }

}

public function search($title) {

  $sql = mysql_query("SELECT * FROM Movies ORDER BY year DESC WHERE title LIKE '%".$title."%'");

  $result = mysql_fetch_assoc($sql);

  return $result;

}

public function remove() {
  $id=$_POST['id'];
  $query = mysql_query("DELETE FROM Movies WHERE id = ".$id);
  $sql = mysql_query("DELETE FROM Actors WHERE movie_id = ".$id);

  if ($query) {
    //sucess
    echo "success";
  }else {
    //throw an error (failed to delete)
    echo "fail";
  }
}

public function viewMovies($i) {

  $sql = mysql_query("SELECT * FROM Movies ORDER BY year DESC LIMIT ".$i);

  $result = mysql_fetch_assoc($sql);

  return $result;

}



}

?>