<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Session::has('token')) {
            return redirect()->intended('dashboard');
        } else {
            try {
                $client = new Client();
                $response = $client->request('POST', 'https://reqres.in/api/login', [
                    'form_params' => [
                        'email' => $request->input('email'),
                        'password' => $request->input('password')
                    ]
                ]);
                $body = json_decode($response->getBody(), true);

                if (isset($body['token'])) {
                    // Usuario (12) / rachel.howell@reqres.in
                    if ($request->input('email') == "rachel.howell@reqres.in")
                        Session::put('esadm', true);
                    else
                        Session::put('esadm', false);
                    Session::put('token', $body['token']);
                    return redirect()->intended('home');
                } else {
                    return back()->withErrors(['error' => $body['error']]);
                }
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                $response = $e->getResponse();
                $body = json_decode($response->getBody(), true);
                return back()->withErrors(['error' => $body['error']]);
            }
        }
    }

    public function logout()
    {
        Session::forget('token');
        Session::forget('esadm');
        return redirect()->route('login');
    }

    public function listausuarios($page = 1)
    {
        $response = Http::get('https://reqres.in/api/users', [
            'page' => $page,
        ]);
        $data = $response->json();
        $usuarios = $data['data'];
        $totalusuarios = $data['total'];
        $totalPages = $data['total_pages'];
        $currentPage = $data['page'];
        return Inertia::render('Usuarios', [
            'users' => $usuarios,
            'totalusuarios' => $totalusuarios,
            'totalPages' => $totalPages,
            'currentPage' => $currentPage,
            "esadm" => Session::get('esadm')
        ]);
    }
}
