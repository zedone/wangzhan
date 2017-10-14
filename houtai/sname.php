<?php
//按中文首字母排序
function orderByName($userName,$order='asc',$key='jlname'){  
   foreach($userName as $name){
        if(is_array($name))$char = getFirstChar($name[$key]);
        elseif(is_string($name))$char= getFirstChar($name);
        $nameArray = array();//将姓名按照姓的首字母与相对的首字母键进行配对  
        if(count($charArray[$char])!=0)$nameArray = $charArray[$char]; 
        array_push($nameArray,$name);   
        $charArray[$char] = $nameArray;  
    } 
    if(strtolower($order)=='asc')ksort($charArray);elseif(strtolower($order)=='desc')krsort($charArray);
    $newarr = array();
    $i=0;
    foreach($charArray as $ck=>$cv){
        if(is_array($cv)){
            foreach($cv as $cck=>$ccv){
                $newarr[$i++] = $ccv;
            }   
        }else{
            $newarr[$i++]=$cv;
        }
    }
    /*echo '按首字母排序前：<br>';  
    print_r($charArray);  
    //根据键值对排序                 
    echo '按首字母排序后：<br>';  
    print_r($charArray);*/  
    return $newarr;  
}
//获取中文的首字母
function getFirstChar($s){  
    $s0 = mb_substr($s,0,1,'utf-8');//获取名字的姓
    $s = iconv('UTF-8','GBK', $s0);//将UTF-8转换成GB2312编码  
    if(ord($s0)>128){//汉字开头，汉字没有以U、V开头的  
    $asc=ord($s{0})*256+ord($s{1})-65536;  
        if($asc>=-20319 and $asc<=-20284)return "A";  
        if($asc>=-20283 and $asc<=-19776)return "B";  
        if($asc>=-19775 and $asc<=-19219)return "C";  
        if($asc>=-19218 and $asc<=-18711)return "D";  
        if($asc>=-18710 and $asc<=-18527)return "E";  
        if($asc>=-18526 and $asc<=-18240)return "F";  
        if($asc>=-18239 and $asc<=-17760)return "G";  
        if($asc>=-17759 and $asc<=-17248)return "H";  
        if($asc>=-17247 and $asc<=-17418)return "I";              
        if($asc>=-17417 and $asc<=-16475)return "J";               
        if($asc>=-16474 and $asc<=-16213)return "K";               
        if($asc>=-16212 and $asc<=-15641)return "L";               
        if($asc>=-15640 and $asc<=-15166)return "M";               
        if($asc>=-15165 and $asc<=-14923)return "N";               
        if($asc>=-14922 and $asc<=-14915)return "O";               
        if($asc>=-14914 and $asc<=-14631)return "P";               
        if($asc>=-14630 and $asc<=-14150)return "Q";               
        if($asc>=-14149 and $asc<=-14091)return "R";               
        if($asc>=-14090 and $asc<=-13319)return "S";               
        if($asc>=-13318 and $asc<=-12839)return "T";               
        if($asc>=-12838 and $asc<=-12557)return "W";               
        if($asc>=-12556 and $asc<=-11848)return "X";               
        if($asc>=-11847 and $asc<=-11056)return "Y";               
        if($asc>=-11055 and $asc<=-10247)return "Z";   
    }elseif(ord($s)>=48 and ord($s)<=57){//数字开头  
        switch(iconv_substr($s,0,1,'utf-8')){  
            case 1:return "Y";  
            case 2:return "E";  
            case 3:return "S";  
            case 4:return "S";  
            case 5:return "W";  
            case 6:return "L";  
            case 7:return "Q";  
            case 8:return "B";  
            case 9:return "J";  
            case 0:return "L";  
        }                 
    }else if(ord($s)>=65 and ord($s)<=90){//大写英文开头  
        return substr($s,0,1);  
    }else if(ord($s)>=97 and ord($s)<=122){//小写英文开头  
        return strtoupper(substr($s,0,1));  
    }else{  
        return iconv_substr($s0,0,1,'utf-8');//中英混合的词语提取首个字符即可       
    }  
}

?>