<?php


namespace SoftUniBlogBundle\Service\Comment;


use SoftUniBlogBundle\Entity\Comment;
use SoftUniBlogBundle\Repository\CommentRepository;
use SoftUniBlogBundle\Service\Articles\ArticleServiceInterface;
use SoftUniBlogBundle\Service\Users\UserServiceInterface;

class CommentService implements CommentServiceInterface
{

    /**
     * @var UserServiceInterface
     */
    private $userService;
    private $commentRepository;
    private $articleService;

    public function __construct(
        CommentRepository $commentRepository,
        UserServiceInterface $userService,
        ArticleServiceInterface $articleService)
    {
        $this->commentRepository = $commentRepository;
        $this->userService = $userService;
        $this->articleService = $articleService;
    }

    /**
     * @param int $articleId
     * @return Comment[]
     */
    public function getAllByArticleId(int $articleId)
    {
        $article = $this->articleService->getOne($articleId);
        return $this
            ->commentRepository
            ->findBy(['article' => $article], ['dateAdded' => 'DESC']);
    }

    public function getOne(): ?Comment
    {

    }

    /**
     * @param Comment $comment
     * @param int $articleId
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     */
    public function create(Comment $comment, int $articleId): bool
    {
        $comment
            ->setAuthor($this->userService->currentUser())
            ->setArticle($this->articleService->getOne($articleId));

        return $this->commentRepository->insert($comment);
    }
}