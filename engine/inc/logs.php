<?php
/*
=====================================================
 DataLife Engine - by SoftNews Media Group 
-----------------------------------------------------
 http://dle-news.ru/
-----------------------------------------------------
 Copyright (c) 2004,2013 SoftNews Media Group
=====================================================
 ������ ��� ������� ���������� �������
=====================================================
 ����: logs.php
-----------------------------------------------------
 ����������: ������ �������� � �����������
=====================================================
*/
if( !defined( 'DATALIFEENGINE' ) OR !defined( 'LOGGED_IN' ) ) {
	die( "Hacking attempt!" );
}
if( $member_id['user_group'] != 1 ) {
	msg( "error", $lang['addnews_denied'], $lang['db_denied'] );
}


if ( file_exists( ROOT_DIR . '/language/' . $selected_language . '/adminlogs.lng' ) ) {
	require_once (ROOT_DIR . '/language/' . $selected_language . '/adminlogs.lng');
}

$start_from = intval( $_REQUEST['start_from'] );
$news_per_page = 50;

if( $start_from < 0 ) $start_from = 0;

$thisdate = $_TIME - (30 * 3600 * 24);

$db->query( "DELETE FROM " . USERPREFIX . "_admin_logs WHERE date < '{$thisdate}'" );

echoheader( "", "" );

if( $action == "auth") $lang['opt_logsc'] = $lang['admin_logs_auth'];
	
	echo <<<HTML
<script language="javascript" type="text/javascript">
<!--
function popupedit( name ){

		var rndval = new Date().getTime(); 

		$('body').append('<div id="modal-overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: #666666; opacity: .40;filter:Alpha(Opacity=40); z-index: 999; display:none;"></div>');
		$('#modal-overlay').css({'filter' : 'alpha(opacity=40)'}).fadeIn('slow');
	
		$("#dleuserpopup").remove();
		$("body").append("<div id='dleuserpopup' title='{$lang['user_edhead']}' style='display:none'></div>");
	
		$('#dleuserpopup').dialog({
			autoOpen: true,
			width: 560,
			height: 500,
			dialogClass: "modalfixed",
			buttons: {
				"{$lang['user_can']}": function() { 
					$(this).dialog("close");
					$("#dleuserpopup").remove();							
				},
				"{$lang['user_save']}": function() { 
					document.getElementById('edituserframe').contentWindow.document.getElementById('saveuserform').submit();							
				}
			},
			open: function(event, ui) { 
				$("#dleuserpopup").html("<iframe name='edituserframe' id='edituserframe' width='100%' height='400' src='{$PHP_SELF}?mod=editusers&action=edituser&user=" + name + "&rndval=" + rndval + "' frameborder='0' marginwidth='0' marginheight='0' allowtransparency='true'></iframe>");
			},
			beforeClose: function(event, ui) { 
				$("#dleuserpopup").html("");
			},
			close: function(event, ui) {
					$('#modal-overlay').fadeOut('slow', function() {
			        $('#modal-overlay').remove();
			    });
			 }
		});

		if ($(window).width() > 830 && $(window).height() > 530 ) {
			$('.modalfixed.ui-dialog').css({position:"fixed"});
			$('#dleuserpopup').dialog( "option", "position", ['0','0'] );
		}

		return false;

}

function search_submit(prm){
	document.navi.start_from.value=prm;
	document.navi.submit();
	return false;
}

$(function(){

	$("#actionlist").delegate("tr", "hover", function(){
	  $(this).toggleClass("hoverRow");
	});

});

//-->
</script>


<div style="padding-top:5px;padding-bottom:2px;">
<table width="100%">
    <tr>
        <td width="4"><img src="engine/skins/images/tl_lo.gif" width="4" height="4" border="0"></td>
        <td background="engine/skins/images/tl_oo.gif"><img src="engine/skins/images/tl_oo.gif" width="1" height="4" border="0"></td>
        <td width="6"><img src="engine/skins/images/tl_ro.gif" width="6" height="4" border="0"></td>
    </tr>
    <tr>
        <td background="engine/skins/images/tl_lb.gif"><img src="engine/skins/images/tl_lb.gif" width="4" height="1" border="0"></td>
        <td style="padding:5px;" bgcolor="#FFFFFF">
<table width="100%">
    <tr>
        <td bgcolor="#EFEFEF" height="29" style="padding-left:10px;"><div class="navigation">{$lang['opt_logsc']}</div></td>
    </tr>
</table>
<div class="unterline"></div>
<table width="100%">
    <tr>
        <td style="padding:2px;">
<table style="text-align:center;" width="100%" height="35px">
<tr style="vertical-align:middle;" >
 <td style="text-align:left;"><a href="?mod=logs"><img title="{$lang['admin_logs_all']}" src="engine/skins/images/log_all.png" border="0"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?mod=logs&action=auth"><img title="{$lang['admin_logs_auth']}" src="engine/skins/images/log_auth.png" border="0"></a></td>
 </tr>
</table>
</td>
    </tr>
</table>
</td>
        <td background="engine/skins/images/tl_rb.gif"><img src="engine/skins/images/tl_rb.gif" width="6" height="1" border="0"></td>
    </tr>
    <tr>
        <td><img src="engine/skins/images/tl_lu.gif" width="4" height="6" border="0"></td>
        <td background="engine/skins/images/tl_ub.gif"><img src="engine/skins/images/tl_ub.gif" width="1" height="6" border="0"></td>
        <td><img src="engine/skins/images/tl_ru.gif" width="6" height="6" border="0"></td>
    </tr>
</table>
</div>


<form action="?mod=logs" method="get" name="navi" id="navi">
<div style="padding-top:5px;padding-bottom:2px;">
<table width="100%">
    <tr>
        <td width="4"><img src="engine/skins/images/tl_lo.gif" width="4" height="4" border="0"></td>
        <td background="engine/skins/images/tl_oo.gif"><img src="engine/skins/images/tl_oo.gif" width="1" height="4" border="0"></td>
        <td width="6"><img src="engine/skins/images/tl_ro.gif" width="6" height="4" border="0"></td>
    </tr>
    <tr>
        <td background="engine/skins/images/tl_lb.gif"><img src="engine/skins/images/tl_lb.gif" width="4" height="1" border="0"></td>
        <td style="padding:5px;" bgcolor="#FFFFFF">
<table width="100%">
    <tr>
        <td bgcolor="#EFEFEF" height="29" style="padding-left:10px;"><div class="navigation">{$lang['opt_logsc']}</div></td>
    </tr>
</table>
<div class="unterline"></div>
<table width="100%" id="actionlist">
    <tr class="thead">
        <th width="170" style="padding:2px;">{$lang['addnews_date']}</th>
        <th width="170" style="padding:2px;">{$lang['user_name']}</th>
        <th width="130">IP:</th>
        <th>{$lang['user_action']}</th>
    </tr>
	<tr class="tfoot"><th colspan="4"><div class="hr_line"></div></th></tr>
HTML;

	if( $action == "auth") {

		$where = "action ='89' OR action ='90' OR action ='91' OR action ='92'";

	} else {

		$where = "action !='89' AND action !='90' AND action !='91' AND action !='92'";
	}
	
	$db->query( "SELECT SQL_CALC_FOUND_ROWS * FROM " . USERPREFIX . "_admin_logs WHERE {$where} ORDER BY date DESC LIMIT {$start_from},{$news_per_page}" );
	
	$i = $start_from;
	while ( $row = $db->get_array() ) {
		$i ++;

		$row['date'] = date( "d.m.Y H:i:s", $row['date'] );
		$status = $lang["admin_logs_action_".$row['action']];

		echo "
        <tr>
        <td style=\"padding-top:5px;padding-bottom:5px\">{$row['date']}</td>
        <td><a class=\"maintitle\" onclick=\"javascript:popupedit('".urlencode($row[name])."'); return false;\" href=\"#\">{$row['name']}</a></td>
        <td>{$row['ip']}</td>
        <td>{$status} <b>".stripslashes($row['extras'])."</b></td>
        </tr>
	    <tr><td background=\"engine/skins/images/mline.gif\" height=1 colspan=4></td></tr>
        ";
	}

	$db->free();

	$result_count = $db->super_query("SELECT FOUND_ROWS() as count");
	$all_count_news = $result_count['count'];

		// pagination

		$npp_nav = "<div class=\"news_navigation\" style=\"margin-bottom:5px; margin-top:5px;\">";
		
		if( $start_from > 0 ) {
			$previous = $start_from - $news_per_page;
			$npp_nav .= "<a onClick=\"javascript:search_submit($previous); return(false);\" href=\"#\" title=\"{$lang['edit_prev']}\">&lt;&lt;</a> ";
		}
		
		if( $all_count_news > $news_per_page ) {
			
			$enpages_count = @ceil( $all_count_news / $news_per_page );
			$enpages_start_from = 0;
			$enpages = "";
			
			if( $enpages_count <= 10 ) {
				
				for($j = 1; $j <= $enpages_count; $j ++) {
					
					if( $enpages_start_from != $start_from ) {
						
						$enpages .= "<a onClick=\"javascript:search_submit($enpages_start_from); return(false);\" href=\"#\">$j</a> ";
					
					} else {
						
						$enpages .= "<span>$j</span> ";
					}
					
					$enpages_start_from += $news_per_page;
				}
				
				$npp_nav .= $enpages;
			
			} else {
				
				$start = 1;
				$end = 10;
				
				if( $start_from > 0 ) {
					
					if( ($start_from / $news_per_page) > 4 ) {
						
						$start = @ceil( $start_from / $news_per_page ) - 3;
						$end = $start + 9;
						
						if( $end > $enpages_count ) {
							$start = $enpages_count - 10;
							$end = $enpages_count - 1;
						}
						
						$enpages_start_from = ($start - 1) * $news_per_page;
					
					}
				
				}
				
				if( $start > 2 ) {
					
					$enpages .= "<a onclick=\"javascript:search_submit(0); return(false);\" href=\"#\">1</a> ... ";
				
				}
				
				for($j = $start; $j <= $end; $j ++) {
					
					if( $enpages_start_from != $start_from ) {
						
						$enpages .= "<a onclick=\"javascript:search_submit($enpages_start_from); return(false);\" href=\"#\">$j</a> ";
					
					} else {
						
						$enpages .= "<span>$j</span> ";
					}
					
					$enpages_start_from += $news_per_page;
				}
				
				$enpages_start_from = ($enpages_count - 1) * $news_per_page;
				$enpages .= "... <a onclick=\"javascript:search_submit($enpages_start_from); return(false);\" href=\"#\">$enpages_count</a> ";
				
				$npp_nav .= $enpages;
			
			}
		
		}
		
		if( $all_count_news > $i ) {
			$how_next = $all_count_news - $i;
			if( $how_next > $news_per_page ) {
				$how_next = $news_per_page;
			}
			$npp_nav .= "<a onclick=\"javascript:search_submit($i); return(false);\" href=\"#\" title=\"{$lang['edit_next']}\">&gt;&gt;</a>";
		}
		
		$npp_nav .= "</div>";
		
		// pagination
	
	echo <<<HTML
	<tr class="tfoot"><th colspan="4"><div class="hr_line"></div></th></tr>
	<tr class="tfoot"><th colspan="2">{$npp_nav}</th></tr>
</table>
</td>
        <td background="engine/skins/images/tl_rb.gif"><img src="engine/skins/images/tl_rb.gif" width="6" height="1" border="0"></td>
    </tr>
    <tr>
        <td><img src="engine/skins/images/tl_lu.gif" width="4" height="6" border="0"></td>
        <td background="engine/skins/images/tl_ub.gif"><img src="engine/skins/images/tl_ub.gif" width="1" height="6" border="0"></td>
        <td><img src="engine/skins/images/tl_ru.gif" width="6" height="6" border="0"></td>
    </tr>
</table>
</div>
<input type="hidden" name="mod" value="logs">
<input type="hidden" name="action" value="{$action}">
<input type="hidden" name="start_from" id="start_from" value="{$start_from}">
<form>
HTML;

echofooter();
?>