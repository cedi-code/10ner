<?php

$form = new Form('/benutzer/doCreate');

echo $form->text()->label('Benutzername')->name('benutzername');
echo $form->text()->label('Email')->name('email');
echo $form->text()->label('Passwort')->name('passwort');
// echo $form->password()->label('Password')->name('password');
echo $form->submit()->label('Benutzer erstellen')->name('send');

$form->end();
