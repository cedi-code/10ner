<section class="intro homeBackground" >
    <div class="introBox">
        <div class="contentRate">


            <?php

                if($gleich) {
                    echo "Diese Bild haben sie schon Bewertet.";
                }else {
                    echo "<div class=\"rateImage\" style=\"background-image: url($bildPfad)\"></div>";
                    echo "<table class=\"range-value\">
                        <td id=\"range1\">1</td ><td id=\"range2\">2</td><td id=\"range3\">3</td><td id=\"range4\">4</td><td id=\"range5\">5</td><td id=\"range6\">6</td><td id=\"range7\">7</td><td id=\"range8\">8</td><td id=\"range9\">9</td><td id=\"range10\">10</td>
                    </table>";
                    $form = new Form('/rate/index', 'POST',  'multipart/form-data');
                    echo "<input id=\"range\"type=\"range\" min=\"1\" max=\"10\" value=\"5\" name=\"bewertung\" class=\"range\"/>";
                    echo  "<input type=\"hidden\" name=\"bid\" value=\" ". $bildId . "\">";
                    echo  "<input type=\"hidden\" name=\"buid\" value=\" ". $bewerterId . "\">";
                    echo  $form->submit()->label('bestätigen')->name('submitRate');

                    $form->end();
                }

            ?>

        </div>
    </div>
</section>