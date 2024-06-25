<?php
require_once('db.php');
// Start or resume the session
session_start();

// Check if the user is already logged in
if (!isset($_SESSION['user'])) {
    // Redirect to the login page (or any other page as needed)
    header("Location: loginpage.php");
    exit();
}
?>
<!DOCTYPE html> <!-- saved from url=(0049)https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2 -->
<html xmlns="https://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script type="text/javascript" src="./ib-fio_files/jquery-3.6.0.min-ver-CE8F684A284EDB4E0F59F8333915FFF3.js"></script>
    <script type="text/javascript" src="./ib-fio_files/wicket-ajax-jquery-ver-6C3579C63E0C4EBFA954D232A7F1B943.js"></script>
    <script type="text/javascript" id="wicket-ajax-base-url">
        /*<![CDATA[*/
        Wicket.Ajax.baseUrl="fio/page/nastenka-bankovni?2";
        /*]]>*/
    </script>
    <script type="text/javascript" src="./ib-fio_files/popper-ver-B88AB82D5D8146BDC5CAC5A91F89C7D3.js"></script>
    <style data-tippy-stylesheet="">
        .tippy-box[data-animation=fade][data-state=hidden]{opacity:0}[data-tippy-root]{max-width:calc(100vw - 10px)}.tippy-box{position:relative;background-color:#333;color:#fff;border-radius:4px;font-size:14px;line-height:1.4;white-space:normal;outline:0;transition-property:transform,visibility,opacity}.tippy-box[data-placement^=top]>.tippy-arrow{bottom:0}.tippy-box[data-placement^=top]>.tippy-arrow:before{bottom:-7px;left:0;border-width:8px 8px 0;border-top-color:initial;transform-origin:center top}.tippy-box[data-placement^=bottom]>.tippy-arrow{top:0}.tippy-box[data-placement^=bottom]>.tippy-arrow:before{top:-7px;left:0;border-width:0 8px 8px;border-bottom-color:initial;transform-origin:center bottom}.tippy-box[data-placement^=left]>.tippy-arrow{right:0}.tippy-box[data-placement^=left]>.tippy-arrow:before{border-width:8px 0 8px 8px;border-left-color:initial;right:-7px;transform-origin:center left}.tippy-box[data-placement^=right]>.tippy-arrow{left:0}.tippy-box[data-placement^=right]>.tippy-arrow:before{left:-7px;border-width:8px 8px 8px 0;border-right-color:initial;transform-origin:center right}.tippy-box[data-inertia][data-state=visible]{transition-timing-function:cubic-bezier(.54,1.5,.38,1.11)}.tippy-arrow{width:16px;height:16px;color:#333}.tippy-arrow:before{content:"";position:absolute;border-color:transparent;border-style:solid}.tippy-content{position:relative;padding:5px 9px;z-index:1}
    </style>
    <link rel="stylesheet" type="text/css" href="./ib-fio_files/tippy-ver-EBD6F8CE46A677E1A4F5F8A8317109A9.css" media="screen, print">
    <script type="text/javascript" src="./ib-fio_files/tippy-ver-9DAE930A24E25D61134B6E5EB6831B36.js"></script>
    <link rel="stylesheet" type="text/css" href="./ib-fio_files/jquery-ui-1.13.1.min-ver-3809AB2F81BAF761459F5E66F169A5D7.css" media="screen">
    <script type="text/javascript" src="./ib-fio_files/jquery-ui-1.13.1.min-ver-1174ABB1D3A146BA5ABD4E6FD5F94B41.js"></script>
    <link rel="stylesheet" type="text/css" href="./ib-fio_files/dragtable.min-ver-603A27916BB2B972383FAEF86CB8C646.css">
    <script type="text/javascript" src="./ib-fio_files/jquery.dragtable.min-ver-EB838506D0325C39D2C16ECD721F919B.js"></script>
    <link rel="stylesheet" type="text/css" href="./ib-fio_files/bootstrap_341.min-ver-4BE1CDB6FF8DBD79BE777AD52F309349.css" media="screen, print">
    <script type="text/javascript" src="./ib-fio_files/bootstrap_341.min-ver-2F34B630FFE30BA2FF2B91E3F3C322A1.js"></script>
    <link rel="stylesheet" type="text/css" href="./ib-fio_files/bootstrap-select.min-ver-2212BC6B437F27E6F6AC3FE2D30BF349.css" media="screen, print">
    <script type="text/javascript" src="./ib-fio_files/bootstrap-select.min-ver-F20D3F02E2FBAD79845F3AB4C458AA20.js"></script>
    <script type="text/javascript" src="./ib-fio_files/DatePicker_cs-ver-B53E393FD0791540160DFB834FE263AD.js"></script>
    <script type="text/javascript" src="./ib-fio_files/anychart-custom.min-ver-E6ABE1B0C8F0DF2ED07B3A7FDD54A660.js"></script>
    <link rel="stylesheet" type="text/css" href="./ib-fio_files/anychart-ui.min-ver-E24303C3CE9A50F1E414D5BDFF81EB84.css" media="screen, print">
    <script type="text/javascript" src="./ib-fio_files/locale-ver-D41945C9878096F6AF9B735E07CF0F38.js"></script>
    <link rel="stylesheet" type="text/css" href="./ib-fio_files/jquery.gridster.min-ver-83FCB00EB7844FFFC66E27F2B5267D33.css">
    <script type="text/javascript" src="./ib-fio_files/jquery.gridster.upraveno-ver-184A1767202413D328F5E95B65E523B3.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" sizes="16x16" type="image/x-icon" href="https://ib.fio.cz/ib/fio/resource/cz.fio.ib2.common.wicket.web.layout.image.FioImage/png/favicon-ver-BED52CBBA61C3C2EFBCD2A3F722B3146.ico">
    <title>Internetové bankovnictví | Fio banka</title>
    <link rel="stylesheet" type="text/css" href="./ib-fio_files/font-awesome.min-ver-269550530CC127B6AA5A35925A7DE6CE.css" media="screen">
    <script type="text/javascript" src="./ib-fio_files/defaultJsFunctions-ver-FA4401E0265BA7A982347E42A49BA273.js"></script>
    <script type="text/javascript" src="./ib-fio_files/defaultLocalizedJsFunctions-ver-57244FFEF2516F1B0F7E5D0F00C28E1C.js"></script>
    <link rel="stylesheet" type="text/css" href="./ib-fio_files/style-ver-85610819C8B6A69C1833660A2996E692.css" media="screen">
    <link rel="stylesheet" type="text/css" href="./ib-fio_files/print-ver-98E7EA0529EA6D60F27CD68E8A462E77.css" media="print">
    <meta name="description" content="Přihlášení do internetového bankovnictví Fio banky. Kromě plateb si zde můžete založit i další účty, požádat o půjčku, kontokorent a další služby.">
    <link rel="stylesheet" type="text/css" href="./ib-fio_files/thin-ver-506BA9CC32CFE34DA38CF0AAD0AE6C24.css" media="screen">
    <link rel="stylesheet" type="text/css" href="./ib-fio_files/velikostPisma_stredni-ver-113B8223BBF3D945CF155F14EE2394AD.css" media="screen">
    <script type="text/javascript">
        /*<![CDATA[*/
        function responsiveTable(table) {
        	if (table.is(':visible')) {
        		if (table.width() > table.parent().width()) {
        			table.parent().addClass('table-responsive2');
        			table.parent().removeClass('table-responsive');
        			Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-","ch":"NavigacePodavaniPokynuChannel|a"});;
        		} else {
        			table.parent().addClass('table-responsive');
        			table.parent().removeClass('table-responsive2');
        		}
        	}
        };
        /*]]>*/
    </script>
    <script type="text/javascript">
        /*<![CDATA[*/
        Wicket.Event.add(window, "domready", function(event) { 
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-stayLoggedInLink","c":"id8abafacc3d0f19593a","i":"id8abafacc3d0f19593a--ajax-indicator","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-header-searchForm-search","m":"POST","c":"id6c330b34c0c05e2e3c","f":"id710449b6f73855b73b","sc":"search","i":"id6c330b34c0c05e2e3c--ajax-indicator","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-neprovedenePlatbyAJineInfoPanel-upozorneniPanel-upozorneniList-0-zobrazitDetailZpravyLink","c":"id12b39bf477491f7e3d","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-neprovedenePlatbyAJineInfoPanel-upozorneniPanel-upozorneniList-1-zobrazitDetailZpravyLink","c":"id24b90e0580ebade63e","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-neprovedenePlatbyAJineInfoPanel-upozorneniPanel-upozorneniList-2-zobrazitDetailZpravyLink","c":"iddb3aa7dcb42f087e3f","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-neprovedenePlatbyAJineInfoPanel-upozorneniPanel-upozorneniList-3-zobrazitDetailZpravyLink","c":"idface306e519c99e540","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-neprovedenePlatbyAJineInfoPanel-upozorneniPanel-upozorneniList-4-zobrazitDetailZpravyLink","c":"id20a4b4f26789feb241","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-neprovedenePlatbyAJineInfoPanel-upozorneniPanel-upozorneniList-5-zobrazitDetailZpravyLink","c":"idae0a0af4145a688f42","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-neprovedenePlatbyAJineInfoPanel-upozorneniPanel-upozorneniList-6-zobrazitDetailZpravyLink","c":"idfa276c28743cdb7e43","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-neprovedenePlatbyAJineInfoPanel-upozorneniPanel-upozorneniList-7-zobrazitDetailZpravyLink","c":"idddadf463bd463a1844","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-neprovedenePlatbyAJineInfoPanel-upozorneniPanel-upozorneniList-8-zobrazitDetailZpravyLink","c":"idce4df07f0f0cadfe45","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-neprovedenePlatbyAJineInfoPanel-upozorneniPanel-upozorneniList-9-zobrazitDetailZpravyLink","c":"ide4de84eb789916ec46","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-neprovedenePlatbyAJineInfoPanel-upozorneniPanel-upozorneniList-10-zobrazitDetailZpravyLink","c":"id1d8dfcec9f9941b347","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-headerLink","c":"ide347b76dec663e8f48","i":"ide347b76dec663e8f48--ajax-indicator","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-removeLink","c":"idf3e8186c4015904949","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-settings-form-save","m":"POST","c":"idda9c05923907c69e4b","f":"id3c57cb705032e91c4a","sc":"save","e":"click","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-pohyby-body-rows-1-row-cells-5-cell-komentarBox-labelBox-editLink","c":"idae0d2660b1e579b24d","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-pohyby-body-rows-2-row-cells-5-cell-komentarBox-labelBox-editLink","c":"id0fa0dd5c660a2f2b4e","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-pohyby-body-rows-3-row-cells-5-cell-komentarBox-labelBox-editLink","c":"idedec84ccc439c98d4f","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-pohyby-body-rows-4-row-cells-5-cell-komentarBox-labelBox-editLink","c":"id2d5aac7edd82144250","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-pohyby-body-rows-5-row-cells-5-cell-komentarBox-labelBox-editLink","c":"idbd44c92b625510bd51","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-pohyby-body-rows-6-row-cells-5-cell-komentarBox-labelBox-editLink","c":"id87805eb70dcf8f9b52","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-pohyby-body-rows-7-row-cells-5-cell-komentarBox-labelBox-editLink","c":"id0672eef63b2d1b8b53","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-pohyby-body-rows-8-row-cells-5-cell-komentarBox-labelBox-editLink","c":"id2af682c37dc18a5f54","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-pohyby-body-rows-9-row-cells-5-cell-komentarBox-labelBox-editLink","c":"idb561cdc596340caa55","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-pohyby-body-rows-10-row-cells-5-cell-komentarBox-labelBox-editLink","c":"idf13e793da4a1818956","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-pohyby-body-rows-11-row-cells-5-cell-komentarBox-labelBox-editLink","c":"id32915e0872e7731457","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-pohyby-body-rows-12-row-cells-5-cell-komentarBox-labelBox-editLink","c":"id9efaba3fed31717258","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-pohyby-body-rows-13-row-cells-5-cell-komentarBox-labelBox-editLink","c":"id0ddfab76da84b65059","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-pohyby-body-rows-14-row-cells-5-cell-komentarBox-labelBox-editLink","c":"idc4bf9a8be4248fdb5a","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-pohyby-body-rows-15-row-cells-5-cell-komentarBox-labelBox-editLink","c":"id1b2f2cf2217ce3115b","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-pohyby-body-rows-16-row-cells-5-cell-komentarBox-labelBox-editLink","c":"id9ba3c921d3801ec15c","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-pohyby-body-rows-17-row-cells-5-cell-komentarBox-labelBox-editLink","c":"id83828d5ea2b4a6fe5d","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-pohyby-body-rows-18-row-cells-5-cell-komentarBox-labelBox-editLink","c":"iddb5688eb36bfe1105e","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-pohyby-body-rows-19-row-cells-5-cell-komentarBox-labelBox-editLink","c":"id03f8313da9d034d45f","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-pohyby-body-rows-20-row-cells-5-cell-komentarBox-labelBox-editLink","c":"id01b782317e53a3b160","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-1-widget-headerLink","c":"idc808ca3560af22e363","i":"idc808ca3560af22e363--ajax-indicator","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-1-widget-removeLink","c":"id95463a14b23fc30364","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-1-widget-settings-form-save","m":"POST","c":"id232602e24d0bca8f66","f":"id2a98e3e9e8dc140365","sc":"save","e":"click","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-2-widget-headerLink","c":"idd770201a344e441a69","i":"idd770201a344e441a69--ajax-indicator","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-2-widget-removeLink","c":"id6ec69a5472aae19f6a","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-2-widget-settings-form-save","m":"POST","c":"idab44e23a6d8851726d","f":"idda32ac7f2d7ec83d6c","sc":"save","i":"idab44e23a6d8851726d--ajax-indicator","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-3-widget-headerLink","c":"idcb97a64b303059996f","i":"idcb97a64b303059996f--ajax-indicator","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-3-widget-removeLink","c":"id5263caaa3944fc4e70","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-3-widget-settings-form-save","m":"POST","c":"id21d983173606669073","f":"id9617411084f4831772","sc":"save","i":"id21d983173606669073--ajax-indicator","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-4-widget-headerLink","c":"idbb1644e4aee82f7675","i":"idbb1644e4aee82f7675--ajax-indicator","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-4-widget-removeLink","c":"id9549c481e2a4039d76","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-widgets-4-widget-settings-settingsPanel-form-submit","m":"POST","c":"idbd01179996b3005880","f":"id4cf2b4c87baa49b07f","sc":"p::submit","e":"click","pd":true});;
        Wicket.Ajax.ajax({"u":"./nastenka-bankovni?2-1.0-widgets-add~widget~link","c":"id0a1f05ace359b6d283","e":"click","ch":"NavigacePodavaniPokynuChannel|a","pd":true});;
        Wicket.Event.publish(Wicket.Event.Topic.AJAX_HANDLERS_BOUND);
        ;});
        /*]]>*/
    </script>
    <script type="text/javascript">
        /*<![CDATA[*/
        Wicket.Event.add(window, "load", function(event) { 
        (function () {
            var interval = setInterval(function () {
                var time = new Date().getTime();
                var parts = docCookies.getItem('__Host-IB2_jsLogoutTime').split('|');
                var modalTime = parts[2];
                var logoutTime = parts[3];
                if (modalTime != null && logoutTime != null) {
                    if (time > logoutTime) {
                        clearInterval(interval);
                        window.location.replace('logout');
                    } else if (time > modalTime) {
                        if ($('.logoutModal').not(':visible')) {
                            $('.logoutModal').modal('show');
                        }
                    } else {
                        $('.logoutModal').modal('hide');
                    }
                }
            }, 1000); // every second
        })();
        ;
        tippy('.tooltipMarker', {allowHTML: true});;
        $(function() {
        	var sirka = $("#ida0432fc964f8cb0a4c").outerWidth();
        	$("#ida0432fc964f8cb0a4c").css("width", sirka);
        });
        ;
        (function() {
        	var table = $("#idb670a5c23553228861");
        
        	responsiveTable(table);
        	table.resize(table, responsiveTable);
        })();
        ;
        (function(){
        	// callback function
        		var callback = function (cols) {
        var attrs = {"u":"./nastenka-bankovni?2-1.0-widgets-widgets-0-widget-pohyby","c":"idb670a5c23553228861","ch":"NavigacePodavaniPokynuChannel|a"};
        var params = [{"name":"cols","value":cols}];
        attrs.ep = params.concat(attrs.ep || []);
        Wicket.Ajax.ajax(attrs);
        }
        ;
        		
        	// nastaveni dragtable na tabulku
        		$('#idb670a5c23553228861').dragtable({
        			dragaccept: '.draggable-header',
        			persistState: function(table) {
        				var columns = [];
        				table.el.find('th').each(function(index, el) {
        					columns.push( $(el).attr('draggable-header-column') );
        				});
        				callback(columns.join(','));
        			}
        		});
        })();
        	
        ;
        (function() {
        
        	// change colors of settings
        	$("#id854d80c5a871b6e062").on("hover", function() {
        		$(this).parent().css("border", "1px solid #DDDDDD");
        		$(this).children().children(".widget_tools").css("color", "#333");
        	}, function() {
        		$(this).parent().css("border", "1px solid #EEEEEE");
        		$(this).children().children(".widget_tools").css("color", "#BBB");
        	});
        
        
        })();;
        (function() {
        	var table = $("#id6f3d6118a838a22367");
        
        	responsiveTable(table);
        	table.resize(table, responsiveTable);
        })();
        ;
        (function(){
        	// callback function
        		var callback = function (cols) {
        var attrs = {"u":"./nastenka-bankovni?2-1.0-widgets-widgets-1-widget-planovanePlatby","c":"id6f3d6118a838a22367","ch":"NavigacePodavaniPokynuChannel|a"};
        var params = [{"name":"cols","value":cols}];
        attrs.ep = params.concat(attrs.ep || []);
        Wicket.Ajax.ajax(attrs);
        }
        ;
        		
        	// nastaveni dragtable na tabulku
        		$('#id6f3d6118a838a22367').dragtable({
        			dragaccept: '.draggable-header',
        			persistState: function(table) {
        				var columns = [];
        				table.el.find('th').each(function(index, el) {
        					columns.push( $(el).attr('draggable-header-column') );
        				});
        				callback(columns.join(','));
        			}
        		});
        })();
        	
        ;
        (function() {
        
        	// change colors of settings
        	$("#idf6339393eb2379f168").on("hover", function() {
        		$(this).parent().css("border", "1px solid #DDDDDD");
        		$(this).children().children(".widget_tools").css("color", "#333");
        	}, function() {
        		$(this).parent().css("border", "1px solid #EEEEEE");
        		$(this).children().children(".widget_tools").css("color", "#BBB");
        	});
        
        
        })();;
        $("#id8990efa16af5ff626b").nextAll("button").first().remove();
        $("#id8990efa16af5ff626b").nextAll(".dropdown-menu").first().remove();
        $("#id8990efa16af5ff626b").selectpicker({dropupAuto: false, showSubtext: true});;
        (function() {
        
        	// change colors of settings
        	$("#id0b61fa8c7ee8859e6e").on("hover", function() {
        		$(this).parent().css("border", "1px solid #DDDDDD");
        		$(this).children().children(".widget_tools").css("color", "#333");
        	}, function() {
        		$(this).parent().css("border", "1px solid #EEEEEE");
        		$(this).children().children(".widget_tools").css("color", "#BBB");
        	});
        
        
        })();;
        $("#id1ae387710352506571").nextAll("button").first().remove();
        $("#id1ae387710352506571").nextAll(".dropdown-menu").first().remove();
        $("#id1ae387710352506571").selectpicker({dropupAuto: false, showSubtext: true});;
        (function() {
        
        	// change colors of settings
        	$("#id5c17c4dffec1e94d74").on("hover", function() {
        		$(this).parent().css("border", "1px solid #DDDDDD");
        		$(this).children().children(".widget_tools").css("color", "#333");
        	}, function() {
        		$(this).parent().css("border", "1px solid #EEEEEE");
        		$(this).children().children(".widget_tools").css("color", "#BBB");
        	});
        
        
        })();;
        $('#id67fb7f5e57a9b97077').datepicker({maxDate: 0}); $('#id61259605e76e4cca78').click(function(){$(this).closest('.input-group').children('.form-control').datepicker('show');});;
        $('#idd77ab154bd860fed79').datepicker({maxDate: 0}); $('#id17970276244030db7a').click(function(){$(this).closest('.input-group').children('.form-control').datepicker('show');});;
        $("#id54077a02989d5d837b").nextAll("button").first().remove();
        $("#id54077a02989d5d837b").nextAll(".dropdown-menu").first().remove();
        $("#id54077a02989d5d837b").selectpicker({dropupAuto: false, showSubtext: true});;
        $("#ide02f938d21d4648d7c").nextAll("button").first().remove();
        $("#ide02f938d21d4648d7c").nextAll(".dropdown-menu").first().remove();
        $("#ide02f938d21d4648d7c").selectpicker({dropupAuto: false, showSubtext: true});;
        $("#id283bf74e6b2db0a77d").nextAll("button").first().remove();
        $("#id283bf74e6b2db0a77d").nextAll(".dropdown-menu").first().remove();
        $("#id283bf74e6b2db0a77d").selectpicker({dropupAuto: false, showSubtext: true});;
        $("#id3243723e491d392d7e").nextAll("button").first().remove();
        $("#id3243723e491d392d7e").nextAll(".dropdown-menu").first().remove();
        $("#id3243723e491d392d7e").selectpicker({dropupAuto: false, showSubtext: true});;
        (function() {
        
        	function showFrekvence(frekvence) {
        		$('#id4cf2b4c87baa49b07f .frekvence').hide();
        		$('#id4cf2b4c87baa49b07f .frekvence-' + frekvence).show();
        	}
        
        	$('#id4cf2b4c87baa49b07f input[name="frekvence"]').change(function() {
        		showFrekvence($(this).attr('show'));
        	});
        	
        	showFrekvence("MONTHLY");
        
        	
        })();;
        (function(){
          anychart.format.outputLocale('cs-cz');
        })();
        ;
        (function(){
        
        	$(".widget_box").find("figure").parent().parent().css("overflow", "hidden");
        	var json = [{'x':'2023-09-01', 'y':151149.4200 },{'x':'2023-08-01', 'y':124213.1800 },{'x':'2023-07-01', 'y':173402.1800 },{'x':'2023-06-01', 'y':164726.6400 },{'x':'2023-05-01', 'y':166951.9700 },{'x':'2023-04-01', 'y':149529.9100 },{'x':'2023-03-01', 'y':158578.1100 },{'x':'2023-02-01', 'y':165481.3700 },{'x':'2023-01-01', 'y':161246.4900 }];
        
        	var dateFormat = anychart.format.outputDateFormat();
        	if (true) {
        		dateFormat = anychart.format.getDateTimeFormat('year_month');
        	}
        
        	var chart = anychart.area();
        	chart.credits().enabled(false);
        	chart.background().fill("transparent");
        
        	var series = chart.area(json);
        	series.stroke("2 #00458A");
        	series.normal().fill("#3880AA", 0.1);
        	series.name("Hodnota");
        
        	var dateTimeScale = anychart.scales.dateTime();
        	dateTimeScale.ticks().interval('day',1);
        	dateTimeScale.ticks().count(Math.min(30, json.length));
        	chart.xScale(dateTimeScale);
        	chart.xScale().minimumGap(0.02);
        	chart.xScale().maximumGap(0.02);
        
        	var markers = series.markers();
        	markers.enabled(false);
        	markers.fill("#00458A");
        	markers.stroke("2 white");
        	var hoverMarkers = series.hovered().markers();
        	hoverMarkers.fill("#9CC12B");
        	hoverMarkers.stroke("2 white");
        
        	chart.yAxis().labels().format(function () {
        		return anychart.format.number(this.value, {decimalsCount: 0}) + " CZK";
        	});
        	chart.xAxis().labels().format(function () {
        		return anychart.format.dateTime(this.tickValue, dateFormat);
        	});
        
        	chart.tooltip().format(function () {
        		return anychart.format.number(this.value, {decimalsCount: 2}) + " CZK";
        	});
        	chart.tooltip().titleFormat(function(){
        		return anychart.format.dateTime(this.x, dateFormat);
        	});
        
        	chart.crosshair(true);
        	chart.crosshair().displayMode('sticky');
        	chart.crosshair().xStroke("#9CC12B", 1.5, "10 5", "round");
        	chart.crosshair().yStroke(null);
        	chart.crosshair().yLabel(false);
        	chart.crosshair().xLabel(false);
        
        	chart.yGrid().enabled(true);
        	chart.yGrid().stroke({dash: "3 5", color: 'lightgray'});
        
        	chart.xGrid().enabled(true);
        	chart.xGrid().stroke({dash: "3 5", color: 'lightgray'});
        
        	chart.container("id0b7d620ce5ee870d81");
        	chart.draw();
        
        	var resizeChart = function (time){
        		if (time === undefined) {
        			time = 1000;
        		}
        		setTimeout(function() {
        			var newWidth = $('#id0b7d620ce5ee870d81').parent().width();
        			// each point needs at least 10 pixels (6 for point, 2 for white line on each side)
        			// we set more so that there is at least a piece of normal line between adjacent points
        			var pointWidth = 18;
        			// too many points for the current width -> show only a line
        			if (newWidth / pointWidth < json.length) {
        				series.markers().enabled(false);
        			}
        			else{
        				series.markers().enabled(true);
        			}
        
        		}, time);
        	};
        	resizeChart(0);
        	resizeChartCallbackFunctions[resizeChartCallbackFunctions.length] = resizeChart;
        
        	$(window).on("resize", function() {
        		resizeChart();
        	});
        
        })();
        ;
        (function() {
        
        	// change colors of settings
        	$("#id81345d7737a85ad182").on("hover", function() {
        		$(this).parent().css("border", "1px solid #DDDDDD");
        		$(this).children().children(".widget_tools").css("color", "#333");
        	}, function() {
        		$(this).parent().css("border", "1px solid #EEEEEE");
        		$(this).children().children(".widget_tools").css("color", "#BBB");
        	});
        
        
        })();;
        (function() {
        
        	var callback = function (serialized) {
        var attrs = {"u":"./nastenka-bankovni?2-1.0-widgets","c":"idd8c30576d3886da284","ch":"NavigacePodavaniPokynuChannel|a"};
        var params = [{"name":"serialized","value":serialized}];
        attrs.ep = params.concat(attrs.ep || []);
        Wicket.Ajax.ajax(attrs);
        }
        ;
        
        	var resizeContentOfWidgets = function($widget) {
        		var vyskaWidgetu = $($widget).innerHeight();
        		var vyskaZahlavi = $($widget).find("div.widget_boxHeader").outerHeight();
        		$($widget).find("div.widget_box").outerHeight(vyskaWidgetu - vyskaZahlavi);
        	}
        	
        	var resizeWidgetsFunc = function () {
        		gridster.resize_widget_dimensions({
        			widget_base_dimensions : [ ($("#idd8c30576d3886da284").width() / 2) - (2 * 10), 55 ],
        		});
        		$("#idd8c30576d3886da284 ul.grid").children("li").attr("style", "");
        	}
        	
        	// zaregistrujeme callback funkci pro resize widgetu, aby je bylo mozne resiznout widgety i z jinych mist aplikace
        	resizeWidgetsCallbackFunction = resizeWidgetsFunc;
        
        	var gridster = $("#idd8c30576d3886da284 ul.grid").gridster({
        		widget_selector : "li.gridsterItem",
        		margin : 10,
        		widget_base_dimensions : [ ($("#idd8c30576d3886da284").width() / 2) - (2 * 10), 55 ],
        		max_cols : 2,
        		resize : {
        			enabled : true,			
        			axes : [ 'x', 'y' ],
        			stop : function(event, ui, $widget) {
        //				console.log("resize stop");
        				resizeContentOfWidgets($widget);
        				resizeWidgets();
        				var s = JSON.stringify(this.serialize());
        				callback(s);
        			},
        			resize : function(e, ui, $widget) {
        				resizeContentOfWidgets($widget);
        			}
        		},
        		draggable : {
        			handle : '.fa-arrows',
        			stop : function(event, ui) {
        				var s = JSON.stringify(this.serialize());
        				callback(s);
        			}
        		},
        		serialize_params : function($w, wgd) {
        			return {
        				widget_id : $($w).attr('widget-id'),
        				col : wgd.col,
        				row : wgd.row,
        				size_x : wgd.size_x,
        				size_y : wgd.size_y
        			};
        		},
        	}).data("gridster");
        
        	$("#idd8c30576d3886da284 ul.grid li").each(function() {
        		resizeContentOfWidgets(this);
        	});
        
        	$(window).on("resize", function() {
        		setTimeout(function() {
        			resizeWidgetsFunc();
        		}, 500);
        	});
        })();;
        setMinimalContentSize();;
        ;});
        /*]]>*/
    </script>
    <style type="text/css">
        [data-col="3"] { left:1150px; }
        [data-col="2"] { left:580px; }
        [data-col="1"] { left:10px; }
        [data-row="24"] { top:1735px; }
        [data-row="23"] { top:1660px; }
        [data-row="22"] { top:1585px; }
        [data-row="21"] { top:1510px; }
        [data-row="20"] { top:1435px; }
        [data-row="19"] { top:1360px; }
        [data-row="18"] { top:1285px; }
        [data-row="17"] { top:1210px; }
        [data-row="16"] { top:1135px; }
        [data-row="15"] { top:1060px; }
        [data-row="14"] { top:985px; }
        [data-row="13"] { top:910px; }
        [data-row="12"] { top:835px; }
        [data-row="11"] { top:760px; }
        [data-row="10"] { top:685px; }
        [data-row="9"] { top:610px; }
        [data-row="8"] { top:535px; }
        [data-row="7"] { top:460px; }
        [data-row="6"] { top:385px; }
        [data-row="5"] { top:310px; }
        [data-row="4"] { top:235px; }
        [data-row="3"] { top:160px; }
        [data-row="2"] { top:85px; }
        [data-row="1"] { top:10px; }
        [data-sizey="1"] { height:55px; }
        [data-sizey="2"] { height:130px; }
        [data-sizey="3"] { height:205px; }
        [data-sizey="4"] { height:280px; }
        [data-sizey="5"] { height:355px; }
        [data-sizey="6"] { height:430px; }
        [data-sizey="7"] { height:505px; }
        [data-sizey="8"] { height:580px; }
        [data-sizey="9"] { height:655px; }
        [data-sizey="10"] { height:730px; }
        [data-sizey="11"] { height:805px; }
        [data-sizey="12"] { height:880px; }
        [data-sizey="13"] { height:955px; }
        [data-sizey="14"] { height:1030px; }
        [data-sizey="15"] { height:1105px; }
        [data-sizey="16"] { height:1180px; }
        [data-sizey="17"] { height:1255px; }
        [data-sizey="18"] { height:1330px; }
        [data-sizey="19"] { height:1405px; }
        [data-sizey="20"] { height:1480px; }
        [data-sizey="21"] { height:1555px; }
        [data-sizey="22"] { height:1630px; }
        [data-sizey="23"] { height:1705px; }
        [data-sizex="1"] { width:550px; }
        [data-sizex="2"] { width:1120px; }
    </style>
</head>

<body>
    <div id="id6386c0101171d2c485" hidden="" data-wicket-placeholder=""></div>
    <div class="modal fade logoutModal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal_lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Odhlášení</h4>
                </div>
                <div class="modal-body"> Delší dobu jste neprovedli žádnou aktivní činnost. Pokud si přejete v práci pokračovat, stiskněte tlačítko OK. Když tak neučiníte, dojde již za necelou minutu k odhlášení. </div>
                <div class="modal-footer"> <button type="button" class="btn greenBtn refreshConnection" id="id8abafacc3d0f19593a">OK</button><span hidden="" class="wicket-ajax-indicator" id="id8abafacc3d0f19593a--ajax-indicator"><img src="./ib-fio_files/indicator-ver-03CE3DCC84AF110E9DA8699A841E5200.gif" alt=""></span> </div>
            </div>
        </div>
    </div>
    <div class="wrapperPage">
        <div class="wrapperHeader">
            <div class="green_border"></div>
            <div class="container" style="margin-bottom: 20px;">
                <div class="row">
                    <div class="col-md-4" style="line-height: 50px;"> <a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-header-home~page"><img class="logo_header img-responsive" src="./ib-fio_files/logo_fio-ver-894B2A39F77CABA34D70A4AC4C0FE0B6.png"></a> </div>
                    <div class="col-md-4 nav_header text-center">
                        <form id="id710449b6f73855b73b" method="post" action="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-header-searchForm" class=""><input type="hidden" name="csrf_hf_id710449b6f73855b73b" id="csrf_hf_id710449b6f73855b73b" value="3mY3iVBxGxztxwvjGYZqcY4LNRKJMpgtPNAF2Ya9b2dFnHK1B1xVwxg5lPfCxqfa">
                            <div id="id710449b6f73855b73b_hf_0" hidden="" class="hidden-fields"></div>
                            <div class="input-group"> <span class="input-group-btn inputAddonPre" style="position: static;"> <button class="btn btn-search" type="submit" name="search" id="id6c330b34c0c05e2e3c"> <i class="fa fa-search"></i> </button><span hidden="" class="wicket-ajax-indicator" id="id6c330b34c0c05e2e3c--ajax-indicator"><img src="./ib-fio_files/indicator-ver-03CE3DCC84AF110E9DA8699A841E5200.gif" alt=""></span> <i class="fa fa-times deleteText" style="display: none;"></i> </span> <input class="form-control searchInput searchInputHeader" type="text" style="border-left: medium none;" value="" name="text" placeholder="Hledat v Internetbankingu a na webu Fio">
                                <div class="input-group-btn dropHover"> <button class="btn btn-default dropdown-toggle" type="button"> <i class="fa fa-angle-down bold"></i> </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li class="dropdown-header">Naposledy hledané</li>
                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-header-searchForm-querySelector-naposledyHledane-vyhledavaniView-0-queryLink"><span>6376678001</span></a></li>
                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-header-searchForm-querySelector-naposledyHledane-vyhledavaniView-1-queryLink"><span>1500</span></a></li>
                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-header-searchForm-querySelector-naposledyHledane-vyhledavaniView-2-queryLink"><span>Auto</span></a></li>
                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-header-searchForm-querySelector-naposledyHledane-vyhledavaniView-3-queryLink"><span>Auto tata</span></a></li>
                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-header-searchForm-querySelector-naposledyHledane-vyhledavaniView-4-queryLink"><span>55039121</span></a></li>
                                        <li class="divider"></li>
                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-header-searchForm-querySelector-rozsireneVyhledavaniLink">Přejít na rozšířené vyhledávání</a></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4 text-center" style="margin-top: 5px;">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="notifiBox newProduct"> <i class="fa fa-plus fa-lg"></i> <a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-header-novyProdukt">Nový produkt</a> </div>
                            </div>
                            <div class="col-md-2" style="border-right: 1px solid #ddd; border-left: 1px solid #ddd;">
                                <div class="zpravy inline notifiBox"> <a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-header-messagesLink" class="mesEnvelope"> <i class="fa fa-envelope-o fa-lg"></i> <span class="label bgRed" style="position: absolute; top: -8px; right: -8px;">220</span> </a> </div>
                            </div>
                            <div class="col-md-6">
                                <div class="top_menu_name">Prijmeni, Jmeno</div>
                                <ul class="top_menu pull-right">
                                    <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-header-nastaveniLink">Nastavení</a></li>
                                    <li><a href="logout.php">Odhlásit</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container wrapperBody">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row menu">
                        <div class="col-md-2">
                            <div role="navigation" class="btn-group btnChevron dropHover" style="width: 100%">
                                <div class="btn-menu btnSingleAcc">
                                    <div class="pull-left">Prijmeni, Jmeno</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-10 menu-topBox" role="navigation">
                            <div>
                                <div class="menu-top">
                                    <div class="btn-group noDropdown">
                                        <ul>
                                            <li> <a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-dashboardLink" class="btn btn-menu dropdown-toggle btn-sm"> <span class="jmeno_dropdown">Nástěnka</span> </a> </li>
                                        </ul>
                                    </div>
                                    <div class="btn-group dropHover">
                                        <div class="btn btn-menu btn-sm">
                                            <div class="jmeno_dropdown"> Poslat peníze </div> <i class="fa fa-angle-down caret-nav"></i>
                                        </div>
                                        <div class="dropdown-menu dropdown-nav">
                                            <div class="clearfix">
                                                <div class="pull-left dropdown_box" style="width: 49%">
                                                    <div class="dropdown_nadpis"> Jednorázově </div>
                                                    <ul>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-poslatPenizeMenu-poslatPenizeCeskyKlient-prevodMeziUctyUFioBanky">Převod uvnitř Fio banky <span class="text-muted"> (ve všech měnách) </span> </a></li>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-poslatPenizeMenu-poslatPenizeCeskyKlient-prevodMeziMymiUcty">Převod mezi mými účty</a></li>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-poslatPenizeMenu-poslatPenizeCeskyKlient-tuzemskaPlatba">Tuzemská platba</a></li>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-poslatPenizeMenu-poslatPenizeCeskyKlient-zaplatMi">Zaplať mi</a></li>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-poslatPenizeMenu-poslatPenizeCeskyKlient-platbaDoSR">Platba do SR</a></li>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-poslatPenizeMenu-poslatPenizeCeskyKlient-europlatba">Europlatba</a></li>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-poslatPenizeMenu-poslatPenizeCeskyKlient-zahranicni">Zahraniční platba</a></li>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-poslatPenizeMenu-poslatPenizeCeskyKlient-hromadnyPokyn">Hromadný příkaz</a></li>
                                                        <li><span class="disableMenuLink tooltipMarker" data-tippy-content="Na podání pokynu musíte mít podepsanou rámcovou smlouvu - investiční." data-tippy-placement="right" aria-label="Na podání pokynu musíte mít podepsanou rámcovou smlouvu - investiční.">Nákup podílových listů</span></li>
                                                        <li><span class="disableMenuLink tooltipMarker" data-tippy-content="Na podání pokynu musíte mít podepsanou rámcovou smlouvu - investiční." data-tippy-placement="right" aria-label="Na podání pokynu musíte mít podepsanou rámcovou smlouvu - investiční.">Nákup dluhopisů</span></li>
                                                    </ul>
                                                </div>
                                                <div class="pull-left dropdown_box" style="width: 49%">
                                                    <div class="dropdown_nadpis"> Pravidelně </div>
                                                    <ul>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-poslatPenizeMenu-poslatPenizeCeskyKlient-trvalyPrikaz">Trvalý příkaz k úhradě</a></li>
                                                        <li><span data-tippy-content="Nemáte žádný účet, ze kterého lze podat daný typ pokynu." data-tippy-placement="right" aria-label="Nemáte žádný účet, ze kterého lze podat daný typ pokynu." class="tooltipMarker disableMenuLink">Euro trvalý příkaz k úhradě</span></li>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-poslatPenizeMenu-poslatPenizeCeskyKlient-sipo">SIPO</a></li>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-poslatPenizeMenu-poslatPenizeCeskyKlient-souhlasSInkasem">Souhlas s inkasem</a></li>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-poslatPenizeMenu-poslatPenizeCeskyKlient-souhlasSInkasemSepa">Souhlas s inkasem SEPA</a></li>
                                                        <li><span class="disableMenuLink tooltipMarker" data-tippy-content="Na podání pokynu musíte mít podepsanou rámcovou smlouvu - investiční." data-tippy-placement="right" aria-label="Na podání pokynu musíte mít podepsanou rámcovou smlouvu - investiční.">Pravidelný nákup podílových listů</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <hr class="dropMenu-hr">
                                            <div class="clearfix">
                                                <div class="pull-left dropdown_box">
                                                    <div class="dropdown_nadpis"> Ostatní </div>
                                                    <ul>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-poslatPenizeMenu-poslatPenizeCeskyKlient-prikazKInkasu"> Příkaz k inkasu <span class="text-muted"> (vy chcete inkasovat od jiné osoby) </span> </a></li>
                                                        <li><span data-tippy-content="Nemáte žádný účet, ze kterého lze podat daný typ pokynu." data-tippy-placement="right" aria-label="Nemáte žádný účet, ze kterého lze podat daný typ pokynu." class="tooltipMarker disableMenuLink">Příkaz k inkasu SEPA</span></li>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-poslatPenizeMenu-poslatPenizeCeskyKlient-importPrikazu">Import plateb a inkas</a></li>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-poslatPenizeMenu-poslatPenizeCeskyKlient-dobitiKreditu">Dobití kreditu</a></li>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-poslatPenizeMenu-poslatPenizeCeskyKlient-avizo">Avízo výběru na pokladně</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-group dropHover">
                                        <div class="btn btn-menu btn-sm">
                                            <div class="jmeno_dropdown"> Přehledy </div> <i class="fa fa-angle-down caret-nav"></i>
                                        </div>
                                        <div style="width: 335px;" class="dropdown-menu dropdown-nav">
                                            <div class="clearfix">
                                                <div class="pull-left dropdown_box">
                                                    <div class="dropdown_nadpis"></div>
                                                    <ul>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-prehledyContainer-pohyby">Pohyby na účtu</a></li>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-prehledyContainer-karetniTransakce">Karetní transakce</a></li>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-prehledyContainer-zustatky">Zůstatky</a></li>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-prehledyContainer-trvalePrikazy"> Trvalé příkazy</a></li>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-prehledyContainer-inkasaSipa">Inkasa a SIPO</a></li>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-prehledyContainer-vypisy">Výpisy z účtu</a></li>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-prehledyContainer-planovane~platby">Plánované platby</a></li>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-prehledyContainer-odmitnuteAStornovanePokyny">Odmítnuté a zrušené platby</a></li>
                                                        <li><a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-prehledyContainer-kPodpisu">Příkazy k podpisu</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-group dropHover">
                                        <div class="btn btn-menu btn-sm">
                                            <div class="jmeno_dropdown"> Platební karty </div> <i class="fa fa-angle-down caret-nav"></i>
                                        </div>
                                        <div style="width: 335px;" class="dropdown-menu dropdown-nav">
                                            <div class="clearfix">
                                                <div class="pull-left dropdown_box">
                                                    <div class="dropdown_nadpis"></div>
                                                    <ul>
                                                        <li> <a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-kartyContainer-prehledKaret"> Přehled karet </a> </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <hr class="dropMenu-hr">
                                            <div class="clearfix">
                                                <div class="pull-left dropdown_box">
                                                    <ul>
                                                        <li> <a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-kartyContainer-karty-0-link"> Fio MC Debit Contactless CZK </a> </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-group noDropdown">
                                        <ul>
                                            <li> <a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-sablony" class="btn btn-menu dropdown-toggle btn-sm"> <span class="jmeno_dropdown">Šablony</span> </a> </li>
                                        </ul>
                                    </div>
                                    <div class="btn-group pull-right noDropdown">
                                        <ul>
                                            <li> <a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-ucetInfo" class="btn btn-menu dropdown-toggle btn-sm"> <span class="jmeno_dropdown">Informace o účtu</span> </a> </li>
                                        </ul>
                                    </div>
                                    <div class="btn-group noDropdown">
                                        <ul>
                                            <li> <a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-menu-investiceLink" class="btn btn-menu dropdown-toggle btn-sm"> <span class="jmeno_dropdown">Investice</span> </a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 wrapper">
                    <div id="idd4efd7c87c67933686">
                        <div class="row dashboardAlert">
                            <div class="col-md-12">
                                <div class="alert alert-yellow">
                                    <div id="idaec8482d93340e8f87">
                                        <h4> <i class="fa fa-exclamation-triangle"></i> Upozornění </h4>
                                        <ul>
                                            <li id="idaabaed0735a402b0d"><span>22.11.2017 21:04:41 - Upozornění na prioritní zprávu: MasterCard Business pro podnikatele a firmy zdarma</span> <a id="id12b39bf477491f7e3d" href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2#">(detail zprávy) </a> </li>
                                            <li id="ida1b4138fa5fbaba7e"><span>02.12.2020 06:52:09 - Upozornění na prioritní zprávu: Podvodníci se vydávají v telefonu za Fio banku</span> <a id="id24b90e0580ebade63e" href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2#">(detail zprávy) </a> </li>
                                            <li id="id0db595658d011a38f"><span>07.09.2019 09:02:50 - Upozornění na prioritní zprávu: Podílové fondy nově v Internetbankingu - investujte snadno online</span> <a id="iddb3aa7dcb42f087e3f" href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2#">(detail zprávy) </a> </li>
                                            <li id="id0cd3b21eb2611f2010"><span>15.12.2020 16:10:03 - Upozornění na prioritní zprávu: Silné ověření klienta - platby kartou v e-shopech a autorizace plateb s menšími částkami přes Internetbanking</span> <a id="idface306e519c99e540" href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2#">(detail zprávy) </a> </li>
                                            <li id="id6d0b3632c332688c11"><span>30.09.2021 13:16:18 - Upozornění na prioritní zprávu: Stěhování pobočky z pasáže Millenium Plaza</span> <a id="id20a4b4f26789feb241" href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2#">(detail zprávy) </a> </li>
                                            <li id="id9f8c0b67d0f161e212"><span>10.02.2021 08:40:34 - Upozornění na prioritní zprávu: Do Fio globálního akciového fondu je možné investovat nově i v eurech</span> <a id="idae0a0af4145a688f42" href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2#">(detail zprávy) </a> </li>
                                            <li id="id85afda2f0d2d8cce13"><span>10.02.2021 08:40:34 - Upozornění na prioritní zprávu: Nově nabízíme splátkové úvěry pro spotřebitele</span> <a id="idfa276c28743cdb7e43" href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2#">(detail zprávy) </a> </li>
                                            <li id="ide81d29c6ae5f3c9e14"><span>08.07.2021 08:39:09 - Upozornění na prioritní zprávu: VISA kartou výběry z bankomatů po celém světě zdarma</span> <a id="idddadf463bd463a1844" href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2#">(detail zprávy) </a> </li>
                                            <li id="id8e77fc396c76aa4f15"><span>08.07.2021 08:39:09 - Upozornění na prioritní zprávu: Informace o automatické obnově platební karty</span> <a id="idce4df07f0f0cadfe45" href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2#">(detail zprávy) </a> </li>
                                            <li id="id570c304be9c60b2016"><span>18.03.2023 10:32:57 - Upozornění na prioritní zprávu: Aktualizace Vašich údajů</span> <a id="ide4de84eb789916ec46" href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2#">(detail zprávy) </a> </li>
                                            <li id="id32b78870dcb2d54817"><span>08.10.2017 18:39:55 - Upozornění na prioritní zprávu: Některé platby nově pošlete i bez autorizace</span> <a id="id1d8dfcec9f9941b347" href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2#">(detail zprávy) </a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="row" style="min-height: 100px;">
                            <div class="col-md-12">
                                <div class="indexZustatkyBox">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="row balanceRow">
                                                <div class="col-sm-6 balanceLabel"> Disponibilní zůstatek: </div>
                                                <div class="col-sm-6 balanceSum availableBalance"> 3&nbsp;540&nbsp;399,12&nbsp;CZK </div>
                                            </div>
                                            <div class="row balanceRow">
                                                <div class="col-sm-6 balanceLabel"> Běžný zůstatek: </div>
                                                <div class="col-sm-6 balanceSum"> 151&nbsp;149,42&nbsp;CZK </div>
                                            </div>
                                            <div>
                                                <div class="row balanceRow">
                                                    <div class="col-sm-6 balanceLabel"> Blokovaná částka: </div>
                                                    <div class="col-sm-6 balanceSum"> 251,30&nbsp;CZK </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="border-left: 1px solid rgb(238, 238, 238); border-right: 1px solid rgb(238, 238, 238);">
                                            <div class="row">
                                                <div class="col-sm-4 balanceLabel"> Číslo účtu: </div>
                                                <div class="col-sm-8 balanceSum"> <span>2819003243 / 2010</span> <!-- account number -->
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4 balanceLabel"> IBAN: </div>
                                                <div class="col-sm-8 balanceSum"> <span>CZ58 2010 0000 0028 1900 3243</span> </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4 balanceLabel"> BIC/SWIFT: </div>
                                                <div class="col-sm-8 balanceSum"> <span>FIOBCZPPXXX</span> </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div>
                                                <div class="AdDashboardHeader">Spočítejte si hypotéku</div>
                                                <div class="AdDashboardText pull-left" style="width: 80%"><a target="_blank" href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-zustatky-reklama-container-linkText"> <span>Pořiďte si hypotéku bez poplatků. Spočítejte si svoji splátku a snižte si její výši s Hypospořicím kontem.</span></a></div>
                                                <div class="AdSmallImg pull-right"> <a target="_blank" href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-zustatky-reklama-container-linkObrazek"> <img src="./ib-fio_files/66x60_Fio_hypoteka_dum.png"> </a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="idd8c30576d3886da284" class="gridsterPanel">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="gridster ready">
                                    <ul class="grid" style="height: 1575px; width: 1140px; position: relative;">
                                        <li id="id059ebaf14dab55e088" widget-id="1" data-row="1" data-col="1" data-sizex="2" data-sizey="9" class="gridsterItem gs-w" style="">
                                            <div id="id854d80c5a871b6e062">
                                                <div class="widget_boxHeader">
                                                    <h4 class="pull-left"> <a id="ide347b76dec663e8f48" href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2#"><span>Pohyby na účtu</span></a><span hidden="" class="wicket-ajax-indicator" id="ide347b76dec663e8f48--ajax-indicator"><img src="./ib-fio_files/indicator-ver-03CE3DCC84AF110E9DA8699A841E5200.gif" alt=""></span> </h4>
                                                    <div class="widget_tools pull-right"> <i class="fa fa-times pull-right tooltipMarker" id="idf3e8186c4015904949" data-tippy-content="Odstranit přehled" data-tippy-placement="top" aria-label="Odstranit přehled"></i> <i class="fa fa-arrows pull-right tooltipMarker" style="cursor: move;" data-tippy-content="Přesunout přehled" data-tippy-placement="top" aria-label="Přesunout přehled"></i>
                                                        <div class="btn-group pull-right dropdownCloseBox"> <i class="fa fa-cog dropdownCloseBtn tooltipMarker" data-tippy-content="Nastavení přehledu" data-tippy-placement="top" aria-label="Nastavení přehledu"></i>
                                                            <div class="dropdown-menu widgetSettings dropdownClose" style="display: none;">
                                                                <div>
                                                                    <form id="id3c57cb705032e91c4a" method="post" action="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-widgets-widgets-0-widget-settings-form"><input type="hidden" name="csrf_hf_id3c57cb705032e91c4a" id="csrf_hf_id3c57cb705032e91c4a" value="fIKrClWPzhVAzzCaKlivE1b1jP8XkYkawBN85Dxfz3gBRXcF7mxnOeYg7otk52RG">
                                                                        <div id="id3c57cb705032e91c4a_hf_0" hidden="" class="hidden-fields"></div>
                                                                        <div class="form-group"> <label>Zobrazený počet (min. 1, max. 2000)</label> <input type="text" class="form-control input-sm" value="20" name="maxNumOfRows"> </div> <label>Zobrazené období</label>
                                                                        <div class="radio"> <label><input type="radio" class="radios radioROK" id="id49fc080a37a3dd8189" name="obdobiPohybu" value="radio0"> <span>Poslední rok</span></label> </div>
                                                                        <div class="radio"> <label><input type="radio" class="radios radioMESIC" id="idd1a948c401a27e0b8a" name="obdobiPohybu" value="radio1" checked="checked"> <span>Poslední měsíc</span></label> </div>
                                                                        <div class="radio"> <label><input type="radio" class="radios radioTYDEN" id="id1f68f67e20b453128b" name="obdobiPohybu" value="radio2"> <span>Poslední týden</span></label> </div>
                                                                        <div> <label>Zobrazené sloupce</label>
                                                                            <ul class="selectColumnsUl">
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="id4118be143485d66718" name="vyberSloupcu:checkGroup" value="check3" checked="checked"> <label for="id4118be143485d66718">Akce</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="id1ccc8df7b6d0b4fa19" name="vyberSloupcu:checkGroup" value="check4" checked="checked"> <label for="id1ccc8df7b6d0b4fa19">Částka</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="id0e0d767d7d5c5f981a" name="vyberSloupcu:checkGroup" value="check5" checked="checked"> <label for="id0e0d767d7d5c5f981a">Datum</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="idd454aa5ad59189c21b" name="vyberSloupcu:checkGroup" value="check6"> <label for="idd454aa5ad59189c21b">ID operace</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="id742c46e3b1cd34231c" name="vyberSloupcu:checkGroup" value="check7"> <label for="id742c46e3b1cd34231c">ID pokynu</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="id9c7838274d7f292d1d" name="vyberSloupcu:checkGroup" value="check8"> <label for="id9c7838274d7f292d1d">KS</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="id36e23e316ac8b2cb1e" name="vyberSloupcu:checkGroup" value="check9"> <label for="id36e23e316ac8b2cb1e">Logo</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="id8fcb04f8c078bceb1f" name="vyberSloupcu:checkGroup" value="check10"> <label for="id8fcb04f8c078bceb1f">Název banky</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="idb582905adde32bab20" name="vyberSloupcu:checkGroup" value="check11"> <label for="idb582905adde32bab20">Název protiúčtu</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="id0686b440d59a7e1021" name="vyberSloupcu:checkGroup" value="check12" checked="checked"> <label for="id0686b440d59a7e1021">Poznámka</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="idd7233f3f51ebb25a22" name="vyberSloupcu:checkGroup" value="check13" checked="checked"> <label for="idd7233f3f51ebb25a22">Protiúčet</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="idb275eaf92e2772f623" name="vyberSloupcu:checkGroup" value="check14"> <label for="idb275eaf92e2772f623">Reference plátce</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="id3157894211482c5224" name="vyberSloupcu:checkGroup" value="check15"> <label for="id3157894211482c5224">SS</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="id476146d8fcbf102e25" name="vyberSloupcu:checkGroup" value="check16" checked="checked"> <label for="id476146d8fcbf102e25">Symboly</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="id25db328cd0fd029926" name="vyberSloupcu:checkGroup" value="check17" checked="checked"> <label for="id25db328cd0fd029926">Typ</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="iddb91d91454b3927c27" name="vyberSloupcu:checkGroup" value="check18"> <label for="iddb91d91454b3927c27">Upřesnění</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="id68c7631dd0c43b4728" name="vyberSloupcu:checkGroup" value="check19"> <label for="id68c7631dd0c43b4728">VS</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="id51e98cb46383ffab29" name="vyberSloupcu:checkGroup" value="check20"> <label for="id51e98cb46383ffab29">Zadal</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="id5b94f7f33973c1782a" name="vyberSloupcu:checkGroup" value="check21"> <label for="id5b94f7f33973c1782a">Zpráva pro příjemce</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        <hr> <input type="checkbox" name="rozkopirovatNaVsechnyUctyCheckBox" id="id65227a6ba62bf97d8c"> <label for="id65227a6ba62bf97d8c">Nastavit na všechny účty</label> <i class="fa fa-question-circle green tooltipMarker" style="cursor: default;" data-tippy-content="Týká se všech účtů včetně nezobrazených." data-tippy-placement="top" aria-label="Týká se všech účtů včetně nezobrazených."></i>
                                                                        <hr>
                                                                        <div class="text-left"> <button class="btn greenBtn btn-sm" id="idda9c05923907c69e4b" type="button"> Zobrazit </button> </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="clearfix"></div>
												<!-- tabulka transakci -->
												<?php include("transactions.html"); ?>
												<!-- tabulka transakci stop -->
                                            </div> <span class="gs-resize-handle gs-resize-handle-x"></span><span class="gs-resize-handle gs-resize-handle-y"></span><span class="gs-resize-handle gs-resize-handle-x"></span><span class="gs-resize-handle gs-resize-handle-y"></span>
                                        </li>
                                        <li id="id4348c5436d8cba76e3" widget-id="2" data-row="10" data-col="1" data-sizex="1" data-sizey="2" class="gridsterItem gs-w" style="">
                                            <div id="idf6339393eb2379f168">
                                                <div class="widget_boxHeader">
                                                    <h4 class="pull-left"> <a id="idc808ca3560af22e363" href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2#"><span>Plánované platby</span></a><span hidden="" class="wicket-ajax-indicator" id="idc808ca3560af22e363--ajax-indicator"><img src="./ib-fio_files/indicator-ver-03CE3DCC84AF110E9DA8699A841E5200.gif" alt=""></span> </h4>
                                                    <div class="widget_tools pull-right"> <i class="fa fa-times pull-right tooltipMarker" id="id95463a14b23fc30364" data-tippy-content="Odstranit přehled" data-tippy-placement="top" aria-label="Odstranit přehled"></i> <i class="fa fa-arrows pull-right tooltipMarker" style="cursor: move;" data-tippy-content="Přesunout přehled" data-tippy-placement="top" aria-label="Přesunout přehled"></i>
                                                        <div class="btn-group pull-right dropdownCloseBox"> <i class="fa fa-cog dropdownCloseBtn tooltipMarker" data-tippy-content="Nastavení přehledu" data-tippy-placement="top" aria-label="Nastavení přehledu"></i>
                                                            <div class="dropdown-menu widgetSettings dropdownClose" style="display: none;">
                                                                <div>
                                                                    <form id="id2a98e3e9e8dc140365" method="post" action="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-widgets-widgets-1-widget-settings-form"><input type="hidden" name="csrf_hf_id2a98e3e9e8dc140365" id="csrf_hf_id2a98e3e9e8dc140365" value="1vSdDummPb8d8Z39SkIRf3552WnT0ZFrM7i6GPieLLgSXv3QACgh03pAtf1RqQ8K">
                                                                        <div id="id2a98e3e9e8dc140365_hf_0" hidden="" class="hidden-fields"></div>
                                                                        <div class="form-group"> <label>Zobrazený počet (min. 1, max. 40)</label> <input type="text" class="form-control input-sm" value="5" name="maxRows"> </div>
                                                                        <div> <label>Zobrazené sloupce</label>
                                                                            <ul class="selectColumnsUl">
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="id6a0ec784039cf2c12b" name="vyberSloupcu:checkGroup" value="check22" checked="checked"> <label for="id6a0ec784039cf2c12b">Akce</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="idf56f0ae881ce7f702c" name="vyberSloupcu:checkGroup" value="check23"> <label for="idf56f0ae881ce7f702c">Autorizoval</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="id638eb229bc22f7022d" name="vyberSloupcu:checkGroup" value="check24"> <label for="id638eb229bc22f7022d">Autorizováno</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="idd12d676a21e1a5ed2e" name="vyberSloupcu:checkGroup" value="check25" checked="checked"> <label for="idd12d676a21e1a5ed2e">Částka</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="idbaff5b19e0b5bc332f" name="vyberSloupcu:checkGroup" value="check26" checked="checked"> <label for="idbaff5b19e0b5bc332f">Datum</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="iddab89fe21f84b28b30" name="vyberSloupcu:checkGroup" value="check27"> <label for="iddab89fe21f84b28b30">Identifikátor</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="id67e73ab1ae3715e831" name="vyberSloupcu:checkGroup" value="check28"> <label for="id67e73ab1ae3715e831">KS</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="id4cb0ce81104b39ee32" name="vyberSloupcu:checkGroup" value="check29" checked="checked"> <label for="id4cb0ce81104b39ee32">Poznámka</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="idfdf784bb2c9f894c33" name="vyberSloupcu:checkGroup" value="check30" checked="checked"> <label for="idfdf784bb2c9f894c33">Protiúčet</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="id39f6c4c6b0de901b34" name="vyberSloupcu:checkGroup" value="check31"> <label for="id39f6c4c6b0de901b34">SS</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="id8d8fce6e348fb19435" name="vyberSloupcu:checkGroup" value="check32" checked="checked"> <label for="id8d8fce6e348fb19435">Symboly</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="idcf72695f1842d2b236" name="vyberSloupcu:checkGroup" value="check33"> <label for="idcf72695f1842d2b236">Typ</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="idd73afbd31299018737" name="vyberSloupcu:checkGroup" value="check34"> <label for="idd73afbd31299018737">VS</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="id5c41e27da2d383c738" name="vyberSloupcu:checkGroup" value="check35"> <label for="id5c41e27da2d383c738">Zadal</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="btn-group dropLiBox">
                                                                                        <div class="checkbox"> <input type="checkbox" id="idc95a7a54f89a770b39" name="vyberSloupcu:checkGroup" value="check36"> <label for="idc95a7a54f89a770b39">Zpráva pro příjemce</label> </div>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        <hr> <input type="checkbox" name="rozkopirovatNaVsechnyUctyCheckBox" id="idfc5a8a55f7350e1ae4"> <label for="idfc5a8a55f7350e1ae4">Nastavit na všechny účty</label> <i class="fa fa-question-circle green tooltipMarker" style="cursor: default;" data-tippy-content="Týká se všech účtů včetně nezobrazených." data-tippy-placement="top" aria-label="Týká se všech účtů včetně nezobrazených."></i>
                                                                        <hr>
                                                                        <div class="text-left"> <button class="btn greenBtn btn-sm" id="id232602e24d0bca8f66" type="button"> Zobrazit </button> </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="clearfix"></div>
												<!-- Planovane platby -->
												<?php include("futurePaiments.html") ?>
												<!-- Planovane platby stop -->
                                            </div> <span class="gs-resize-handle gs-resize-handle-x"></span><span class="gs-resize-handle gs-resize-handle-y"></span><span class="gs-resize-handle gs-resize-handle-x"></span><span class="gs-resize-handle gs-resize-handle-y"></span>
                                        </li>
                                        <li id="ideb762b2d59dbaa16e5" widget-id="3" data-row="10" data-col="2" data-sizex="1" data-sizey="2" class="gridsterItem gs-w" style="">
                                            <div id="id0b61fa8c7ee8859e6e">
                                                <div class="widget_boxHeader">
                                                    <h4 class="pull-left"> <a id="idd770201a344e441a69" href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2#"><span>Platební karta</span></a><span hidden="" class="wicket-ajax-indicator" id="idd770201a344e441a69--ajax-indicator"><img src="./ib-fio_files/indicator-ver-03CE3DCC84AF110E9DA8699A841E5200.gif" alt=""></span> </h4>
                                                    <div class="widget_tools pull-right"> <i class="fa fa-times pull-right tooltipMarker" id="id6ec69a5472aae19f6a" data-tippy-content="Odstranit přehled" data-tippy-placement="top" aria-label="Odstranit přehled"></i> <i class="fa fa-arrows pull-right tooltipMarker" style="cursor: move;" data-tippy-content="Přesunout přehled" data-tippy-placement="top" aria-label="Přesunout přehled"></i>
                                                        <div class="btn-group pull-right dropdownCloseBox"> <i class="fa fa-cog dropdownCloseBtn tooltipMarker" data-tippy-content="Nastavení přehledu" data-tippy-placement="top" aria-label="Nastavení přehledu"></i>
                                                            <div class="dropdown-menu widgetSettings dropdownClose" style="display: none;">
                                                                <div>
                                                                    <form id="idda32ac7f2d7ec83d6c" method="post" action="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-widgets-widgets-2-widget-settings-form"><input type="hidden" name="csrf_hf_idda32ac7f2d7ec83d6c" id="csrf_hf_idda32ac7f2d7ec83d6c" value="FO3kAemJBK27LtEzuhx9fDYdW3LNR2ZTQuj1KmY6JWHimt9uhVkE59nmctmtGbST">
                                                                        <div id="idda32ac7f2d7ec83d6c_hf_0" hidden="" class="hidden-fields"></div>
                                                                        <div class="form-group"> <label id="id8990efa16af5ff626b-w-lbl" for="id8990efa16af5ff626b"></label>
                                                                            <div class="dropdown bootstrap-select form-control bs3"><select class="form-control" name="karta" id="id8990efa16af5ff626b">
                                                                                    <option selected="selected" value="873559647">Fio MC Debit Contactless CZK</option>
                                                                                </select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-default" data-toggle="dropdown" role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox" aria-expanded="false" data-id="id8990efa16af5ff626b" title="Fio MC Debit Contactless CZK">
                                                                                    <div class="filter-option">
                                                                                        <div class="filter-option-inner">
                                                                                            <div class="filter-option-inner-inner">Fio MC Debit Contactless CZK</div>
                                                                                        </div>
                                                                                    </div><span class="bs-caret"><span class="caret"></span></span>
                                                                                </button>
                                                                                <div class="dropdown-menu open">
                                                                                    <div class="inner open" role="listbox" id="bs-select-1" tabindex="-1">
                                                                                        <ul class="dropdown-menu inner " role="presentation"></ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="text-left"> <button class="btn greenBtn btn-sm" id="idab44e23a6d8851726d" type="button"> Zobrazit </button><span hidden="" class="wicket-ajax-indicator" id="idab44e23a6d8851726d--ajax-indicator"><img src="./ib-fio_files/indicator-ver-03CE3DCC84AF110E9DA8699A841E5200.gif" alt=""></span> </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="clearfix"></div>
												<!-- Platebni karty -->
												<?php include("cards.html"); ?>
												<!-- Platebni karty stop -->
                                            </div> <span class="gs-resize-handle gs-resize-handle-x"></span><span class="gs-resize-handle gs-resize-handle-y"></span><span class="gs-resize-handle gs-resize-handle-x"></span><span class="gs-resize-handle gs-resize-handle-y"></span>
                                        </li>
                                        <li id="id2d45b68279f11a72e6" widget-id="5" data-row="17" data-col="1" data-sizex="1" data-sizey="5" class="gridsterItem gs-w" style="">
											<!-- Detail karty -->
											<?php include("cardInfo.html"); ?>
											<!-- Detail karty stop -->
                                             <span class="gs-resize-handle gs-resize-handle-x"></span><span class="gs-resize-handle gs-resize-handle-y"></span><span class="gs-resize-handle gs-resize-handle-x"></span><span class="gs-resize-handle gs-resize-handle-y"></span>
                                        </li>
                                        <li id="id3f43badc5b5ec127e7" widget-id="4" data-row="12" data-col="1" data-sizex="2" data-sizey="5" class="gridsterItem gs-w" style="">
											<!-- Graf -->
											<?php include("chart.php"); ?>
											<!-- Graf stop -->
                                             <span class="gs-resize-handle gs-resize-handle-x"></span><span class="gs-resize-handle gs-resize-handle-y"></span><span class="gs-resize-handle gs-resize-handle-x"></span><span class="gs-resize-handle gs-resize-handle-y"></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 20px;">
                            <div class="col-xs-12">
                                <div class="add_widget" id="id0a1f05ace359b6d283"> <i class="fa fa-plus"></i> Přidat přehled </div>
                            </div>
                        </div>
                        <div id="id9064270d3ea0422fea" hidden="" data-wicket-placeholder=""></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapperFooter">
            <div class="green_border" style="margin-top: 25px; margin-bottom: 0px;"></div>
            <div class="grey_footer">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 gfBox" style="padding-left: 0px"> <a style="margin-left: 20px" href="https://ib.fio.cz/ib/fio/page/fioservis-zadani"> <i class="fa fa-envelope-o fa-lg"></i> Napište nám přes <strong>Fio servis</strong> </a> </div>
                        <div class="col-sm-6 text-right gfBox"> <a style="border-right: 1px solid #999; margin-right: 15px; padding-right: 15px;" href="https://ib.fio.cz/ib/fio/page/kurzovni-listek"> <i class="fa fa-eur fa-lg"></i> Kurzovní lístek </a> <a href="https://ib.fio.cz/ib/fio/page/log"> <i class="fa fa-lock fa-lg"></i> Historie přístupů </a> </div>
                    </div>
                </div>
            </div>
            <div class="grey2_footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 gfBox">
                            <div> <strong>Vaše pobočka</strong> <a href="https://www.fio.cz/o-nas/kontakty" target="_blank">(zobrazit všechny)</a> </div>
                            <div> <span class="footBranch">Praha 1, Havlíčkova 1028/5, 110 00 </span> <span class="footBranch">tel.: <strong>224 346 938, 939, 940, linka 989 - pokladna</strong></span> <span class="footBranch">praha.millennium@fio.cz</span> <span class="footBranch"> <a href="https://www.fio.cz/o-nas/kontakty/316150-Praha---Millennium" target="_blank"> <i class="fa fa-external-link"></i></a> </span> </div>
                        </div>
                        <div class="col-md-4 text-right gfBox footCopy">
                            <div class="footerLangs"> <a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-footer-footerCZ-langCz"><img src="./ib-fio_files/VlajkaCzVelka-ver-09793143F96B19AF735C707E3069487F.png"></a> <a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-footer-footerCZ-langSk"><img src="./ib-fio_files/VlajkaSkVelka-ver-1EBB0CE03A92206BDAFCA4BB95AA9154.png"></a> <a href="https://ib.fio.cz/ib/fio/page/nastenka-bankovni?2-1.-footer-footerCZ-langGb"><img src="./ib-fio_files/VlajkaGbVelka-ver-33A79546E65BF38629EC0BF90A0BCC3D.png"></a> </div>
                            <div> <span>©</span> <span>2023</span> <span style="margin-right: 10px">Fio banka</span> <span><a target="_blank" href="https://www.fio.cz/spolecnost_dokumenty_ostatni_pravniProhlaseni.php">Právní prohlášení</a></span> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="overlayImgZoom"></div>
    <div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div><svg width="0" height="0" style="position: absolute; left: -99999px; top: -99999px;"><text font-style="normal" font-variant="normal" font-family="Verdana, Helvetica, Arial, sans-serif" font-size="12" font-weight="normal" letter-spacing="normal" text-decoration="none">149 529,91 CZK</text>
        <defs></defs>
        <g></g>
        <g></g>
    </svg>
</body>

</html>