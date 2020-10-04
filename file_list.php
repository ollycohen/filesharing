<!-- Lists the names of all the files uploaded previously by the user 
     inspired by https://www.php.net/manual/en/class.directoryiterator.php -->
<?php
$dirname = "/srv/m2/uploads/" . $_SESSION["user"] . "/";
$dir = new DirectoryIterator(dirname($dirname . "file"));
?>
<table id="files" class ="table">
    <?php
    foreach ($dir as $fileinfo) {
        if (!$fileinfo->isDot()) {
    ?>
            <tr>
                <th>
                    <?php echo htmlspecialchars($fileinfo->getFilename()); ?>
                </th>
                <th>
                    <form action="display.php" method="POST" target="_blank">
                        <input type="hidden" name="filename" value="<?php echo htmlspecialchars($dirname . $fileinfo->getFilename()) ?>" />
                        <input type="submit" value="view/download" class="btn btn-dark"/>
                    </form>
                </th>
                <th>
                    <form action="delete.php" method="POST">
                        <input type="hidden" name="filename" value="<?php echo htmlspecialchars($dirname . $fileinfo->getFilename()) ?>" />
                        <input type="submit" value="delete" class="btn btn-dark"/>
                    </form>
                </th>
            </tr>
    <?php
        }
    }
    ?>
</table>
<br><br>