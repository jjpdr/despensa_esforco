<?php
/** @package    DespensaEsforco::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * MetodoPagamentoMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the MetodoPagamentoDAO to the metodo_pagamento datastore.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * You can override the default fetching strategies for KeyMaps in _config.php.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package DespensaEsforco::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class MetodoPagamentoMap implements IDaoMap, IDaoMap2
{

	private static $KM;
	private static $FM;
	
	/**
	 * {@inheritdoc}
	 */
	public static function AddMap($property,FieldMap $map)
	{
		self::GetFieldMaps();
		self::$FM[$property] = $map;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public static function SetFetchingStrategy($property,$loadType)
	{
		self::GetKeyMaps();
		self::$KM[$property]->LoadType = $loadType;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetFieldMaps()
	{
		if (self::$FM == null)
		{
			self::$FM = Array();
			self::$FM["Id"] = new FieldMap("Id","metodo_pagamento","id",true,FM_TYPE_INT,10,null,true);
			self::$FM["NomeTitular"] = new FieldMap("NomeTitular","metodo_pagamento","nome_titular",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["NumeroCartao"] = new FieldMap("NumeroCartao","metodo_pagamento","numero_cartao",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["DataValidadeCartao"] = new FieldMap("DataValidadeCartao","metodo_pagamento","data_validade_cartao",false,FM_TYPE_DATE,null,null,false);
			self::$FM["CodigoSeguranca"] = new FieldMap("CodigoSeguranca","metodo_pagamento","codigo_seguranca",false,FM_TYPE_INT,3,null,false);
			self::$FM["CpfTitular"] = new FieldMap("CpfTitular","metodo_pagamento","cpf_titular",false,FM_TYPE_VARCHAR,255,null,false);
		}
		return self::$FM;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetKeyMaps()
	{
		if (self::$KM == null)
		{
			self::$KM = Array();
		}
		return self::$KM;
	}

}

?>