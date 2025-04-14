<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PingController extends Controller
{
    public function ping()
    {
        $message = 'Pong';
        $title = 'Ping';
        $description = 'This is a ping page';
        return view('ping', [
            'message' => $message,
            'title' => $title,
            'description' => $description
        ]);
    }
}