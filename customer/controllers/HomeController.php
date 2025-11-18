<?php

namespace Customer\Controllers;

use Core\Components\Controller;

class HomeController extends Controller
{
    public function actionIndex(): void
    {
        $this->render('customer/views/home/index.php', [
            'title' => 'Welcome to Aunt Joy Restaurant',
        ]);
    }
}
