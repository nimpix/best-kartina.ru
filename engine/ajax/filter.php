<?php
	/*
		=====================================================
		Smart Xfields Search Engine 
		-----------------------------------------------------
		http://dle.press
		-----------------------------------------------------
		Заходите в мой блог о DLE, там выложены полезные мелочи
		=====================================================
		Подготовил для вас: DomiTori
		=====================================================
		Файл: filter.php
		-----------------------------------------------------
	*/
	
	@error_reporting ( E_ALL ^ E_WARNING ^ E_NOTICE );
	@ini_set ( 'display_errors', true );
	@ini_set ( 'html_errors', false );
	@ini_set ( 'error_reporting', E_ALL ^ E_WARNING ^ E_NOTICE );
	
	define( 'DATALIFEENGINE', true );
	define( 'ROOT_DIR', substr( dirname(  __FILE__ ), 0, -12 ) );
	define( 'ENGINE_DIR', ROOT_DIR . '/engine' );
	
	include ENGINE_DIR . '/data/config.php';
	
	date_default_timezone_set ( $config['date_adjust'] );
	
	if( $config['http_home_url'] == "" ) {
		
		$config['http_home_url'] = explode( "engine/ajax/rating.php", $_SERVER['PHP_SELF'] );
		$config['http_home_url'] = reset( $config['http_home_url'] );
		$config['http_home_url'] = "http://" . $_SERVER['HTTP_HOST'] . $config['http_home_url'];
		
	}
	
	require_once ENGINE_DIR . '/classes/mysql.php';
	require_once ENGINE_DIR . '/data/dbconfig.php';
	require_once ENGINE_DIR . '/modules/functions.php';
	
	dle_session();
	
	$_REQUEST['skin'] = totranslit($_REQUEST['skin'], false, false);
	
	if( $_REQUEST['skin'] ) {
		if( @is_dir( ROOT_DIR . '/templates/' . $_REQUEST['skin'] ) ) {
			$config['skin'] = $_REQUEST['skin'];
			} else {
			die( "Hacking attempt!" );
		}
	}
	
	if( $config["lang_" . $config['skin']] ) {
		if ( file_exists( ROOT_DIR . '/language/' . $config["lang_" . $config['skin']] . '/website.lng' ) ) {	
			include_once ROOT_DIR . '/language/' . $config["lang_" . $config['skin']] . '/website.lng';
		} else die("Language file not found");
		} else {
		
		include_once ROOT_DIR . '/language/' . $config['langs'] . '/website.lng';
		
	}
	$config['charset'] = ($lang['charset'] != '') ? $lang['charset'] : $config['charset'];
	
	$allow_active_news = true;
	
	require_once ENGINE_DIR . '/classes/templates.class.php';
	
	$tpl = new dle_template();
	
	if ( ($config['allow_smartphone'] AND !$_SESSION['mobile_disable'] AND $tpl->smartphone) OR $_SESSION['mobile_enable'] ) {
		
		if ( @is_dir ( ROOT_DIR . '/templates/smartphone' ) ) {
			
			$config['skin'] = "smartphone";
			$smartphone_detected = true;
			
			if( $config['allow_comments_wysiwyg'] > 0 ) $config['allow_comments_wysiwyg'] = 0;
			
		}
		
	}
	
	$tpl->dir = ROOT_DIR . '/templates/' . totranslit($config['skin'], false, false);
	
	$cat_info = get_vars( "category" );
	
	if( ! is_array( $cat_info ) ) {
		$cat_info = array ();
		
		$db->query( "SELECT * FROM " . PREFIX . "_category ORDER BY posi ASC" );
		while ( $row = $db->get_row() ) {
			
			$cat_info[$row['id']] = array ();
			
			foreach ( $row as $key => $value ) {
				$cat_info[$row['id']][$key] = stripslashes( $value );
			}
			
		}
		set_vars( "category", $cat_info );
		$db->free();
	}
	
	while (list($key, $value) = each($_GET)) {
		
		if( $key == 'genre' ) {
			
			if ($config['allow_multi_category']) {
				
				if( $_GET['genre_filter'] == 1 ) $where[] = "category regexp '[[:<:]](" . implode( '|', $value ) . ")[[:>:]]'";
				
				else {
					foreach( $value as $genre ) {
						$genres[] = "category regexp '[[:<:]](".$genre.")[[:>:]]'";
					}
					$genre = implode(" AND ", $genres);
					$where[] = '(' .$genre. ')';
				}
				
			} else  $where[] = "category = '{$value[0]}'";
			
			} elseif ( substr($key,0,3) == 'xf_' ) {
			
			preg_match_all('#xf_(.*)_(.*)#', $key, $matches, PREG_SET_ORDER);
			
			if( $matches[0][2] == 'start' OR $matches[0][2] == 'end'  ) {
				
				if($matches[0][2]=='start')
				{
					$where[] = "SUBSTRING_INDEX( SUBSTRING_INDEX( xfields, '{$matches[0][1]}|', -1 ) ,  '||', 1 )>$value-0.001";	
				}
				else
				{
					$where[] = "SUBSTRING_INDEX( SUBSTRING_INDEX( xfields, '{$matches[0][1]}|', -1 ) ,  '||', 1 )<$value+0.001";
				}
				} else {
				
				if( count($value) == 1 ) $where[] = "xfields LIKE '%".substr($key,3)."|%".convert_unicode( $value[0], $config['charset']  )."%'";
				
				else {
					
					foreach($value as $xf){
						$searchLS[] = "xfields LIKE '%".substr($key,3)."|%".convert_unicode( $xf, $config['charset']  )."%'";
					}
					
					$xfs = implode(" OR ", $searchLS);
					$where[] = '(' .$xfs. ')';
					
				}
			}
		}
		
	}
	
	if( isset($where) ) $where = ' AND ' . implode( ' AND ', $where );
	
	//$where = " AND (xfields LIKE '%kinopoisk|%8.5%' OR xfields LIKE '%kinopoisk|%8.0%')";
	
	if( $_GET['cstart'] ) $cstart = $_GET['cstart'];
	else $cstart = 0;
	
	$sql_select = "SELECT id, short_story, xfields, title, category, alt_name FROM " . PREFIX . "_post WHERE approve=1$where ORDER BY date DESC LIMIT $cstart,".$config['news_number'];
	$sql_count = "SELECT COUNT(*) as count FROM " . PREFIX . "_post WHERE approve=1$where";
	
	$config['news_navigation'] = 0;
	
	include ENGINE_DIR . '/modules/show.short.php';
	
	if( $tpl->result['content'] !== '' ) {
		
		if( $config['news_number'] AND $config['news_number'] < $count_all and $news_count < $count_all ) {
			
			$tpl->load_template( 'navigation_filter.tpl' );
			
			$tpl->set_block( "'\[next-link\](.*?)\[/next-link\]'si", "<a href=\"#\" id=\"filter-next\" data-cstart=\"$news_count\">\\1</a>" );
			
			$tpl->compile( 'navi' );
			
			$tpl->result['content'] .= $tpl->result['navi'];
			
			$tpl->clear();
			
		}
		
		} else {
		
		$tpl->load_template( 'info_filter.tpl' );
		$tpl->set( '{error}', "К сожалению, поиск по сайту не дал никаких результатов. Попробуйте изменить или упростить Ваш запрос." );
		$tpl->set( '{title}', $lang['all_err_1'] );
		$tpl->compile( 'content' );
		$tpl->clear();
		
	}
	
	@header( "Content-type: text/html; charset=" . $config['charset'] );
	echo $tpl->result['content'];
	
?>