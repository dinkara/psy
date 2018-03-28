<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'admin' => \App\Http\Middleware\IsAdmin::class,
        'doctor' => \App\Http\Middleware\IsDoctor::class,
        'doctor.question' => \App\Http\Middleware\AttachDoctorQuestion::class,
        'patient' => \App\Http\Middleware\IsPatient::class,
        'patient.question' => \App\Http\Middleware\AttachPatientQuestion::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'jwt.auth' => \Tymon\JWTAuth\Middleware\GetUserFromToken::class,
        'jwt.refresh' => \Tymon\JWTAuth\Middleware\RefreshToken::class,
        'dinkoapi.auth' => \Dinkara\DinkoApi\Http\Middleware\DinkoApiAuthMiddleware::class,
        'user.check.status' => \App\Http\Middleware\CheckUserStatusMiddleware::class,
        'exists.certificate' => \App\Http\Middleware\CertificateExists::class,    
        'exists.company' => \App\Http\Middleware\CompanyExists::class,    
        'exists.doctor' => \App\Http\Middleware\DoctorExists::class,    
        'exists.message' => \App\Http\Middleware\MessageExists::class,    
        'exists.note' => \App\Http\Middleware\NoteExists::class,    
        'exists.patient' => \App\Http\Middleware\PatientExists::class,    
        'exists.profile' => \App\Http\Middleware\ProfileExists::class,    
        'exists.question' => \App\Http\Middleware\QuestionExists::class,    
        'exists.rating' => \App\Http\Middleware\RatingExists::class,    
        'exists.role' => \App\Http\Middleware\RoleExists::class,    
        'exists.session' => \App\Http\Middleware\SessionExists::class,
        'session.completed' => \App\Http\Middleware\IsSessionCompleted::class,
        'exists.socialnetwork' => \App\Http\Middleware\SocialNetworkExists::class,    
        'exists.transaction' => \App\Http\Middleware\TransactionExists::class,    
        'exists.user' => \App\Http\Middleware\UserExists::class,    
        'exists.wallet' => \App\Http\Middleware\WalletExists::class,    
        'owns.doctor' => \App\Http\Middleware\DoctorOwner::class,    
        'owns.message' => \App\Http\Middleware\MessageOwner::class,    
        'owns.patient' => \App\Http\Middleware\PatientOwner::class,    
        'owns.profile' => \App\Http\Middleware\ProfileOwner::class,    
        'owns.wallet' => \App\Http\Middleware\WalletOwner::class,
        'owns.session' => \App\Http\Middleware\SessionOwner::class,
        'session.participant' => \App\Http\Middleware\SessionOwner::class,
        'owns.note' => \App\Http\Middleware\NotenOwner::class,
        'owns.certificate' => \App\Http\Middleware\CertificateOwner::class,
        'can.message' => \App\Http\Middleware\CanMessage::class,

    ];
}
