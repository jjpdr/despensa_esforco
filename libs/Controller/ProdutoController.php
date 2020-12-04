<?php
/** @package    Despesnsa Esforço v3.0 ::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Produto.php");

/**
 * ProdutoController is the controller class for the Produto object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package Despesnsa Esforço v3.0 ::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class ProdutoController extends AppBaseController
{

	/**
	 * Override here for any controller-specific functionality
	 *
	 * @inheritdocs
	 */
	protected function Init()
	{
		parent::Init();

		// TODO: add controller-wide bootstrap code
		
		// TODO: if authentiation is required for this entire controller, for example:
		// $this->RequirePermission(ExampleUser::$PERMISSION_USER,'SecureExample.LoginForm');
	}

	/**
	 * Displays a list view of Produto objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Produto records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new ProdutoCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Id,Nome,DataValidade,Categoria,Prioridade,QtdMinima,QtdMaxima'
				, '%'.$filter.'%')
			);

			// TODO: this is generic query filtering based only on criteria properties
			foreach (array_keys($_REQUEST) as $prop)
			{
				$prop_normal = ucfirst($prop);
				$prop_equals = $prop_normal.'_Equals';

				if (property_exists($criteria, $prop_normal))
				{
					$criteria->$prop_normal = RequestUtil::Get($prop);
				}
				elseif (property_exists($criteria, $prop_equals))
				{
					// this is a convenience so that the _Equals suffix is not needed
					$criteria->$prop_equals = RequestUtil::Get($prop);
				}
			}

			$output = new stdClass();

			// if a sort order was specified then specify in the criteria
 			$output->orderBy = RequestUtil::Get('orderBy');
 			$output->orderDesc = RequestUtil::Get('orderDesc') != '';
 			if ($output->orderBy) $criteria->SetOrder($output->orderBy, $output->orderDesc);

			$page = RequestUtil::Get('page');

			if ($page != '')
			{
				// if page is specified, use this instead (at the expense of one extra count query)
				$pagesize = $this->GetDefaultPageSize();

				$produtos = $this->Phreezer->Query('Produto',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $produtos->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $produtos->TotalResults;
				$output->totalPages = $produtos->TotalPages;
				$output->pageSize = $produtos->PageSize;
				$output->currentPage = $produtos->CurrentPage;
			}
			else
			{
				// return all results
				$produtos = $this->Phreezer->Query('Produto',$criteria);
				$output->rows = $produtos->ToObjectArray(true, $this->SimpleObjectParams());
				$output->totalResults = count($output->rows);
				$output->totalPages = 1;
				$output->pageSize = $output->totalResults;
				$output->currentPage = 1;
			}


			$this->RenderJSON($output, $this->JSONPCallback());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method retrieves a single Produto record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('id');
			$produto = $this->Phreezer->Get('Produto',$pk);
			$this->RenderJSON($produto, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Produto record and render response as JSON
	 */
	public function Create()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$produto = new Produto($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $produto->Id = $this->SafeGetVal($json, 'id');

			$produto->Nome = $this->SafeGetVal($json, 'nome');
			$produto->DataValidade = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dataValidade')));
			$produto->Categoria = $this->SafeGetVal($json, 'categoria');
			$produto->Prioridade = $this->SafeGetVal($json, 'prioridade');
			$produto->QtdMinima = $this->SafeGetVal($json, 'qtdMinima');
			$produto->QtdMaxima = $this->SafeGetVal($json, 'qtdMaxima');

			$produto->Validate();
			$errors = $produto->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$produto->Save();
				$this->RenderJSON($produto, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Produto record and render response as JSON
	 */
	public function Update()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$pk = $this->GetRouter()->GetUrlParam('id');
			$produto = $this->Phreezer->Get('Produto',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $produto->Id = $this->SafeGetVal($json, 'id', $produto->Id);

			$produto->Nome = $this->SafeGetVal($json, 'nome', $produto->Nome);
			$produto->DataValidade = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dataValidade', $produto->DataValidade)));
			$produto->Categoria = $this->SafeGetVal($json, 'categoria', $produto->Categoria);
			$produto->Prioridade = $this->SafeGetVal($json, 'prioridade', $produto->Prioridade);
			$produto->QtdMinima = $this->SafeGetVal($json, 'qtdMinima', $produto->QtdMinima);
			$produto->QtdMaxima = $this->SafeGetVal($json, 'qtdMaxima', $produto->QtdMaxima);

			$produto->Validate();
			$errors = $produto->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$produto->Save();
				$this->RenderJSON($produto, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Produto record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('id');
			$produto = $this->Phreezer->Get('Produto',$pk);

			$produto->Delete();

			$output = new stdClass();

			$this->RenderJSON($output, $this->JSONPCallback());

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}
}

?>
