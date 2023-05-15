<?php

namespace App\Controller;

use App\Entity\Conversation;
use App\Entity\Message;
use App\Repository\ConversationRepository;
use App\Repository\MessageRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ConversationController extends AbstractController
{
    #[Route('/api/v1/conversation/create/{id}', methods: ['POST'])]
    public function index(UserRepository $userRepository, Request $request, ConversationRepository $conversationRepository): JsonResponse
    {
        try {
            $sender = $this->getUser();
            $receiverId = $request->get('id');
            $receiver = $userRepository->findOneBy(['id' => $receiverId]);

            $conversation = new Conversation();
            $conversation->setSender($sender);
            $conversation->setReceiver($receiver);

            $conversationRepository->save($conversation, true);

            return new JsonResponse("", 201);
        }catch (\Exception $exception){
            return new JsonResponse($exception->getMessage(), 500);
        }
    }

    #[Route('/api/v1/conversation/createmessage/{id}', methods: ['POST'])]
    public function createNewMessage(Conversation $conversation, Request $request, MessageRepository $messageRepository){
        $message = json_decode($request->getContent(), true);
        $message = $message['message'];
        $senderUser = $this->getUser();
        $receiverUser = $conversation->getReceiver();


        $newMessage = new Message();
        $newMessage->setContent($message);
        $newMessage->setSender($senderUser);
        $newMessage->setConversation($conversation);
        $newMessage->setReceiver($receiverUser);

        $messageRepository->save($newMessage, true);

        return new JsonResponse("", 201);
    }

    #[Route('/api/v1/conversation/getmessages/{id}', methods: ['GET'])]
    public function getMessages(Conversation $conversation, MessageRepository $messageRepository){
        $messages = $messageRepository->findBy(['conversation' => $conversation]);

        //dd($messages);

        return new JsonResponse($messages, 200);
    }
}
