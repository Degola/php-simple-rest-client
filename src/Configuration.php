<?php
	/**
	 *
	 *
	 * User: degola
	 * Date: 05.09.16
	 * Time: 11:51
	 */

namespace Groar\Rest\Endpoint;

class Configuration {
	const AUTH_TYPE_NONE = 0;
	const AUTH_TYPE_HTTP_BASIC = 1;

	const CONTENT_TYPE_JSON = 'application/json';

	private $authType = self::AUTH_TYPE_NONE;
	private $contentType = self::CONTENT_TYPE_JSON;

	private $baseUrl;
	private $username;
	private $password;

	/**
	 * @return mixed
	 */
	public function getBaseUrl() {
		return $this->baseUrl;
	}

	/**
	 * @param mixed $baseUrl
	 */
	public function setBaseUrl($baseUrl) {
		$this->baseUrl = $baseUrl;
	}

	/**
	 * @return mixed
	 */
	public function getAuthType() {
		return $this->authType;
	}

	/**
	 * @param mixed $authType
	 */
	public function setAuthType($authType) {
		$this->authType = $authType;
	}

	/**
	 * @return mixed
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * @param mixed $username
	 */
	public function setUsername($username) {
		$this->username = $username;
	}

	/**
	 * @return mixed
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @param mixed $password
	 */
	public function setPassword($password) {
		$this->password = $password;
	}

	/**
	 * @return string
	 */
	public function getContentType() {
		return $this->contentType;
	}

	/**
	 * @param string $contentType
	 */
	public function setContentType($contentType) {
		$this->contentType = $contentType;
	}


}