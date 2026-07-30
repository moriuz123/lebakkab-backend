<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
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

        $this->renderable(function (\Throwable $e, $request) {
            if ($request->is('admin*') && auth()->check()) {
                $is404 = $e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
                $is403 = $e instanceof \Illuminate\Auth\Access\AuthorizationException || 
                         $e instanceof \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException ||
                         ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException && $e->getStatusCode() === 403);

                if ($is404) {
                    \Filament\Notifications\Notification::make()
                        ->title('Halaman Tidak Ditemukan')
                        ->body('Halaman yang Anda tuju tidak tersedia atau salah penulisan.')
                        ->warning()
                        ->send();
                    return redirect('/admin');
                }

                if ($is403) {
                    \Filament\Notifications\Notification::make()
                        ->title('Akses Ditolak')
                        ->body('Anda tidak memiliki izin untuk mengakses halaman atau modul tersebut.')
                        ->danger()
                        ->send();
                    return redirect('/admin');
                }
            }
        });
    }
}
