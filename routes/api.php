<?php

use Illuminate\Http\Request;

//Default auth routes
Route::post('login', 'Auth\AuthController@login');
Route::post('auth/facebook', 'Auth\AuthController@facebookAuth');
Route::post('auth/google', 'Auth\AuthController@googleAuth');
Route::post('register', 'Auth\AuthController@register');
Route::post('forgot/password', 'Auth\ForgotPasswordController@forgot');
Route::get('email/confirmation/{confirmation_code}', 'Auth\AuthController@confirmEmail');
Route::post('password/reset', 'Auth\ForgotPasswordController@resetPassword');


Route::middleware(['dinkoapi.auth', 'user.check.status'])->group(function (){
    Route::get('token/refresh', 'Auth\AuthController@getToken');
    Route::post('logout', 'Auth\AuthController@logout');    
    
    /*===================== CertificateController route section =====================*/
    Route::group(['prefix' => 'certificates'], function(){
        Route::get('paginate', 'CertificateController@paginate');



    });   

    Route::apiResource('certificates', 'CertificateController', [
        'parameters' => [
            'certificates' => 'id'
        ]
    ]);
    /* End CertificateController route section */
    
    /*===================== CompanyController route section =====================*/
    Route::group(['prefix' => 'companies'], function(){
        Route::get('paginate', 'CompanyController@paginate');
        
        Route::get('{id}/doctors', 'CompanyController@allDoctors');

        Route::get('{id}/doctors/paginate', 'CompanyController@paginatedDoctors');



    });   

    Route::apiResource('companies', 'CompanyController', [
        'parameters' => [
            'companies' => 'id'
        ]
    ]);
    /* End CompanyController route section */
    
    /*===================== DoctorController route section =====================*/
    Route::group(['prefix' => 'doctors'], function(){
        Route::get('paginate', 'DoctorController@paginate');
        
        Route::get('{id}/certificates', 'DoctorController@allCertificates');

        Route::get('{id}/certificates/paginate', 'DoctorController@paginatedCertificates');
        
        Route::get('sessions', 'DoctorController@allSessions');

        Route::get('sessions/paginate', 'DoctorController@paginatedSessions');
        
        Route::post('sessions/range', 'DoctorController@sessionsInRange');



    });   

    Route::apiResource('doctors', 'DoctorController', [
        'parameters' => [
            'doctors' => 'id'
        ]
    ]);
    /* End DoctorController route section */
    
    /*===================== MessageController route section =====================*/
    Route::group(['prefix' => 'messages'], function(){        

        Route::get('{poi_id}/chat', 'MessageController@chat');

    });   

    Route::resource('messages', 'MessageController', [
        'parameters' => [
            'messages' => 'id'
        ],
        'only' => [
            "store"
        ]
    ]);
    /* End MessageController route section */
    
    /*===================== NoteController route section =====================*/
    Route::group(['prefix' => 'notes'], function(){
        Route::get('paginate', 'NoteController@paginate');



    });   

    Route::apiResource('notes', 'NoteController', [
        'parameters' => [
            'notes' => 'id'
        ]
    ]);
    /* End NoteController route section */
    
    /*===================== PatientController route section =====================*/
    Route::group(['prefix' => 'patients'], function(){
        Route::get('paginate', 'PatientController@paginate');
        
        Route::get('sessions', 'PatientController@allSessions');

        Route::get('sessions/paginate', 'PatientController@paginatedSessions');

        Route::post('sessions/range', 'PatientController@sessionsInRange');

    });   

    Route::resource('patients', 'PatientController', [
        'parameters' => [
            'patients' => 'id'
        ],
        'except' => [
            'store', 'update', 'destroy'
        ]
    ]);
    /* End PatientController route section */
    
    /*===================== QuestionController route section =====================*/
    Route::group(['prefix' => 'questions'], function(){
        Route::get('paginate', 'QuestionController@paginate');
        
        Route::get('{id}/ratings', 'QuestionController@allRatings');

        Route::get('{id}/ratings/paginate', 'QuestionController@paginatedRatings');



    });   

    Route::apiResource('questions', 'QuestionController', [
        'parameters' => [
            'questions' => 'id'
        ]
    ]);
    /* End QuestionController route section */
    
    /*===================== RatingController route section =====================*/
    Route::group(['prefix' => 'ratings'], function(){
        Route::get('paginate', 'RatingController@paginate');
        
        Route::get('{id}/questions', 'RatingController@allQuestions');

        Route::get('{id}/questions/paginate', 'RatingController@paginatedQuestions');

        Route::post('{id}/questions/{question_id}', 'RatingController@attachQuestion');

        Route::delete('{id}/questions/{question_id}', 'RatingController@detachQuestion');

    });   

    Route::apiResource('ratings', 'RatingController', [
        'parameters' => [
            'ratings' => 'id'
        ]
    ]);
    /* End RatingController route section */
    
    /*===================== SessionController route section =====================*/
    Route::group(['prefix' => 'sessions'], function(){
        Route::get('paginate', 'SessionController@paginate');
        
        Route::post('{id}/cancel', 'SessionController@cancel');
        
        Route::post('{id}/approve', 'SessionController@approve');
        
        Route::get('{id}/notes', 'SessionController@allNotes');

        Route::get('{id}/notes/paginate', 'SessionController@paginatedNotes');
        
        Route::get('{id}/ratings', 'SessionController@allRatings');

        Route::get('{id}/ratings/paginate', 'SessionController@paginatedRatings');



    });   

    Route::resource('sessions', 'SessionController', [
        'parameters' => [
            'sessions' => 'id'
        ],
        'except' => [
            'destroy'
        ]
    ]);
    /* End SessionController route section */
    
    /*===================== TransactionController route section =====================*/
    Route::group(['prefix' => 'transactions'], function(){
        Route::get('paginate', 'TransactionController@paginate');



    });   

    Route::apiResource('transactions', 'TransactionController', [
        'parameters' => [
            'transactions' => 'id'
        ]
    ]);
    /* End TransactionController route section */
    
    /*===================== UserController route section =====================*/
    Route::group(['prefix' => 'users'], function(){
        Route::get("/me", 'UserController@me');
        Route::post("/", 'UserController@update');
        
        Route::get('roles', 'UserController@allRoles');

        Route::get('roles/paginate', 'UserController@paginatedRoles');
        
        Route::get('social-networks', 'UserController@allSocialNetworks');

        Route::get('social-networks/paginate', 'UserController@paginatedSocialNetworks');

    });
    
    Route::resource('users', 'UserController', [
        'parameters' => [
            'users' => 'id'
        ],
        'except' => [
            'store', 'update', 'destroy'
        ]
    ]);
    
    /* End UserController route section */
    
    /*===================== WalletController route section =====================*/
    Route::group(['prefix' => 'wallets'], function(){
        Route::get('paginate', 'WalletController@paginate');
        
        Route::get('{id}/transactions', 'WalletController@allTransactions');

        Route::get('{id}/transactions/paginate', 'WalletController@paginatedTransactions');



    });   

    Route::apiResource('wallets', 'WalletController', [
        'parameters' => [
            'wallets' => 'id'
        ]
    ]);
    /* End WalletController route section */


});

