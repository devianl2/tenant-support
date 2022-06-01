<?php

namespace Tenant\Support\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Prophecy\Exception\Doubler\MethodNotFoundException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Exception;

class ThrowErrorCode
{
    /**
     * @throws Exception
     */
    public static function errorCode(int $code, string $message = null) {
        switch ($code) {
            case 401:
                throw new AuthorizationException($message ?? 'Unauthorized access');

            case 403:
                throw new ForbiddenException($message ?? 'Forbidden to access');

            case 404:
                throw new NotFoundHttpException($message ?? 'Data not found');

            default:
                throw new Exception($message ?? 'Exception error. Error Code:'.$code);
        }
    }
}
