<?php
namespace Common;
/**
 * Author : Min Thura
 * Created On : 18-Nov-2015
 * Version : 0.1.0
 */

class FileUpload {
		public static function upload($file, $directory = ''){
				try {
						if (!$directory) {
								$directory = '/uploads/';
						}else{
								if (!self::startsWith($directory, '/')) {
										$directory = '/' . $directory;
								}
								if (!self::endsWith($directory, '/')) {
										$directory = $directory . '/';
								}
						}
						$path = public_path() . $directory;
						$ext = '.' . $file->getClientOriginalExtension();
						$filename = md5(round(microtime(true)) . '_' . uniqid()) . $ext;
						$file->move($path, $filename);
						$uploaded_file_path = $directory . $filename;
						return $uploaded_file_path;
				} catch (Exception $e) {
						return '';
				}
		}

		private static function startsWith($haystack, $needle){
		     return (substr($haystack, 0, strlen($needle)) === $needle);
		}

		private static function endsWith($haystack, $needle){
		     return (substr($haystack, -strlen($needle)) === $needle);
		}
}
