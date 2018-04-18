<section class="intro" >
    <div class="introBox">
        <div class="content colorMainBlue">
        <h2>Register</h2>
		<?php
			$form = new Form('/benutzer/doCreate');

			echo $form->text()->label('Benutzername')->name('benutzername');
			echo $form->text()->label('Email')->name('email');
			echo $form->password()->label('Passwort')->name('passwort');

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