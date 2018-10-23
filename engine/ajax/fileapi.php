<?php

	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	ini_set('max_input_time', 6000);
	ini_set("max_execution_time", 6000);
	
	class FileAPI {
		const OK = 200;
		const ERROR = 500;


		private static function rRestructuringFilesArray(&$arrayForFill, $currentKey, $currentMixedValue, $fileDescriptionParam){
			if( is_array($currentMixedValue) ){
				foreach( $currentMixedValue as $nameKey => $mixedValue ){
					self::rRestructuringFilesArray($arrayForFill[$currentKey],
											 $nameKey,
											 $mixedValue,
											 $fileDescriptionParam);
				}
			} else {
				$arrayForFill[$currentKey][$fileDescriptionParam] = $currentMixedValue;
			}
		}


		private static function determineMimeType(&$file){
			if( function_exists('mime_content_type') ){
				if( isset($file['tmp_name']) && is_string($file['tmp_name']) ){
					if( $file['type'] == 'application/octet-stream' ){
						$mime = mime_content_type($file['tmp_name']);
						if( !empty($mime) ){
							$file['type'] = $mime;
						}
					}
				}
				else if( is_array($file) ){
					foreach( $file as &$entry ){
						self::determineMimeType($entry);
					}
				}
			}
		}


		/**
		 * Enable CORS -- http://enable-cors.org/
		 * @param array [$options]
		 */
		public static function enableCORS($options = null){
			if( is_null($options) ){
				$options = array();
			}

			if( !isset($options['origin']) ){
				$options['origin'] = $_SERVER['HTTP_ORIGIN'];
			}

			if( !isset($options['methods']) ){
				$options['methods'] = 'POST, GET';
			}

			if( !isset($options['headers']) ){
				$options['headers'] = array();
			}

			header('Access-Control-Allow-Origin: ' . $options['origin']);
			header('Access-Control-Allow-Methods: ' . $options['methods']);
			header('Access-Control-Allow-Headers: ' . implode(', ', array_merge($options['headers'], array('X-Requested-With', 'Content-Range', 'Content-Disposition'))));

			if( !isset($options['cookie']) || $options['cookie'] ){
				header('Access-Control-Allow-Credentials: true');
			}
		}


		/**
		 * Request header
		 * @return array
		 */
		public static function getRequestHeaders(){
			$headers = array();

			foreach( $_SERVER as $key => $value ){
				if( substr($key, 0, 5) == 'HTTP_' ){
					$header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
					$headers[$header] = $value;
				}
			}

			return $headers;
		}


		/**
		 * Retrieve File List
		 * @return array
		 */
		public static function getFiles(){
			$files = array();

			// http://www.php.net/manual/ru/reserved.variables.files.php#106558
			foreach( $_FILES as $firstNameKey => $arFileDescriptions ){
				foreach( $arFileDescriptions as $fileDescriptionParam => $mixedValue ){
					self::rRestructuringFilesArray($files, $firstNameKey, $_FILES[$firstNameKey][$fileDescriptionParam], $fileDescriptionParam);
				}
			}

			self::determineMimeType($files);

			return	$files;
		}


		/**
		 * Make server response
		 * @param array $res
		 * @param string [$jsonp]
		 */
		public static function makeResponse(array $res, $jsonp = null){
			$body = $res['body'];
			$json = is_array($body) ? json_encode($body) : $body;

			$httpStatus = isset($res['status']) ? $res['status'] : self::OK;
			$httpStatusText  = addslashes(isset($res['statusText']) ? $res['statusText'] : 'OK');
			$httpHeaders = isset($res['headers']) ? $res['headers'] : array();

			if( empty($jsonp) ){
				header("HTTP/1.1 $httpStatus $httpStatusText");
				$httpHeaders['Content-Type'] = 'application/json';
				foreach( $httpHeaders as $header => $value ){
					header("$header: $value");
				}
				echo $json;
			}
			else {
				$json = addslashes($json);

				echo  <<<END
					<script>
					(function (ctx, jsonp){
						'use strict';
						var status = $httpStatus, statusText = "$httpStatusText", response = "$json";
						try {
							ctx[jsonp](status, statusText, response);
						} catch (e){
							var data = "{\"id\":\"$jsonp\",\"status\":"+status+",\"statusText\":\""+statusText+"\",\"response\":\""+response.replace(/\"/g, '\\\\\"')+"\"}";
							try {
								ctx.postMessage(data, document.referrer);
							} catch (e){}
						}
					})(window.parent, '$jsonp');
					</script>
END;
			}
		}

	}
	

	if( strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' ){
		$files  = FileAPI::getFiles(); // Retrieve File List
		$images = array();
		// Fetch all image-info from files list
		fetchImages($files, $images);

		// JSONP callback name
		$jsonp  = isset($_REQUEST['callback']) ? trim($_REQUEST['callback']) : null;
	
		// JSON-data for server response
		$json   = array(
			'images'  => $images
			, 'data'    => array('_REQUEST' => $_REQUEST, '_FILES' => $files)
		);

		// Server response: "HTTP/1.1 200 OK"
		FileAPI::makeResponse(array(
			'status' => FileAPI::OK
			, 'statusText' => 'OK'
			, 'body' => $json
		), $jsonp);
		exit;
	}

	function fetchImages($files, &$images, $name = 'file'){
		if( isset($files['tmp_name']) ){
			$filename = $files['tmp_name'];
			list($mime) = explode(';', @mime_content_type($filename));

			if( strpos($mime, 'image') !== false ){
				$size = getimagesize($filename);
				$timeDir = time();
				$imgPath = "/uploads/foto-na-holste/{$timeDir}/";
				mkdir($_SERVER['DOCUMENT_ROOT'].$imgPath, 0777);
				$imgPath .= str_replace(',', '', $files['name']);
				file_put_contents($_SERVER['DOCUMENT_ROOT'].$imgPath, file_get_contents($filename));

				$images['path'] =  $imgPath;
			}
		}
		else {
			foreach( $files as $name => $file ){
				fetchImages($file, $images, $name);
			}
		}
	}
