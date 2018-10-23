<?php

	
	if( strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' ){

		$config = array(
			'email' => 'admin@best-kartina.ru',
			'headers' => "MIME-Version: 1.0\r\n"
				."Content-type: text/html; charset=utf-8\r\n"
		);

		$message = '';

			$title = "Заявка на помощь дизайнера";
			$message .= "<p><b>Имя:</b> {$_POST['name']}</p>";
			$message .= "<p><b>Телефон:</b> {$_POST['phone']}</p>";
			$message .= "<p><b>Почта:</b> {$_POST['email']}</p>";
			$message .= "<p><b>Комментарий:</b> -{$_POST['desc']}</p>";
			$message .= "<p><b>Фото</b></p>";
			$files =  json_decode($_POST['dopfotozfnh'], true);
			if($files){
				foreach( $files as $file){
					$message .= "<p><a href=\"http://{$_SERVER['SERVER_NAME']}{$file}\"><img style=\"max-width:500px;\" src=\"http://{$_SERVER['SERVER_NAME']}{$file}\" alt=\"{$file}\"></a></p>";
				}
			}


	
		mail($config['email'], $title, $message, $config['headers']);


	}
