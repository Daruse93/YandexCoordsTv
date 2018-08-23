<?php
$corePath = $modx->getOption('core_path',null,MODX_CORE_PATH).'components/yandexcoordstv/';
switch ($modx->event->name) {
    case 'OnTVInputRenderList':
        $modx->event->output($corePath.'tv/input/');
        break;
    case 'OnTVOutputRenderList':
        $modx->event->output($corePath.'tv/output/');
        break;
    case 'OnTVInputPropertiesList':
        $modx->event->output($corePath.'tv/inputoptions/');
        break;
    case 'OnTVOutputRenderPropertiesList':
        $modx->event->output($corePath.'tv/properties/');
        break;
    case 'OnManagerPageBeforeRender':
        break;
    	case 'OnDocFormRender':
		
		$jqueryScript = '<script type="text/javascript">';
		$jqueryScript .= "\n";
		$jqueryScript .= 'if(typeof jQuery == "undefined"){';
		$jqueryScript .= "\n";
		$jqueryScript .= 'document.write(\'<script type="text/javascript" src="//yandex.st/jquery/2.1.1/jquery.min.js" ></\'+\'script>\');';
		$jqueryScript .= "\n";
		$jqueryScript .= '}';
		$jqueryScript .= "\n";
		$jqueryScript .= '</script>';
		$jqueryScript .= "\n";
		
		$modx->regClientStartupScript($jqueryScript, true);
		
		
		$ymapsScript = '<script type="text/javascript">';
		$ymapsScript .= "\n";
		$ymapsScript .= 'if(typeof ymaps == "undefined"){';
		$ymapsScript .= "\n";
		$ymapsScript .= 'document.write(\'<script type="text/javascript" src="//api-maps.yandex.ru/2.1/?lang=ru_RU" ></\'+\'script>\');';
		$ymapsScript .= "\n";
		$ymapsScript .= '}';
		$ymapsScript .= "\n";
		$ymapsScript .= '</script>';
		$ymapsScript .= "\n";
		
		$modx->regClientStartupScript($ymapsScript, true);
		break;
}