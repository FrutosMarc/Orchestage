<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once(PS_ADMIN_DIR.'/../classes/AdminTab.php');
/**
 * Description of AdminOrchestrasoft
 *
 * @author Marc
 */
class AdminOrchestrasoft extends AdminTab {
   public function __construct()
    {
    $this->table = 'orchestrasoft';
    $this->className = 'orchestrasoft';
    $this->lang = false;
    $this->edit = true;
    $this->delete = true;
    $this->fieldsDisplay = array(
      'id_orchestrasoft' => array(
        'title' => $this->l('ID'),
        'align' => 'center',
        'width' => 25),
      'orchestrasoft' => array(
        'title' => $this->l('Name'),
        'width' => 200)
    );
 
    $this->identifier = 'id_orchestrasoft';
 
    parent::__construct();
    }
 
  public function displayForm()
    {
    global $currentIndex;
 
    $defaultLanguage = intval(Configuration::get('PS_LANG_DEFAULT'));
    $languages = Language::getLanguages();
    $obj = $this->loadObject(true);
 
    echo '
      <script type="text/javascript">
        id_language = Number('.$defaultLanguage.');
      </script>';
 
    echo '
      <form action="' . $currentIndex . '&submitAdd' .  $this->table . '=1&token=' . $this->token . '" method="post" class="width3">
        ' . ($obj->id ? '<input type="hidden" name="id_' . $this->table . '" value="' . $obj->id . '" />' : '').'
        <fieldset><legend><img src="../img/admin/profiles.png" />' . $this->l('Profiles') . '</legend>
          <label>'.$this->l('Name:').' </label>
          <div class="margin-form">';
    foreach ( $languages as $language )
      echo '
          <div id="name_' . $language['id_lang'|'id_lang'] . '" style="display: ' . ($language['id_lang'|'id_lang'] == $defaultLanguage ? 'block' : 'none') . '; float: left;">
            <input size="33" type="text" name="name_' . $language['id_lang'|'id_lang'] . '" value="' . htmlentities( $this->getFieldValue( $obj, 'name', intval( $language['id_lang'|'id_lang'] ) ), ENT_COMPAT, 'UTF-8' ) . '" /><sup>*</sup>
          </div>';
    $this->displayFlags( $languages, $defaultLanguage, 'name', 'name' );
    echo '
          <div class="clear"></div>
        </div>
        <div class="margin-form">
          <input type="submit" value="'.$this->l('Save').'" name="submitAdd'.$this->table.'" class="button" />
        </div>
        <div class="small"><sup>*</sup> '.$this->l('Required field').'</div>
      </fieldset>
    </form> ';
    }   

}
