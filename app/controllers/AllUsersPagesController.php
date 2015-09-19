<?php

class AllUsersPagesController extends BaseController {

    public function getHome() {
        return View::make('hello');
    }

}