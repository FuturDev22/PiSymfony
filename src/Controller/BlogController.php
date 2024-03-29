<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Article;
use App\Entity\PostLike;
use App\Form\SearchForm;
use Symfony\Component\HttpFoundation\File\File;

use App\Entity\Categorie;
use App\Entity\Comment;
use App\Form\ArticleType;
use App\Form\CategorieType;
use App\Form\CommentsType;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Repository\PostLikeRepository;
use ContainerAj7bnPz\PaginatorInterface_82dac15;
use Doctrine\Persistence\ObjectManager;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;





class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="app_blog")
     */
    public function index(ArticleRepository $repo,CategorieRepository $repo1, Request $request)
    {
        $data = new SearchData();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        $articles = $repo->findSearch($data);
        $Cat = $repo1->findAll();

        return $this->render('blog/Front/Blog.html.twig', [
            'controller_name' => 'BlogController','articles'=>$articles,'categories'=>$Cat,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/blog/{id}", name="blog_show")
     * @param Id $id
     */
    public function show($id, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $repo2 = $this->getDoctrine()->getRepository(Comment::class);
        $comment=new Comment();
        $form=$this->createForm(CommentsType::class,$comment);
        $form->handleRequest($request);
        //$hasAccess = $this->isGranted('ROLE_USER');
        $article = $repo->find($id);
        $darticles=$repo->findBy(array(),array('date'=>'DESC'),3,0);
        $comments= $repo2->findBy(['article'=>$id] , array('createdAt'=>'DESC'));

        if ($form->isSubmitted() && $form->isValid()) {
          //  if (!$hasAccess){
            //    $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
          //  }
            //else{
                $author="youssef@esprit.tn";
                $comment->setAuthor($author);
                $dt=new \DateTime();
                $dt->add(new \DateInterval('PT1H'));
                $comment->setCreatedAt($dt);
                $comment->setArticle($article);
                $em= $this->getDoctrine()->getManager();
                $em->persist($comment);
                $em->flush();
                return $this->redirectToRoute('blog_show', array('id' => $id));
            }

        //}

        return $this->render('blog/Front/show.html.twig',['article'=>$article,'comments'=>$comments, 'darticles'=>$darticles,'form'=> $form->createView()]);
    }


    /**
     * @Route("/Article/{id}/like", name="Article_Like")
     */
    public function like($id)
    {
        $liked=false;
        //$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user="youssef";
        $manager=$this->getDoctrine()->getManager();
        $article=$manager->getRepository(Article::class)->find($id);
        $likes=$manager->getRepository(PostLike::class)->findAll();
        foreach ($likes as $l){
            if (($l==$user) && ($l->getArticle()->getId()==$id)){
                $manager->remove($l);
                $manager->flush();
                $liked=true;
                $this->addFlash('warning', 'Post unliked !');
            }
        }
        if (!$liked){
            $PostLike = new PostLike();
            $PostLike->setArticle($article);
            $PostLike->setUser($user);
            $manager->persist($PostLike);
            $manager->flush();
            $this->addFlash('success', 'Post liked !');
        }
        return $this->redirectToRoute('blog');

    }
    /**
     * @Route("/blog/{id}/remove/{idC}", name="blog_uncomment")
     */
    public function removeComment($id,$idC){
        $manager= $this->getDoctrine()->getManager();
        $comment= $manager->getRepository(Comment::class)->find($idC);
        $manager->remove($comment);
        $manager->flush();
        return $this->redirectToRoute('blog_show', array('id' => $id));

    }
    /**
     * @Route("/Remove/{id}", name="Supprimer" )

     */


    public function removeArticleAction(Article $article)
    {

        $em=$this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();
        return $this->redirectToRoute("BackBlog");

    }
    /**
     * @Route("/BackBlog", name="BackBlog")

     */
    public function BackBlogAction(ArticleRepository $repo,CategorieRepository $repo1)
    {
        $categories =$repo1->findAll();
        $articles = $repo->findAll();
        return $this->render('blog/Back/BlogBack.html.twig',['articles'=>$articles,'categories'=>$categories]);
    }
    /**
     * @Route("/BackBlog/newCat", name="Cat_new")
     * @Route ("/BackBlog/{id}/edit_Cat",name="Cat_edit")
     */

    public function createCat(Categorie $cat = null,Request $request)
    {
        if(!$cat) {
            $cat = new  Categorie();
        }
        $form=$this->createForm(CategorieType::class,$cat);
        $form->handleRequest($request) ;

        if ($form->isSubmitted()&& $form->isValid())
        {


            $manager=$this->getDoctrine()->getManager();
            $manager->persist($cat);
            $manager->flush();
            //$this->redirectToRoute('blogBack_show', ['id' => $article->getId()]);
            return $this->redirectToRoute('BackBlog');

        }

        return $this->render('blog/Back/CreateCat.html.twig',['formCat'=>$form->createView(),'editMode'=>$cat->getId()!==null]);
    }

    /**
     * @Route("/RemoveCat/{id}", name="SupprimerCat" )

     */


    public function removeCatAction(Categorie $categorie)
    {

        $em=$this->getDoctrine()->getManager();
        $em->remove($categorie);
        $em->flush();
        return $this->redirectToRoute("BackBlog");

    }
    /**
     * @Route("/BackBlog/new", name="Article_new")
     * @Route ("/BackBlog/{id}/edit",name="Blog_edit")
     */
    public function create(Article $article = null,Request $request, \Swift_Mailer $mailer)
    {
        if(!$article) {
            $article = new  Article();
        }
        $form=$this->createForm(ArticleType::class,$article);
        $form->handleRequest($request) ;

        if ($form->isSubmitted() && $form->isValid())
        {

            $file = $form['Image']->getData();
            if($file)
            {
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $article->setImage($fileName);
                $file->move(
                    $this->getParameter('EventImage_directory'),
                    $fileName
                );
            }else
            {
                $article->setImage('default.png');
            }


            if(!$article->getId()) {
                $article->setDate(new \DateTime());
            }

            $manager=$this->getDoctrine()->getManager();
            $manager->persist($article);
            $manager->flush();
            //$users=$manager->getRepository(User::class)->findAll();
            //foreach ($users as $u){
              //  $message= (new \Swift_Message('[MedikaTravel] : Nouvel Article'))
                //    ->setFrom("medikatravel2021@gmail.com")
                  //  ->setTo($u->getEmail())
                    // ->setBody(
                      //  $this->renderView('emails/newsletter.html.twig',
                      //      compact('article')),
                      //  'text/html');
                //$mailer->send($message);
          //  }

            //$this->redirectToRoute('blogBack_show', ['id' => $article->getId()]);
            return $this->redirectToRoute('BackBlog');

        }

        return $this->render('blog/Back/CreateArticle.html.twig',['formArticle'=>$form->createView(),'editMode'=>$article->getId()!==null]);
    }
    /**
     * @Route("/change_locale/{locale}", name="change_locale")
     */
    public function changeLocale($locale, Request $request)
    {
        // On stocke la langue dans la session
        $request->getSession()->set('_locale', $locale);


        // On revient sur la page précédente
        return $this->redirect($request->headers->get('referer'));
    }




}
