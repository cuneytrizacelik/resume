<?

class palette {


  public static $_themes = array(
    1 => array('655643','80bca3','fbfbe0','e6ac27','bf4d28'),
    2 => array('e8ddcb','cdb380','036564','033649','031634'),
    3 => array('fd6162','ff7f66','ff9f88','587289','f4e4cd'),
    4 => array('fee2d4','fbc596','f6883b','371a0a','57974d')
  );

  private static $_t = false;

  public static function i($file, $theme=1) {

    $factory = new palette();
    $factory->_t = self::$_themes[$theme];

    return $factory->parse($file);

  }

  public function parse($file) {

    $css = file_get_contents($file);

    for ($i = 0, $max = count($this->_t); $i != $max; $i++) {
      $css = str_replace('$'.($i+1), '#'.$this->_t[$i], $css);
      $css = str_replace('!'.($i+1), $this->rgb($this->_t[$i]), $css);
    }

    return $css;

  }

  private function rgb($hex) {

    $rgb = array();
    for ($x = 0; $x < 3; $x++){
      $rgb[$x] = hexdec(substr($hex,(2*$x),2));
    }

    return implode(', ', $rgb);

  }

}
