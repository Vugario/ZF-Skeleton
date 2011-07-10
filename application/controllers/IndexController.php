<?php

class IndexController extends My_Controller_Controller
{

    public function indexAction()
    {
        $result = $this->db->fetchAll( 'SELECT * FROM topic ORDER BY date_created DESC' );
        
        $this->view->items = $result;
    }
    
    public function viewAction()
    {
    	$id = $this->_getParam( 'id' );
    	
    	if( empty( $id ) )
    		throw new Exception( 'No ID was given' );
    	
    	$result = $this->db->fetchRow( 'SELECT * FROM topic WHERE id = ?', $id );
    	if( !$result )
    		throw new Exception( 'Topic not found' );
    	
    	$this->view->item = $result;
    }
    
    public function addAction()
    {
    	$objForm = $this->getForm();
    	
    	if( $this->getRequest()->isPost() )
    	{
    		
    		if( $objForm->isValid( $_POST ) )
    		{
    			
    			$arrData = array( 'title' => $_POST['title'], 'email' => $_POST['email'], 'content' => $_POST['content'], 'date_created' => date('Y-m-d H:i:s') );
    			$insert = $this->db->insert( 'topic', $arrData );
    			
    			if( $insert )
    			{
    				$this->_redirect( 'index/view/id/' . $this->db->lastInsertId() );
    				exit;
    			}
    			
    		}
    		
    	}
    	
    	$this->view->form = $objForm;
    }
    
    private function getForm()
    {
    	$objForm = new Zend_Form();
    	$objForm->setAction('');
    	$objForm->setMethod('post');
    	
    	$objTitle = new Zend_Form_Element_Text( 'title', array( 'label' => 'Title' ) );
    	$objTitle->setRequired( true );
    	
    	$objEmail = new Zend_Form_Element_Text( 'email', array( 'label' => 'E-mail adres' ) );
    	$objEmail->setRequired( true );
    	$objEmail->addValidator( new Zend_Validate_Emailaddress() );
    	
    	$objContent = new Zend_Form_Element_Textarea( 'content' );
    	$objContent->setRequired( true );
    	
    	$objSubmit = new Zend_Form_Element_Submit( 'submit' );
    	
    	$objForm->addElements( array( $objTitle, $objEmail, $objContent, $objSubmit ) );
    	
    	return $objForm;
    }


}

