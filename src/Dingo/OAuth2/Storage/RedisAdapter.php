<?php namespace Dingo\OAuth2\Storage;

use Predis\Client;

class RedisAdapter extends Adapter {

	/**
	 * Redis client instance.
	 * 
	 * @var \Predis\Client
	 */
	protected $redis;

	/**
	 * Array of tables used when interacting with database.
	 * 
	 * @var array
	 */
	protected $tables = [
		'clients'                   => 'oauth_clients',
		'client_endpoints'          => 'oauth_client_endpoints',
		'tokens'                    => 'oauth_tokens',
		'token_scopes'              => 'oauth_token_scopes',
		'authorization_codes'       => 'oauth_authorization_codes',
		'authorization_code_scopes' => 'oauth_authorization_code_scopes',
		'scopes'                    => 'oauth_scopes'
	];

	/**
	 * Create a new Dingo\OAuth2\Storage\RedisAdapter instance.
	 * 
	 * @param  \Predis\Client  $redis
	 * @param  string  $prefix
	 * @param  array  $tables
	 * @return void
	 */
	public function __construct(Client $redis, array $tables = [])
	{
		$this->redis = $redis;
		$this->tables = array_merge($this->tables, $tables);
	}

	/**
	 * Create the client storage instance.
	 * 
	 * @return \Dingo\OAuth2\Storage\Redis\Client
	 */
	public function createClientStorage()
	{
		return new Redis\Client($this->redis, $this->tables);
	}
	
	/**
	 * Create the token storage instance.
	 * 
	 * @return \Dingo\OAuth2\Storage\Redis\Token
	 */
	public function createTokenStorage()
	{
		return new Redis\Token($this->redis, $this->tables);
	}

	/**
	 * Create the authorization code storage instance.
	 * 
	 * @return \Dingo\OAuth2\Storage\Redis\AuthorizationCode
	 */
	public function createAuthorizationStorage()
	{
		return new Redis\AuthorizationCode($this->redis, $this->tables);
	}

	/**
	 * Create the scope storage instance.
	 * 
	 * @return \Dingo\OAuth2\Storage\Redis\Scope
	 */
	public function createScopeStorage()
	{
		return new Redis\Scope($this->redis, $this->tables);
	}

}