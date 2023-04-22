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

      // getting video information
      $video = json_decode(GetVideoInfo($video_id));
      $isvalid = $video->playabilityStatus->status;

      $formats = $video->streamingData->formats;
      $thumbnails = $video->videoDetails->thumbnail->thumbnails;
      $title = $video->videoDetails->title;
      $short_description = $video->videoDetails->shortDescription;
      $channel_id = $video->videoDetails->channelId;
      $channel_name = $video->videoDetails->author;
      $views = $video->videoDetails->viewCount;
      $video_duration_in_seconds = $video->videoDetails->lengthSeconds;
      $thumbnail = end($thumbnails)->url;

      // seconds to minutes&hours
      $hours = floor($video_duration_in_seconds / 3600);
      $minutes = floor(($video_duration_in_seconds / 60) % 60);
      $seconds = $video_duration_in_seconds % 60;
    }
  }
}

?>

