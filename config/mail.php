<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | This option controls the default mailer that is used to send all email
    | messages unless another mailer is explicitly specified when sending
    | the message. All additional mailers can be configured within the
    | "mailers" array. Examples of each type of mailer are provided.
    |
    */

    'default' => env('MAIL_MAILER', 'log'),

    /*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    |
    | Here you may configure all of the mailers used by your application plus
    | their respective settings. Several examples have been configured for
    | you and you are free to add your own as your application requires.
    |
    */

    'mailers' => [

        /*
        |--------------------------------------------------------------------------
        | Default SMTP Mailer
        |--------------------------------------------------------------------------
        */

        'smtp' => [
            'transport' => 'smtp',
            'scheme' => env('MAIL_SCHEME'),
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', '127.0.0.1'),
            'port' => env('MAIL_PORT', 2525),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env(
                'MAIL_EHLO_DOMAIN',
                parse_url(
                    (string) env('APP_URL', 'http://localhost'),
                    PHP_URL_HOST
                )
            ),
        ],

        /*
        |--------------------------------------------------------------------------
        | Mailtrap Sandbox
        |--------------------------------------------------------------------------
        */
        'mailtrap' => [
            'transport' => 'smtp',
            'scheme' => 'smtp',
            'host' => env('MAILTRAP_HOST', 'sandbox.smtp.mailtrap.io'),
            'port' => env('MAILTRAP_PORT', 2525),
            'username' => env('MAILTRAP_USERNAME'),
            'password' => env('MAILTRAP_PASSWORD'),
            'timeout' => null,
        ],

        /*
        |--------------------------------------------------------------------------
        | Amazon SES
        |--------------------------------------------------------------------------
        */

        'ses' => [
            'transport' => 'ses',
        ],

        /*
        |--------------------------------------------------------------------------
        | Postmark
        |--------------------------------------------------------------------------
        */

        'postmark' => [
            'transport' => 'postmark',
        ],

        /*
        |--------------------------------------------------------------------------
        | Resend
        |--------------------------------------------------------------------------
        */

        'resend' => [
            'transport' => 'resend',
        ],

        /*
        |--------------------------------------------------------------------------
        | Sendmail
        |--------------------------------------------------------------------------
        */

        'sendmail' => [
            'transport' => 'sendmail',
            'path' => env(
                'MAIL_SENDMAIL_PATH',
                '/usr/sbin/sendmail -bs -i'
            ),
        ],

        /*
        |--------------------------------------------------------------------------
        | Log
        |--------------------------------------------------------------------------
        */

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        /*
        |--------------------------------------------------------------------------
        | Array
        |--------------------------------------------------------------------------
        */

        'array' => [
            'transport' => 'array',
        ],

        /*
        |--------------------------------------------------------------------------
        | Failover
        |--------------------------------------------------------------------------
        */

        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
            'retry_after' => 60,
        ],

        /*
        |--------------------------------------------------------------------------
        | Round Robin
        |--------------------------------------------------------------------------
        */

        'roundrobin' => [
            'transport' => 'roundrobin',
            'mailers' => [
                'ses',
                'postmark',
            ],
            'retry_after' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    |
    | This address is used as the default sender for your application's
    | emails.
    |
    */

    'from' => [
        'address' => env(
            'MAIL_FROM_ADDRESS',
            'hello@example.com'
        ),

        'name' => env(
            'MAIL_FROM_NAME',
            env('APP_NAME', 'Laravel')
        ),
    ],

];
