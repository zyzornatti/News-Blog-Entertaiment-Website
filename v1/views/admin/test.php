<?php
if(isset ($_POST['submit'])){
  // $text = cleans($_POST['title']);
  // $text = rand(1000, 9999).time();
  // $uh = $conn->prepare("UPDATE web_content SET author_id=:uh WHERE web_content_id=:uid");
  // $uh->bindParam(":uh", $text);
  // $uh->bindParam(":uid", $id);
  // $uh->execute();
  echo $text;
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form class="" action="" method="post">
      <input type="text" name="title" value=""><br/>
      <input type="submit" name="submit" value="submit">
    </form>
  </body>
</html>
