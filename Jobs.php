<?php
    require_once 'vendor/autoload.php';
    use App\Models\Job;
    
    $jobs = Job::all();
  
    
    function printJob($job){
      
        echo '<li class="work-position">';
        echo '<h5>'.$job->title.'</h5>';
        echo '<p>'.$job->description.'</p>';
        
        echo '<strong>Achievements:</strong>';
        echo '<ul>';
        echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
        echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
        echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
        echo '</ul>';
        echo '</li>';
      
    }