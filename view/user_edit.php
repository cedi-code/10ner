<section class="intro" >
    <div class="introBox">
        <div class="content profil-content">
            <?php
                echo "<div style='margin-bottom: 5%'>";
                echo "<div class=\"imgbox-hover hover-box\">";
                echo "<img src=\"/images/camille.jpg\"/>";
                echo "<div class=\"centered\"><h3>Change Profile</h3></div>";
                echo "</div>";
                echo "<h2>" . $_SESSION['benutzername'] . "</h2>";
                echo "</div>";
                echo "<h3>Bilder von ". $_SESSION['benutzername'] . "</h3>";
            ?>
            <div class="profil-image-table">
                <div class="card imgbox-hover">
                    <img src="/images/cute_pomeranian_dog.jpg"/>
                    <div class="centered lead"><span class="glyphicon glyphicon-trash"></span></div>
                    <p>Rating : 10</p>
                </div>

                <div class="card homeBackground" onclick="location.href='/default'";>
                    <div class="center-plus">&#43;<br/></div>
                </div>
            </div>

        </div>
    </div>
</section>