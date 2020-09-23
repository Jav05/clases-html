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

public function filtraArray($array=''){
    
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
