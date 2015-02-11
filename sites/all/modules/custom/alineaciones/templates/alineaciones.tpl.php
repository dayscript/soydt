<?php $data = alineaciones_data();?>
<div id="filtros" class="clearfix <?php echo ($data["alineacion"]->field_fecha_torneo['und'][0]['target_id'] == $_SESSION['fecha_activa']->nid)?"active":""?>">
    <form>
        <div class="small-4 columns">
            <label>Fecha
                <select name="fecha" id="fecha" class="text-center">
                    <?php foreach($data["fechas"] as $fecha):?>
                        <option  <?php echo ($fecha->field_fecha_abierta['und'][0]['value']==1)?"":""?>  <?php echo ($fecha->nid==$data["alineacion"]->field_fecha_torneo['und'][0]['target_id'])?"selected":""?> class="text-center" value="<?php echo $fecha->nid?>"><?php echo $fecha->title?></option>
                        <?php if($_SESSION['fecha_activa']->nid==$fecha->nid)break;?>
                    <?php endforeach?>
                </select>
            </label>
        </div>
        <div class="small-4 columns">
            <label>Formaci&oacute;n
                <select name="formacion" id="formacion" class="text-center" <?php echo ($data["alineacion"]->field_fecha_torneo['und'][0]['target_id'] != $_SESSION['fecha_activa']->nid)?"disabled":""?>>
                    <?php foreach($data["formaciones"] as $formacion):?>
                        <?php if($formacion->tid==$data["alineacion"]->field_formacion['und'][0]['tid'])$form = $formacion;?>
                        <option <?php echo ($formacion->tid==$data["alineacion"]->field_formacion['und'][0]['tid'])?"selected":""?> class="text-center" value="<?php echo $formacion->tid?>"><?php echo $formacion->name?></option>
                    <?php endforeach?>
                    <?php if($form){
                        $positions = get_posiciones($form->description);
                    }?>
                </select>
            </label>
        </div>
        <div class="small-4 columns">
            <label>Capit&aacute;n
                <select name="capitan" id="capitan" class="text-center" <?php echo ($data["alineacion"]->field_fecha_torneo['und'][0]['target_id'] != $_SESSION['fecha_activa']->nid)?"disabled":""?>>
                    <option value="0">Seleccione un capit&aacute;n...</option>
                    <?php if(isset($data["equipo"]->field_jugadores2['und'])):?>
                        <?php foreach($data["equipo"]->field_jugadores2['und'] as $player):?>
                            <?php $pl = node_load($player['target_id']);?>
                            <?php if(isset($data["alineacion"]->field_capitan['und']) && $pl->nid==$data["alineacion"]->field_capitan['und'][0]['target_id'])$capitan = $pl;?>
                            <option <?php echo (isset($data["alineacion"]->field_capitan['und'])&&$pl->nid==$data["alineacion"]->field_capitan['und'][0]['target_id'])?"selected":""?> class="text-center" value="<?php echo $pl->nid?>"><?php echo $pl->title?></option>
                        <?php endforeach?>
                    <?php endif?>
                </select>
            </label>
        </div>
        <input type="hidden" name="id_alineacion" id="id_alineacion" value="<?php echo $data["alineacion"]->nid?>">
    </form>
</div>
<?php if ($data["alineacion"]->field_fecha_torneo['und'][0]['target_id'] == $_SESSION['fecha_activa']->nid):?>
    <div data-alert class="alert-box info radius">
        <strong>Nota: </strong>Recuerda que ya no es necesario guardar la alineación. Cada cambio que realices queda grabado automáticamente.
        <a href="#" class="close">&times;</a>
    </div>
<?php else :?>
    <div data-alert class="alert-box warning radius">
        <strong>Nota:</strong> Esta fecha se encuentra cerrada. No se pueden realizar cambios en la alineación.
        <a href="#" class="close">&times;</a>
    </div>
<?php endif?>
<div></div>
<div id="cancha" class="clearfix <?php echo ($data["alineacion"]->field_fecha_torneo['und'][0]['target_id'] == $_SESSION['fecha_activa']->nid)?"active":""?>">
    <?php for($i=1;$i<=11;$i++):?>
        <?php
        $var = "field_jugador".$i;
        if(isset($data["alineacion"]->{$var}['und']) && $data["alineacion"]->{$var}['und'][0]['target_id']>0){
            $asigned = "asigned";
        } else {
            $asigned = "";
        }?>
        <div id="place<?php echo $i?>" class="place place_position<?php echo $positions[$i]["position"]?> <?php echo $asigned?>" style="top: <?php echo 55+($positions[$i]["y"]-1)*28?>px;left: <?php echo 230+($positions[$i]["x"]-1)*65?>px;">
            <input type="hidden" class="position" value="<?php echo $positions[$i]["position"]?>">
            <?php if($asigned):?>
                <input type="hidden" class="id" value="<?php echo $data["alineacion"]->{$var}['und'][0]['target_id']?>">
            <?php endif?>
            <img src="/sites/all/themes/soydt_foundation/images/players/player<?php echo $positions[$i]["position"]?>.png">
        </div>
    <?php endfor?>
    <?php for($i=1;$i<=11;$i++):?>
        <?php if(isset($data["alineacion"]->{"field_jugador" . $i}['und']) && $data["alineacion"]->{"field_jugador" . $i}['und'][0]['target_id'] >0):?>
            <?php $player = $data["alineacion"]->{"field_jugador" . $i}['und'][0]?>
            <?php $pl = node_load($player['target_id']);?>
            <div id="<?php echo $pl->nid?>" class="player player<?php echo $pl->nid?> player_position<?php echo $pl->field_posicion['und'][0]['tid']?> end columns text-center" >
                <div class="image small-12 columns"><img src="/sites/all/themes/soydt_foundation/images/players/<?php echo $pl->field_equipo['und'][0]['target_id']?>.png"></div>
                <div class="name_points columns small-12 text-center">
                    <div class="columns small-9 name"><a href="/node/<?php echo $pl->nid?>"><?php echo explode(" ",$pl->field_apellidos['und'][0]['value'])[0]?></a></div>
                    <div class="columns small-3 text-center points">0</div>
                    <?php if(isset($data["alineacion"]->field_capitan['und']) && $pl->nid == $data["alineacion"]->field_capitan['und'][0]['target_id']):?>
                        <div class="star"></div>
                    <?php endif?>
                </div>
                <div class="options columns small-10 small-centered text-center">
                    <a href="/node/<?php echo $pl->nid?>" class="info"></a>
                    <?php if($data["alineacion"]->field_fecha_torneo['und'][0]['target_id'] == $_SESSION['fecha_activa']->nid):?>
                        <a id="drop<?php echo $pl->nid?>" class="drop"></a>
                        <a class="sell" id="sell<?php echo $pl->nid?>"></a>
                    <?php endif?>
                </div>
            </div>
        <?php endif?>
    <?php endfor ?>
    <div id="suplentes">
        <?php if($data["alineacion"]->field_fecha_torneo['und'][0]['target_id'] != $_SESSION['fecha_activa']->nid || true):?>
            <?php if(isset($data["alineacion"]->field_suplentes['und'])):?>
                <?php foreach($data["alineacion"]->field_suplentes['und'] as $player):?>
                    <?php $pl = node_load($player['target_id']);?>
                    <div id="<?php echo $pl->nid?>" class="player player<?php echo $pl->nid?> player_position<?php echo $pl->field_posicion['und'][0]['tid']?> end columns text-center" >
                        <div class="image small-12 columns"><img src="/sites/all/themes/soydt_foundation/images/players/<?php echo $pl->field_equipo['und'][0]['target_id']?>.png"></div>
                        <div class="name_points columns small-12 text-center">
                            <div class="columns small-9 name"><a href="/node/<?php echo $pl->nid?>"><?php echo explode(" ",$pl->field_apellidos['und'][0]['value'])[0]?></a></div>
                            <div class="columns small-3 text-center points">0</div>
                            <?php if(isset($data["alineacion"]->field_capitan['und']) && $pl->nid == $data["alineacion"]->field_capitan['und'][0]['target_id']):?>
                                <div class="star"></div>
                            <?php endif?>
                        </div>
                        <div class="options columns small-10 small-centered text-center">
                            <a href="/node/<?php echo $pl->nid?>" class="info"></a>
                            <?php if($data["alineacion"]->field_fecha_torneo['und'][0]['target_id'] == $_SESSION['fecha_activa']->nid):?>
                                <a id="drop<?php echo $pl->nid?>" class="drop"></a>
                                <a class="sell" id="sell<?php echo $pl->nid?>"></a>
                            <?php endif?>
                        </div>
                    </div>
                <?php endforeach?>
            <?php endif?>
        <?php endif?>
    </div>
</div>

<div id="alineaciones-popup" class="reveal-modal tiny" data-reveal data-options="close_on_background_click: false;" >
</div>