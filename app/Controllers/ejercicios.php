<?php

namespace App\Controllers;

class Exercises extends BaseControllers{
    public function index(): string
    {
        return view('exercises');
    }
}