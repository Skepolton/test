let MaytoniMap = { 
    init: function (parametrs) {
        MaytoniMap.contacts = parametrs.contacts;
        ymaps.ready(function(){
        MaytoniMap.Y_initMap([MaytoniMap.contacts[0].PROPERTY_LON_VALUE,MaytoniMap.contacts[0].PROPERTY_LAT_VALUE]);
        });
    },
    Y_initMap : function(coords){

        MaytoniMap.Y_map = new ymaps.Map("Maytoni_Map",{
            zoom:5,
            controls: [],
            center: coords
        });

        var hCheck = $('#Maytoni_Map').height();

        var ZC = new ymaps.control.ZoomControl({
            options : {
                position:{
                    right :20,
                    bottom  :((hCheck / 2) - 100)
                }
            }
        });

        MaytoniMap.Y_map.controls.add(ZC);       
        MaytoniMap.Y_baloons();
        MaytoniMap.Y_ContactsList();

    },
    Y_baloons: function(){
        for(var i in MaytoniMap.contacts){
            var baloonHTML  = "<div id='baloon'>";
            baloonHTML += "<div class='baloon_name'>";
                baloonHTML += MaytoniMap.contacts[i].NAME;
            baloonHTML += "</div>";

            if(MaytoniMap.contacts[i].PROPERTY_CITY_VALUE)
                baloonHTML += "<div><div class=tel_icon'></div>"+MaytoniMap.contacts[i].PROPERTY_CITY_VALUE+"<div style='clear:both'></div></div>";
            if(MaytoniMap.contacts[i].PROPERTY_PHONE_VALUE)
                baloonHTML += "<div><div class=tel_icon'></div>"+MaytoniMap.contacts[i].PROPERTY_PHONE_VALUE+"<div style='clear:both'></div></div>";
            if(MaytoniMap.contacts[i].PROPERTY_EMAIL_VALUE)
                baloonHTML += "<div><div class='email_icon'></div>"+MaytoniMap.contacts[i].PROPERTY_EMAIL_VALUE+"<div style='clear:both'></div></div>";

            baloonHTML += "</div>";

            MaytoniMap.contacts[i].placeMark = new ymaps.Placemark([MaytoniMap.contacts[i].PROPERTY_LON_VALUE,MaytoniMap.contacts[i].PROPERTY_LAT_VALUE],{
                balloonContent: baloonHTML
            }, {
                iconLayout: 'default#image',
                iconImageHref: '/local/components/maytoni/maytoni.officemap/templates/.default/images/NActive.png',
                iconImageSize: [40, 43],
                iconImageOffset: [-10, -31]
            });
            MaytoniMap.Y_map.geoObjects.add(MaytoniMap.contacts[i].placeMark);
            MaytoniMap.contacts[i].placeMark.link = i;
            MaytoniMap.contacts[i].placeMark.events.add('balloonopen',function(metka){
                MaytoniMap.Y_markChosenContact(metka.get('target').link);
            });
        }
        MaytoniMap.Y_readyToBlink = true;
    },
    Y_ContactsList: function(){
        var html = '';
        for(var i in MaytoniMap.contacts){
            
            if(typeof(MaytoniMap.contacts[i]) === 'function') continue;
            address = MaytoniMap.contacts[i].NAME;
            html+='<p id="CNT_'+i+'" onclick="MaytoniMap.Y_selectContact(\''+i+'\')" onmouseover="MaytoniMap.Y_blinkContact(\''+i+'\',true)" onmouseout="MaytoniMap.Y_blinkContact(\''+i+'\')"><span>'+address+'</span></p>';
        }
        $('#Contact_wrapper').html(html);
    },
    Y_selectContact: function(i){
        var checker = $('#Maytoni_Map').width();
        var adr = (checker > 700) ? 0.2 : -(120 / checker);
        MaytoniMap.Y_map.setCenter([MaytoniMap.contacts[i].PROPERTY_LON_VALUE,parseFloat(MaytoniMap.contacts[i].PROPERTY_LAT_VALUE)-adr]);
        MaytoniMap.contacts[i].placeMark.balloon.open();
    },
    Y_markChosenContact: function(id){
        if($('.selected').attr('id') !== 'CNT_'+id){
            $('.selected').removeClass('selected');
            $("#CNT_"+id).addClass('selected');
            MaytoniMap.Y_selectContact(id);
        }
    },
    Y_blinkContact: function(i,ifOn){
        if(MaytoniMap.Y_readyToBlink){
            if(typeof(ifOn)!=='undefined' && ifOn)
            MaytoniMap.contacts[i].placeMark.options.set({iconImageHref:"/local/components/maytoni/maytoni.officemap/templates/.default/images/Active.png"});
            else
            MaytoniMap.contacts[i].placeMark.options.set({iconImageHref:"/local/components/maytoni/maytoni.officemap/templates/.default/images/NActive.png"});
        }
    },
}