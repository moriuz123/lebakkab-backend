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

        $this->renderable(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, $request) {
            if ($request->is('admin*')) {
                if (auth()->check()) {
                    \Filament\Notifications\Notification::make()
                        ->title('Halaman Tidak Ditemukan')
                        ->body('Halaman yang Anda tuju tidak tersedia atau salah penulisan.')
                        ->warning()
                        ->send();
                    return redirect('/admin');
                }
            }
        });

        $this->renderable(function (\Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException $e, $request) {
            if ($request->is('admin*') && auth()->check()) {
                \Filament\Notifications\Notification::make()
                    ->title('Akses Ditolak')
                    ->body('Anda tidak memiliki izin untuk mengakses halaman atau modul tersebut.')
                    ->danger()
                    ->send();
                return redirect('/admin');
            }
        });

        $this->renderable(function (\Illuminate\Auth\Access\AuthorizationException $e, $request) {
            if ($request->is('admin*') && auth()->check()) {
                \Filament\Notifications\Notification::make()
                    ->title('Akses Ditolak')
                    ->body('Anda tidak memiliki izin untuk melakukan aksi tersebut.')
                    ->danger()
                    ->send();
                return redirect('/admin');
            }
        });
    }
}
