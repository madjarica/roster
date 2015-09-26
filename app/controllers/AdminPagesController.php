<?php

class AdminPagesController extends BaseController {

    public function getAdminHome() {
        return View::make('admin.home');
    }

    public function getLogin() {
        return View::make('admin.login');
    }

}