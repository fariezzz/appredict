<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('main-page.about', [
            'title' => 'Tentang Kami',
            'profiles' => [
                [
                    'photo' => 'images/fariez.jpg',
                    'name' => 'Muhammad Fariez Riziq Ilham',
                    'nim' => '247006111146',
                    'institution' => 'Universitas Siliwangi',
                ],
                [
                    'photo' => 'images/raya.jpg',
                    'name' => 'Moh Raya Alfareza Alban',
                    'nim' => '247006111133',
                    'institution' => 'Universitas Siliwangi',
                ],
                [
                    'photo' => 'images/fathir.jpg',
                    'name' => 'Fathir Rizki Fadillah',
                    'nim' => '247006111129',
                    'institution' => 'Universitas Siliwangi',
                ],
                [
                    'photo' => 'images/dwiki.jpg',
                    'name' => 'Dwiki Muhammad Wasfi',
                    'nim' => '247006111136',
                    'institution' => 'Universitas Siliwangi',
                ],
                [
                    'photo' => 'images/andhara.jpg',
                    'name' => 'Andhara Febry Pitriana',
                    'nim' => '247006111144',
                    'institution' => 'Universitas Siliwangi',
                ],
            ],
        ]);
    }
}