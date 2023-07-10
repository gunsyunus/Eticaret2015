<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use DB;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
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
        parent::report($e);
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
        // Local
        if (env('APP_DEBUG') == true) {
            return parent::render($request, $e);
        }

        // Production
        if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            $settings = DB::table('settings')->where('id_setting', '=', '1')->first();
            $designs = DB::table('designs')->where('id_design', '=', '1')->first();
            return response()->view('errors.404', ['settings' => $settings, 'designs' => $designs], 404);
        } elseif ($e instanceof \Symfony\Component\Debug\Exception\FatalErrorException) {
            return response()->view('errors.500', [], 500);
        } else {
            return parent::render($request, $e);
        }
    }
}
