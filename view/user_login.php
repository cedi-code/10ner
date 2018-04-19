<section class="intro" >
    <div class="introBox">
        <div class="content colorMainBlue">
            <h2 c>Login</h2>
            <?php
            $form = new Form('/login');

            echo $form->email()->label('Email')->name('email');
            echo $form->passwort()->label('Passwort')->name('passwort');
            
            foreach($this->errors as $error) {
                echo '<div class="alert alert-danger">'
                 . $error .
            '</div>';
            }

            echo $form->submit()->label('Login')->name('send');

            $form->end();

            ?>
            <span class="float-md-right "><a href="/benutzer/index">Register now!</a></span>
        </div>

    </div>
</section>