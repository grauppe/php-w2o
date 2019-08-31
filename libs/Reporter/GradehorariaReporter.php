<?php
/** @package    W2o::Reporter */

/** import supporting libraries */
require_once("verysimple/Phreeze/Reporter.php");

/**
 * This is an example Reporter based on the Gradehoraria object.  The reporter object
 * allows you to run arbitrary queries that return data which may or may not fith within
 * the data access API.  This can include aggregate data or subsets of data.
 *
 * Note that Reporters are read-only and cannot be used for saving data.
 *
 * @package W2o::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class GradehorariaReporter extends Reporter
{

	// the properties in this class must match the columns returned by GetCustomQuery().
	// 'CustomFieldExample' is an example that is not part of the `gradehoraria` table
	public $Materianome;

	public $Id;
	public $Horario;
	public $Grademensal;
	public $Diasemana;
	public $Materiaid;
	public $Tipoaula;

	/*
	* GetCustomQuery returns a fully formed SQL statement.  The result columns
	* must match with the properties of this reporter object.
	*
	* @see Reporter::GetCustomQuery
	* @param Criteria $criteria
	* @return string SQL statement
	*/
	static function GetCustomQuery($criteria)
	{
		$sql = "select
			`materia`.`nome` as Materianome
			,`gradehoraria`.`id` as Id
			,`gradehoraria`.`horario` as Horario
			,`gradehoraria`.`gradeMensal` as Grademensal
			,`gradehoraria`.`diaSemana` as Diasemana
			,`gradehoraria`.`materiaId` as Materiaid
		from `gradehoraria`
                inner join materia on gradehoraria.materiaid = materia.id";

		// the criteria can be used or you can write your own custom logic.
		// be sure to escape any user input with $criteria->Escape()
		$sql .= $criteria->GetWhere();
		$sql .= $criteria->GetOrder();

		return $sql;
	}
	
	/*
	* GetCustomCountQuery returns a fully formed SQL statement that will count
	* the results.  This query must return the correct number of results that
	* GetCustomQuery would, given the same criteria
	*
	* @see Reporter::GetCustomCountQuery
	* @param Criteria $criteria
	* @return string SQL statement
	*/
	static function GetCustomCountQuery($criteria)
	{
		$sql = "select count(1) as counter from `gradehoraria`";

		// the criteria can be used or you can write your own custom logic.
		// be sure to escape any user input with $criteria->Escape()
		$sql .= $criteria->GetWhere();

		return $sql;
	}
}

?>