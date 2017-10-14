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

    public function home(Request $request)
    {
        return redirect()->route('index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('index');
    }

    public function dashboard(Request $request)
    {
        $participants = Participant::all();
        $participantsCount = Participant::all()->count();

        return view('dashboard', compact('participants', 'participantsCount'));
    }

    public function vote_page(Request $request)
    {
        $participants = Participant::all();

        return view('vote_page', compact('participants'));
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

        $request->session()->put('store_participant_success', 'Je deelname is bevestigd!');

        return redirect()->back();
    }

    public function delete_participant(Participant $participant, Request $request) {
        $participant->delete();

        return redirect()->back()->with('delete_participant_success', "Deelnemer <strong>{$participant->name}</strong> verwijderd");
    }
}
