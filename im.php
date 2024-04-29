<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Display Images</title>
</head>
<body>
    <!-- Gallery to display images -->
    <div class="gallery">
        <?php
        // Directory path
        $directory = "view/uploads";

        // Get all image files from the directory
        $images = glob($directory . "/*.{jpg,png,gif,jpeg}", GLOB_BRACE);

        // Check if images exist
        if ($images) {
            // Loop through each image file and generate <img> tag
            foreach ($images as $image) {
                // Output <img> tag with the image source
                echo '<img src="' . $image . '" alt="Uploaded Image">';
            }
        } else {
            // Output a message if no images found
            echo "No images found in the directory: " . $directory;
        }
        ?>
    </div>
</body>
</html>
