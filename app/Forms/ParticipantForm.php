<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ParticipantForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'rules' => 'required|max:100|min:2|string', 'label'=>'Naam', 'errors' => ['class' => 'text-danger']
            ])
            ->add('address', 'text', [
                'rules' => 'required|max:100|min:2|string', 'label'=>'Adres', 'errors' => ['class' => 'text-danger']
            ])
            ->add('city', 'text', [
                'rules' => 'required|max:100|min:2|string', 'label'=>'Woonplaats', 'errors' => ['class' => 'text-danger']
            ])
            ->add('email', 'email', [
                'rules' => 'required|max:100|min:5|email|unique:participants,email|string', 'label'=>'E-mailadres', 'errors' => ['class' => 'text-danger']
            ])
            ->add('image', 'file', [
                'rules' => 'required|max:5000|image|mimes:jpeg,jpg,png|dimensions:min_width=100,min_height=200', 'label'=>'Jouw foto (max. 5MB, min. 100x200)', 'errors' => ['class' => 'text-danger']
            ])
            ->add('submit', 'submit', [
                'label' => 'Verzenden!', 'attr' => ['class' => 'btn btn-lg btn-default btn-block text-uppercase'], 'errors' => ['class' => 'text-danger']
            ]);
    }
}
