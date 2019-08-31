<?php
/** @package    W2o::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * GradehorariaMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the GradehorariaDAO to the gradehoraria datastore.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * You can override the default fetching strategies for KeyMaps in _config.php.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package W2o::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class GradehorariaMap implements IDaoMap, IDaoMap2
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
			self::$FM["Id"] = new FieldMap("Id","gradehoraria","id",true,FM_TYPE_INT,11,null,true);
			self::$FM["Horario"] = new FieldMap("Horario","gradehoraria","horario",false,FM_TYPE_ENUM,array("1","2","3","4"),null,false);
			self::$FM["Grademensal"] = new FieldMap("Grademensal","gradehoraria","gradeMensal",false,FM_TYPE_ENUM,array("Todas","Penultima","Ultima"),null,false);
			self::$FM["Diasemana"] = new FieldMap("Diasemana","gradehoraria","diaSemana",false,FM_TYPE_ENUM,array("Segunda","Terca","Quarta","Quinta","Sexta","Sabado"),null,false);
			self::$FM["Materiaid"] = new FieldMap("Materiaid","gradehoraria","materiaId",false,FM_TYPE_INT,11,null,false);
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
			self::$KM["FK_gradehoraria_materia"] = new KeyMap("FK_gradehoraria_materia", "Materiaid", "Materia", "Id", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>