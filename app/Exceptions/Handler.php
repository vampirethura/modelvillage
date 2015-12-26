<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\Debug\ExceptionHandler as SymfonyDisplayer;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        // dd($e);
        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }

        if ($this->isHttpException($e) && $e->getStatusCode() == 500) {
            $debug = config('app.debug', false);
            return response()->view('errors.500', ['exception' => $e, 'debug' => $debug], 500);
            // return $this->renderHttpException($e);
        }

        if ($this->isHttpException($e)) {
            return $this->renderHttpException($e);
        }

        return parent::render($request, $e);
    }

    /**
     * Convert the given exception into a Response instance.
     *
     * @param \Exception $e
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertExceptionToResponse(Exception $e)
    {
        $debug = config('app.debug', false);
        if ($debug) {
            return (new SymfonyDisplayer($debug))->createResponse($e);
        }
        return response()->view('errors.500', ['exception' => $e, 'debug' => $debug], 500);
    }
}
