<section class="intro" >
    <div class="introBox">
        <div class="content colorMainBlue">
        <h2>Benutzer bearbeiten</h2>
        <?php
            $form = new Form('/profil/doUpdate', 'POST',  'multipart/form-data');

            echo $form->text()->label('neuer Benutzername')->name('benutzername');
            echo $form->passwort()->label('neues Passwort')->name('passwort');
            echo $form->file()->label('neues Profilbild')->name('updateBild');
            
            foreach($this->errors as $error) {
                echo '<div class="alert alert-danger">'
                 . $error .
            '</div>';
            }
            echo $form->submit()->label('bestätigen')->name('updateUser');
            echo "Funktioniert leider noch nicht alles :(";
            $form->end();
        ?>
        </div>
    </div>
</section>