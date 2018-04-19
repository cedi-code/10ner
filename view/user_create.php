<section class="intro" >
    <div class="introBox">
        <div class="content colorMainBlue">
        <h2>Register</h2>
		<?php
			$form = new Form('/benutzer/doCreate', 'POST',  'multipart/form-data');

			echo $form->text()->label('Benutzername')->name('benutzername');
			echo $form->email()->label('Email')->name('email');
			echo $form->passwort()->label('Passwort')->name('passwort');
			echo $form->file()->label('Profilbild')->name('profilbild');
			
			foreach($this->errors as $error) {
				echo '<div class="alert alert-danger">'
 				 . $error .
			'</div>';
			}
			echo $form->submit()->label('Benutzer erstellen')->name('sendUser');

			$form->end();
		?>
        </div>
    </div>
</section>