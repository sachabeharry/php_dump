<?php

/* View contents of any variable as (pretty) HTML
 * Use: Dump::html( mixed expr ); 
 */

class Dump 
{
    
    private static $_utilId     = 0;
    public static $printCount   = 0;
        
    public static function newId() {
        return ++self::$_utilId;
    }

    public static function getStyle() {
        return(
            "<style>
            
                div.upm {
                    border-radius: 2px;
                    margin: 10px;
                    background: #fff;
                    min-height: 40px;
                    border: 1px solid #eee;
                    padding: 1px 0px;
                }
            
                div.upo {
                    border-radius: 0 2px 0 2px;
                    padding: 2px 2px 2px 2px;
                    border: 1px solid #fff;
                    position: relative;
                    background: #fff;
                }
            
                div.upt {
                    font-family: 'Lucida Grande', Arial;
                    margin: 0px;
                    font-size: 12px;
                    background-color: #f9f9f9;
                    color: #222;
                    padding: 6px 8px;
                    border-bottom: 1px solid #e0e0e0;
                    border-radius: 2px 2px 0 0;
                    background-image: -moz-linear-gradient( -90deg, #fcfcfc, #f9f9f9 );
                    background-image: -webkit-gradient( linear, left top, left bottom, from( #fcfcfc ), to( #f9f9f9 ) );        
                }
                
                div.uph {
                    font-family: Monaco, 'Courier New';
                    font-size: 12px;
                    line-height: 16px;
                    color: #abc;
                    padding: 6px;
                    overflow: auto;
                    max-height: 300px;
                }
                
                div.upt a.uptbn, a.upohtbn {
                    display: block; 
                    float: right;
                    font-family: Helvetica, Arial;
                    font-size: 12px;
                    background-color: #f3f3f3;
                    color: #ccc;
                    padding: 0px;
                    width: 14px;
                    -moz-border-radius: 2px;
                    -webkit-border-radius: 2px;
                    border: 1px solid #ddd;
                    text-decoration: none;
                    margin-left: 4px;
                    text-align: center;
                    outline: none;
                }

                div.upt a.uptbn:hover, a.upohtbn {
                    background-color: #f9f9f9;
                }
                
                a.upohtbn { margin-bottom: 2px; }
                
                br.clear {
                    display: block; 
                    clear: both;
                }
                            
                div.uph a {
                    font-family: Helvetica, Arial;
                    font-size: 12px;
                    background-color: #e0f0ff;
                    color: #39c;
                    padding: 0px 4px 0px 4px;
                    border-radius: 2px;
                    text-decoration: none; 
                }
                                    
                div.uph span.count {
                    font-family: 'Lucida Grande', Arial;
                    font-size: 10px;
                    font-weight: bold; 
                    color: #ddd;
                    padding: 0px 4px 0px 4px;
                    display: inline-block;
                    margin-left: 1px;
                }
                
                div.uph span.count.more {
                    color: #888;
                }

                div.uph a:hover {
                    background-color: #cef;
                }
            
                div.uph a.more {
                    background-color: #efc;
                    color: #393;
                }
                                            
                div.uph a.more:hover {
                    background-color: #cf8;
                }

                div.asm, div.osm {
                    margin: 0px;
                    padding: 0px 0px 0px 20px;
                    border-left: 1px dotted #ccc;
                }
            
                span.prw {
                    color: #04c;
                    color: #48c;
                }
            
                span.cla {
                    color: #04c;
                }
                
                span.pro, span.pri {
                    color: #c90;
                }
            
                span.ark {
                    color: #333;
                    color: #08c;
                }
            
                span.var {
                    color: #024;
                    color: #468;
                }
                            
                span.arr, span.obj {
                    color: #c08;
                }               

                span.nul {
                    color: #c80;
                }
            
                span.boo {
                    color: #808;
                }
                            
                span.int {
                    color: #04c;
                }
            
                span.str {
                    color: #082;
                }
            
                span.udt {
                    color: #444;
                }
            </style>" 
        );
    }

    public static function getJavaScript() {
        return(
            "<script type=\"text/javascript\">
            
                function toggleCHt( id ) {
                    var btn = document.getElementById( 'hbtn_'+id ); 
                    var c = document.getElementById( 'c_'+id ); 
                    
                    if( c.style.maxHeight == 'none' ) {
                        btn.innerHTML = '_';
                        c.style.maxHeight = '300px';
                    } else {
                        btn.innerHTML = '&oline;';
                        c.style.maxHeight = 'none';
                    }
                    return false;
                }
        
                function toggleSm( id ) {                       
                    var btn = document.getElementById( 'btn'+id );
                    var bt = document.getElementById( 'bt'+id );
                    var b = document.getElementById( id ); 
                    if( btn.innerHTML == '+' ) {
                        btn.innerHTML = '&minus;';
                        btn.className = '';//btn.className.replace( '/\bmore\b/', '' );
                        bt.className = 'count';//bt.className.replace( '/\bmore\b/', '' );
                        b.style.visibility = 'visible';
                        b.style.display = 'block';
                    } else {
                        btn.innerHTML = '+';
                        btn.className += ' more ';
                        bt.className += ' more ';
                        b.style.visibility = 'hidden';
                        b.style.display = 'none';
                    }
                
                    return false;
                }
                            
            </script>"
        );
    }
    
    public static function html( $subject = NULL, $name = '' ) {

        
        if( self::$printCount == 0 ) {
            echo( self::getStyle() );
        }
        
        
        $myId = self::newId();
        echo "<div class=\"upm\">";
        echo    "<div class=\"upt\" id=\"$myId\"><strong>$name</strong>";
        echo        "<a title=\"Toggle Height\" class=\"uptbn\" id=\"hbtn_$myId\" href=\"\" onclick=\"javascript: return toggleCHt('$myId');\">_</a>";
        echo        "<br class=\"clear\"/>";
        echo    "</div>";
        echo    "<div class=\"upo\" id=\"v_$myId\">";
        echo        "<div class=\"uph\" id=\"c_$myId\">";
        self::_printRec( $subject );
        echo        "</div>";
        echo    "</div>";
        echo "</div>";
        
        if( self::$printCount == 0 ) {
            echo( self::getJavaScript() );
        }
        self::$printCount++;
    }

    private static function _printRec( &$subject, $l = 0 ) {
        $c = 0;
        if( is_object( $subject ) ) {
            $toArrayUsed = false;
            if( false && method_exists( $subject, 'toArray' ) ) {
                $sub = $subject->toArray();
                $toArrayUsed = '.toArray()';
            } else {
                $sub = (array) $subject;
            }
            $count = count( $sub );
            if( $count == 0 ) {
                echo "<span class=\"obj\">Object</span> <<span class=\"cla\">". get_class( $subject ). "</span>> $toArrayUsed ( EMPTY ) <br/>";
            } else {
                $c= 0;
                $myId = self::newId();
                echo "<span class=\"obj\">Object</span> <<span class=\"cla\">". get_class( $subject ). "</span>> $toArrayUsed ( <a title=\"$count\" href=\"#\" onclick=\"javascript: return toggleSm('$myId');\" id=\"btn".$myId."\">&minus;</a><span title=\"Level $l\" class=\"count\" id=\"bt".$myId."\">&larr; $count</span>";
                echo "<div class=\"osm\" id=\"$myId\">";
                foreach( $sub as $key => &$val ) {
                    echo '.<span class="var">';
                    if ($key{0} == "\0") {
                        $keyParts = explode("\0", $key);
                        echo $keyParts[2];
                        echo (($keyParts[1] == '*')  ? '<span class="pro">:protected</span>' : '<span class="pri">:private</span>');
                    } else {
                        echo $key;
                    }           
                    echo '</span> <span class="prw">&rsaquo;</span> ';
                    $c += self::_printRec( $val, $l+1 );
                }
                echo "</div> ) <span class=\"count\">&Sigma; $c</span> <br/>";
            }
        } elseif ( is_array($subject) ) {
            $count = count( $subject );
            if( $count == 0 ) {
                echo "<span class=\"arr\">Array</span> ( EMPTY ) <br/>";
            } else {
                $c = 0;
                $myId = self::newId();
                echo "<span class=\"arr\">Array</span> ( <a title=\"$count\" href=\"#\" onclick=\"javascript: return toggleSm('$myId');\" id=\"btn".$myId."\">&minus;</a><span title=\"Level $l\" class=\"count\" id=\"bt".$myId."\">&larr; $count</span>";
                echo "<div class=\"asm\" id=\"$myId\">";
                foreach ($subject as $key => &$val) {
                    if( is_integer( $key ) ) {
                        echo '[<span class="ark">' . $key . '</span>]';
                    } else {
                        echo '[<span class="ark" style="color: #684">\'' . $key . '\'</span>]';
                    }
                    echo ' <span class="prw">&rsaquo;</span> ';
                    $c += self::_printRec( $val, $l+1 );
                }
                echo "</div> ) <span class=\"count\">&Sigma; $c</span> <br/>";              
            }

        } else {
            $c = 1;
            if( NULL === $subject ) {
                echo "<span class=\"nul\">NULL";
            } elseif( is_bool( $subject ) ) {
                echo "<span class=\"boo\">". ( $subject == TRUE ? 'TRUE' : 'FALSE' );
            } elseif( is_string( $subject ) ) {
                echo "<span class=\"str\">'" . htmlspecialchars( $subject ) . "'";
            } elseif( is_integer( $subject ) || is_double( $subject ) ) {
                echo "<span class=\"int\">$subject";
            } else {
                echo "<span class=\"udt\">$subject (". gettype($subject). ")";
            }
            echo "</span> <br/>";
        }
        return $c;
    }

}
