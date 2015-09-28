<?php

class AjaxController extends BaseController {

    public function deleteUser($id) {
        $user = User::where('id', '=', $id)->first();
        $user->delete();
    }

    public function deleteJob($id) {
        $job = Job::where('id', '=', $id)->first();
        $job->delete();
    }

    public function getApproveApplication($id, $status) {
        $application = Application::find($id);
        $application->approve = $status;
        $application->save();
    }
}