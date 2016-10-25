<?php
	/**
	 *
	 *
	 * User: degola
	 * Date: 05.09.16
	 * Time: 11:54
	 */

namespace Groar\Rest\Endpoint;

class Transport {
	/**
	 * @var Configuration
	 */
	private $configuration;

	public function __construct(Configuration $configuration) {
		$this->configuration = $configuration;
	}

	protected function buildUrl($url) {
		$baseUrl = $this->configuration->getBaseUrl();
		if(substr($baseUrl, -1) != '/') {
			$baseUrl .= '/';
		}
		if(substr($url, 0, 1) == '/') {
			return $baseUrl.substr($url, 1);
		}
		return $baseUrl.$url;
	}
	protected function getContext($httpMethod, $content = null) {
		$headers = [];
		$httpHeader = [];
		switch($this->configuration->getAuthType()) {
			case Configuration::AUTH_TYPE_HTTP_BASIC:
				$headers[] = "Authorization: Basic " . base64_encode(implode(':', [$this->configuration->getUsername(), $this->configuration->getPassword()]));
				break;
		}
		if(!is_null($content)) {
			$headers[] = "Content-Type: ".$this->configuration->getContentType();
			switch($this->configuration->getContentType()) {
				case Configuration::CONTENT_TYPE_JSON:
					$httpHeader['content'] = json_encode($content);
					break;
			}
			$headers[] = "Content-Length: ".strlen($httpHeader['content']);
		}
		$httpHeader['method'] = $httpMethod;
		$httpHeader['header'] = implode("\r\n", $headers);
		$context = stream_context_create(array(
			'http' => $httpHeader
		));
		return $context;
	}

	/**
	 * @param $url
	 * @param $context
	 * @return string
	 * @throws TransportException
	 */
	protected function getContent($url, $context) {
		$content = @file_get_contents($url, false, $context);
		if($content === false) {
			$error = error_get_last();
			throw new TransportException($error['message']);
		}
		return $content;
	}

	public function get($url) {
		return $this->getContent(
			$this->buildUrl($url),
			$this->getContext('GET', null)
		);
	}
	public function post($url, $data) {
		return $this->getContent(
			$this->buildUrl($url),
			$this->getContext('POST', $data)
		);
	}
}