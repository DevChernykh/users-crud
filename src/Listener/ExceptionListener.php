<?php

declare(strict_types=1);

namespace App\Listener;

use App\Exception\HttpResponsableException;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

#[AsEventListener(event: KernelEvents::EXCEPTION)]
class ExceptionListener
{
    public function __invoke(ExceptionEvent $event): void
    {
//        $throwable = $event->getThrowable();
//
//        $newThrowable = match (true) {
//            $throwable instanceof UnprocessableEntityHttpException => $this->getValidationHttpException(),
//            $throwable instanceof HttpResponsableException => $this->getHttpResponableException($throwable),
//            default => new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR),
//        };
//
//        $event->setThrowable($newThrowable);
    }

    private function getValidationHttpException(): HttpException
    {
        return new HttpException(
            Response::HTTP_UNPROCESSABLE_ENTITY,
            'Incorrect data'
        );
    }

    private function getHttpResponableException(HttpResponsableException $exception): HttpException
    {
        return new HttpException(
            $exception->getStatusCode(),
            $exception->getMessage(),
        );
    }
}
