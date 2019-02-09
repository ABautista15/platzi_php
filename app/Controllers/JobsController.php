<?php
    namespace App\Controllers;
    use App\Models\Job;
    use Respect\Validation\Validator as v;

    class JobsController extends BaseController {
        public function addJobAction($request){
            $responseMessage = '';
            if($request->getMethod() == 'POST'){
                $postData = $request->getParsedBody();
                $jobValidator = v::key('title', v::stringType()->notEmpty())
                  ->key('description', v::stringType()->notEmpty());

                 // true
                try {
                    $jobValidator->assert($postData);
                    $job = new Job();
                    $job->title = $postData['title'];
                    $job->description = $postData['description'];
                    $job->visible = 1;
                    $job->months = 2;
                    $job->save();

                    $responseMessage = 'Saved';
                } catch (\Exception $e) {
                    $responseMessage = $e->getMessage();
                }
                
            }

            return $this->renderHTML('addJob.twig',[
                'responseMessage' => $responseMessage,
            ]);
        }
    }