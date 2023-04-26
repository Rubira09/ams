<?php
    namespace App;

    class Aula{
        public function extrairInformacoes(){
            
            $aulas = scandir("aulas");
            array_pop($aulas);
            $aulas = array_slice($aulas,2);


            $save_dados = array();
            foreach($aulas as $cont ){

                if(is_dir("aulas/".$cont)){
                  
                   

                    $get_dados = file_get_contents("aulas/$cont/aula.js");
                    $dados_json = json_decode( substr($get_dados,18));
                    $get_imports = $dados_json -> imports;
                     
                 
                        
                        //  var_dump($get_dados);

                $dadosAula = array();
            

                foreach($get_imports as $get_import_one_by_one){
                    $get_dados_one_by_one = file_get_contents("aulas/$cont/". $get_import_one_by_one);
                    
                    if($get_dados_one_by_one[0] == "c") {
                        $get_dados_one_by_one_json = json_decode(rtrim(substr($get_dados_one_by_one,15),")"));
                    } else {
                        $get_dados_one_by_one_json = json_decode(rtrim(substr($get_dados_one_by_one,14),")"));
                    }
                    $obj_one_by_one = [
                        "id" => $get_dados_one_by_one_json->id,
                        "tipo" => $get_dados_one_by_one_json->tipo
                    ];
                    array_push($dadosAula, $obj_one_by_one);
                }  
                $save_dados[$cont] = $dadosAula;

        
                  }
                
              }
           

              file_put_contents('aulas/dadosAulas.json', json_encode($save_dados));    
              foreach($save_dados as $key => $dados){
                echo $key;
                echo "<pre>"    ;
                var_dump($dados);
                echo "</pre>"    ;
                echo "=====================";


              }
              
        }
        
    }
