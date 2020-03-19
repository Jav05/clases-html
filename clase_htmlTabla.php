<?php

        /* 
         *                              EJEMPLO DE USO MAS ABAJO
         */

        class htmlTabla{

        /*
        * array de datos a mostrar en la tabla, puede ser multidimensional como cuando
        * viene de una consulta a la BBDD
        */
        public $array;
        /*
        * numero de columnas parara mostar la informacion
        */
        public $numColumnas = '1';
        /*
        * borde de la tabla
        */
        public $border = '0';
        /*
        * el width
        */
        public $width = '100%';
        /*
        * clase para CSS de la tabla
        */
        public $class = '';
        /*
        * CSS del tr
        */
        public $trClass = '';
        /*
        * CSS del td
        */
        public $tdClass = '';
        /*
        * convierte en un enlace cada elemento "../docs/pagina.php?var=$var&foo=$foo"
        * para que las variables pasadas dean las internas usar $varEnlace. y esta dejar
        * de la forma "pagina.php"
        */
        public $enlace = '';

        /*
        * $delante imprime lo que sea entre el numero de orden $i. y el elemento del array a mostar en pantalla.
        * como un tag de imagen, un guion
        */   
        public $delante = '';
        /*
        * $i se setea a 1 por que si no, no podria generrarse bien la tabla html
        */
        public $i = 1;
        /*
        * $iOk es = a true imprimirá delante del elemento el valor de  $i. en una celda
        */
        public $iOk = false;
        /*
         * para pasar el valor de los campos de la consulta por GET
         * es uno o todos los campos de la tabla de la bd. se puede pasar como array
         */
        public $varEnlace = '';
        /*
         * CSS para las filas que llevan el nombre del campo de BBDD como titulo cabecera
         */
        public $trClassCabecera;
        /*
         * CSS para las celdas que llevan el nombre del campo de BBDD como titulo cabecera
         */
        public $tdClassCabecera;
        
        public $suPropioValor;
        
        public $todosValores;
        
        public $cabeceras;
        
        
    //tablas en varias columnas sin la cabecera del nombre del campode la BBDD o indice asociativo array
    public function creaTablaHtml (){
        
        
    $html = "<table width='$this->width' border='$this->border' class='$this->class'>";
    $arrUtil = new arrayUtils();
    $numcolumnas = $this->numColumnas;
  
    $total_resultados = count($this->array);
   if ($total_resultados>0) {
       
       
      //si queremos que aparezcan las cabeceras en las tablas
        if ($this->cabeceras == true){

            $html .= "<tr class='$this->trClassCabecera'>";
              //$uArray->muestraArray($row);

                $g=0 ; 
          foreach ($this->array as $key_8 => $result2) {

               if ($g==$numcolumnas){break;}//de esta manera solo recorre el bucle el numero de campos nada mas
                   foreach ($result2 as $key6 => $value5) {
                            $html .= "<td class='$this->tdClassCabecera'>".$key6."</td>";   
                            }
              $g++;
            }
              $html .= '</tr>';

        }
    
    //iniciamos contador
    $this->i;
     foreach($this->array as $value){
         
     $resto = ($this->i % $numcolumnas); 
       
       if($resto == 1){ /*si es el primer elemento creamos una nueva fila*/ 
         $html .= "<tr class='$this->trClass'>";
         }
                 
     
        if($this->iOk == true) { $html .= "<td class='$this->tdClass'>$this->i</td>";}// si $this->iOk = true imprimira el numero delante    
        if($this->delante != '') { $html .= "<td class='$this->tdClass'>$this->delante</td>";} //y $this->delante si no esta vacio imprime lo que le pongas imagen por ejemplo    

            
                     if(is_array($value)){
                        foreach ($value as $key => $result) {
                        
                         //si $this->enlace con variable externa o no, esta llena lo creamos si no lo dejamos vacio
                        if($this->enlace != ''){
                              $html .= "<td class='$this->tdClass'>";
                              
                              
                              //pasar todos los valores en el enlace
                              if($this->todosValores == true){
                                  $html .=  "<a href='$this->enlace?";
                                  $html_1 = array ();
                                  foreach ($value as $key3 => $result3) {
                                      
                                   $html_1[] = $key3.'='.$result3;
                                   
                                   
                                  }
                                  $html .= $arrUtil->inmplota('&', $html_1);
                                  $html .= "' >$value[$key]</a></td>"; 
                              }
                              
                              
                              
                              //armar enlaces, cada elemento con su valor
                           
                              elseif($this->suPropioValor == true){
                                  
                                   $html .=  "<a href='$this->enlace?$key=$value[$key]' >";
                                   $html .= $value[$key]."</a></td>"; 
                                  
                                  
                              }
                              
                              //si $varEnlace viene lleno cambio el valor de $key por el suyo
                              elseif($this->varEnlace !=''){
                                   $key_a = $this->varEnlace;
                                   $valor = urlencode($value[$key_a]);
                                   $variable = md5($this->varEnlace);
                                   
                                   $html .=  "<a href='$this->enlace?$variable=$valor' >";
                                   $html .= $value[$key]."</a></td>"; 
                              }else{
                                   $html .=  "<a href='$this->enlace' >";
                                   $html .= $value[$key]."</a></td>";
                              }
                              
                              
                        }else{
                              $html .= "<td class='$this->tdClass'>".$value[$key]."</td>";
                        }
                         
                      
                    } 
                   
                  
                }else{
                   
                    $html .= "<td class='$this->tdClass'>".$value."</td>";
                }
                  
                  
                 /*cuando el resto sea = 0 cerramos fila*/ 
                if($resto == 0){
                  /*cerramos la fila*/ 
                  $html .= "</tr>"; 
                }
   $this->i++; 
 }
 if($resto != 0){
  /*Si en la última fila sobran columnas, creamos celdas vacías*/
   for ($j = 0; $j < (($numcolumnas - $resto)*count($value)); $j++){
     $html .= "<td></td>"; 
    }
   $html .= "</tr>";
  } 
}else{ 
  $html .= "<tr><td class='$this->tdClass'>0 elementos encontrados</td></tr> ";
 } 
$html .= '</table>';
 return $html;       
        
    }
    
 
    //crea tablas con varias columnas con los nobres de los campos de la bbdd o indices de arrays asociativos de titulos en una colunma
   public function tablaCabeceras ($array, $numColumnas = '1', $border='0', $width = '100%', $class='', $trClassCabecera='',
                                    $tdClassCabecera='', $trClass='', $tdClass=''){
       
       
$html = "<table width='$width' class='$class' border='$border'>";

$total_resultados = count($array);
   if ($total_resultados>0) {
       
       
       
  $numcolumnas =$this->numColumnas;
  
  $html .= "<tr class='$trClassCabecera'>";
  //$uArray->muestraArray($row);
  
    $g=0 ; 
   foreach ($array as $key2 => $result2) {
       
       if ($g==$numcolumnas){break;}
       foreach ($result2 as $key5 => $value3) {
           
            
                    $html .= "<td class='$tdClassCabecera'>".$key5."</td>";   
               
                    
                    
  }
  $g++;
  }
  $html .= '</tr>';

  
     
     $i = 1;
     foreach($array as $value){
       $resto = ($i % $numcolumnas).'<br>'; 
       
      
       
       if($resto == 1){ /*si es el primer elemento creamos una nueva fila*/ 
         $html .= "<tr class='$trClass'>";
     }
                 //$uArray->muestraArray($value);
                 
                if(is_array($value)){
                    
                   
                    
                   foreach ($value as $key => $result) {
                    $html .= "<td class='$tdClass'>".$value[$key]."</td>";   
                    } 
                    
                 }else{
                    $html .= "<td class='$tdClass'>$value</td>";
                }
                  
                  
                 /*mostramos el valor del campo especificado*/ 
                if($resto == 0){
                  /*cerramos la fila*/ 
                  $html .= "</tr>"; 
                }
   $i++; 
 }
 if($resto != 0){
  /*Si en la última fila sobran columnas, creamos celdas vacías*/
   for ($j = 0; $j < (($numcolumnas - $resto)*count($value)); $j++){
     $html .= "<td>&nbsp;</td>"; 
    }
   $html .= "</tr>";
  } 
}else{ 
  $html .= "<tr><td>0 elementos encontrados</td></tr> ";
 } 
$html .= '</table>';
return $html;
       
   } 
    
    
    
    
    
}


//error_reporting(E_ALL);
//$tablaErr = new htmlTabla();
//$uArray   = new arrayUtils();
//$BD       = new consulta_principal();
//$tabla    = 'errores_palabras';
//$columna  = 'error';
////$row      = $BD->leer($tabla,$columna);
//
//$tablaErr->array = $BD->leer($tabla,$columna);
//$tablaErr->numColumnas = 2;
//$tablaErr->border = 0;
//$tablaErr->width = '35%';
//$tablaErr->class = 'textbox2';
//$tablaErr->trclass = '';
//$tablaErr->tdClass = '';
//$tablaErr->enlace = '../index.php';
////$tablaErr->i = 1;
//
////para imprimir delante el numero de orden, falso no imprime
//$tablaErr->iOk = true;
////para imprimir delante del elemento del array
//$tablaErr->delante = ' - ';
//
//$tabla_err = $tablaErr->creaTabla();
//echo $tabla_err;
//$BD = null;