<?php

namespace Tenant\Support\Exceptions;

use Tenant\Support\Traits\ApiResponse;
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

class ExHandler extends ExceptionHandler
{
    use ApiResponse;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Throwable $exception, $request) {

            $statusCode = 0;
            $message = '';

            if ($exception instanceof AuthorizationException) 
            {
                $statusCode = 401;
                $message = $exception->getMessage();
            }else if ($exception instanceof AccessDeniedHttpException) 
            {
                $statusCode = 401;
                $message = $exception->getMessage();
            } else if ($exception instanceof ForbiddenException) 
            {
                $statusCode = 403;
                $message = $exception->getMessage();
            } else if ($exception instanceof ModelNotFoundException) 
            {
                $statusCode = 404;
                $message = 'Data not found.';
            } else if ($exception instanceof NotFoundHttpException) 
            {
                $statusCode = 404;
                $message = 'Data not found.';
            } else if ($exception instanceof MethodNotAllowedHttpException) 
            {
                $statusCode = 404;
                $message = 'Data not found.';
            } else if ($exception instanceof MethodNotFoundException) 
            {
                $statusCode = 405;
                $message = 'Method Data not found.';
            } else if ($exception instanceof \InvalidArgumentException) 
            {
                $statusCode = 500;
                $message = 'Invalid argument.';
            } else if ($exception instanceof HttpResponseException) 
            {
                $statusCode = 500;
                $message = 'Internal server error.';
            } else if ($exception instanceof NoTenantFound) 
            {
                $statusCode = 404;
                $message = $exception->getMessage();
            }  else if ($exception instanceof NotFoundException) 
            {
                $statusCode = 404;
                $message = $exception->getMessage();
            } else if ($exception instanceof Exception) 
            {
                $statusCode = 500;
                $message = $exception->getMessage();
            }

            if ($request->wantsJson()) {
                return $this->errorResponse($message, $statusCode);
            } else
            {
                return response()->view('errors.error', [
                    'code'  =>  $statusCode,
                    'message'   =>  $message
                ], $statusCode);
            }
        });
    }
}
