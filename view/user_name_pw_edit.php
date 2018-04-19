<section class="intro" >
    <div class="introBox">
        <div class="content profil-content">
            <?php
                echo "<div style='margin-bottom: 5%'>";
                echo "<div class=\"imgbox-hover hover-box\">";
                echo "<img src=\"/images/camille.jpg\"/>";
                echo "<div class=\"centered\" onclick=\"location.href='profil/edit';\"><h3>Change Profile</h3></div>";
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
                <label for="uploadImage">
                    <div  class="card homeBackground";>
                        <div class="center-plus">&#43;</div>

                    </div>
                </label>
                <input id="uploadImage" type="file"/>
            </div>

        </div>
    </div>
</section>