<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Participant;

class PageController extends Controller
{
    public function index(Request $request)
    {
        return view('index');
    }

    public function dashboard(Request $request)
    {
        return view('dashboard');
    }

    public function winners(Request $request)
    {
        return view('winners');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('index');
    }

    public function home(Request $request)
    {
        return redirect()->route('index');
    }

    public function participate(FormBuilder $formBuilder, Request $request)
    {
        $form = $formBuilder->create(\App\Forms\ParticipantForm::class, [
            'method' => 'POST',
            'url' => route('store_participant')
        ]);

        return view('participate', compact('form'));
    }

    public function store_participant(FormBuilder $formBuilder, Request $request)
    {
        $form = $formBuilder->create(\App\Forms\ParticipantForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $participant = new Participant();
        $participant->name = $request->input('name');
        $participant->address = $request->input('address');
        $participant->city = $request->input('city');
        $participant->email = $request->input('email');
        $path = $request->file('image')->store('public/uploads');
        $participant->image_path = $path;
        $participant->ip = $request->ip();
        $participant->votes = 0;

        $participant->save();

        return redirect()->route('index');
    }
}
