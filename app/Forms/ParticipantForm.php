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
                'rules' => 'required|max:2000|image|mimes:jpeg,jpg,png|dimensions:min_width=150,min_height=200,max_width=3000,max_height=4000', 'label'=>'Jouw foto (max. 2MB, min. 150x200, max. 3000x4000)', 'errors' => ['class' => 'text-danger']
            ])
            ->add('submit', 'submit', [
                'label' => 'Verzenden!', 'attr' => ['class' => 'btn btn-lg btn-default btn-block text-uppercase'], 'errors' => ['class' => 'text-danger']
            ]);
    }
}
