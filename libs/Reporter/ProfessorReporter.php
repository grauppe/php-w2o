<?php

/** @package    W2o::Reporter */
/** import supporting libraries */
require_once("verysimple/Phreeze/Reporter.php");

/**
 * This is an example Reporter based on the Professor object.  The reporter object
 * allows you to run arbitrary queries that return data which may or may not fith within
 * the data access API.  This can include aggregate data or subsets of data.
 *
 * Note that Reporters are read-only and cannot be used for saving data.
 *
 * @package W2o::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class ProfessorReporter extends Reporter {

    // the properties in this class must match the columns returned by GetCustomQuery().
    // 'CustomFieldExample' is an example that is not part of the `professor` table
    public $Materianome;
    public $Datainicio;
    public $Id;
    public $Nome;
    public $Tipo;
    public $Materiaid;

    /*
     * GetCustomQuery returns a fully formed SQL statement.  The result columns
     * must match with the properties of this reporter object.
     *
     * @see Reporter::GetCustomQuery
     * @param Criteria $criteria
     * @return string SQL statement
     */

    static function GetCustomQuery($criteria) {
        $sql = "select
			`materia`.`nome` as Materianome
			,`feria`.`datainicio` as Datainicio
			,`professor`.`id` as Id
			,`professor`.`nome` as Nome
			,`professor`.`tipo` as Tipo
                        ,`professor`.`materiaId` as Materiaid
		from `professor`
                inner join materia on professor.materiaid = materia.id
                left join feria on professor.id = feria.professorid";

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

    static function GetCustomCountQuery($criteria) {
        $sql = "select count(1) as counter from `professor`";

        // the criteria can be used or you can write your own custom logic.
        // be sure to escape any user input with $criteria->Escape()
        $sql .= $criteria->GetWhere();

        return $sql;
    }

}

?>