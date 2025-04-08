<?php
function already_exist($dataExist,$redirection){
    echo '<script>alert("'.$dataExist.' already exist\n\nUse another.") </script>';
    echo '<script>location.href="'.$redirection.'"</script>';
}

?>