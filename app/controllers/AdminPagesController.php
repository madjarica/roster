<?php

class AdminPagesController extends BaseController {

    public function getAdminHome() {
        return View::make('admin.home');
    }

}