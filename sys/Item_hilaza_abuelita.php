<?php
/** Definicion
 *
 */
class Item_hilaza_abuelita
{
	public $code_hilaza_abuelita;
	public $name_abuelita;
	public $existencias_abuelita;
	public $eje_x;
	public $eje_y;

	function get_name_format_id()		{
		$name = str_replace(' ','',$this->name_abuelita);
		return $name;
	}
}
?>
