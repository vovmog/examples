<form id="my_form" method="POST">
    <label for="name">Name<span class="red">*</span></label>
    <input type="text" name="my_form_name" id="name" required minlength="2">
    <label for="phone">Phone Number<span class="red">*</span></label>
    <input type="text" name="phone" id="phone" required>
    <label for="email">Email<span class="red">*</span></label>
    <input type="email" name="email" id="email" required>
    <label>Date of birth</label>

    <div class="three_col">
        <select name="day" id="day"></select>
        <select name="month" id="month"></select>
        <select name="year" id="year"></select>
    </div>
    <div class="three_col">
        <div><label for="height">Height (cm)</label><input type="text" name="height" id="height"></div>
        <div><label for="hair">Hair color</label><input type="text" name="hair" id="hair"></div>
        <div><label for="eyes">Eyes color</label><input type="text" name="eyes" id="eyes"></div>
        <div><label for="shirt">Shirt size</label><input type="text" name="shirt" id="shirt"></div>
        <div><label for="waist">Waist size</label><input type="text" name="waist" id="waist"></div>
        <div><label for="shoes">Shoes Size</label><input type="text" name="shoes" id="shoes"></div>
    </div>
    <label for="education">Education</label><textarea name="education" id="education" rows="2"></textarea>
    <label for="experience">Hands on Experience</label><textarea name="experience" id="experience" rows="2"></textarea>
    <label for="languages">Languages</label><input type="text" name="languages" id="languages">
    <label for="voice">Voice tone</label><input type="text" name="voice" id="voice">
    <label for="skills">Additional skills</label><textarea name="skills" id="skills" rows="2"></textarea>
    <label for="show_reel">Show reel link</label><input type="text" name="show_reel" id="show_reel">
    <label for="website">Actor’s website</label><input type="url" name="website" id="website">

    <div class="file_upload">
        <label for="headshots">browse</label>
        <input type="file" multiple name="headshots[]" id="headshots">
        <span class="file-type">Headshots</span>
        <mark></mark>
    </div>
    <div class="file_upload">
        <label for="CV">browse</label>
        <input type="file" multiple name="CV[]" id="CV">
        <span class="file-type">CV</span>
        <mark></mark>
    </div>
    <div class="file_upload">
        <label for="voice_file">browse</label>
        <input type="file" multiple name="voice_file[]" id="voice_file">
        <span class="file-type">Voice sample</span>
        <mark></mark>
    </div>
    <input type="hidden" name="action" value="my_form_ajax">
    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('my_form_ajax'); ?>">

    <div class="terms">
        <input type="checkbox" id="terms"> <span>
             <?php
             if (get_bloginfo('language') == 'he-HE') {
                 echo "על ידי סימון אני מאשר כי קראתי והסכמתי <a data-fancybox-type=\"iframe\" href=\"/wp-content/uploads/2015/10/terms.html\">לתנאים</a></span>";
             } else {
                 echo "Check here to indicate that you have read and agree to <a data-fancybox-type=\"iframe\" href=\"/wp-content/uploads/2015/10/terms.html\">the Terms and Conditions</a>.</span>";
             }
             ?>

    </div>
    <div class="term_conf hide">
        <p> I have read and agree to the <a data-fancybox-type="iframe" href="/wp-content/uploads/2015/10/terms.html">Terms
                and Conditions</a>.</p>

        <div class="but">
            <button onclick="acceptConf()">Accept</button>
            <button class="cancel" onclick="jQuery.fancybox.close();">Cancel</button>
        </div>
    </div>
    <div id="thanks_reg">
        <p>
            <?php
            if (get_bloginfo('language') == 'he-HE') {
                echo "תודה על פנייתך, אצור קשר בקרוב";
            } else {
                echo "Thanks for contacting me, we'll be in touch soon.";
            }
            ?>
        </p>

    </div>

    <div class="block_but">
        <input type="submit" class="button" value="send" disabled>
    </div>
</form>
<script>
    window.onload = function () {
        var day = new Date,
            md = (new Date(day.getFullYear(), day.getMonth() + 1, 0, 0, 0, 0, 0)).getDate(),
            $month_name = "January February March April May June July August September October November December".split(" ");

        function set_select(a, c, d, e) {
            var el = document.getElementsByName(a)[0];
            for (var b = el.options.length = 0; b < c; b++) {
                if (a == 'month') {
                    el.options[b] = new Option($month_name[b], $month_name[b]);
                } else {
                    el.options[b] = new Option(b + d, b + d);
                }
//                el.options[b] = new Option(a == 'month' ? $month_name[b] : b + d, b + d);
            }
            el.options[e] && (el.options[e].selected = !0)
        }

        set_select("day", md, 1, day.getDate() - 1);
        set_select("month", 12, 1, day.getMonth());
        set_select("year", 71, day.getFullYear() - 70, 70);

//        document.getElementsByName('hour')[0].value = day.getHours()
//        document.getElementsByName('minute')[0].value = day.getMinutes()

        var year = document.getElementById('year');
        var month = document.getElementById("month");

        function check_date() {
            var a = year.value | 0,
                c = month.value | 0;
            md = (new Date(a, c, 0, 0, 0, 0, 0)).getDate();
            a = document.getElementById("day").selectedIndex;
            set_select("day", md, 1, a)
        }

        if (document.addEventListener) {
            year.addEventListener('change', check_date, false);
            month.addEventListener('change', check_date, false);

        } else {
            year.detachEvent('onchange', check_date);
            month.detachEvent('onchange', check_date);
        }

        var file_api = ( window.File && window.FileReader && window.FileList && window.Blob ) ? true : false;
        jQuery(".file_upload input[type='file']").on("change", function () {
//            console.log(jQuery(this)[0].files);
            var file_name = "";
            if (file_api && jQuery(this)[0].files.length > 0)
                for (i = 0; i < jQuery(this)[0].files.length; i++) {
                    file_name += jQuery(this)[0].files[i].name + " ";
                }

            else
                file_name = jQuery(this).val().replace("C:\\fakepath\\", '');

            if (!file_name.length)
                return;

            jQuery(this).siblings('mark').text(file_name);
        });
    }
</script>