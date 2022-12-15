<?php

include_once 'kural.php';

# Thou a beautiful poem π , just at look - tiggers 
# hot love, you never change great constant ! 
$மாதிரி = " கவிதை நீ ஆகிறாய் பை, கண்டதும்         
            காதல்தூண்டிவிடும் மாறா மாறிலிநீயடி";
$பாடல் = new பாடல்($மாதிரி);
$பாடல்->பாடல்_பையமா();

$குறள்கள் = file('குறள்.txt');       
foreach($குறள்கள் as $குறள் ){
    $பாடல் = new பாடல்($குறள்);
    $பாடல்->பாடல்_பையமா();
}

?>

<hr>
<form action="" method="POST">
  <h1>குறள் தேடல்</h1> 
  <label for="name">வார்த்தை(1 to 24 characters):</label>

  <input type="text" id="name" name="தேடல்" required
        minlength="1" maxlength="24" size="16"></input>
  <input type="submit" value="Search குறள்"></input>
  <style>
      label {
          display: block;
          font: 1rem 'Fira Sans', sans-serif;
      }
      input,
      label {
          margin: .4rem 0;
      }
  </style>
</form>