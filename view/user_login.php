<section class="intro" >
    <div class="introBox">
        <div class="content colorMainBlue">
            <h2 c>Login</h2>
            <?php
            $form = new Form('/login/doCreate');

            echo $form->text()->label('Email')->name('email');
            echo $form->text()->label('Passwort')->name('passwort');
            // echo $form->password()->label('Password')->name('password');
            echo $form->submit()->label('Login')->name('send');

            $form->end();

            ?>
            <span class="float-md-right "><a href="/benutzer">Register now!</a></span>
        </div>

    </div>
</section>