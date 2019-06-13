<html>
<head>
  <title>Quick minify Javascript on the fly with PHP</title>
  <style>
    * {
      font-family: 'Courier New', Courier, monospace;
    }
    body {
      background-color: #404040;
      color: #dddddd;
    }

    #fooObject {
      position:absolute;
      left:0px;
      top:8em;
      width:5em;
      background: orange;
      color:#000;
      border:2px solid #000;
      text-align: center;
      padding: 10px;
      border-radius: 100%;
    }
  </style>
  <script type="text/javascript">
  <!--

<?php
$minify=true;
if ($minify)ob_start();
?>

var foo = null; // object

function doMove() {
  foo.style.left = parseInt(foo.style.left)+1+'px';
  setTimeout(doMove,20); // call doMove in 20msec
}

function init() {
  foo = document.getElementById('fooObject'); // get the "foo" object
  foo.style.left = '0px'; // set its initial position to 0px
  doMove(); // start animating
}
/*
Here is a multiline comment
and it continues...
*/
window.onload = init;

<?php 
if ($minify) {
  $js = trim(ob_get_contents());
  $jsm = preg_replace('/\/\*[^\*]*\*\//i', '', $js);
  $js = explode("\n",trim($js));
  $jsm = explode("\n",trim($jsm));
  $jso=array();
  ob_end_clean();
  foreach ($jsm as $l) {
    $l = explode('//',$l,2);
    $l = trim($l[0]);
    $l = preg_replace('/([,;=\:\)\{\}]) /i', '\1', $l);
    $l = preg_replace('/ ([=\:\(\{\}])/i', '\1', $l);
    if (!empty($l))$jso[]=$l;
  }
  echo implode("", $jso);
}
?>

  -->
  </script>
</head>
<body>

  <div style="max-width: 640px;margin: 0 auto;">
    <h1>Quick minify JS on th fly with PHP</h1>

    <div id="fooObject">
     Hello!
    </div>
<?php 
if ($minify) {
?>
    <h4>Your code</h4>
    <textarea readonly="readonly" style="width: 100%;height:400px;"><?php echo implode("\n",$js); ?></textarea>
    <h4>Minified code</h4>
    <textarea readonly="readonly" style="width: 100%;height:130px;"><?php echo implode("",$jso); ?></textarea>
<?php 
}
?>
  </div>
</body>
</html>
