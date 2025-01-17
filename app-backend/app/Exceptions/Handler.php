<?php

namespace App\Exceptions;

use BadMethodCallException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Stancl\Tenancy\Exceptions\TenantCouldNotBeIdentifiedOnDomainException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
        $this->renderable(function (UnauthorizedException $e, $request) {
            return response()->json([
                'errors' => [
                    'unauthorized' => [
                        'Usuário não tem permissão requerida.'
                    ]
                ]
            ], 403);
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            $model = Arr::last(explode('\\', $e->getModel()));
            $modelTranslation = getPortugueseModelName($model);
            $modelName = $modelTranslation ?? $model;

            return response()->json([
                'errors' => [
                    'model' => [
                        $modelName . ' não encontrado(a).'
                    ]
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        if ($e->getMessage() === 'Email já existe') {
            return response()->json([
                'errors' => [
                    'email' => [
                        $e->getMessage()
                    ]
                ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($e instanceof QueryException) {
            return response()->json([
                'errors' => [
                    'query' => [
                        $e->getMessage()
                    ]
                ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($e instanceof TenantCouldNotBeIdentifiedOnDomainException) {
            return response()->json([
                'errors' => [
                    'tenant' => [
                        $e->getMessage()
                    ]
                ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($e instanceof NotFoundHttpException) {
            return response()->json([
                'errors' => [
                    'route' => [
                        $e->getMessage()
                    ]
                ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        if ($e instanceof BadMethodCallException) {
            return response()->json([
                'errors' => [
                    'query' => [
                        $e->getMessage()
                    ],
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }


        return parent::render($request, $e);
    }
}
