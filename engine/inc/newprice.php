<?
if(!defined('DATALIFEENGINE'))
{
  die("Hacking attempt!");
}




function xfieldsdataload2($id) { // ��� ������� - ������� ������ ������
	if( $id == "" ) return;
	
	$xfieldsdata = explode( "||", $id );
	foreach ( $xfieldsdata as $xfielddata ) {
		list ( $xfielddataname, $xfielddatavalue ) = explode( "|", $xfielddata );
		$data[$xfielddataname] = $xfielddatavalue;
	}
	return $data;
}




 function post_image($short_story){

			$images = array();
			preg_match_all('/(img|src)=("|\')[^"\'>]+/i', $short_story, $media);
			$data=preg_replace('/(img|src)("|\'|="|=\')(.*)/i',"$3",$media[0]);
	
			foreach($data as $url) {
				$info = pathinfo($url);
				if (isset($info['extension'])) {
					if ($info['filename'] == "spoiler-plus" OR $info['filename'] == "spoiler-plus" ) continue;
					$info['extension'] = strtolower($info['extension']);
					if (($info['extension'] == 'jpg') || ($info['extension'] == 'jpeg') || ($info['extension'] == 'gif') || ($info['extension'] == 'png')) array_push($images, $url);
				}
			}

return $images[0];

}





if($_POST['id'] && $_POST['type'] && $_POST['value']){

 $_POST['value'] = iconv("UTF-8", "CP1251", $_POST['value']);
 
if($_POST['value'] == "�����"){exit;}
// if($_POST['value'] == "�����"){$_POST['value'] = "";}

		$id = intval($_POST['id']);
		if ( $id ) {




if($_POST['type'] == "title"){


 $db->query("UPDATE ".USERPREFIX."_post SET `title` = '{$_POST['value']}' WHERE ".USERPREFIX."_post.`id` = '{$id}'");


}else{


$result = $db->query("SELECT id,xfields FROM ".USERPREFIX."_post WHERE `id` = '{$id}'");

$row = $db->get_array($result);

	$xfieldsdata = xfieldsdataload2( $row[xfields] );
	
$xfieldsdata[$_POST['type']] = $_POST['value'];

if ($_POST['type'] == "price"){
$skidka = 30; // 30% ������
// $xfieldsdata["old_price"] = (ceil($_POST['value']/$skidka))*100-10; // ������ � ������� - �� ������ ������� �� 100% ������ � 30% � ���������� 70% ������������ ��� ���������� �������� ����
// $xfieldsdata["old_price"] = ceil($_POST['value']*100 / (100-$skidka) ); // ��� ����������
$xfieldsdata["old_price"] = (ceil($_POST['value']/(100-$skidka)))*100;
}

	foreach ( $xfieldsdata as $xfieldname => $xfielddata ) {
   $xfieldsdata_array[] = $xfieldname."|".$xfielddata;
  }
  $xfieldsdata_new = implode( "||", $xfieldsdata_array );
  $xfieldsdata_new = addslashes($xfieldsdata_new);

 $db->query("UPDATE ".USERPREFIX."_post SET `xfields` = '{$xfieldsdata_new}' WHERE ".USERPREFIX."_post.`id` = '{$id}'");



}




		}
echo 'ok';





























}else{






echoheader('', '');













// $result = $db->query("SELECT id,title,xfields,category FROM ".USERPREFIX."_post ORDER BY `sorting` ASC");
   $result = $db->query("SELECT id,title,xfields,category,short_story FROM ".USERPREFIX."_post ORDER BY `id` ASC");

echo <<<HTML
<table width="100%" id="newslist">
	<tr class="thead">
    	<th width="120" style="text-align: left;">&nbsp;������&nbsp;</th>
    	<!-- <th width="90" style="text-align: left;">&nbsp;����&nbsp;</th> -->
    	<!-- <th width="90" style="text-align: left;">&nbsp;������ ����&nbsp;</th> -->
    	<th width="130">������</th>
    	<th width="80">������� - ID</th>
    	<th width="150">������</th>
	</tr>
	<tr class="tfoot"><td colspan="6"><div class="hr_line"></div></td></th>
HTML;
while ($row = $db->get_row($result)) {

	$xfieldsdata = xfieldsdataload2( $row['xfields'] );

//  $row[title] = str_replace("Monster Beats ", "", $row[title]);




 if(empty($xfieldsdata['razmer'])){$xfieldsdata['razmer'] = "�����";} // � ������ ��������� ���� �������� - ���� �������� �������� � ������� ��� �����, �� �� �������������� � � �� �.�. ��� ������ �������������� �����
 if(empty($xfieldsdata['artikul'])){$xfieldsdata['artikul'] = "�����";}


$post_image = post_image($row['short_story']);
$post_image = str_replace($config['http_home_url'], "/", $post_image); // �� ������� �������� ����� ����� ��������� � ������ ���������, � ����� � �������� - ��� � ��


$cat = explode(",", $row['category']);
$categories = unserialize(file_get_contents(ENGINE_DIR . '/cache/system/category.php'));


echo <<<HTML
	<tr>
        <td><span id="{$row['id']}" type="title" class="editable">{$row['title']}</span><br>&nbsp;</td>
       <!-- <td><span id="{$row['id']}" type="price" class="editable">{$xfieldsdata['price']}</span></td> -->
       <!-- <td><span id="{$row['id']}" type="old_price" class="editable">{$xfieldsdata['old_price']}</span></td> -->
        <td><span id="{$row['id']}" type="razmer" class="editable">{$xfieldsdata['razmer']}</span></td>
        <td><span id="{$row['id']}" type="artikul" class="editable">{$xfieldsdata['art']}</span> - {$row['id']}</td>
        <td><a href="$post_image" target="_blank"><img src="/img/img.php?h=130&amp;w=150&amp;src=$post_image"></a><br> {$categories[$cat[0]]['name']}<br> {$categories[$cat[1]]['name']}<br> {$categories[$cat[2]]['name']}<br> {$categories[$cat[3]]['name']}</td>
    </tr>
	<tr><td background="engine/skins/images/mline.gif" height=1 colspan=6></td></tr>
HTML;

unset($post_image);
}
echo <<<HTML
</table>
<script type="text/javascript" src="engine/classes/js/ajax_edit.js"></script>
HTML;


















echofooter();



}
 
?>