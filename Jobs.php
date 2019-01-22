<?php

    use App\Models\Job;
    require_once 'vendor/autoload.php';
    $job1 = new Job("PHP Developer","Hola mundo");
  
    $job1->visible = true;
    $job1->months = 16;
    
    $jobs = [
      $job1
    ];
    
    
    function printJob($job){
      if($job->visible){
        echo '<li class="work-position">';
        echo '<h5>'.$job->getTitle().'</h5>';
        echo '<p>'.$job->description.'</p>';
        echo '<p>'.$job->getDurationAsString().'</p>';
        echo '<strong>Achievements:</strong>';
        echo '<ul>';
        echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
        echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
        echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
        echo '</ul>';
        echo '</li>';
      }
    }