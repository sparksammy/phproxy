<?php 

if (basename(__FILE__) == basename($_SERVER['PHP_SELF']))
{
    exit(0);
}

echo '<?xml version="1.0" encoding="utf-8"?>';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
<head>
  <title>01010000 01110010 01101111 01111000 01111001 </title>
  <link rel="stylesheet" type="text/css" href="./files/css/style.css" title="Default Theme" media="all" />
</head>
<body onload="document.getElementById('address_box').focus()">
<div id="container">
  <h1 id="title">01010000 01110010 01101111 01111000 01111001 </h1>
  <ul id="navigation">
    <li><a href="<?php echo $GLOBALS['_script_base'] ?>">URL Form</a></li>
    <li><a href="javascript:alert('cookie managment has not been implemented yet')">Manage Cookies</a></li>
  </ul>
<?php

switch ($data['category'])
{
    case 'auth':
?>
  <div id="auth"><p>
  <b>Enter your username and password for "<?php echo htmlspecialchars($data['realm']) ?>" on <?php echo $GLOBALS['_url_parts']['host'] ?></b>
  <form method="post" action="">
    <input type="hidden" name="<?php echo $GLOBALS['_config']['basic_auth_var_name'] ?>" value="<?php echo base64_encode($data['realm']) ?>" />
    <label>Username <input type="text" name="username" value="" /></label> <label>Password <input type="password" name="password" value="" /></label> <input type="submit" value="Login" />
  </form></p></div>
<?php
        break;
    case 'error':
        echo '<div id="error"><p>';
        
        switch ($data['group'])
        {
            case 'url':
                echo '<b>URL Error (' . $data['error'] . ')</b>: ';
                switch ($data['type'])
                {
                    case 'internal':
                        $message = 'Failed to connect to the specified host. '
                                 . 'Possible problems are that the server was not found, the connection timed out, or the connection refused by the host. '
                                 . 'Try connecting again and check if the address is correct.';
                        break;
                    case 'external':
                        switch ($data['error'])
                        {
                            case 1:
                                $message = 'The URL you\'re attempting to access is blacklisted by this server. Please select another URL.';
                                break;
                            case 2:
                                $message = 'The URL you entered is malformed. Please check whether you entered the correct URL or not.';
                                break;
                        }
                        break;
                }
                break;
            case 'resource':
                echo '<b>Resource Error:</b> ';
                switch ($data['type'])
                {
                    case 'file_size':
                        $message = 'The file your are attempting to download is too large.<br />'
                                 . 'Maxiumum permissible file size is <b>' . number_format($GLOBALS['_config']['max_file_size']/1048576, 2) . ' MB</b><br />'
                                 . 'Requested file size is <b>' . number_format($GLOBALS['_content_length']/1048576, 2) . ' MB</b>';
                        break;
                    case 'hotlinking':
                        $message = 'It appears that you are trying to access a resource through this proxy from a remote Website.<br />'
                                 . 'For security reasons, please use the form below to do so.';
                        break;
                }
                break;
        }
        
        echo 'An error has occured while trying to browse through the proxy. <br />' . $message . '</p></div>';
        break;
}
?>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <ul id="form">
      <li id="address_bar"><label>Web Address <input id="address_box" type="text" name="<?php echo $GLOBALS['_config']['url_var_name'] ?>" value="<?php echo isset($GLOBALS['_url']) ? htmlspecialchars($GLOBALS['_url']) : '' ?>" onfocus="this.select()" /></label> <input id="go" type="submit" value="Go" /></li>
      <?php
      
      foreach ($GLOBALS['_flags'] as $flag_name => $flag_value)
      {
          if (!$GLOBALS['_frozen_flags'][$flag_name])
          {
              echo '<li class="option"><label><input type="checkbox" name="' . $GLOBALS['_config']['flags_var_name'] . '[' . $flag_name . ']"' . ($flag_value ? ' checked="checked"' : '') . ' />' . $GLOBALS['_labels'][$flag_name][1] . '</label></li>' . "\n";
          }
      }
      ?>
    </ul>
  </form>
  <div id="footer"><a href="https://phproxy.github.io">01010000 01110010 01101111 01111000 01111001 00100000 00101101 00100000 01100010 01111001 00100000 01010011 01001100 01001100 01001111 01010010 01000100  </a></div>
</div>
</body>
</html>
