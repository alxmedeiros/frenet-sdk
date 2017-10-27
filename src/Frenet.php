<?php
/**
 * Created by IntelliJ IDEA.
 * User: alexandre
 * Date: 26/10/17
 * Time: 23:48
 */
namespace Frenet;

use Httpful\Exception\ConnectionErrorException;
use Httpful\Request;

class Frenet {

    private $_apiUrl = 'http://api.frenet.com.br';
    private $_token = '';
    private $_httpClient = '';

    private static $_apiInstance;

    /**
     * Private Frenet constructor.
     * @param string $_apiUrl
     */
    private function __construct($_token) {
        $this->_token = $_token;

    }

    public static function init($_token) {
        if ( empty(self::$_apiInstance) ) {
            self::$_apiInstance = new Frenet($_token);
        }

        return self::$_apiInstance;
    }

    private function getRequest($_endpoint) {
        try {

            $response = Request::get($this->_apiUrl.$_endpoint)
                ->addHeaders(array(
                    'ContentType' => 'application/json',
                    'token'       => $this->_token
                ))
                ->send();

            if ( $response->code === 200 || $response->code === 201 ) {
                return $response->body;
            } else {
                throw new \Exception($response->body->Message, $response->code);
            }

        } catch (ConnectionErrorException $ex) {
            throw $ex;
        }
    }

    public function getShippingInfo() {

        try {
            return $this->getRequest('/shipping/info');
        } catch (\Exception $ex) {
            $_error = new \stdClass();

            $_error->code = $ex->getCode();
            $_error->message = $ex->getMessage();

            return $_error;
        }

    }


}