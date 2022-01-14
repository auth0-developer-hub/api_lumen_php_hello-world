<?php
namespace App\Http\Controllers\Api;

use App\Services\MessageServiceInterface;
use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller;

class MessagesController extends Controller
{
    public function showPublicMessage(MessageServiceInterface $messageService): JsonResponse
    {
        return new JsonResponse($messageService->getPublicMessage()->toArray());
    }

    public function showAdminMessage(MessageServiceInterface $messageService): JsonResponse
    {
        return new JsonResponse($messageService->getAdminMessage()->toArray());
    }

    public function showProtectedMessage(MessageServiceInterface $messageService): JsonResponse
    {
        return new JsonResponse($messageService->getProtectedMessage()->toArray());
    }
}
