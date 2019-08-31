<?php

/** @package    W2o::Model */
/** import supporting libraries */
require_once("DAO/ProfessorDAO.php");
require_once("ProfessorCriteria.php");

/**
 * The Professor class extends ProfessorDAO which provides the access
 * to the datastore.
 *
 * @package W2o::Model
 * @author ClassBuilder
 * @version 1.0
 */
class Professor extends ProfessorDAO {

    /**
     * Override default validation
     * @see Phreezable::Validate()
     */
    public function Validate() {
        // example of custom validation
        // $this->ResetValidationErrors();
        // $errors = $this->GetValidationErrors();
        // if ($error == true) $this->AddValidationError('FieldName', 'Error Information');

        if (!$this->HasValidationErrors()) {
            // já existe um registro igual no banco
            $criteria = new ProfessorCriteria();
            $criteria->Materiaid_Equals = $this->Materiaid;
            $criteria->Tipo_Equals = $this->Tipo;
            $professores = $this->_phreezer->Query('Professor', $criteria);

            if ($professores->Count() > 0) {
                $this->AddValidationError('tipo', 'Já existem registros para esta Matéria e Tipo');
            }
        }

        return !$this->HasValidationErrors();

        //return parent::Validate();
    }

    /**
     * @see Phreezable::OnSave()
     */
    public function OnSave($insert) {
        // the controller create/update methods validate before saving.  this will be a
        // redundant validation check, however it will ensure data integrity at the model
        // level based on validation rules.  comment this line out if this is not desired
        if (!$this->Validate())
            throw new Exception('Unable to Save Professor: ' . implode(', ', $this->GetValidationErrors()));

        // OnSave must return true or Phreeze will cancel the save operation
        return true;
    }

}

?>
