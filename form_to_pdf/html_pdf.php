<?php
$html = "
<div class='wrapper'>

    <div class='header' style='text-align: center;'>
        <img src='/wp-content/themes/creative/form/mpdf/logo_pdf.jpg' width='32mm' alt='logo'>
    </div>
    <h1>Personal Information</h1>
    <div class='divider'></div>

    <span class='desc'>Name:</span>
    <p class='value'>&nbsp; $name </p>
    <span class='desc'>Phone Number:</span>
    <p class='value'>&nbsp; $phone </p>
    <span class='desc'>Email:</span>
    <p class='value'>&nbsp; $email </p>

<div>
    <span class='desc'>Date of birth:</span>
    <div class='three'><p class='value'>&nbsp; $day </p></div>
    <div class='three-center'><p class='value'>&nbsp; $month </p></div>
    <div class='three-last'><p class='value'>&nbsp; $year </p></div>
</div>

    <div>
        <div class='three'>
            <span class='desc'>Hight (cm, inc):</span>
            <p class='value'>&nbsp; $height </p>
        </div>
        <div class='three-center'>
            <span class='desc'>Hair color:</span>
            <p class='value'>&nbsp; $hair </p>
        </div>
        <div class='three-last'>
            <span class='desc'>Eyes color:</span>
            <p class='value'>&nbsp;$eyes</p>
        </div>
    </div>

    <div>
        <div class='three'>
            <span class='desc'>Shirt size:</span>
            <p class='value'>&nbsp;$shirt</p>
        </div>
        <div class='three-center'>
            <span class='desc'>Waist size:</span>
            <p class='value'>&nbsp;$waist</p>
        </div>
        <div class='three-last'>
            <span class='desc'>Shoes size:</span>
            <p class='value'>&nbsp;$shoes</p>
        </div>
    </div>
    <span class='desc'>Education:</span>
    <p class='value'>&nbsp;
    $education
    </p>

    <span class='desc'>Hands on Experience:</span>
    <p class='value'>&nbsp;
   $experience
    </p>

    <span class='desc'>Languages:</span>
    <p class='value'>&nbsp;
        $languages
    </p>
    <span class='desc'>Voice tone:</span>
    <p class='value'>&nbsp;
        $voice
    </p>
    <span class='desc'>Additional skills:</span>
    <p class='value'>&nbsp;
    $skills
    </p>
     <span class='desc'>Show reel link:</span>
    <p class='value'>&nbsp;
        $show_reel
    </p>
     <span class='desc'>Actor’s website:</span>
    <p class='value'>&nbsp;
        $website
    </p>

</div>
";