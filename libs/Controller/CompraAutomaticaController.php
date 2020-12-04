<?php
/** @package    Despesnsa Esforço v3.0 ::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/CompraAutomatica.php");

/**
 * CompraAutomaticaController is the controller class for the CompraAutomatica object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package Despesnsa Esforço v3.0 ::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class CompraAutomaticaController extends AppBaseController
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
	 * Displays a list view of CompraAutomatica objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for CompraAutomatica records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new CompraAutomaticaCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Id,NomeSupermercado,Categoria,Prioridade,ValorMaximo,MetodoPagamento,EnderecoEntrega'
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

				$compraautomaticas = $this->Phreezer->Query('CompraAutomatica',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $compraautomaticas->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $compraautomaticas->TotalResults;
				$output->totalPages = $compraautomaticas->TotalPages;
				$output->pageSize = $compraautomaticas->PageSize;
				$output->currentPage = $compraautomaticas->CurrentPage;
			}
			else
			{
				// return all results
				$compraautomaticas = $this->Phreezer->Query('CompraAutomatica',$criteria);
				$output->rows = $compraautomaticas->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single CompraAutomatica record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('id');
			$compraautomatica = $this->Phreezer->Get('CompraAutomatica',$pk);
			$this->RenderJSON($compraautomatica, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new CompraAutomatica record and render response as JSON
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

			$compraautomatica = new CompraAutomatica($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $compraautomatica->Id = $this->SafeGetVal($json, 'id');

			$compraautomatica->NomeSupermercado = $this->SafeGetVal($json, 'nomeSupermercado');
			$compraautomatica->Categoria = $this->SafeGetVal($json, 'categoria');
			$compraautomatica->Prioridade = $this->SafeGetVal($json, 'prioridade');
			$compraautomatica->ValorMaximo = $this->SafeGetVal($json, 'valorMaximo');
			$compraautomatica->MetodoPagamento = $this->SafeGetVal($json, 'metodoPagamento');
			$compraautomatica->EnderecoEntrega = $this->SafeGetVal($json, 'enderecoEntrega');

			$compraautomatica->Validate();
			$errors = $compraautomatica->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$compraautomatica->Save();
				$this->RenderJSON($compraautomatica, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing CompraAutomatica record and render response as JSON
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
			$compraautomatica = $this->Phreezer->Get('CompraAutomatica',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $compraautomatica->Id = $this->SafeGetVal($json, 'id', $compraautomatica->Id);

			$compraautomatica->NomeSupermercado = $this->SafeGetVal($json, 'nomeSupermercado', $compraautomatica->NomeSupermercado);
			$compraautomatica->Categoria = $this->SafeGetVal($json, 'categoria', $compraautomatica->Categoria);
			$compraautomatica->Prioridade = $this->SafeGetVal($json, 'prioridade', $compraautomatica->Prioridade);
			$compraautomatica->ValorMaximo = $this->SafeGetVal($json, 'valorMaximo', $compraautomatica->ValorMaximo);
			$compraautomatica->MetodoPagamento = $this->SafeGetVal($json, 'metodoPagamento', $compraautomatica->MetodoPagamento);
			$compraautomatica->EnderecoEntrega = $this->SafeGetVal($json, 'enderecoEntrega', $compraautomatica->EnderecoEntrega);

			$compraautomatica->Validate();
			$errors = $compraautomatica->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$compraautomatica->Save();
				$this->RenderJSON($compraautomatica, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing CompraAutomatica record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('id');
			$compraautomatica = $this->Phreezer->Get('CompraAutomatica',$pk);

			$compraautomatica->Delete();

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
