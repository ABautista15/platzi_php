<?php
    namespace App\Controllers;
    use App\Models\Job;

    class JobsController extends BaseController {
        public function addJobAction($request){

            if($request->getMethod() == 'POST'){
                $postData = $request->getParsedBody();
                $job = new Job();
                $job->title = $postData['title'];
                $job->description = $postData['description'];
                $job->visible = 1;
                $job->months = 2;
                $job->save();
            }

            return $this->renderHTML('addJob.twig');
        }
    }