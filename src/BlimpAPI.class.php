<?php

require_once 'Requests/library/Requests.php';
Requests::register_autoloader();


DEFINE("API_ENDPOINT", "https://app.getblimp.com/api/v2");


class Client {

    private $headers;

    private $resources = array(
        'company',
        'project',
        'goal',
        'task',
        'comment',
        'file',
        'user'
    );

    public $response = array(
        'headers' => array(),
        'success' => FALSE,
        'status_code' => FALSE
    );

    public function __construct($username, $api_key, $app_id, $app_secret) {
        $this->headers = array(
                    'Content-Type' => 'application/json',
                    'Authorization' => 'ApiKey '.$username.':'.$api_key,
                    'X_BLIMP_APPID' => $app_id,
                    'X_BLIMP_SECRET' => $app_secret
            );
    }

    private function generateURL($resource, $path=null) {

        if(!in_array($resource, $this->resources)) {
            throw new Exception('Resource not available.');
        }

        if($path) {
            $url = API_ENDPOINT.'/'.$resource.'/';
        } else {
            $url = API_ENDPOINT.'/'.$resource;
        }

        return $url.$path.'/';
    }

    private function processRequest($request) {
        $this->response['headers'] = $request->headers->getIterator();
        $this->response['success'] = $request->success;
        $this->response['status_code'] = $request->status_code;

        return json_decode($request->body);
    }

    private function request($method, $url, $payload=null) {
        switch ($method) {
            case 'get':
                $type = Requests::GET;
                $data = $payload;
                break;
            case 'post':
                $type = Requests::POST;
                $data = json_encode($payload);
                break;
            case 'patch':
                $type = Requests::PUT;
                $data = json_encode($payload);
                break;
            case 'delete':
                $type = Requests::DELETE;
                $data = array();
                break;
        }

        $request = Requests::request($url, $this->headers, $data, $type);

        return $this->processRequest($request);
    }

    public function get($resource, $identifier=null, $params=array()) {
        $url = $this->generateURL($resource, $identifier);
        return $this->request('get', $url, $params);
    }

    public function create($resource, $params) {
        $url = $this->generateURL($resource);
        return $this->request('post', $url, $params);
    }

    public function update($resource, $identifier, $params) {
        $url = $this->generateURL($resource, $identifier);
        return $this->request('patch', $url, $params);
    }

    public function delete($resource, $identifier) {
        $url = $this->generateURL($resource, $identifier);
        return $this->request('delete', $url);
    }

    public function schema($resource) {
        return $this->get($resource);
    }

    public function getRateLimitStatus() {
        $headers = $this->response['headers'];

        if(empty($headers)) {
            return array();
        }

        return array(
            'remaining' => $headers['x-ratelimit-remaining'],
            'limit' => $headers['x-ratelimit-limit']
        );
    }
}

?>
