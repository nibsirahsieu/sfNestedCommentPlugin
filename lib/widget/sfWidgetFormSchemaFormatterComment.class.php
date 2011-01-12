<?php
class sfWidgetFormSchemaFormatterComment extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "<div class='form_control%row_class%'>
                        %label% \n %field% 
                        %help% %hidden_fields%\n</div>\n";


  public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null)
  {
    $row = parent::formatRow(
      $label,
      $field,
      $errors,
      $help,
      $hiddenFields
    );

    return strtr($row, array(
      '%row_class%' => (count($errors) > 0) ? ' form_error' : '',
    ));
  }
}