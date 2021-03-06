<?php

namespace SoftUniBlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SoftUniBlogBundle\Entity\Comment;
use SoftUniBlogBundle\Form\CommentType;
use SoftUniBlogBundle\Service\Articles\ArticleServiceInterface;
use SoftUniBlogBundle\Service\Comment\CommentServiceInterface;
use SoftUniBlogBundle\Service\Users\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends Controller
{

    /**
     * @var ArticleServiceInterface
     */
    private $articleService;
    /**
     * @var CommentServiceInterface
     */
    private $commentService;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    public function __construct(
        ArticleServiceInterface $articleService,
        CommentServiceInterface $commentService,
        UserServiceInterface $userService)
    {
        $this->articleService = $articleService;
        $this->commentService = $commentService;
        $this->userService = $userService;
    }

    /**
     * @Route("/comment/create/{id}", name="comment_create", methods={"POST"})
     * @param Request $request
     * @param $id
     * @return Response
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function create(Request $request, $id)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        $this->addFlash("message", "Comment created successfully!");
        $this->commentService->create($comment, $id);
        return $this->redirectToRoute("article_view", ['id' => $id]);
    }

    /**
     * @Route("/user/{id}/message", name="user_message", methods={"GET"})
     * @param $id
     * @return Response
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function addUserMessage($id){
        return $this->render("users/message.html.twig",
            [
                'user' => $this->userService->findOneById($id)
            ]);
    }


    public function getAllCommentsByArticleId(){

    }
}
