<?php

namespace App\Exceptions;

use Closure;
use GraphQL\Error\Error;
use Nuwave\Lighthouse\Exceptions\RendersErrorsExtensions;
use Nuwave\Lighthouse\Execution\ErrorHandler;
use Nuwave\Lighthouse\Exceptions\AuthenticationException;

class CustomHandler implements ErrorHandler
{
    /**
     * Handle Exceptions that implement Nuwave\Lighthouse\Exceptions\RendersErrorsExtensions
     * and add extra content from them to the 'extensions' key of the Error that is rendered
     * to the User.
     *
     * @param  \GraphQL\Error\Error  $error
     * @param  \Closure  $next
     * @return array
     */
    public static function handle(Error $error, Closure $next): array
    {
        $underlyingException = $error->getPrevious();
        $langs = [
            'The user credentials were incorrect.'=>'用户凭据不正确!',
            'Unauthenticated.'=>'登录失效!'
        ];
        $message = $error->message;
        if(in_array($error->message, array_keys($langs))){
            $message = $langs[$message];
        }
        if ($underlyingException instanceof AuthenticationException) {
            $error = new Error(
                $message,
                $error->nodes,
                $error->getSource(),
                $error->getPositions(),
                $error->getPath(),
                $underlyingException,
                $underlyingException->extensionsContent()
            );
        }
        if ($underlyingException instanceof RendersErrorsExtensions) {
            // Reconstruct the error, passing in the extensions of the underlying exception
            $error = new Error(
                $error->message,
                $error->nodes,
                $error->getSource(),
                $error->getPositions(),
                $error->getPath(),
                $underlyingException,
                []
            );
        }else{
            $error = new Error(
                $message,
                $error->nodes,
                $error->getSource(),
                $error->getPositions(),
                $error->getPath(),
                $underlyingException,
                []
            );
        }
        return $error->toSerializableArray();
//         return $next($error);
    }
}
