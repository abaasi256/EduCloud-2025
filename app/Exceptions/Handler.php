<?php

namespace App\Exceptions;

use App\Http\Helpers\AppHelper;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();

            if(!env('APP_DEBUG', false)) {
                if (!$request->user() && AppHelper::isFrontendEnabled()) {
                    $locale = Session::get('user_locale');
                    App::setLocale($locale);

                    if ($statusCode == 404) {
                        return response()->view('errors.front_404', [], 404);
                    }

                    if ($statusCode == 500) {
                        return response()->view('errors.front_500', [], 500);
                    }
                }
            }

            if ($request->user()) {
                if ($statusCode == 404) {
                    return response()->view('errors.back_404', [], 404);
                }

                if ($statusCode == 401) {
                    return response()->view('errors.back_401', [], 401);
                }
            }
        }

        return parent::render($request, $exception);
    }
}