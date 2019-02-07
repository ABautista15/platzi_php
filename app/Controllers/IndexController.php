<?php
namespace App\Controllers;

use App\Models\Job;

class IndexController extends BaseController{
    public function indexAction(){
        $jobs = Job::all();

        $name = 'Adrian Bautista Orozco';
        $limitMonths = 2000;
        return $this->renderHTML('index.twig',[
            'name' => $name,
            'jobs' => $jobs
        ]);
    }
}