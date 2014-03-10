<?php

namespace Book\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
    	$EntityM = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
    	
//     	Books
		$rpBooks = 	$EntityM->getRepository("\Book\Entity\Books")->createQueryBuilder("b");
		
// 		Validando filtros
// 		ID
		if ( $this->params("id") != null )
		{
			$rpBooks->select("b.title",'b.author','b.isbn','b.publisher');
			$rpBooks->where( $rpBooks->expr()->eq("b.id", $this->params("id") )  );
		}else{
			$rpBooks->select('b.title','b.author');
			
	// 		TITLE
			if( $this->params()->fromQuery("title") )
			{
				$rpBooks->where( $rpBooks->expr()->like("b.title", "'%" . $this->params()->fromQuery("title") . "%'" )  );
				
			}
			
	// 		AUTHOR
			if ( $this->params()->fromQuery("author") )
			{
				$rpBooks->where( $rpBooks->expr()->like("b.author", "'%" . $this->params()->fromQuery("author") . "%'" )  );
			}
		}
		
		$ltBooks = $rpBooks->getQuery()->getArrayResult();
		
		if( count($ltBooks) > 1)
			echo json_encode($ltBooks);
		else
			echo json_encode(end($ltBooks));
		
    	return $this->response;
    }


}

