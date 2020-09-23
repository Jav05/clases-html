<?php
class arrayUtils {
    
public $arr;
private $orden;
public $contador;

    public function __construct($arr ='') {
    $this->arr = (array)$arr;
    $this->contador = count($this->arr);
    }
    
public function agregaElem($valor,$indice=false)
{
    if(!$indice) {
    $this->arr[] = $valor;
    return $this->arr;
    } 
    else 
    {
        
        if(is_int($indice)) {
        $this->arr[(int)$indice] = $valor;
        return $this->arr;
        }
        else
        {
        $this->arr[(string)$indice] = $valor;
        return $this->arr;
        }
    }
}
public function eliminaElem($indice) {
    
    if(is_int($indice)) {
            if(isset($this->arr[(int)$indice])) {
            unset($this->arr[(int)$indice]);
            return $this->arr;
        }
        else
        {
            return $this->arr;
        }
    }
    else 
    {
        if(isset($this->arr[(string)$indice])) {
            unset($this->arr[(string)$indice]);
            return $this->arr;
        }
        else
        {
       
            return $this->arr;
        }
    }
}
public function resetea($array=''){
        
        if ($array != ''){
            
            $array = array_values($array);
            return $array;
        }else {
            
            $this->arr = array_values($this->arr);
            return $this->arr;
            
        }
        
}





public function cambiaValor($arrayInsertar, $array=''){
    
    if($array ==''){
        $this->arr = array_replace($this->arr, $arrayInsertar  );
        return $this->arr;
    }else{
        $array = array_replace($array, $arrayInsertar  );
        return $array;
    }
}

public function fitraArray($array=''){
    
     if($array ==''){
         $this->arr = array_filter($this->arr);
         return $this->arr;
     }else{
         $array = array_filter($array);
         return $array;
     }
}

public function codificaArray ($arr = ''){
    
    $arrayCod = json_encode($this->arr, JSON_UNESCAPED_UNICODE);
    
        if ($arr != '') $arrayCod = json_encode($arr, JSON_UNESCAPED_UNICODE);
        
            return $arrayCod;
    
}

public function decodificaArray ($array, $param = ''){
    
    if($param == '') $arrayDeco = json_decode($array, true);// true devuelve un array asiciativo al decodificar
    if($param != '') $arrayDeco = json_decode($array, $param);
    
  
      
      return $arrayDeco;
    
}


public function explota($arg, $str){
    
   
    $strExplotado = explode($arg, $str);
    
      
      return $strExplotado;
    
}

public function inmplota($arg, $arr){
    
    $strExplotado = implode($arg, $arr);
    
      return $strExplotado;
    
}


public function vaciaArray() {
    
    $this->arr = array();
    $this->orden = array();

}

public function muestraArray($array = '', $exit = true){
    
    echo '<pre>'; 
    if ($array != '' ) {
        var_dump($array);
    }else{
        var_dump($this->arr);   
    }
    echo '</pre>';
    if( $exit == true)  exit;
    
}
public function muestraArrayDosColumnas($array, $campoBD = '', $tableW = '100%', $clase = '', $titulo_tabla = '' ){
    
    
echo "<table width='$tableW'  class='$clase'>";
echo "<tr><td align='left' class='' />
<a class='btn btn-outline-dark' href='scripts/cerrores.php' role='button'>$titulo_tabla</a>
</td>
<td class='float-right'>
<a class='btn btn-outline-dark' href='javascript:cerrar();' role='button'>ocultar errores</a>
</td>

</tr>";

    for ($i=0; $i<count($array); $i++){
        
        if ($i%2 ==0){
            echo '<tr><td width="50%">';
        }else{
            echo '<td>';
        }
        
        
        
        if (is_array($array[$i])){
            
            for($j=0; $j<count($array[$i]); $j++){
            echo ($i+1).' - '.$array[$i][$campoBD];
            }
            
        }else{
            echo ($i+1).' - '.$array[$i];
        }
        
        
        
        
        if ($i%2 ==0){
            echo '</td>';
        }else{
            echo '</td></tr>';
        }
        
    }
echo '</table>';
    
}  
public function muestraArrayDosColumnas2($array, $campoBD = '', $tableW = '100%', $clase = '' ){
    
    
echo "<table width='$tableW'  class='$clase'>";
$html.="<table width='$tableW'  class='$clase'>";

    for ($i=0; $i<count($array); $i++){
        
        if ($i%2 ==0){
            echo  '<tr><td width="50%">';
            $html.= '<tr><td width="50%">';
        }else{
            echo '<td>';
            $html.='<td>';
        }
        
        
        
        if (is_array($array[$i])){
            
            for($j=0; $j<count($array[$i]); $j++){
             echo ($i+1).' - '.$array[$i][$campoBD];   
            $html.= ($i+1).' - '.$array[$i][$campoBD];
            }
            
        }else{
            echo ($i+1).' - '.$array[$i];
            $html.= ($i+1).' - '.$array[$i];
        }
        
        
        
        
        if ($i%2 ==0){
            echo '</td>';
            $html .= '</td>';
        }else{
            echo  '</td></tr>';
            $html .= '</td></tr>';
        }
        
    }
echo '</table>';
$html .= '</table>';
 return $html;   
}  

public function formularioErroresPalabras($array = '', $campoBD = '', $accion = '', $palabra = '', $clave = '', $numErrores = '', $errores = '', $tableW = '100%', $clase = '' ){
    

    
echo "<form action='$accion' method='POST'>";
echo "<table width='$tableW'  class='$clase'>";
echo "<input type='hidden' name='numErrores' value = '$numErrores'  id='numErrores' />";
echo "<input type='hidden' name='palabra' value = '$palabra'  id='plabra' />";
echo "<input type='hidden' name='clave' value = '$clave' id='clave' />";
echo "<tr><td colspan='2' class=''>";

    if ($errores != ''){
         echo "Modificar errores de la palabra: <b>$palabra</b>.";
    }else{
        echo "Seleccionar error(s) de la palabra: <b>$palabra</b>.";
    }

echo "</td></tr>";



    for ($i=0; $i<count($array); $i++){
        
        if ($i%2 ==0){
            echo '<tr><td width="50%">';
        }else{
            echo '<td>';
        }
        
        
        
            echo '<input type="checkbox" name="errorp[]"';  
            
            
               if($errores !=''){
                    foreach ($errores as $value) {
                        if ($value == ($i+1)) echo 'checked="checked"';

                    }
               }
                    
                    
                    
                    
                       echo    ' value="'.($i+1).'"> ';
                       
                       
                       if (is_array($array[$i])){
                           

                           
                           
            
                            for($j=0; $j<count($array[$i]); $j++){
                            echo ($i+1).' - '.$array[$i][$campoBD];
                            }
            
                        }else{
                            echo ($i+1).' - '.$array[$i];
                        }
                       
                       
                       
            
                    
        
                    if ($i%2 ==0){
                        echo '</td>';
                    }else{
                        echo '</td></tr>'; 
                    }
                    
                   if (($i+1) == count($array)){
                        
                        echo "<tr><td colspan ='2' align ='center' />";
                        echo '<input type="submit" name="button1" id="button1" value="Enviar" class="btn btn-outline-dark btn-lg">';
                        echo "</td></tr>";
                         }
        
    }
echo '</table>';
echo '</form>';
    
}    

public function formularioErroresPalabras2($array = '', $campoBD = '',$id='', $accion, $palabra, $clave, $numErrores, $errores, $tableW = '100%', $clase = '', $valuebot ){
    
    $this->arr = $array;
    

    
echo "<form action='$accion' method='POST'>";
echo "<table width='$tableW'  class='$clase'>";
echo "<tr><td>";
echo "<table width='100%'  class='table'>";


echo "<input type='hidden' name='numErrores' value = '$numErrores'  id='numErrores' />";
echo "<input type='hidden' name='palabra' value = '$palabra'  id='plabra' />";
echo "<input type='hidden' name='clave' value = '$clave' id='clave' />";
echo "<tr><td colspan='2' class='abajo_bordes'>";

    
         echo "Seleccione los errores a eliminar.";
    
        
    

echo "</td></tr>";

    for ($i=0; $i<count($this->arr); $i++){
        
        if ($i%2 ==0){
            echo '<tr><td width="50%">';
        }else{
            echo '<td>';
        }
        
        
        
            echo '<input type="checkbox" name="errorp[]"';  
               
                    foreach ($errores as $value) {
                        if ($value == ($i+1)) echo 'checked="checked"';

                    }
                    
                       
                       
                       
                       if (is_array($this->arr[$i])){
            
                            for($j=0; $j<1; $j++){
                                
                               // no pilla los values de id_e del error
                                echo    ' value="'.($this->arr[$i]['id_e']).'"> ';
                            echo ($i+1).' - '.$this->arr[$i][$campoBD];
                            }
            
                        }else{
                            echo    ' value="'.($i).'"> ';
                            echo ($i+1).' - '.$this->arr[$i];
                        }
                       
                       
                       
            
                    
        
                    if ($i%2 ==0){
                        echo '</td>';
                    }else{
                        echo '</td></tr>'; 
                    }
                    
                   if (($i+1) == count($this->arr)){
                        
                        echo "<tr><td colspan ='2' align ='center' />";
                        echo '<br>';
                        echo "<input type='submit' name='button1' id='button1' value='$valuebot' class='btn btn-outline-dark btn-lg'/>";
                        echo "</td></tr>";
                         }
        
    }
echo '</td></tr>';
echo '</table>';
echo '</form>';
    
} 




public function array_flatten($array) { 
  if (!is_array($array)) { 
    return false; 
  } 
  $result = array(); 
  foreach ($array as $key => $value) { 
    if (is_array($value)) { 
        $uArray = new arrayUtils();
      $result = array_merge($result, $uArray->array_flatten($value)); 
    } else { 
      $result = array_merge($result, array($key => $value));
    } 
  } 
  return $result; 
}


public function ordenaPor($items, $attr, $order)
{
    $sortedItems = [];
    foreach ($items as $item) {
        $key = is_object($item) ? $item->{$attr} : $item[$attr];
        $sortedItems[$key] = $item;
    }
    if ($order === 'desc') {
        krsort($sortedItems);
    } else {
        ksort($sortedItems);
    }
 
    return array_values($sortedItems);
}



}