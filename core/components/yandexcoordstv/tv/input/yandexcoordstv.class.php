<?php

if(!class_exists('YandexCoordsTvInputRender')) {
    class YandexCoordsTvInputRender extends modTemplateVarInputRender {
        public function getTemplate() {
            return $this->modx->getOption('core_path').'components/yandexcoordstv/tv/tpl/yandexcoordstv.tpl';
        }
        public function process($value,array $params = array()) {
           
        }
    }
}
return 'YandexCoordsTvInputRender';