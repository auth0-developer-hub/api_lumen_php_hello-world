<?php
namespace App\Http\Controllers\Api;

use App\Services\MessageServiceInterface;
use Laravel\Lumen\Routing\Controller;

class MessagesController extends Controller
{
    public function showPublicMessage(MessageServiceInterface $messageService)
    {
        return $messageService->getPublicMessage()->toArray();
    }

    public function showAdminMessage(MessageServiceInterface $messageService)
    {
        return $messageService->getAdminMessage()->toArray();
    }

    public function showProtectedMessage(MessageServiceInterface $messageService)
    {
        return $messageService->getProtectedMessage()->toArray();
    }
}
