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

