<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\CommentVote;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class CommentsController extends Controller
{
    /**
     * @Route("/komentarze", name="comments_list")
     */
    public function commentsAction(Request $request)
    {
        $getCommentsQuery = $this->getDoctrine()
            ->getRepository('AppBundle:Comment')
            ->getCommentsQuery($this->getUser());

        $paginator = $this->get('knp_paginator');
        $comments = $paginator->paginate(
            $getCommentsQuery,
            $request->query->get('page', 1),
            10
        );

        return $this->render('Comments/list.html.twig', [
            'comments' => $comments,
        ]);
    }

    /**
     * @Route("/komentarze/usun/{id}", name="comment_remove")
     * @Security("user == comment.getUser()")
     */
    public function removeAction(Comment $comment)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($comment);
        $em->flush();

        $this->addFlash('success', 'Twój komentarz został usunięty');

        return $this->redirectToRoute('comments_list', []);
    }

    /**
     * @Route("/komentarze/glosuj-up/{id}/{productId}", name="comment_vote_up")
     */
    public function voteUpAction(Comment $comment, $productId, Request $request)
    {
        $commentVote = $this->getDoctrine()
            ->getRepository('AppBundle:CommentVote')
            ->findOneBy([
                'user' => $this->getUser(),
                'comment' => $comment,
            ]);

        if ($commentVote) {

            if ($request->isXmlHttpRequest()) {
                return new JsonResponse([
                    'success'   => false, 'message' => 'Możesz zagłosować na komentarz tylko raz'
                ]);
            }

            $this->addFlash('danger', 'Możesz zagłosować na komentarz tylko raz');

        } else {

            $em = $this->getDoctrine()->getManager();

            $commentVote = new CommentVote();
            $commentVote->setComment($comment);
            $commentVote->setUser($this->getUser());

            $em->persist($commentVote);

            $comment->setNbVoteUp($comment->getNbVoteUp() + 1);

            $em->persist($comment);
            $em->flush();
        }
        
        if ($request->isXmlHttpRequest()) {
            return new JsonResponse([
                'success'   => true, 'nbVotes'  => $comment->getNbVoteUp()
            ]);
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("/komentarze/glosuj-down/{id}/{productId}", name="comment_vote_down")
     */
    public function voteDownAction(Comment $comment, $productId, Request $request)
    {
        $commentVote = $this->getDoctrine()
            ->getRepository('AppBundle:CommentVote')
            ->findOneBy([
                'user' => $this->getUser(),
                'comment' => $comment,
            ]);
        if ($commentVote) {

            if ($request->isXmlHttpRequest()) {
                return new JsonResponse([
                    'success'   => false, 'message' => 'Możesz zagłosować na komentarz tylko raz'
                ]);
            }
            
            $this->addFlash('danger', 'Możesz zagłosować na komentarz tylko raz');
        } else {
            $em = $this->getDoctrine()->getManager();

            $commentVote = new CommentVote();
            $commentVote->setComment($comment);
            $commentVote->setUser($this->getUser());

            $em->persist($commentVote);

            $comment->setNbVoteDown($comment->getNbVoteDown() + 1);

            $em->persist($comment);
            $em->flush();
        }

        if ($request->isXmlHttpRequest()) {
            return new JsonResponse([
                'success'   => true, 'nbVotes'  => $comment->getNbVoteDown()
            ]);
        }

        return $this->redirect($request->headers->get('referer'));
    }
}