<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * @return Factory|View
     */

    public function index(): view
    {
        $pages = [
            [
                'title' => 'O компании',
                'alias' => 'About'
            ],
            [
                'title' => 'Советы',
                'alias' => 'advices'
            ],
            [
                'title' => 'Услуги',
                'alias' => 'Services'
            ],
            [
                'title' => 'Контакты',
                'alias' => 'Contacts'
            ],

        ];
        return view('home', compact('pages'));
    }

}
