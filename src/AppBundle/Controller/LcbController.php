<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Articles;
use AppBundle\Entity\Users;
use AppBundle\Entity\Categories;
use AppBundle\Entity\Comments;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class LcbController extends Controller
{
    /**
     * @Route("/index/{message}", name="index")
     */
    public function indexAction($message='', Request $request)
    {

      $articles = $this->getDoctrine()
          ->getRepository('AppBundle:Articles')
          ->findAll();

      $comments = $this->getDoctrine()
          ->getRepository('AppBundle:Comments')
          ->findAll();

      $categories = $this->getDoctrine()
          ->getRepository('AppBundle:Categories')
          ->findAll();

      return $this->render('lcb/index.html.php', array('message' => $message, 'articles' => $articles, 'comments' => $comments, 'categories' => $categories));
      /*
        $articles = $this->getDoctrine()
            ->getRepository('AppBundle:Articles')
            ->findAll();

        return $this->render('lcb/index.html.php', array(
          'articles' => $articles
        ));
        */
    }









    // 1
    /**
     * @Route("/create_user", name="create_user")
     */
    public function createAction(Request $request)
    {
        $user = new Users;
        $name = $_POST['tbName'];
        $pass = $_POST['tbPass'];

        $user->setName($name);
        $user->setPass($pass);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $this->addFlash(
          'notice',
          'User Added'
        );

        return $this->redirectToRoute('index', array('message' => "Account is created."));
    }














    // 2
    /**
     * @Route("/login_user", name="login_user")
     */
    public function login_userAction(Request $request)
    {

        $name = $_POST['tbName'];
        $pass = $_POST['tbPass'];

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $users = $qb->select(array('t'))
        ->from('AppBundle:Users', 't')
        ->where("t.name = '".$name."'")
        ->andWhere("t.pass = '".$pass."'")
        ->getQuery()
        ->getResult();


        if(count($users) > 0) {
          $_SESSION['user_id'] = $users[0]->getId();
        }

        return $this->render('lcb/index.html.php', array('message' => 'you are logged in'));

    }














    // 3
    /**
     * @Route("/create_article", name="create_article")
     */
    public function create_articleAction(Request $request)
    {
        $article = new Articles;
        $categories_id = $_POST['tbCategories_id'];
        $text = $_POST['tbText'];
        $title = $_POST['tbTitle'];
        $user_id = $_SESSION['user_id'];

        $article->setCategories_id($categories_id);
        $article->setText($text);
        $article->setTitle($title);
        $article->setUsers_id($user_id);

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        $this->addFlash(
          'notice',
          'article Added'
        );

        return $this->redirectToRoute('index', array('message' => "Article is created."));
    }












    // 4
    /**
     * @Route("/create_categorie", name="create_categorie")
     */
    public function create_categorieAction(Request $request)
    {
        $categorie = new Categories;
        $title = $_POST['tbTitle'];
        $user_id = $_SESSION['user_id'];

        $categorie->setTitle($title);
        $categorie->setUsers_id($user_id);

        $em = $this->getDoctrine()->getManager();
        $em->persist($categorie);
        $em->flush();

        $this->addFlash(
          'notice',
          'Categorie Added'
        );

        return $this->redirectToRoute('index', array('message' => "Categorie is created."));
    }



















    // 5
    /**
     * @Route("/update_article", name="update_article")
     */
    public function update_articleAction(Request $request)
    {
        $id_articles = $_POST['article_id'];
        $categories_id = $_POST['tbCategories_id'];
        $text = $_POST['tbText'];
        $title = $_POST['tbTitle'];
        $user_id = $_SESSION['user_id'];

        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Articles')->find($id_articles);

        $article->setCategories_id($categories_id);
        $article->setText($text);
        $article->setTitle($title);
        $article->setUsers_id($user_id);

        $em->flush();

        $this->addFlash(
          'notice',
          'article Added'
        );

        return $this->redirectToRoute('index', array('message' => "Article is updated."));
    }




    /**
     * @Route("/create_comment", name="create_comment")
     */
    public function create_commentAction(Request $request)
    {
        $comment = new Comments;
        $title = $_POST['tbTitle'];
        $text = $_POST['tbText'];
        $article_id = $_POST['article_id'];
        $user_id = $_SESSION['user_id'];

        $comment->setTitle($title);
        $comment->setText($text);
        $comment->setArticles_id($article_id);
        $comment->setUsers_id($user_id);

        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();

        $this->addFlash(
          'notice',
          'Categorie Added'
        );

        return $this->redirectToRoute('index', array('message' => "Comment is created."));
    }




    /**
     * @Route("/update_comment", name="create_comment")
     */
    public function update_commentAction(Request $request)
    {
        $id_comment = $_POST['comment_id'];
        $title = $_POST['tbTitle'];
        $text = $_POST['tbText'];
        $article_id = $_POST['article_id'];
        $user_id = $_SESSION['user_id'];

        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository('AppBundle:Comments')->find($id_comment);

        $comment->setTitle($title);
        $comment->setText($text);
        $comment->setArticles_id($article_id);
        $comment->setUsers_id($user_id);

        $em->flush();

        $this->addFlash(
          'notice',
          'article Added'
        );

        return $this->redirectToRoute('index', array('message' => "Comment is updated."));
    }


    /**
     * @Route("/delete_article", name="delete_article")
     */
    public function delete_articleAction(Request $request)
    {



        $article_id = $_POST['article_id'];

        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Articles')->find($article_id);

        $em->remove($article);
        $em->flush();

        $this->addFlash(
          'notice',
          'Article deleted'
        );

        return $this->redirectToRoute('index', array('message' => "Article is deleted."));
    }



    /**
     * @Route("/delete_comment", name="delete_comment")
     */
    public function delete_commentAction(Request $request)
    {
        $comment_id = $_POST['comment_id'];

        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository('AppBundle:Comments')->find($comment_id);

        $em->remove($comment);
        $em->flush();

        $this->addFlash(
          'notice',
          'comment deleted'
        );

        return $this->redirectToRoute('index', array('message' => "comment is deleted."));
    }






















    // 6
    /**
     * @Route("/update_categorie", name="update_categorie")
     */
    public function update_categorieAction(Request $request)
    {
        $categorie_id = $_POST['categorie_id'];
        $title = $_POST['tbTitle'];
        $user_id = $_SESSION['user_id'];

        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('AppBundle:Categories')->find($categorie_id);

        $categorie->setTitle($title);
        $categorie->setUsers_id($user_id);

        $em->flush();

        $this->addFlash(
          'notice',
          'article Added'
        );

        return $this->redirectToRoute('index', array('message' => "Categorie is updated."));
    }


    /**
     * @Route("/delete_categorie", name="delete_categorie")
     */
    public function delete_categorieAction(Request $request)
    {

        $categorie_id = $_POST['categorie_id'];

        $em = $this->getDoctrine()->getManager();
        $RAW_QUERY = "DELETE FROM articles WHERE categories_id = '$categorie_id';";
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $em = $this->getDoctrine()->getManager();
        $RAW_QUERY = "DELETE FROM categories WHERE id = '$categorie_id';";
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        return $this->redirectToRoute('index', array('message' => "Categorie is deleted. With all its articles."));
    }







}
