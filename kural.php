<?php
    /************** குறள் தேடல் : பையம்  π PIEM *******************

     * auth: கேசவன்
     * date: பொழுதுகழியா நாள்
     * நன்றி : https://github.com/jskswamy/dailykural (For the CSV format)
     * 
     **********************************************************************/


define('அதிகபட்ச_வார்த்தைகள்',7);

class பாடல் {
    protected $குறள்         = '';
    protected $பாடல்        = '';
    protected $அச்சு_வடிவு   = [];
    protected $வார்த்தைகள்  = [];
    protected $பதிவு         = 0;         # log
    protected $π_இலக்கங்கள் = [3,1,4,1,5,9,2,6];
    #π(pi) = 3.141592 65358979 3238462643383279502884197169399375105820974944592307816406286208998628034825342117067

    public function __construct($பாட்டு){
        $this->குறள்_கொடு($பாட்டு);
    }

    protected function குறள்_கொடு($பாட்டு){          #setKural
        $this->குறள் = preg_replace('/\./','',$பாட்டு);
        $this->குறள் = trim(preg_replace('/\s+/', ' ',$this->குறள்));      
    }

    protected function குறள்_எடு(){                   #getKural
        return $this->குறள்;
    }

    protected function குறள்_உடைத்து_சோதி(){       #validateKural
        $this->வார்த்தைகள் = explode(' ', $this->பாடல்);   #break 
        return sizeof($this->வார்த்தைகள்)==அதிகபட்ச_வார்த்தைகள்?true:false;
    }

    protected function குறள்_திருப்பு(){                #reverseKural
        return implode(' ',array_reverse(explode(' ',$this->குறள்)));
    }

    public function பாடல்_பையமா(){                 #isKuralPiem
        return $this->பாடல்_பகு($this->குறள்)??$this->பாடல்_பகு($this->குறள்_திருப்பு()) ;
        // return ;     // try luck over reversal way as well
    }

    protected function பாடல்_பகு($பாட்டு){
        $this->பாடல் = $பாட்டு;
        if($this->குறள்_பையம்_சோதனை()){
            $return['state'] = "வெற்றி! இந்த பாடல் பையம் (#PIEM)";
            $return['உள்ளீடு'] = $this->குறள்_எடு();
            $return['log'] = $this->அச்சு_வடிவு;
        }else{
            $return = NULL;
            // echo "பாடல் doesn't match Piem\n";
        }
        return $return;
    }

    public function பாடல்_break(){
        // return preg_replace('~((\w+\s){4})~', '$1' . "<br>\n", $this->குறள்);
        $return ='';
        $arr = explode (" " , $this->குறள்);
        $lines = array_chunk($arr,4);
        foreach($lines as $line) 
            $return .= implode (" ", $line)."<br>\r\n";
            return $return;
    }

    public function பாடல்_தேடல்($வார்த்தை){
        if(str_contains($this->குறள், $வார்த்தை)){
            return $this->குறள்;
        }else {
            return FALSE;   # code...
        }
    }

    protected function குறள்_பையம்_சோதனை(){
        if(!$this->குறள்_உடைத்து_சோதி()){
           if($this->பதிவு) echo "WARNING: This appears doesn't a valid குறள்! Continuing...\n";
        };
        
        unset($this->அச்சு_வடிவு);
        $varthaigalSliced = array_slice($this->வார்த்தைகள், 0, sizeof($this->π_இலக்கங்கள்));

        foreach ($varthaigalSliced as $location => $வார்த்தை) {
            $வார்த்தை= trim($வார்த்தை,',');

            $regex = "/\pL\pM*|./u";//Unicode letter & Unicode Mark     # Thanks: https://stackoverflow.com/questions/28582596
            preg_match_all($regex, $வார்த்தை, $varthai_out);
            $வார்த்தை_நீளம் = count($varthai_out[0]);

            $this->அச்சு_வடிவு[] = $வார்த்தை_நீளம்." : ".$வார்த்தை ;

            if($this->π_இலக்கங்கள்[$location] == $வார்த்தை_நீளம்){
                $isSuccess[$location] = true  ;
                continue;
            }else{
                $isSuccess[$location] = false  ;
            }
        }

        return array_product($isSuccess);
    }
}

?>
