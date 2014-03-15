<?php

require_once 'ParseDown.php';

class HTMLComposer{
    
    private static $assets = array(
        array( 'name' => 'φάση 1', 'file' => 'phase1.md' ),
        array( 'name' => 'φάση 2', 'file' => 'phase2.md' ),
        array( 'name' => 'φάση 3', 'file' => 'phase3.md' ),
        array( 'name' => 'φάση 4', 'file' => 'phase4.md' ),
        array( 'name' => 'φάση 5', 'file' => 'phase5.md' ),
    );
    private static $ACTIVE_PHASE = 0; // index in assets array
    private static $FAQ_SPLIT_TOKEN = '========================='; // 15
    private static $QUESTION_SPLIT_TOKEN = '-------------------------'; // 15
    
    private static $TEMPLATE_FILEPATH = 'Template.php';
    private static $MARKDOWN_PARSER = null;
    private static $singleInst = null;

    private function __construct() {
        self::$MARKDOWN_PARSER = new Parsedown(); 
    }
    
    public static function SingletonCreate(){
        if( !self::$singleInst )
            self::$singleInst = new HTMLComposer();
    }
    
    private static function ParseMdFaq( $mdFaq, $id ){
        $faq = explode( self::$QUESTION_SPLIT_TOKEN, $mdFaq );
        if( !empty($faq) && count($faq)==2 ){
            $q = $faq[0];
            
            $a = self::$MARKDOWN_PARSER->parse( $faq[1] );
            if( $a ){
                return array( 'q' => $q, 'a' => $a, 'id' => $id );
            }else
                return null;
        }else
            return null;
    }
    
    private static function ParseMds(){
        $phasesFaqs = array();
        for( $i=0; $i<count(self::$assets); ++$i ){
            $asset = self::$assets[$i];
            $phasesFaqs[$i] = array( 
                    'name' => $asset['name'], 
                    'id' => $i, 
                    'faqs' => array() 
                );
            $mdFile = @file_get_contents( $asset['file'] );
            if( $mdFile ){
                $mdFaqs = explode( self::$FAQ_SPLIT_TOKEN, $mdFile );
                
                for($j=0; $j<count($mdFaqs); ++$j){
                    $faq = self::ParseMdFaq( $mdFaqs[$j], $i . '-' . $j );
                    
                    if($faq){   
                        $phasesFaqs[$i]['faqs'][] = $faq;
                    }else{
                        echo 'parse error @: ' . $mdFaqs[$j];
                        return null;
                    }
                }
                
            }else{
                echo 'file is missing: ' . $asset['file'];
                return null;
            }
        }
        return $phasesFaqs;
    }
    
    private static function render($file, $variables = array()){
        extract($variables);

        ob_start();
        include $file;
        $renderedView = ob_get_clean();

        return $renderedView;
    }
    
    public static function Compose( $outputName ){
        
        $mds = self::ParseMds();
        if($mds){
            $view = self::render( 
                    self::$TEMPLATE_FILEPATH, 
                    array( 'mds' => $mds, "active" => self::$ACTIVE_PHASE ) 
                );
            file_put_contents( $outputName, $view);
        }
    }
        

}
