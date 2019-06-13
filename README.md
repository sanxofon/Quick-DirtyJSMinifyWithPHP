# Quick &amp; dirty Javascript minify with PHP

You can edit your javascript code and it will be deployed minified.

### See **[example.php](example.php)**

## Simple & to the point:

    <?php
    ob_start();
    ?>
    
    /*
    Your Javascript Code Here
    */
    
    <?php
    $js = trim(ob_get_contents());
    ob_end_clean();
    $jsm = preg_replace('/\/\*[^\*]*\*\//i', '', $js);
    $js = explode("\n",trim($js));
    $jsm = explode("\n",trim($jsm));
    $jso=array();
    foreach ($jsm as $l) {
      $l = explode('//',$l,2);
      $l = trim($l[0]);
      $l = preg_replace('/([,;=\:\)\{\}]) /i', '\1', $l);
      $l = preg_replace('/ ([=\:\(\{\}])/i', '\1', $l);
      if (!empty($l))$jso[]=$l;
    }
    echo implode("", $jso);
    ?>
