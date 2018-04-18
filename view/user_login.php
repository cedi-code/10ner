<section class="intro" >
    <div class="introBox">
        <div class="content colorMainBlue">
            <h2 c>Login</h2>
            <?php
            $form = new Form('/login/checkLogin');

            echo $form->text()->label('Email')->name('email');
            echo $form->text()->label('Passwort')->name('passwort');
            // echo $form->password()->label('Passwor2d')->name('password2');
            echo $form->submit()->label('Login')->name('send');

            $form->end();

            ?>
            <span class="float-md-right "><a href="/benutzer/index">Register now!</a></span>
        </div>

    </div>
</section>