<?php
/** @package    Despesnsa Esforço v3.0 ::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/EnderecoEntrega.php");

/**
 * EnderecoEntregaController is the controller class for the EnderecoEntrega object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package Despesnsa Esforço v3.0 ::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class EnderecoEntregaController extends AppBaseController
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
	 * Displays a list view of EnderecoEntrega objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for EnderecoEntrega records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new EnderecoEntregaCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Id,Rua,NroCasa,Bairro,Cidade,Cep,HorarioPreferencial'
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

				$enderecoentregas = $this->Phreezer->Query('EnderecoEntrega',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $enderecoentregas->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $enderecoentregas->TotalResults;
				$output->totalPages = $enderecoentregas->TotalPages;
				$output->pageSize = $enderecoentregas->PageSize;
				$output->currentPage = $enderecoentregas->CurrentPage;
			}
			else
			{
				// return all results
				$enderecoentregas = $this->Phreezer->Query('EnderecoEntrega',$criteria);
				$output->rows = $enderecoentregas->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single EnderecoEntrega record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('id');
			$enderecoentrega = $this->Phreezer->Get('EnderecoEntrega',$pk);
			$this->RenderJSON($enderecoentrega, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new EnderecoEntrega record and render response as JSON
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

			$enderecoentrega = new EnderecoEntrega($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $enderecoentrega->Id = $this->SafeGetVal($json, 'id');

			$enderecoentrega->Rua = $this->SafeGetVal($json, 'rua');
			$enderecoentrega->NroCasa = $this->SafeGetVal($json, 'nroCasa');
			$enderecoentrega->Bairro = $this->SafeGetVal($json, 'bairro');
			$enderecoentrega->Cidade = $this->SafeGetVal($json, 'cidade');
			$enderecoentrega->Cep = $this->SafeGetVal($json, 'cep');
			$enderecoentrega->HorarioPreferencial = $this->SafeGetVal($json, 'horarioPreferencial');

			$enderecoentrega->Validate();
			$errors = $enderecoentrega->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$enderecoentrega->Save();
				$this->RenderJSON($enderecoentrega, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing EnderecoEntrega record and render response as JSON
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
			$enderecoentrega = $this->Phreezer->Get('EnderecoEntrega',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $enderecoentrega->Id = $this->SafeGetVal($json, 'id', $enderecoentrega->Id);

			$enderecoentrega->Rua = $this->SafeGetVal($json, 'rua', $enderecoentrega->Rua);
			$enderecoentrega->NroCasa = $this->SafeGetVal($json, 'nroCasa', $enderecoentrega->NroCasa);
			$enderecoentrega->Bairro = $this->SafeGetVal($json, 'bairro', $enderecoentrega->Bairro);
			$enderecoentrega->Cidade = $this->SafeGetVal($json, 'cidade', $enderecoentrega->Cidade);
			$enderecoentrega->Cep = $this->SafeGetVal($json, 'cep', $enderecoentrega->Cep);
			$enderecoentrega->HorarioPreferencial = $this->SafeGetVal($json, 'horarioPreferencial', $enderecoentrega->HorarioPreferencial);

			$enderecoentrega->Validate();
			$errors = $enderecoentrega->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$enderecoentrega->Save();
				$this->RenderJSON($enderecoentrega, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing EnderecoEntrega record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('id');
			$enderecoentrega = $this->Phreezer->Get('EnderecoEntrega',$pk);

			$enderecoentrega->Delete();

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
