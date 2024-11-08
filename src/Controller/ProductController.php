<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/', name: 'app_product')]
    public function index(ProductRepository $productRepository): Response
    {

        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);

        /*$product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        return $this->render('product/index.html.twig', [
            'comment_form' => $form,
        ]);*/
        /* $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setConference($conference);
            if ($photo = $form['photo']->getData()) {
                $filename = bin2hex(random_bytes(6)) . '.' . $photo->guessExtension();
                $photo->move($photoDir, $filename);
                $comment->setPhotoFilename($filename);
            }
            $this->entityManager->persist($comment);
            $this->entityManager->flush();

            $context = [
                'user_ip' => $request->getClientIp(),
                'referrer' => $request->headers->get('referer'),
                'permalink' => $request->getUri(),
            ];
            $this->bus->dispatch(new CommentMessage($comment->getId(), $context));
            $notifier->send(new Notification('Thank you for the feedback; your comment will be posted after moderation.', ['browser']));
            return $this->redirectToRoute('conference', ['slug' => $conference->getSlug()]);
        } elseif ($form->isSubmitted()) {
            $notifier->send(new Notification('Can you check your submission? There are some problems with it.', ['browser']));
        }


        $offset = max(0, $request->query->get('offset', 0));
        $paginator = $commentRepository->getCommentPaginator($conference, $offset);
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);*/
    }
}
