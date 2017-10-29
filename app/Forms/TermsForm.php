<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Illuminate\Support\Facades\Storage;
use App\Term;

class TermsForm extends Form
{
    public function buildForm()
    {
        $this->add('term_interval', 'select', [
            'choices' => [
                'daily' => 'Dagelijks',
                'weekly' => 'Wekelijks',
                'monthly' => 'Maandelijks',
                'quarterly' => 'Driemaandelijks',
                'yearly' => 'Jaarlijks'
            ],
            'rules' => 'required|in:daily,weekly,monthly,quarterly,yearly',
            'selected' => Storage::get(config('globals.term_interval_filename')),
            'label' => 'Periode-interval',
            'errors' => ['class' => 'text-danger']
        ])
        ->add('term_amount', 'number', [
            'rules' => 'required|min:1|numeric',
            'label' => 'Aantal perioden',
            'value' => Term::count(),
            'errors' => ['class' => 'text-danger']
        ])
        ->add('submit', 'submit', [
            'label' => 'Wijzigen',
            'attr' => ['class' => 'btn btn-lg btn-default btn-block text-uppercase'],
            'errors' => ['class' => 'text-danger']
        ]);

        // $this
        //     ->add('start1', 'datetime-local', [
        //         'rules' => 'required|date', 'label'=>'Start periode 1', 'errors' => ['class' => 'text-danger'], 'attr' => ['class' => 'form-control start']
        //     ])
        //     ->add('end1', 'datetime-local', [
        //         'rules' => 'required|date', 'label'=>'Einde periode 1', 'errors' => ['class' => 'text-danger'], 'attr' => ['class' => 'form-control end']
        //     ])
        //     ->add('start2', 'datetime-local', [
        //         'rules' => 'required|date', 'label'=>'Start periode 2', 'errors' => ['class' => 'text-danger'], 'attr' => ['class' => 'form-control start']
        //     ])
        //     ->add('end2', 'datetime-local', [
        //         'rules' => 'required|date', 'label'=>'Einde periode 2', 'errors' => ['class' => 'text-danger'], 'attr' => ['class' => 'form-control end']
        //     ])
        //     ->add('start3', 'datetime-local', [
        //         'rules' => 'required|date', 'label'=>'Start periode 3', 'errors' => ['class' => 'text-danger'], 'attr' => ['class' => 'form-control start']
        //     ])
        //     ->add('end3', 'datetime-local', [
        //         'rules' => 'required|date', 'label'=>'Einde periode 3', 'errors' => ['class' => 'text-danger'], 'attr' => ['class' => 'form-control end']
        //     ])
        //     ->add('start4', 'datetime-local', [
        //         'rules' => 'required|date', 'label'=>'Start periode 4', 'errors' => ['class' => 'text-danger'], 'attr' => ['class' => 'form-control start']
        //     ])
        //     ->add('end4', 'datetime-local', [
        //         'rules' => 'required|date', 'label'=>'Einde periode 4', 'errors' => ['class' => 'text-danger'], 'attr' => ['class' => 'form-control end']
        //     ])
        //     ->add('submit', 'submit', [
        //         'label' => 'Wijzigen', 'attr' => ['class' => 'btn btn-lg btn-default btn-block text-uppercase'], 'errors' => ['class' => 'text-danger']
        //     ]);
    }
}
