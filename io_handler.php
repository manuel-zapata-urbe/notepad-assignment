<?php
$BASE_DIRECTORY = 'created';

if (!is_file($BASE_DIRECTORY)) mkdir($BASE_DIRECTORY);

$fileName = $_POST['fileName'];
$directoryName = $_POST['directoryName'];

$files = array();

if (!empty($fileName) || !empty($directoryName)) {
  $errorMessage = null;
  $fileName &&  file_put_contents($BASE_DIRECTORY . '/' . $fileName . '.txt', '');
  $directoryName && mkdir($BASE_DIRECTORY . '/' . $directoryName);

  foreach (scandir($BASE_DIRECTORY) as $file) {
    if ($file !== '.' && $file !== '..') {
      $files[] = $file;
    }
  }
} else {
  $errorMessage = 'Debe ingresar algo, nombre de archivo, directorio o ambos.';
}

function ends_with($string, $stringEnd) {
  $stringEndCount = strlen($stringEnd);

  if ($stringEndCount == 0)  return true;

  return (substr($string, -$stringEndCount) == $stringEnd);
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <link href='https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css' rel='stylesheet'>
  <title>Bloc de Notas</title>
</head>
<div class='w-9/12 m-auto p-2'>
  <div class='text-center border-2 border-green-300 rounded-md m-5 p-3'>
    <?php if (isset($errorMessage)) : ?>
      <h2 class='text-xl my-7'>An <strong class='text-green-500'>error</strong> occured in the request.</h2>
      <p><?php echo $errorMessage; ?></p>
    <?php else : ?>
      <h2 class='text-xl my-7'>
        Created <strong class='text-green-500'>files</strong> and <strong class='text-green-500'>directories</strong>.
      </h2>
      <?php
      echo '<ul class="list-disc w-4/12 text-left m-auto">';
      foreach ($files as $created) {
        if (ends_with($created, '.txt')) {
          echo '<li> <strong class="text-green-500">FILE</strong> - "' . $created . '"</li>';
        } else {
          echo '<li> <strong class="text-green-500">DIRECTORY</strong> - "' . $created . '"</li>';
        }
      }
      echo '</ul>';
      ?>
    <?php endif; ?>
  </div>
</div>

</html>