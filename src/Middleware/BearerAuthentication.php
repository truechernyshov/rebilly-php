<?php
/**
 * This source file is proprietary and part of Rebilly.
 *
 * (c) Rebilly SRL
 *     Rebilly Ltd.
 *     Rebilly Inc.
 *
 * @see https://www.rebilly.com
 */

namespace Rebilly\Middleware;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Rebilly\Middleware;

/**
 * Class BearerAuthentication.
 *
 */
final class BearerAuthentication implements Middleware
{
    public const HEADER = 'Authorization';

    /** @var string */
    private $sessionToken;

    /**
     * Constructor
     *
     * @param string $sessionToken
     */
    public function __construct($sessionToken)
    {
        $this->sessionToken = (string) $sessionToken;
    }

    /**
     * Add HTTP header to request.
     *
     * {@inheritdoc}
     */
    public function __invoke(Request $request, Response $response, callable $next)
    {
        return call_user_func(
            $next,
            $request->withHeader(self::HEADER, "Bearer {$this->sessionToken}"),
            $response
        );
    }
}
