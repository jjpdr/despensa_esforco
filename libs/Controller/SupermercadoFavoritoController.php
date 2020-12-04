<?php
/** @package    Despesnsa Esforço v3.0 ::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/SupermercadoFavorito.php");

/**
 * SupermercadoFavoritoController is the controller class for the SupermercadoFavorito object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package Despesnsa Esforço v3.0 ::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class SupermercadoFavoritoController extends AppBaseController
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
	 * Displays a list view of SupermercadoFavorito objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for SupermercadoFavorito records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new SupermercadoFavoritoCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Id,Nome,Endereco,Bairro,Cep,Cidade,Estado,DataUltimaCompra'
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

				$supermercadofavoritos = $this->Phreezer->Query('SupermercadoFavorito',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $supermercadofavoritos->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $supermercadofavoritos->TotalResults;
				$output->totalPages = $supermercadofavoritos->TotalPages;
				$output->pageSize = $supermercadofavoritos->PageSize;
				$output->currentPage = $supermercadofavoritos->CurrentPage;
			}
			else
			{
				// return all results
				$supermercadofavoritos = $this->Phreezer->Query('SupermercadoFavorito',$criteria);
				$output->rows = $supermercadofavoritos->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single SupermercadoFavorito record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('id');
			$supermercadofavorito = $this->Phreezer->Get('SupermercadoFavorito',$pk);
			$this->RenderJSON($supermercadofavorito, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new SupermercadoFavorito record and render response as JSON
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

			$supermercadofavorito = new SupermercadoFavorito($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $supermercadofavorito->Id = $this->SafeGetVal($json, 'id');

			$supermercadofavorito->Nome = $this->SafeGetVal($json, 'nome');
			$supermercadofavorito->Endereco = $this->SafeGetVal($json, 'endereco');
			$supermercadofavorito->Bairro = $this->SafeGetVal($json, 'bairro');
			$supermercadofavorito->Cep = $this->SafeGetVal($json, 'cep');
			$supermercadofavorito->Cidade = $this->SafeGetVal($json, 'cidade');
			$supermercadofavorito->Estado = $this->SafeGetVal($json, 'estado');
			$supermercadofavorito->DataUltimaCompra = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dataUltimaCompra')));

			$supermercadofavorito->Validate();
			$errors = $supermercadofavorito->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$supermercadofavorito->Save();
				$this->RenderJSON($supermercadofavorito, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing SupermercadoFavorito record and render response as JSON
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
			$supermercadofavorito = $this->Phreezer->Get('SupermercadoFavorito',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $supermercadofavorito->Id = $this->SafeGetVal($json, 'id', $supermercadofavorito->Id);

			$supermercadofavorito->Nome = $this->SafeGetVal($json, 'nome', $supermercadofavorito->Nome);
			$supermercadofavorito->Endereco = $this->SafeGetVal($json, 'endereco', $supermercadofavorito->Endereco);
			$supermercadofavorito->Bairro = $this->SafeGetVal($json, 'bairro', $supermercadofavorito->Bairro);
			$supermercadofavorito->Cep = $this->SafeGetVal($json, 'cep', $supermercadofavorito->Cep);
			$supermercadofavorito->Cidade = $this->SafeGetVal($json, 'cidade', $supermercadofavorito->Cidade);
			$supermercadofavorito->Estado = $this->SafeGetVal($json, 'estado', $supermercadofavorito->Estado);
			$supermercadofavorito->DataUltimaCompra = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dataUltimaCompra', $supermercadofavorito->DataUltimaCompra)));

			$supermercadofavorito->Validate();
			$errors = $supermercadofavorito->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$supermercadofavorito->Save();
				$this->RenderJSON($supermercadofavorito, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing SupermercadoFavorito record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('id');
			$supermercadofavorito = $this->Phreezer->Get('SupermercadoFavorito',$pk);

			$supermercadofavorito->Delete();

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
