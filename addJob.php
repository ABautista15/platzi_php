<?php
    
    use App\Models\Job;
    if(!empty($_POST)){
        $job = new Job();
        $job->title = $_POST['title'];
        $job->description = $_POST['description'];
        $job->visible = 1;
        $job->months = 2;
        $job->save();
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Job</title>
</head>
<body>
    <h1>Add Job</h1>
    <form action="addJob.php" method="POST">
        <label for="">Title</label>
        <input type="text" name="title">

        <label for="">Description</label>
        <input type="text" name="description">

        <button type="submit">Save</button>
        
    </form>
</body>
</html>