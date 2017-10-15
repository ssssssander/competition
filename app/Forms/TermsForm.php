<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class TermsForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('start1', 'datetime-local', [
                'rules' => 'required|date', 'label'=>'Start periode 1', 'errors' => ['class' => 'text-danger']
            ])
            ->add('end1', 'datetime-local', [
                'rules' => 'required|date', 'label'=>'Einde periode 1', 'errors' => ['class' => 'text-danger']
            ])
            ->add('start2', 'datetime-local', [
                'rules' => 'required|date', 'label'=>'Start periode 2', 'errors' => ['class' => 'text-danger']
            ])
            ->add('end2', 'datetime-local', [
                'rules' => 'required|date', 'label'=>'Einde periode 2', 'errors' => ['class' => 'text-danger']
            ])
            ->add('start3', 'datetime-local', [
                'rules' => 'required|date', 'label'=>'Start periode 3', 'errors' => ['class' => 'text-danger']
            ])
            ->add('end3', 'datetime-local', [
                'rules' => 'required|date', 'label'=>'Einde periode 3', 'errors' => ['class' => 'text-danger']
            ])
            ->add('start4', 'datetime-local', [
                'rules' => 'required|date', 'label'=>'Start periode 4', 'errors' => ['class' => 'text-danger']
            ])
            ->add('end4', 'datetime-local', [
                'rules' => 'required|date', 'label'=>'Einde periode 4', 'errors' => ['class' => 'text-danger']
            ])
            ->add('submit', 'submit', [
                'label' => 'Wijzigen', 'attr' => ['class' => 'btn btn-lg btn-default btn-block text-uppercase'], 'errors' => ['class' => 'text-danger']
            ]);
    }
}
