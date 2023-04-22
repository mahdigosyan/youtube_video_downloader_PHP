<?php

include "./scripts/GetVideoInfo.php";
$isvalid = "";
$isVideoIdValid = "";

if (isset($_POST['submit'])) {
  $video_link = $_POST['video_url'];
  if ($video_link != "") {
    $isVideoIdValid = preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_link, $match);
    if ($isVideoIdValid == "1") {
      $video_id =  $match[1];

