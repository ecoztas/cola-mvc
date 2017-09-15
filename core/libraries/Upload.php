<?php

/**
 * Cola - MVC
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	Cola
 * @author	Emre Can ÖZTAŞ <emrecanoztas@outlook.com>
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://github.com/emrecanoztas/cola-mvc
 * @version	0.0.1
 */

namespace Cola\Libraries {
	
	use Cola\Config\Config as Config;
	use Cola\Config\FileTypes as FileTypes;
	use Cola\System\Error as Error;
	
	class Upload
	{
		private $_upload;
		
		public function __construct()
		{
			$this->_upload = null;
		}
		
		public function uploadFile($file = null, $fileName = null)
		{
			if (!is_null($file) && !is_bool($file)) {
				if (isset($_FILES[$file])) {
					$this->_upload = $file;

					$error = $_FILES[$this->_upload]['error'];

					if ($error > 0) {
						switch ($error) {
							case 1:
								Error::basicError('The file exceeds the upload_max_filesize setting in php.ini', 256);
								break;
							case 2:
								Error::basicError('The file exceeds the MAX_FILE_SIZE setting in the HTML form', 256);
								break;
							case 3:
								Error::basicError('The file was only partially uploaded.', 256);
								break;
							case 4:
								Error::basicError('No file was uploaded.', 256);
								break;
							case 6:
								Error::basicError('No temporary folder was available.', 256);
								break;
							case 7:
								Error::basicError('Unable to write to the disk', 256);
								break;
							case 8:
								Error::basicError('File upload stopped.', 256);
								break;
							default:
								Error::basicError('A system error occurred.', 256);
								break;
						}
					} else {
						$size = $_FILES[$this->_upload]['size'];

						if (Config::$upload['maxFileSize'] < $size) {
							Error::basicError('File size over.', 256);
							return;
						} else {
							$allowedFileTypes = array();

							if (is_null(Config::$upload['allowedFileTypes']) || is_bool(Config::$upload['allowedFileTypes']) || Config::$upload['allowedFileTypes'] === '') {
								$allowedFileTypes = FileTypes::$allowedFileTypes;
							} else {
								$allowedFileTypes = Config::$upload['allowedFileTypes'];
							}

							$type 		= $_FILES[$this->_upload]['type'];
							$extension 	= '';

							if (is_array($allowedFileTypes)) {
								foreach ($allowedFileTypes as $fileTypes => $value) {
									if (is_array($value)) {
										foreach ($value as $arrType) {
											if (is_null($extension) || $extension == '') {
												if ($type == $arrType) {
													$extension = $fileTypes;
													// echo($extension);
												}
											} else {
												continue;
											}
										}
									} else {
										if ($type == $value) {
											$extension = $fileTypes;
											break;
										}
									}
								}
							} else {
								if ($type === $allowedFileTypes) {
									$extension = $allowedFileTypes;
								}
							}

							if (!is_null($extension) || $extension != '') {
								$result 	 = false;
								$temp        = explode('.', $_FILES[$file]['name']);

								if (!is_null($fileName) && !is_bool($fileName) && $fileName != '') {
									$result = move_uploaded_file($_FILES[$file]['tmp_name'], Config::$upload['path'] . $fileName . '.' . end($temp));
								} else if (Config::$upload['originalFileName']) {
									$result = move_uploaded_file($_FILES[$file]['tmp_name'], Config::$upload['path'] . $_FILES[$file]['name']);
								} else if (!is_null(Config::$upload['fileName']) && !is_bool(Config::$upload['fileName']) && Config::$upload['fileName'] != '') {			
									$result = move_uploaded_file($_FILES[$file]['tmp_name'], Config::$upload['path'] . Config::$upload['fileName'] . '.' . end($temp));
								} else {
									$result = move_uploaded_file($_FILES[$file]['tmp_name'], Config::$upload['path'] . sha1(uniqid(mt_rand(), true)) . '.' . end($temp));
								}

								if ($result) {
									return(true);
								} else {
									return(false);
								}
								
							} else {
								return(null);
							}
						}
					}
				} else {
					return(null);
				}
			} else {
				return(null);
			}
		}
		
	}
	
}