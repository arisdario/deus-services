<?php

	class DeusApi {

        private $apiUrl 		= 'http://api.url'; //Don't forget to change the url
        private $fileName 	= 'file_data.xml'; //Don't forget to change the path where you want to save the file !

        /**
         * @param $username
         * @param $password
         * @return string
         */
        private function generateKey($username, $password){
            return md5($username.$password);
        }

        /**
         * @param string $username
         * @param string $password
         * @param string $method
         * @param null $codes
         * @return string
         */
        public function retrieveData($username, $password, $method = 'all', $codes = null) {

            $key 			= $this->generateKey($username, $password);

            $fields 			= array();
            $fields['key'] 		= $key;
            $fields['method'] 	= $method;
            if( $method == 'bycode' ){
                if( !is_null($codes) ){
                    $fields['code'] = $codes;
                }else{
                    return false;
                }
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-API-KEY:'.$key.''));
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
            $fp = fopen($this->fileName, 'w');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_exec($ch);
            curl_close($ch);

            return $this->fileName;
        }
    }
