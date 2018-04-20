<section class="intro" >
    <div class="introBox">
        <div class="content profil-content">
            <?php
                require_once '../repository/BildRepository.php';
                $imageRepository = new BildRepository();

                echo "<div style='margin-bottom: 5%'>";
                echo "<div class=\"imgbox-hover hover-box\">";
                $profilBild = $imageRepository->getProfilBild($_SESSION['uid']);
                echo "<img src=/{$profilBild}>";
                echo "<a href='/profil/doUpdate'><div class=\"centered\"><h3>Change Profile</h3></div>";
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
                <form action="/profil" method="post" enctype="multipart/form-data">
                    <input id="uploadImage" type="file"  name="uploadImage"/>
                    <input type="submit" id="submitUpload" name="upload"/>
                </form>
            </div>

        </div>
    </div>
</section>