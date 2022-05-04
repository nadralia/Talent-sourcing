<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\ErrorHandler\Error\FatalError;
use InvalidArgumentException;
use Throwable;
use TypeError;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use PDOException;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        \League\OAuth2\Server\Exception\OAuthServerException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];
    
    public function report(Throwable $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception) && app()->environment('production')) {
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $throwable) {
            //
        });
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function render($request, Throwable $throwable)
    {
        if (request()->is('api/*')) {
            if ($throwable instanceof TypeError) {
                $response = errorResponse('Please check your request and try again', 400);
            } elseif ($throwable instanceof NotFoundHttpException || $throwable instanceof ModelNotFoundException) {
                $response = errorResponse('Record not found!', 404);
            } elseif ($throwable instanceof FatalError || $throwable instanceof InvalidArgumentException) {
                $response = errorResponse('Opps! Something went wrong, and we have been notified', 500);
            } elseif ($throwable instanceof ValidationException) {
                $response = errorResponse($throwable->validator->errors()->first(), 422, $throwable->validator->errors());
            } elseif ($throwable instanceof QueryException || $throwable instanceof PDOException) {
                $message = $throwable->getMessage();
                $message = substr($message, strpos($message, ':') + 1);
                $message = substr($message, 0, strpos($message, ':') + 1);
                $message = substr($message, 0, strpos($message, ':'));

                $response = errorResponse(trim($message), 422);
            } elseif ($throwable instanceof AuthenticationException) {
                $response = errorResponse($throwable->getMessage(), 401);
            } else {
                $response = errorResponse($throwable->getMessage(), 500);
            }

            Log::error($throwable);

            return $response;
        }
    
        return parent::render($request, $throwable);
    }
}
