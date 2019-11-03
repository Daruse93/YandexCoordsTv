<?php
/**
 * Build the setup options form.
 */

$output = null;

$intro = 'Для корректной работы пакета, требуется получить <strong>Javascript API</strong>, его можно получить в 
        <a href="https://developer.tech.yandex.ru/" target="_blank">личном кабинета разработчика яндекс</a>.';

$apiKey = 'API ключ яндекса';
$apiKey_intro = 'Введите API ключ яндекса';
$output =
    '<style>
    #setup_form_wrapper {font: normal 12px Arial;line-height:18px;}
    #setup_form_wrapper a {color: #08C;}
    #setup_form_wrapper label {width: 125px; text-align: right;}
    #setup_form_wrapper input {height: 25px; border: 1px solid #AAA; border-radius: 3px; padding: 3px;}
    #setup_form_wrapper input#apikey {height: 25px; width: 200px;}
    #setup_form_wrapper table {margin-top:10px;}
    #setup_form_wrapper small {font-size: 10px; color:#555; font-style:italic;}
</style>
<div id="setup_form_wrapper">
    <p>'.$intro.'</p>
    <table cellspacing="5" id="setup_form">
        <tr>
            <td><label for="apikey">'.$apiKey.':</label></td>
            <td><input type="text" name="apikey" value="" placeholder="aaa11a11-111a-1111-1111-11111a111111" id="apikey" /></td>
        </tr>
        <tr><td colspan="2"><small>'.$apiKey_intro.'</small></td></tr>
    </table>
</div>
';

return $output;