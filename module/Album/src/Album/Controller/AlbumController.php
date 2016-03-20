<?php

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager; //use Zend\View\Model\ViewModel;  //use Doctrine\ORM\EntityManager;//use Zend\View\Helper\Navigation;
use Album\Entity\BlogPost;
use Album\Entity\Tag;
use Album\Form\UploadForm;
use Album\Form\UpdateBlogPostForm;
use Album\Form\CreateBlogPostForm;
use Album\Form\DeleteBlogPostForm;

class AlbumController extends AbstractActionController
{

    protected $em;

    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function createAction() {

        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $form = new CreateBlogPostForm($objectManager);
        $blogPost = new BlogPost();
        $form->bind($blogPost);

        if ($this->request->isPost()) {
            $postData = $this->getRequest()->getPost()->toArray();

            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                $tag = $postData['blog-post']['tags'][0]['name'];
                $item = new Tag();
                $item->setName($tag);
                $blogPost->addTag($item);
                $objectManager->persist($blogPost);
                $objectManager->flush();
                return $this->redirect()->toRoute('album', array());
            }
        }
        return array('form' => $form);
    }

    public function indexAction() {

        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $data = $objectManager->getRepository('Album\Entity\BlogPost')->findAll();

        foreach ($data as $row) {
            echo $row->getId() . " " . $row->getTitle() . " " . $row->getTag()->getName() . "<BR>";
        }
    }

    public function editAction() {
        $data = $this->params()->fromRoute();

        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $form = new UpdateBlogPostForm($objectManager);

        $blogPost = $objectManager->getRepository('Album\Entity\BlogPost')->findOneById($this->params('id', $data['id']));

        $form->bind($blogPost);
        if ($this->request->isPost()) {
            $postData = $this->getRequest()->getPost()->toArray();
            $form->setData($postData);
            
            if ($form->isValid()) {
                $tag = $postData['blog-post']['tags'][0]['name'];
                $item = new Tag();
                $item->setName($tag);
                $blogPost->addTag($item);
                $objectManager->persist($blogPost);
                $objectManager->flush();
                return $this->redirect()->toRoute('album', array());
            }
        }
        return array('form' => $form);
    }

    public function deleteAction() {
        $data = $this->params()->fromRoute();
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $form = new DeleteBlogPostForm($objectManager);
        $blogPost = $objectManager->getRepository('Album\Entity\BlogPost')->findOneById($this->params('id', $data['id']));

        $form->bind($blogPost);

        if ($this->request->isPost()) {
            $id = $this->params('id', $data['id']);
            $album = $this->getEntityManager()->find('Album\Entity\BlogPost', $id);
            if ($form->isValid()) {
                $this->getEntityManager()->remove($album);
                $this->getEntityManager()->flush();
                return $this->redirect()->toRoute('album', array());
            }
        }return array('form' => $form);
    }

    public function uploadFormAction() {
        $form = new UploadForm('upload-form');
        $tempFile = null;

        $prg = $this->fileprg($form);
        if ($prg instanceof \Zend\Http\PhpEnvironment\Response) {
            return $prg; // Return PRG redirect response
        } elseif (is_array($prg)) {
            if ($form->isValid()) {
                $data = $form->getData();
                //  return $this->redirect()->toRoute('view/success');
            } else {
                $fileErrors = $form->get('image-file')->getMessages();
                if (empty($fileErrors)) {
                    $tempFile = $form->get('image-file')->getValue();
                }
            }
        }

        return array(
            'form' => $form,
            'tempFile' => $tempFile,
        );
    }

    /*      // Plugin Code

      $plugin = $this->MyFirstPlugin();
      $plugin->doSomething();
      return new ViewModel();

      // Navigation Code
      $container = new Zend\Navigation\Navigation(array(
      array(
      'label' => 'Relations using strings',
      'rel' => array(
      'alternate' => 'http://www.example.org/'
      ),
      'rev' => array(
      'alternate' => 'http://www.example.net/'
      )
      ),
      array(
      'label' => 'Relations using arrays',
      'rel' => array(
      'alternate' => array(
      'label' => 'Example.org',
      'uri' => 'http://www.example.org/'
      )
      )
      ),
      array(
      'label' => 'Relations using configs',
      'rel' => array(
      'alternate' => new Zend\Config\Config(array(
      'label' => 'Example.org',
      'uri' => 'http://www.example.org/'
      ))
      )
      ),
      array(
      'label' => 'Relations using pages instance',
      'rel' => array(
      'alternate' => Zend\Navigation\Page\AbstractPage::factory(array(
      'label' => 'Example.org',
      'uri' => 'http://www.example.org/'
      ))
      )
      )
      ));

      }
     */
}
