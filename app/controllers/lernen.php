<?php

class Lernen extends Controller{
    function Index(){
        $baseInfo = array(
            'page' => 'lernen'
        );
        $this->view('template/header', $baseInfo);
        echo "Bitte eine Memoryset auswählen!";
        $this->view('template/footer');
    }

    function memory($memorySet = ""){


        $this->model("MemorySet");

        if($memorySet == "toft"){
            header("Location: https://memoriz.it/toft");
        }

        

        $name = $this->MemorySet->getNameOfMemorySet($memorySet);

        if($name != "NOT FOUND"){

            $cards = $this->MemorySet->get8RandomFromMemorySet($memorySet);

            if(!$cards){
                header("Location: https://memoriz.it/Error999");
            }

            $memoryInfo = array(
                'name' => $name,
                'getCards' => function() use ($cards){

                    shuffle($cards);
                    foreach($cards as $card){
                        $memoryKarteInfo = array(
                            'content' => $card['content'],
                            'id' => $card['id']
                        );
                        $this->view('lernen/memory-karte', $memoryKarteInfo);
                    }
                }
            );

            $baseInfo = array(
                'page' => 'lernen'
            );
            $this->view('template/header', $baseInfo);

            $this->view('lernen/index', $memoryInfo);
        }else{
            $this->view('lernen/memory-not-found');
        }

        $this->view('template/footer');
    }

    function ressourcen($memorySet = ""){
        echo "ressourcen";
    }
}

?>