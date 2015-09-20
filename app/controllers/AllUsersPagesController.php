<?php

class AllUsersPagesController extends BaseController {

    public function getHome() {
        $jobs = Job::paginate(5);
        $highlighted = Job::where('highlighted', 1)->get();
        return View::make('all.index')
            ->with('jobs', $jobs)
            ->with('highlighted', $highlighted);
    }

    public function getViewJob($id) {
        $jobs = Job::where('id', $id)->get();
        $highlighted = Job::where('highlighted', 1)->get();
        return View::make('all.jobs.view-job')
            ->with('jobs', $jobs)
            ->with('highlighted', $highlighted);
    }

    public function getViewJobs($category) {
        $jobs = Job::where('job_type', $category)->paginate(10);
        $highlighted = Job::where('highlighted', 1)->get();
        return View::make('all.jobs.view-jobs')
            ->with('jobs', $jobs)
            ->with('category', $category)
            ->with('highlighted', $highlighted);
    }

    public function getApplyJob($id) {
        $jobs = Job::where('id', $id)->get();
        $highlighted = Job::where('highlighted', 1)->get();
        return View::make('all.jobs.apply-job')
            ->with('jobs', $jobs)
            ->with('highlighted', $highlighted);
    }

}