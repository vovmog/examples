<?php

/**
 * Добавление нового видежта Foo_Widget.
 */
class My_Form_Widget extends WP_Widget
{

    // Регистрация видежта используя основной класс
    function __construct()
    {
        parent::__construct(
            'foo_widget', // Base ID
            __('My Form Widget', 'text_domain'), // Name
            array('description' => __('My Form Widget', 'text_domain'),) // Args
        );
    }

    /**
     * Вывод виджета во Фронт-энде
     *
     * @param array $args аргументы виджета.
     * @param array $instance сохраненные данные из настроек
     */
    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);

//        echo $args['before_widget'];
        echo "<div class='my_form'>";
        if (!empty($title)) {
            echo "<div class='section-title'><h5>" . $title . "</h5></div>";
        }
        include_once('form.php');
//        echo $args['after_widget'];
        echo "</div>";
    }

    /**
     * Админ-часть виджета
     *
     * @param array $instance сохраненные данные из настроек
     */
    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('New title', 'text_domain');
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    /**
     * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance новые настройки
     * @param array $old_instance предыдущие настройки
     *
     * @return array данные которые будут сохранены
     */
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

        return $instance;
    }

}

// конец класса Foo_Widget

// регистрация Foo_Widget в WordPress
function register_my_form_widget()
{
    register_widget('My_Form_Widget');
}

add_action('widgets_init', 'register_my_form_widget');

add_action('wp_ajax_my_form_ajax', 'my_form_ajax'); // если нужно чтобы вся бадяга работала для админов
add_action('wp_ajax_nopriv_my_form_ajax', 'my_form_ajax'); // крепим на событие wp_ajax_nopriv_add_object_ajax, где add_object_ajax это параметр action, который мы добавили в перехвате отправки формы, add_object - ф-я которую надо запустить
function my_form_ajax()
{
    $errors = '';
    $nonce = $_POST['nonce']; // берем переданную формой строку проверки
    if (!wp_verify_nonce($nonce, 'my_form_ajax')) { // проверяем nonce код, второй параметр это аргумент из wp_create_nonce
        $errors .= 'Error'; // пишим ошибку
    }
    if ($errors) {
        echo $errors;// если были ошибки, выводим ответ в формате json с success = false и умираем
//        var_dump($_POST);
//        var_dump($_FILES);
        die();
    } else {
        my_send_mail();
    }
}


function my_send_mail()
{

//    var_dump($_POST);
//    var_dump($_FILES);
    $error = "";

    if (isset($_POST['my_form_name']) && mb_strlen($_POST['my_form_name']) > 1) {
        $name = trim($_POST['my_form_name']);
    } else {
        $error .= " error error_name ";
    }
    if (isset($_POST['phone']) && mb_strlen($_POST['phone']) > 5) {
        $phone = trim($_POST['phone']);
    } else {
        $error .= " error error_phone ";
    }
    if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = trim($_POST['email']);
    } else {
        $error .= "error error_email";
    }
    if (isset($_POST['day'])) {
        $day = trim($_POST['day']);
    } else {
        $day = "";
    }
    if (isset($_POST['month'])) {
        $month = trim($_POST['month']);
    } else {
        $month = "";
    }
    if (isset($_POST['year'])) {
        $year = trim($_POST['year']);
    } else {
        $year = "";
    }
    if (isset($_POST['height'])) {
        $height = trim($_POST['height']);
    } else {
        $height = "";
    }
    if (isset($_POST['hair'])) {
        $hair = trim($_POST['hair']);
    } else {
        $hair = "";
    }
    if (isset($_POST['eyes'])) {
        $eyes = trim($_POST['eyes']);
    } else {
        $eyes = "";
    }
    if (isset($_POST['shirt'])) {
        $shirt = trim($_POST['shirt']);
    } else {
        $shirt = "";
    }
    if (isset($_POST['waist'])) {
        $waist = trim($_POST['waist']);
    } else {
        $waist = "";
    }
    if (isset($_POST['shoes'])) {
        $shoes = trim($_POST['shoes']);
    } else {
        $shoes = "";
    }
    if (isset($_POST['education'])) {
        $education = trim($_POST['education']);
    } else {
        $education = "";
    }
    if (isset($_POST['experience'])) {
        $experience = trim($_POST['experience']);
    } else {
        $experience = "";
    }
    if (isset($_POST['languages'])) {
        $languages = trim($_POST['languages']);
    } else {
        $languages = "";
    }
    if (isset($_POST['voice'])) {
        $voice = trim($_POST['voice']);
    } else {
        $voice = "";
    }
    if (isset($_POST['skills'])) {
        $skills = trim($_POST['skills']);
    } else {
        $skills = "";
    }
    if (isset($_POST['show_reel'])) {
        $show_reel = trim($_POST['show_reel']);
    } else {
        $show_reel = "";
    }
    if (isset($_POST['website'])) {
        $website = trim($_POST['website']);
    } else {
        $website = "";
    }
    if ($error) {
        echo $error;
        die();
    }
    $text_msg = "<div><h3>FROM:</h3><ul>
<li style='margin-bottom: 20px;'><b style='display: inline-block;width: 100px'>Name: </b>$name</li>
<li style='margin-bottom: 20px;'><b style='display: inline-block;width: 100px'>Phone Number: </b>$phone</li>
<li style='margin-bottom: 20px;'><b style='display: inline-block;width: 100px'>Email: </b>$email</li>

</ul></div>";

    $attach_file = array();
    $picture = "";
    $CV = "";
    $voice_file = "";


    for ($i = 0; $i < sizeof($_FILES['headshots']['name']); $i++) {
        if (!empty($_FILES['headshots']['name'][0]) or !empty($_FILES['headshots']['name'][$i])) {

            $path = get_template_directory() . "/form/include/" . $_FILES['headshots']['name'][$i];
            if (copy($_FILES['headshots']['tmp_name'][$i], $path)) $picture[$i] = $path;
            $ext = pathinfo($picture[$i])['extension'];
            rename($picture[$i], get_template_directory() . "/form/include/headshots" . $i . "." . $ext);
            $attach_file[] = get_template_directory() . "/form/include/headshots" . $i . "." . $ext;

        }
    }

    for ($i = 0; $i < sizeof($_FILES['CV']['name']); $i++) {
        if (!empty($_FILES['CV']['name'][0]) or !empty($_FILES['CV']['name'][$i])) {

            $path = get_template_directory() . "/form/include/" . $_FILES['CV']['name'][$i];
            if (copy($_FILES['CV']['tmp_name'][$i], $path)) $picture[$i] = $path;
            $ext = pathinfo($picture[$i])['extension'];
            rename($picture[$i], get_template_directory() . "/form/include/CV" . $i . "." . $ext);
            $attach_file[] = get_template_directory() . "/form/include/CV" . $i . "." . $ext;

        }
    }
    for ($i = 0; $i < sizeof($_FILES['voice_file']['name']); $i++) {
        if (!empty($_FILES['voice_file']['name'][0]) or !empty($_FILES['voice_file']['name'][$i])) {
            $path = get_template_directory() . "/form/include/" . $_FILES['voice_file']['name'][$i];
            if (copy($_FILES['voice_file']['tmp_name'][$i], $path)) $picture[$i] = $path;
            $ext = pathinfo($picture[$i])['extension'];
            rename($picture[$i], get_template_directory() . "/form/include/voice_file" . $i . "." . $ext);
            $attach_file[] = get_template_directory() . "/form/include/voice_file" . $i . "." . $ext;

        }
    }


    $headers[] = 'From: Dana Gury <dana@danagury.com>' . "\r\n";
    $headers[] = 'content-type: text/html';


//
    echo("success");
    include_once('html_pdf.php');
    $mpdf = new mPDF('utf-8', "A4", '', '', 0, 0, 0, 0, 0, 0);//создаем PDF файл, задаем формат, отступы и.т.д.
//    $mpdf->charset_in = 'utf-8';//задаем кодировку
//$stylesheet = file_get_contents('pdfstyle.css');//подключаем CSS
//$mpdf->WriteHTML($stylesheet, 1);//передаем CSS в mPDF
//    $mpdf->list_indent_first_level = 0;//фиг его знает
    $stylesheet = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/creative/form/mpdf/main.css');
    $mpdf->WriteHTML($stylesheet, 1);    // The parameter 1 tells that this is css/style only and no body/html/text
    $mpdf->WriteHTML($html);//передаем HTML d mPDF
//    $mpdf->Output('./test2.pdf',"F");//получаем PDF файл в корень сайта при вызове сниппета$content = $mpdf->Output('form.pdf', 'F');
    $mpdf->Output(get_template_directory() . '/mpdf/include/Personal-Information.pdf', "F");
    $PersonalInformation_pdf = get_template_directory() . "/mpdf/include/Personal-Information.pdf";
    $attach_file[] = $PersonalInformation_pdf;
    $attachments = array($picture, $CV, $voice_file, $PersonalInformation_pdf);
    $admin_email = trim(get_bloginfo('admin_email'));
    if (wp_mail($admin_email, 'danagury.com', $text_msg, $headers, $attach_file)) {
        echo "mail send";
    } else {
        echo "error mail";
    }
    if ($attach_file) {
        foreach ($attach_file as $attach) {
            unlink($attach);
        }
    }

    die();
}

