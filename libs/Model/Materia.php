<?php

/** @package    W2o::Model */
/** import supporting libraries */
require_once("DAO/MateriaDAO.php");
require_once("MateriaCriteria.php");

/**
 * The Materia class extends MateriaDAO which provides the access
 * to the datastore.
 *
 * @package W2o::Model
 * @author ClassBuilder
 * @version 1.0
 */
class Materia extends MateriaDAO {

    /**
     * Override default validation
     * @see Phreezable::Validate()
     */
    public function Validate() {
        // example of custom validation
        //$this->ResetValidationErrors();
        //$errors = $this->GetValidationErrors();
        //if ($error == true) $this->AddValidationError('FieldName', 'Error Information');

        if (!$this->HasValidationErrors()) {
            // já existe um registro igual no banco
            $criteria = new MateriaCriteria();
            $criteria->Nome_Equals = $this->Nome;
            $materias = $this->_phreezer->Query('Materia', $criteria);

            if ($materias->Count() > 0) {
                $this->AddValidationError('nome', 'Já existem Matéria Cadastrada');
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
            throw new Exception('Unable to Save Materia: ' . implode(', ', $this->GetValidationErrors()));

        // OnSave must return true or Phreeze will cancel the save operation
        return true;
    }

}

?>
