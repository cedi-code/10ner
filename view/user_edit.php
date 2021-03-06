<section class="intro" >
    <div class="introBox">
        <div class="content profil-content">
            <?php
                require_once '../repository/BildRepository.php';
                echo "<div style='margin-bottom: 5%'>";
                echo "<div class=\"imgbox-hover hover-box\">";
                echo "<img src=/{$profilBild}>";
                echo "<a href='/profil/doUpdate'><div class=\"centered\"><h3>Change Profile</h3></div></a>";
                echo "</div>";
                echo "<h2>" . $_SESSION['benutzername'] . ": " . $averageRate . "</h2>";
                echo "</div>";
                echo "<h3>Bilder von ". $_SESSION['benutzername'] . "</h3>";
            ?>
            <div class="profil-image-table">
                <?php
                while($bild = $bilder->fetch_object())
                {
                    echo "<div class='card imgbox-hover'>
                        <img src='/{$bild->pfad}'/><a href='/profil/deleteImage?bild_id={$bild->ID_Bild}'><div class='centered lead'><span class='glyphicon glyphicon-trash'></span></div></a>
                        </div>";
                }
                ?>
                <label for="uploadImage">
                    <div  class="card homeBackground";>
                        <div class="center-plus">&#43;</div>

                    </div>
                </label>
                <form action="/profil" method="post" enctype="multipart/form-data">
                    <input id="uploadImage" type="file"  name="uploadImage"/>
                    <input type="submit" id="submitUpload" name="upload"/>
                </form>
            </div>

        </div>
    </div>
</section>