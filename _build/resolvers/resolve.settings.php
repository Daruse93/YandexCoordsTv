<?php
/** @var $modx modX */
if (!$modx = $object->xpdo AND !$object->xpdo instanceof modX) {
    return true;
}
/** @var $options */
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:
        if (!$tmp = $modx->getObject('modSystemSetting', array('key' => 'yandex_coords_tv_api_key'))) {
            $tmp = $modx->newObject('modSystemSetting');
        }
        $tmp->fromArray(array(
            'namespace' => 'yandexcoordstv',
            'area'      => 'api',
            'xtype'     => 'textfield',
            'value'     => !empty($options['apikey']) ? trim($options['apikey']) : '' ,
            'key'       => 'yandex_coords_tv_api_key',
        ), '', true, true);
        $tmp->save();

        break;
    case xPDOTransport::ACTION_UNINSTALL:
        break;
}
return true;