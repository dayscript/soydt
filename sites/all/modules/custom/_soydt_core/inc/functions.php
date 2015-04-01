<?php
/**
 * @param $id_ftb = int
 * @param $ids_futbolistas = array();
 */
  function existe_futbolista_en_referencia_entidad ($id_ftb, $ids_futbolistas) {
    $id_ftb = (int) $id_ftb;
    foreach ($ids_futbolistas as $jugador) {
      if ($jugador['target_id'] == $id_ftb)
        return true;
    }
  }


?>