<div id="yandexcoordstv{$tv->id}"></div>
<input id="tv{$tv->id}" name="tv{$tv->id}"
    type="text"
    value="{$tv->get('value')|escape}"
    {$style}
    tvtype="{$tv->type}"
/>


<style>
    #yandexcoordstv{$tv->id}{
        height: 300px;
        width: 560px;
    }
</style>

<script type="text/javascript">

/* API YANDEX*/
// 
// Дождёмся загрузки API и готовности DOM.
ymaps.ready(init);

function init() {
    var center{$tv->id} = [{$tv->get('value')|escape}];
    if('{$tv->get('value')|escape}' == ''){
        center{$tv->id} = [55.753994, 37.622093];
    }
    var myPlacemark{$tv->id},
        myMap{$tv->id} = new ymaps.Map('yandexcoordstv{$tv->id}', {
            center: center{$tv->id},
            zoom: 9,
            controls: []
        }), mySearchControl = new ymaps.control.SearchControl({
            options: {
                noPlacemark: true
            }
        }), zoomControl = new ymaps.control.ZoomControl({
            options: {
                size: "small"
            }
        });

        myMap{$tv->id}.controls.add(mySearchControl);
        myMap{$tv->id}.controls.add(zoomControl);
    // Если уже TV заполнено
    if('{$tv->get('value')|escape}' != ''){
        myPlacemark{$tv->id} = createPlacemark([{$tv->get('value')|escape}]);
        myMap{$tv->id}.geoObjects.add(myPlacemark{$tv->id});
        getAddress(myPlacemark{$tv->id}.geometry.getCoordinates());
    }
    
    //Слушаем выбор поиска
    mySearchControl.events.add('resultselect', function (e) {
        var index = e.get('index');
        var coords = mySearchControl.getResult(index)._value.geometry.getCoordinates();
        setMarker{$tv->id}(coords);
    });
   
    setMarker{$tv->id} = function (coords){
            // Если метка уже создана – просто передвигаем ее.
        if (myPlacemark{$tv->id}) {
            myPlacemark{$tv->id}.geometry.setCoordinates(coords);
        }
        // Если нет – создаем.
        else {
            myPlacemark{$tv->id} = createPlacemark(coords);
            myMap{$tv->id}.geoObjects.add(myPlacemark{$tv->id});
            // Слушаем событие окончания перетаскивания на метке.
            myPlacemark{$tv->id}.events.add('dragend', function () {
                getAddress(myPlacemark{$tv->id}.geometry.getCoordinates());
            });
        }
        getAddress(coords);
    }
    
    // Слушаем клик на карте.
    myMap{$tv->id}.events.add('click', function (e) {
        var coords = e.get('coords');
        setMarker{$tv->id}(coords);
    });
    
    

    // Создание метки.
    function createPlacemark(coords) {
        return new ymaps.Placemark(coords, {
            iconCaption: 'поиск...'
        }, {
            preset: 'islands#violetDotIconWithCaption',
            draggable: true
        });
    }
    
    // Определяем адрес по координатам (обратное геокодирование).
    function getAddress(coords) {
        myPlacemark{$tv->id}.properties.set('iconCaption', 'поиск...');
        ymaps.geocode(coords).then(function (res) {
            var firstGeoObject = res.geoObjects.get(0),
                    array = firstGeoObject.properties.get('description').split(', '),
                    country = array[0],
                city = array[1];
            myPlacemark{$tv->id}.properties
                .set({
                    iconCaption: firstGeoObject.properties.get('name'),
                    balloonContent: firstGeoObject.properties.get('text')
                });
           $('#tv{$tv->id}').val(firstGeoObject.geometry.getCoordinates());
        });
    }
}

/* emd API YANDEX*/

// <![CDATA[
{literal}
Ext.onReady(function() {
    var fld = MODx.load({
    {/literal}
        xtype: 'textfield'
        ,applyTo: 'tv{$tv->id}'
        ,width: '50%'
        ,enableKeyEvents: true
        ,msgTarget: 'under'
        ,allowBlank: {if $params.allowBlank == 1 || $params.allowBlank == 'true'}true{else}false{/if}
        {if $params.minLength},minLength: {$params.minLength}{/if}
        {if $params.maxLength},maxLength: {$params.maxLength}{/if}
        {if $params.regex},regex: new RegExp('{$params.regex}'){/if}
        {if $params.regexText},regexText: '{$params.regexText}'{/if}
    {literal}
        ,listeners: { 'keydown': { fn:MODx.fireResourceFormChange, scope:this}}
    });
    Ext.getCmp('modx-panel-resource').getForm().add(fld);
    MODx.makeDroppable(fld);
});
{/literal}
// ]]>
</script>
