<section class="intro" >
    <div class="introBox">
        <div class="content colorMainBlue">
        <h2>Benutzer bearbeiten</h2>
        <?php
            $form = new Form('/profil/update', 'POST',  'multipart/form-data');

            echo $form->text()->label('neuer Benutzername')->name('benutzername');
            echo $form->passwort()->label('neues Passwort')->name('passwort');
            echo $form->file()->label('neues Profilbild')->name('profilbild');
            
            foreach($this->errors as $error) {
                echo '<div class="alert alert-danger">'
                 . $error .
            '</div>';
            }
            echo $form->submit()->label('bestätigen')->name('updateUser');

            $form->end();
        ?>
        </div>
    </div>
</section>