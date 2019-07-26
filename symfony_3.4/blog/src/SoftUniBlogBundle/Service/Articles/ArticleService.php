<?php

namespace SoftUniBlogBundle\Service\Articles;


use Doctrine\Common\Collections\ArrayCollection;
use SoftUniBlogBundle\Entity\Article;
use SoftUniBlogBundle\Repository\ArticleRepository;
use SoftUniBlogBundle\Service\Users\UserServiceInterface;

class ArticleService implements ArticleServiceInterface
{

    private $articleRepository;
    private $userService;

    /**
     * ArticleService constructor.
     * @param ArticleRepository $articleRepository
     * @param UserServiceInterface $userService
     */
    public function __construct(ArticleRepository $articleRepository,
            UserServiceInterface $userService)
    {
        $this->articleRepository = $articleRepository;
        $this->userService = $userService;
    }


    /**
     * @param Article $article
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(Article $article): bool
    {
        $author = $this->userService->currentUser();
        $article->setAuthor($author);
        $article->setViewCount(0);
        return $this->articleRepository->insert($article);
    }

    /**
     * @param Article $article
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function edit(Article $article): bool
    {
        return $this->articleRepository->update($article);
    }

    /**
     * @param Article $article
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Article $article): bool
    {
        return $this->articleRepository->remove($article);
    }

    /**
     * @return ArrayCollection|Article[]
     */
    public function getAll()
    {
        return $this->articleRepository->findAll();
    }

    /**
     * @param int $id
     * @return Article|null|object
     */
    public function getOne(int $id): ?Article
    {
        return $this->articleRepository->find($id);
    }

    /**
     * @return ArrayCollection|Article[]
     */
    public function getAllArticlesByAuthor()
    {
       return $this->articleRepository
            ->findBy(
                [],
                [
                    'dateAdded' => 'DESC'
                ]);
    }
}